<?php
/**
 * MediaWiki Wikilog extension
 * Copyright © 2008, 2009 Juliano F. Ravasi
 * http://www.mediawiki.org/wiki/Extension:Wikilog
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 * http://www.gnu.org/copyleft/gpl.html
 */

/**
 * @addtogroup Extensions
 * @author Juliano F. Ravasi < dev juliano info >
 */

if ( !defined( 'MEDIAWIKI' ) )
	die();

/**
 * Common wikilog pager interface.
 */
interface WikilogPager
{
	function including( $x = NULL );
	function getNavigationBar( $class = 'wl-navbar-any' );
}

/**
 * Summary pager.
 *
 * Lists wikilog articles from one or more wikilogs (selected by the provided
 * query parameters) in reverse chronological order, displaying article
 * sumaries, authors, date and number of comments. This pager also provides
 * a "read more" link when appropriate. If there are more articles than
 * some threshold, the user may navigate through "newer posts"/"older posts"
 * links.
 *
 * Formatting is controlled by a number of system messages.
 */
class WikilogSummaryPager
	extends ReverseChronologicalPager
	implements WikilogPager
{
	# Override default limits.
	public $mLimitsShown = array( 5, 10, 20, 50 );

	# Local variables.
	protected $mQuery = NULL;			///< Wikilog item query data
	protected $mIncluding = false;		///< If pager is being included

	/**
	 * Constructor.
	 * @param $query Query object, containing the parameters that will select
	 *   which articles will be shown.
	 * @param $limit Override how many articles will be listed.
	 */
	function __construct( WikilogItemQuery $query, $limit = false, $including = false ) {
		# WikilogItemQuery object drives our queries.
		$this->mQuery = $query;
		$this->mIncluding = $including;

		# Parent constructor.
		parent::__construct();

		# Fix our limits, Pager's defaults are too high.
		global $wgUser, $wgWikilogNumArticles;
		$this->mDefaultLimit = intval( $wgUser->getOption( 'searchlimit' ) );

		if ( $limit ) {
			$this->mLimit = $limit;
		} else {
			list( $this->mLimit, /* $offset */ ) =
				$this->mRequest->getLimitOffset( $wgWikilogNumArticles, 'searchlimit' );
		}

		# This is too expensive, limit listing.
		global $wgWikilogSummaryLimit;
		if ( $this->mLimit > $wgWikilogSummaryLimit )
			$this->mLimit = $wgWikilogSummaryLimit;

		# We will need a clean parser if not including.
		global $wgParser;
		if ( !$this->mIncluding ) {
			$wgParser->clearState();
		}
	}

	/**
	 * Property accessor/mutators.
	 */
	function including( $x = NULL ) { return wfSetVar( $this->mIncluding, $x ); }

	function getQueryInfo() {
		return $this->mQuery->getQueryInfo( $this->mDb );
	}

	function getDefaultQuery() {
		return parent::getDefaultQuery() + $this->mQuery->getDefaultQuery();
	}

	function getIndexField() {
		return 'wlp_pubdate';
	}

	function getStartBody() {
		return "<div class=\"wl-roll visualClear\">\n";
	}

	function getEndBody() {
		return "</div>\n";
	}

	function getEmptyBody() {
		return '<div class="wl-empty">' . wfMsgExt( 'wikilog-pager-empty', array( 'parsemag' ) ) . "</div>";
	}

	function getNavigationBar( $class = 'wl-navbar-any' ) {
		if ( !isset( $this->mNavigationBar[$class] ) ) {
			global $wgLang;

			$nicenumber = $wgLang->formatNum( $this->mLimit );
			$linkTexts = array(
				'prev'	=> wfMsgExt( 'wikilog-pager-newer-n', array( 'parsemag' ), $nicenumber ),
				'next'	=> wfMsgExt( 'wikilog-pager-older-n', array( 'parsemag' ), $nicenumber ),
				'first'	=> wfMsgHtml( 'wikilog-pager-newest' ),
				'last'	=> wfMsgHtml( 'wikilog-pager-oldest' )
			);
			$pagingLinks = $this->getPagingLinks( $linkTexts );
			$limitLinks = $this->getLimitLinks();

			$limits = implode( ' | ', $limitLinks );
			$classes = implode( ' ', array( 'wl-navbar', $class ) );

			$this->mNavigationBar[$class] = wfMsgExt( 'wikilog-navigation-bar',
				array( 'parsemag' ),
				/* $1 */ $pagingLinks['first'],
				/* $2 */ $pagingLinks['prev'],
				/* $3 */ $pagingLinks['next'],
				/* $4 */ $pagingLinks['last'],
				/* $5 */ $limits,
				/* $6 */ $classes
			);
		}
		return $this->mNavigationBar[$class];
	}

	function formatRow( $row ) {
		global $wgUser, $wgContLang;

		$skin = $this->getSkin();

		# Retrieve article parser output and other data.
		$item = WikilogItem::newFromRow( $row );
		list( $article, $parserOutput ) = WikilogUtils::parsedArticle( $item->mTitle );
		list( $summary, $content ) = WikilogUtils::splitSummaryContent( $parserOutput );

		# Some general data.
		$authors = WikilogUtils::authorList( array_keys( $item->mAuthors ) );
		$pubdate = $wgContLang->timeanddate( $item->getPublishDate(), true );
		$comments = WikilogUtils::getCommentsWikiText( $item );

		# Entry div class.
		$divclass = 'wl-entry' . ( $item->getIsPublished() ? '' : ' wl-draft' );
		$result = "<div class=\"{$divclass} visualClear\">";

		# Edit section link.
		if ( $item->mTitle->quickUserCan( 'edit' ) ) {
			$result .= $this->editLink( $item->mTitle );
		}

		# Title heading, with link.
		$heading = $skin->makeKnownLinkObj( $item->mTitle, $item->mName .
			( $item->getIsPublished() ? '' : ' ' . wfMsgForContent( 'wikilog-draft-title-mark' ) ) );
		$result .= "<h2>{$heading}</h2>\n";

		# Item header.
		$msg = wfMsgForContentNoTrans( 'wikilog-item-brief-header',
			/* $1 */ $item->mParentTitle->getPrefixedURL(),
			/* $2 */ $item->mParentName,
			/* $3 */ $item->mTitle->getPrefixedURL(),
			/* $4 */ $item->mName,
			/* $5 */ $authors,
			/* $6 */ $pubdate,
			/* $7 */ $comments
		);
		if ( !empty( $msg ) ) {
			$result .= $this->parse( $msg . "\n" );
		}

		# Item text.
		if ( $summary ) {
			$more = $this->parse( wfMsgForContentNoTrans( 'wikilog-item-more',
				/* $1 */ $item->mParentTitle->getPrefixedURL(),
				/* $2 */ $item->mParentName,
				/* $3 */ $item->mTitle->getPrefixedURL(),
				/* $4 */ $item->mName
			) );
			$result .= "<div class=\"wl-summary\">{$summary}\n{$more}\n</div>\n";
		} else {
			$result .= "<div class=\"wl-summary\">{$content}</div>\n";
		}

		# Item footer.
		$msg = wfMsgForContentNoTrans( 'wikilog-item-brief-footer',
			/* $1 */ $item->mParentTitle->getPrefixedURL(),
			/* $2 */ $item->mParentName,
			/* $3 */ $item->mTitle->getPrefixedURL(),
			/* $4 */ $item->mName,
			/* $5 */ $authors,
			/* $6 */ $pubdate,
			/* $7 */ $comments
		);
		if ( !empty( $msg ) ) {
			$result .= $this->parse( $msg . "\n" );
		}

		$result .= "</div>\n\n";
		return $result;
	}

	/**
	 * Parse a given wikitext and returns the resulting HTML fragment.
	 * Uses either $wgParser->recursiveTagParse() or $wgParser->parse()
	 * depending whether the content is being included in another
	 * article. Note that the parser state can't be reset, or it will
	 * break the parser output.
	 * @param $text Wikitext that should be parsed.
	 * @return Resulting HTML fragment.
	 */
	protected function parse( $text ) {
		global $wgTitle, $wgParser, $wgOut;
		if ( $this->mIncluding ) {
			return $wgParser->recursiveTagParse( $text );
		} else {
			$popts = $wgOut->parserOptions();
			$output = $wgParser->parse( $text, $wgTitle, $popts, true, false );
			return $output->getText();
		}
	}

	/**
	 * Returns a wikilog article edit link, much similar to a section edit
	 * link in normal articles.
	 * @param $title Wikilog article title object.
	 * @return HTML fragment.
	 */
	private function editLink( $title ) {
		$skin = $this->getSkin();
		$url = $skin->makeKnownLinkObj( $title, wfMsg( 'wikilog-edit-lc' ), 'action=edit' );
		$result = wfMsg( 'editsection-brackets', $url );
		return "<span class=\"editsection\">$result</span>";
	}
}

/**
 * Template pager.
 *
 * Lists wikilog articles like #WikilogSummaryPager, but using a given
 * template to format the summaries. The template receives the article
 * data through its parameters:
 *
 * - 'class': div element class attribute
 * - 'wikilogTitle': title (as text) of the wikilog page
 * - 'wikilogPage': title (prefixed, for link) of the wikilog page
 * - 'title': title (as text) of the article page
 * - 'page': title (prefixed, for link) of the article page
 * - 'authors': authors
 * - 'tags': tags
 * - 'published': empty (draft) or "*" (published)
 * - 'pubdate': article publication date
 * - 'updated': article last update date
 * - 'summary': article summary
 * - 'comments': comments page link
 */
class WikilogTemplatePager
	extends WikilogSummaryPager
{
	protected $mTemplate, $mTemplateTitle;

	/**
	 * Constructor.
	 */
	function __construct( WikilogItemQuery $query, Title $template, $limit = false, $including = false ) {
		global $wgParser;

		# Parent constructor.
		parent::__construct( $query, $limit, $including );

		# Load template
		list( $this->mTemplate, $this->mTemplateTitle ) =
			$wgParser->getTemplateDom( $template );
		if ( $this->mTemplate === false )
			$this->mTemplate = "[[:$template]]";
	}

	function getDefaultQuery() {
		$query = parent::getDefaultQuery();
		$query['template'] = $this->mTemplateTitle->getPartialURL();
		return $query;
	}

	function getStartBody() {
		return "<div class=\"wl-tpl-roll\">\n";
	}

	function getEndBody() {
		return "</div>\n";
	}

	function formatRow( $row ) {
		global $wgParser, $wgContLang;

		# Retrieve article parser output and other data.
		$item = WikilogItem::newFromRow( $row );
		list( $article, $parserOutput ) = WikilogUtils::parsedArticle( $item->mTitle );
		list( $summary, $content ) = WikilogUtils::splitSummaryContent( $parserOutput );
		if ( !$summary ) $summary = $content;

		# Some general data.
		$authors = WikilogUtils::authorList( array_keys( $item->mAuthors ) );
		$tags = implode( wfMsgForContent( 'comma-separator' ), array_keys( $item->mTags ) );
		$pubdate = $wgContLang->timeanddate( $item->getPublishDate(), true );
		$updated = $wgContLang->timeanddate( $item->getUpdatedDate(), true );
		$comments = WikilogUtils::getCommentsWikiText( $item );
		$divclass = 'wl-entry' . ( $item->getIsPublished() ? '' : ' wl-draft' );

		# Template parameters.
		$vars = array(
			'class'         => $divclass,
			'wikilogTitle'  => $item->mParentName,
			'wikilogPage'   => $item->mParentTitle->getPrefixedText(),
			'title'         => $item->mName,
			'page'          => $item->mTitle->getPrefixedText(),
			'authors'       => $authors,
			'tags'          => $tags,
			'published'     => $item->getIsPublished() ? '*' : '',
			'pubdate'       => $pubdate,
			'updated'       => $updated,
			'summary'       => $wgParser->insertStripItem( $summary ),
			'comments'      => $comments
		);

		$frame = $wgParser->getPreprocessor()->newCustomFrame( $vars );

		# XXX: Work around MediaWiki bug 20431
		# https://bugzilla.wikimedia.org/show_bug.cgi?id=20431
		$frame->title = $frame->parser->mTitle;
		$frame->titleCache = array( $frame->title ? $frame->title->getPrefixedDBkey() : false );

		$text = $frame->expand( $this->mTemplate );

		return $this->parse( $text );
	}
}

/**
 * Archives pager.
 *
 * Lists wikilog articles in a table, with date, authors, wikilog and
 * title, without summaries, for easy navigation through large amounts of
 * articles.
 */
class WikilogArchivesPager
	extends TablePager
	implements WikilogPager
{
	# Local variables.
	protected $mQuery = NULL;			///< Wikilog item query data
	protected $mIncluding = false;		///< If pager is being included

	/**
	 * Constructor.
	 */
	function __construct( WikilogItemQuery $query, $including = false ) {
		# WikilogItemQuery object drives our queries.
		$this->mQuery = $query;
		$this->mIncluding = $including;

		# Parent constructor.
		parent::__construct();
	}

	/**
	 * Property accessor/mutators.
	 */
	function including( $x = NULL ) { return wfSetVar( $this->mIncluding, $x ); }

	function getQueryInfo() {
		return $this->mQuery->getQueryInfo( $this->mDb );
	}

	function getDefaultQuery() {
		$query = parent::getDefaultQuery() + $this->mQuery->getDefaultQuery();
		$query['view'] = 'archives';
		return $query;
	}

	function getTableClass() {
		return 'wl-archives TablePager';
	}

	function isFieldSortable( $field ) {
		static $sortableFields = array(
			'wlp_pubdate',
			'wlp_updated',
			'wlw_title',
			'wlp_title',
		);
		return in_array( $field, $sortableFields );
	}

	function getNavigationBar( $class = 'wl-navbar-any' ) {
		if ( !isset( $this->mNavigationBar[$class] ) ) {
			global $wgLang;

			$nicenumber = $wgLang->formatNum( $this->mLimit );
			$linkTexts = array(
				'prev'	=> wfMsgHtml( 'wikilog-pager-prev' ),
				'next'	=> wfMsgHtml( 'wikilog-pager-next' ),
				'first'	=> wfMsgHtml( 'wikilog-pager-first' ),
				'last'	=> wfMsgHtml( 'wikilog-pager-last' )
			);
			$pagingLinks = $this->getPagingLinks( $linkTexts );
			$limitLinks = $this->getLimitLinks();

			$limits = implode( ' | ', $limitLinks );
			$classes = implode( ' ', array( 'wl-navbar', $class ) );

			$this->mNavigationBar[$class] = wfMsgExt( 'wikilog-navigation-bar',
				array( 'parsemag' ),
				/* $1 */ $pagingLinks['first'],
				/* $2 */ $pagingLinks['prev'],
				/* $3 */ $pagingLinks['next'],
				/* $4 */ $pagingLinks['last'],
				/* $5 */ $limits,
				/* $6 */ $classes
			);
		}
		return $this->mNavigationBar[$class];
	}

	function formatRow( $row ) {
		$attribs = array();
		$columns = array();
		$this->mCurrentRow = $row;
		$this->mCurrentItem = WikilogItem::newFromRow( $row );
		if ( !$this->mCurrentItem->getIsPublished() ) {
			$attribs['class'] = 'wl-draft';
		}
		foreach ( $this->getFieldNames() as $field => $name ) {
			$value = isset( $row->$field ) ? $row->$field : null;
			$formatted = strval( $this->formatValue( $field, $value ) );
			if ( $formatted == '' ) {
				$formatted = '&nbsp;';
			}
			$class = 'TablePager_col_' . htmlspecialchars( $field );
			$columns[] = "<td class=\"$class\">$formatted</td>";
		}
		return Xml::tags( 'tr', $attribs, implode( "\n", $columns ) ) . "\n";
	}

	function formatValue( $name, $value ) {
		global $wgContLang;

		switch ( $name ) {
			case 'wlp_pubdate':
				$s = $wgContLang->timeanddate( $value, true );
				if ( !$this->mCurrentRow->wlp_publish ) {
					$s = Xml::wrapClass( $s, 'wl-draft-inline' );
				}
				return $s;

			case 'wlp_updated':
				return $value;

			case 'wlp_authors':
				return $this->authorList( $this->mCurrentItem->mAuthors );

			case 'wlw_title':
				$page = $this->mCurrentItem->mParentTitle;
				$text = $this->mCurrentItem->mParentName;
				return $this->getSkin()->makeKnownLinkObj( $page, $text );

			case 'wlp_title':
				$page = $this->mCurrentItem->mTitle;
				$text = $this->mCurrentItem->mName;
				$s = $this->getSkin()->makeKnownLinkObj( $page, $text );
				if ( !$this->mCurrentRow->wlp_publish ) {
					$draft = wfMsg( 'wikilog-draft-title-mark' );
					$s = Xml::wrapClass( "$s $draft", 'wl-draft-inline' );
				}
				return $s;

			case 'wlp_num_comments':
				$page = $this->mCurrentItem->mTitle->getTalkPage();
				$text = $this->mCurrentItem->getNumComments();
				return $this->getSkin()->makeKnownLinkObj( $page, $text );

			case '_wl_actions':
				if ( $this->mCurrentItem->mTitle->quickUserCan( 'edit' ) ) {
					return $this->editLink( $this->mCurrentItem->mTitle );
				} else {
					return '';
				}

			default:
				return htmlentities( $value );
		}
	}

	function getDefaultSort() {
		return 'wlp_pubdate';
	}

	function getFieldNames() {
		global $wgWikilogEnableComments;

		$fields = array();

		$fields['wlp_pubdate']			= wfMsgHtml( 'wikilog-published' );
 		// $fields['wlp_updated']			= wfMsgHtml( 'wikilog-updated' );
		$fields['wlp_authors']			= wfMsgHtml( 'wikilog-authors' );

		if ( !$this->mQuery->isSingleWikilog() )
			$fields['wlw_title']		= wfMsgHtml( 'wikilog-wikilog' );

		$fields['wlp_title']			= wfMsgHtml( 'wikilog-title' );

		if ( $wgWikilogEnableComments )
			$fields['wlp_num_comments']	= wfMsgHtml( 'wikilog-comments' );

		$fields['_wl_actions']			= wfMsgHtml( 'wikilog-actions' );
		return $fields;
	}

	/**
	 * Formats the given list of authors into a textual comma-separated list.
	 * @param $list Array with wikilog article author information.
	 * @return Resulting HTML fragment.
	 */
	private function authorList( $list ) {
		if ( is_string( $list ) ) {
			return $this->authorLink( $list );
		}
		else if ( is_array( $list ) ) {
			$list = array_keys( $list );
			return implode( ', ', array_map( array( &$this, 'authorLink' ), $list ) );
		}
		else {
			return '';
		}
	}

	/**
	 * Formats an author user page link.
	 * @param $name Username of the author.
	 * @return Resulting HTML fragment.
	 */
	private function authorLink( $name ) {
		$skin = $this->getSkin();
		$title = Title::makeTitle( NS_USER, $name );
		return $skin->makeLinkObj( $title, $name );
	}

	/**
	 * Returns a wikilog article edit link for the actions column of the table.
	 * @param $title Wikilog article title object.
	 * @return HTML fragment.
	 */
	private function editLink( $title ) {
		$skin = $this->getSkin();
		$url = $skin->makeKnownLinkObj( $title, wfMsg( 'wikilog-edit-lc' ), 'action=edit' );
		return wfMsg( 'wikilog-brackets', $url );
	}
}
