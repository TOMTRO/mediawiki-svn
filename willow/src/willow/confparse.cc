/* This code is in the public domain.
 * $Id$
 */

#include <vector>
#include <string>
#include <utility>
#include <cstdarg>
#include <cerrno>
using std::string;
using std::vector;
using std::make_pair;

#define NEED_PARSING_TREE

#include "confparse.h"
#include "willow.h"
#include "wlog.h"
#include "wbackend.h"
#include "wconfig.h"

namespace conf {

tree global_conf_tree;
map<string, value> variable_list;

vector<string> ignorables;
static void add_ignorable(string const &);
static int is_ignorable(string const &);
int parse_error;

int curpos = 0;
int lineno = 0;
string linebuf;
string current_file;
tree parsing_tree;

const int require_name = 0x1;

tree *
parse_file(string const &file)
{
	parsing_tree.reset();
	if ((yyin = fopen(file.c_str(), "r")) == NULL) {
		wlog(WLOG_ERROR, "could not open configuration file %s: %s",
				file.c_str(), strerror(errno));
		return NULL;
	}
	if (yyparse() || parse_error)
		return NULL;
	return &parsing_tree;
}

void
free_newconf_state(void)
{
	variable_list.clear();
}

void
add_variable(value *val)
{
map<string, value>::iterator	it;
	it = variable_list.find(val->cv_name);
	if (it != variable_list.end())
		return;
	variable_list.insert(make_pair(val->cv_name, *val));
}

void
add_variable_simple(string const &name, string const &vval)
{
value	var = declpos();
avalue	aval;
	var.cv_name = name;
	aval.av_type = cv_qstring;
	aval.av_strval = vval;
	var.cv_values.push_back(aval);
	variable_list.insert(make_pair(var.cv_name, var));
}

value *
value_from_variable(string const &name, string const &varname, declpos const &pos)
{
map<string, value>::iterator	it;
value	*val;
	it = variable_list.find(varname);
	if (it == variable_list.end())
		return NULL;
	val = new value(it->second);
	val->cv_pos = pos;
	return val;
}


static void
add_ignorable(std::string const &pat)
{
	ignorables.push_back(pat);
}

static int
is_ignorable(std::string const &pat)
{
	return std::find(ignorables.begin(), ignorables.end(), pat) != ignorables.end();
}


struct if_entry {
	const char	*name;
	bool		 true_;
} if_table[] = {
	{ NULL, false }
};

bool
if_true(std::string const &if_)
{
if_entry	*e;
char const	*dir, *od;
	dir = od = if_.c_str();
	dir += sizeof("%if");
	while (isspace(*dir))
		dir++;

	for (e = if_table; e->name; ++e)
		if (e->name == dir)
			return e->true_;
	conf::report_parse_error("unknown %%if directive \"%s\"", dir);
	return false;
}

void
tree_entry::add(value const &v)
{
value	*existing;
	if ((existing = (*this)/v.cv_name) != NULL) {
		existing->cv_values.insert(
			existing->cv_values.end(),
			v.cv_values.begin(), v.cv_values.end());
		return;
	}
	item_values.insert(make_pair(v.cv_name, v));
}

tree_entry *
tree::find(string const &block, string const &name)
{
vector<tree_entry>::iterator	it, end;
	for (it = entries.begin(), end = entries.end(); it != end; ++it) {
		if (it->item_name == block && (name.empty() || (name == it->item_key))) {
			it->item_touched = true;
			return &*it;
		}
	}
	return NULL;
}

tree_entry *
tree::find(string const &block)
{
	return find(block, "");
}

tree_entry *
tree::find_or_new(
	string const	&block,
	string const	&name,
	declpos const	&pos,
	bool		 unnamed,
	bool		 is_template
) {
tree_entry	*f, n(pos);
	if ((f = find(block, name)) != NULL)
		return f;

	n.item_unnamed = unnamed;
	n.item_name = block;
	n.item_key = name;
	n.item_pos = pos;
	n.item_is_template = is_template;
	entries.push_back(n);
	return &*entries.rbegin();
}

tree_entry *
tree::find_item(tree_entry const &e)
{
	if (e.item_unnamed)
		return find(e.item_name);
	else	return find(e.item_name, e.item_key);
}

tree_entry *
new_tree_entry_from_template(
	tree			&t,
	string const		&block,
	string const		&name,
	string const		&templatename,
	declpos const		&pos,
	bool			 unnamed,
	bool			 is_template
) {
tree_entry	*n, *e;
value		*value;
void		*pp = NULL;
const char	*key;
	if ((e = t.find(block, templatename)) == NULL)
		return e;
	n = t.find_or_new(block, name, pos, unnamed, true);
	n->item_values = e->item_values;
	return n;
}


int
find_untouched(tree &t)
{
int		 i = 0;
const char	*key;
value		*val;
void		*pp = NULL;
vector<tree_entry>::const_iterator	it, end;
map<string, value>::const_iterator	vit, vend;
	for (it = t.entries.begin(), end = t.entries.end(); it != end; ++it) {
		if (it->item_is_template)
			continue;
		if (!it->item_touched) {
			it->report_error("top-level block \"%s\" not recognised", it->item_name.c_str());
			i++;
			continue;
		}
		for (vit = it->item_values.begin(), vend = it->item_values.end(); vit != vend; ++vit) {
		string	name;
			if (vit->second.cv_touched)
				continue;
			if (!it->item_unnamed)
				name = "/" + it->item_name + "=" + it->item_key + "/" + vit->second.cv_name;
			else
				name = "/" + it->item_name + "/" + vit->second.cv_name;
			if (is_ignorable(name))
				continue;
			vit->second.report_error("%s was not recognised", name.c_str());
			i++;
		}
	}
	return i;
}

value *
tree_entry::operator/(string const &name)
{
map<string, value>::iterator	it;
	it = item_values.find(name);
	if (it == item_values.end())
		return NULL;
	it->second.cv_touched = true;
	return &it->second;
}

/*
 * add a new top-level item to the tree.
 */
bool
tree::add(tree_entry const &item)
{
value		*existing;
	/* if the entry already exists, do nothing */
	if (find_item(item) != NULL)
		return false;
	entries.push_back(item);
	return true;
}

void
handle_pragma(string const &pragma)
{
char	*mp, *op, *ap;
	mp = wstrdup(pragma.c_str());
	op = mp;
	if (*mp == '\n')
		++mp;
	/* skip '%pragma ' */
	mp += sizeof("%pragma");
	while (isspace(*mp))
		++mp;

	/* now up to the first space or EOS is the pragma name */
	if ((ap = strchr(mp, ' ')) != NULL)
		*ap++ = '\0';
	if (!strcmp(mp, "ignore_ok")) {
		if (*ap != '"' || ap[strlen(ap) - 1] != '"')
			report_parse_error("%%pragma ignore_ok must be followed by a quoted string");
		else {
		const char	*sp;
			ap++;
			ap[strlen(ap) - 1] = '\0';
			for (sp = ap; *sp; ++sp) {
				if (!(isalnum(*sp) || strchr("_?*/=", *sp)))
					report_parse_error("\"%s\" is not a valid value mask", ap);
				else {
					add_ignorable(ap);
				}
			}
		}	
	} else {
		report_parse_error("unrecognised %%pragma \"%s\"", mp);
	}

	wfree(op);
}

value::value(declpos const &pos)
	: cv_touched(false)
	, cv_pos(pos)
{
}

tree_entry::tree_entry(declpos const &pos)
	: item_pos(pos)
	, item_unnamed(false)
	, item_touched(false)
	, item_is_template(false)
{
}

avalue::avalue()
	: av_intval(0)
	, av_type(0)
{
}

/* public functions */

void
report_parse_error(const char *fmt, ...)
{
va_list	ap;
char	msg[1024] = { 0 };

	parse_error = 1;

	va_start(ap, fmt);
	vsnprintf(msg, sizeof msg, fmt, ap);
	va_end(ap);

	wlog(WLOG_ERROR, "\"%s\", line %d: %s", current_file.c_str(), lineno, msg);
}

void
value::vreport_error(const char *fmt, va_list ap) const
{
char	msg[1024] = { 0 };
	vsnprintf(msg, sizeof msg, fmt, ap);
	wlog(WLOG_ERROR, "%s: %s", cv_pos.format().c_str(), msg);
}

void
value::report_error(const char *fmt, ...) const
{
va_list	ap;
	va_start(ap, fmt);
	vreport_error(fmt, ap);
	va_end(ap);
}

bool
value::is_single(cv_type t) const
{
	return nvalues() == 1 && cv_values[0].av_type == t;
}

size_t
value::nvalues(void) const
{
	return cv_values.size();
}

void
tree_entry::vreport_error(const char *fmt, va_list ap) const
{
char	msg[1024] = { 0 };
	vsnprintf(msg, sizeof msg, fmt, ap);
	wlog(WLOG_ERROR, "%s: %s", item_pos.format().c_str(), msg);
}

void
tree_entry::report_error(const char *fmt, ...) const
{
va_list	ap;
	va_start(ap, fmt);
	vreport_error(fmt, ap);
	va_end(ap);
}

void
catastrophic_error(const char *fmt, ...)
{
char	msg[1024] = { 0 };
va_list	ap;
	va_start(ap, fmt);
	vsnprintf(msg, sizeof msg, fmt, ap);
	va_end(ap);
	wlog(WLOG_ERROR, "\"%s\", line %d: catastrophic error: %s", current_file.c_str(), lineno, msg);
}

extern "C" void
yyerror(const char *err)
{
	wlog(WLOG_ERROR, "\"%s\", line %d: %s", current_file.c_str(), lineno, err);
}

void
tree::reset(void)
{
	entries.clear();
}

bool
find_include(string &file)
{
	return false;
}

block_definer &
conf_definer::block(string const &name, int flags)
{
block_definer *b = new block_definer(*this, name, flags);
	blocks.push_back(b);
	return *b;
}

bool
value_definer::validate(tree_entry &e, value &v)
{
	return (*vv)(e, v);
}

void
value_definer::set(tree_entry &e, value &v)
{
	(*vs)(e, v);
}

block_definer::block_definer(conf_definer &parent_, string const &name_, int flags_)
	: parent(parent_)
	, name(name_)
	, vefn(NULL)
	, sefn(NULL)
	, flags(flags_)
{
}

block_definer &
block_definer::block(string const &name, int flags)
{
	return parent.block(name, flags);
}

bool
block_definer::validate(tree_entry &e)
{
map<string, conf::value>::iterator	it, end;
map<string, value_definer *>::iterator	vit;
bool ret = true;
	for (it = e.item_values.begin(), end = e.item_values.end(); it != end; ++it) {
		vit = values.find(it->first);
		if (vit == values.end())
			continue;
		it->second.cv_touched = true;
		ret = vit->second->validate(e, it->second) && ret;
	}
	if (vefn)
		ret = (*vefn)(e) && ret;
	if ((flags & require_name) && e.item_key.empty()) {
		e.report_error("this block cannot be unnamed");
		ret = false;
	}
	return ret;
}

void
block_definer::set(tree_entry &e)
{
map<string, conf::value>::iterator	it, end;
map<string, value_definer *>::iterator	vit;
	for (it = e.item_values.begin(), end = e.item_values.end(); it != end; ++it) {
		vit = values.find(it->first);
		if (vit == values.end())
			continue;
		vit->second->set(e, it->second);
	}
	if (sefn)
		(*sefn)(e);
}

string
type_name(cv_type t)
{
	switch (t) {
	case cv_string:
		return "string";
	case cv_qstring:
		return "quoted string";
	case cv_yesno:
		return "boolean";
	case cv_int:
		return "integer";
	case cv_time:
		return "time or size";
	default:
		return "unknown type";
	}
}

bool
conf_definer::validate(tree &t) const
{
bool	ret = true;
vector<block_definer *>::const_iterator	bit, bend;
vector<tree_entry>::iterator	tit, tend;
	for (tit = t.entries.begin(), tend = t.entries.end(); tit != tend; ++tit) {
		for (bit = blocks.begin(), bend = blocks.end(); bit != bend; ++bit) {
			if ((*bit)->name == tit->item_name) {
				tit->item_touched = true;
				ret = (*bit)->validate(*tit) && ret;
			}
		}
	}
	if (find_untouched(t))
		return false;
	return ret;
}

void
conf_definer::set(tree &t) const
{
vector<block_definer *>::const_iterator	bit, bend;
vector<tree_entry>::iterator	tit, tend;
	for (tit = t.entries.begin(), tend = t.entries.end(); tit != tend; ++tit) {
		for (bit = blocks.begin(), bend = blocks.end(); bit != bend; ++bit) {
			if ((*bit)->name == tit->item_name) {
				(*bit)->set(*tit);
			}
		}
	}
}
 
} // namespace conf
