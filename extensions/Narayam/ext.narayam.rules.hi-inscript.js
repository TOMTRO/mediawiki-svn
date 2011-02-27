/**
 * InScript regular expression rules table for Devanagari script for Hindi
 * According to CDAC's "Enhanced InScript Keyboard Layout 5.2"
 * @author Junaid P V ([[user:Junaidpv]])
 * @date 2011-02-26
 * License: GPLv3
 */
 
 // Normal rules
var rules = [
['X', '', '\u0901'],
['x', '', '\u0902'],
['_', '', '\u0903'],
['D', '', '\u0905'],
['E', '', '\u0906'],
['F', '', '\u0907'],
['R', '', '\u0908'],
['G', '', '\u0909'],
['T', '', '\u090A'],
['\\+', '', '\u090B'],
['!', '', '\u090D'],
['S', '', '\u090F'],
['W', '', '\u0910'],
['\\|', '', '\u0911'],
['A', '', '\u0913'],
['Q', '', '\u0914'],
['k', '', '\u0915'],
['K', '', '\u0916'],
['i', '', '\u0917'],
['I', '', '\u0918'],
['U', '', '\u0919'],
[';', '', '\u091A'],
['\\:', '', '\u091B'],
['p', '', '\u091C'],
['P', '', '\u091D'],
['\\}', '', '\u091E'],
["'", '', '\u091F'],
['"', '', '\u0920'],
['\\[', '', '\u0921'],
['\\{', '', '\u0922'],
['C', '', '\u0923'],
['l', '', '\u0924'],
['L', '', '\u0925'],
['o', '', '\u0926'],
['O', '', '\u0927'],
['v', '', '\u0928'],
['h', '', '\u092A'],
['H', '', '\u092B'],
['y', '', '\u092C'],
['Y', '', '\u092D'],
['c', '', '\u092E'],
['/', '', '\u092F'],
['j', '', '\u0930'],
['n', '', '\u0932'],
['b', '', '\u0935'],
['M', '', '\u0936'],
['\\<', '', '\u0937'],
['m', '', '\u0938'],
['u', '', '\u0939'],
['\\]', '', '\u093C'],
['e', '', '\u093E'],
['f', '', '\u093F'],
['r', '', '\u0940'],
['g', '', '\u0941'],
['t', '', '\u0942'],
['\\=', '', '\u0943'],
['\\@', '', '\u0945'],
['s', '', '\u0947'],
['w', '', '\u0948'],
['\\\\', '', '\u0949'],
['a', '', '\u094B'],
['q', '', '\u094C'],
['d', '', '\u094D'],
['\\>', '', '\u0964'],
['0', '', '\u0966'],
['1', '', '\u0967'],
['2', '', '\u0968'],
['3', '', '\u0969'],
['4', '', '\u096A'],
['5', '', '\u096B'],
['6', '', '\u096C'],
['7', '', '\u096D'],
['8', '', '\u096E'],
['9', '', '\u096F'],
['\\#', '', '\u094D\u0930'],
['\\$', '', '\u0930\u094D'],
['\\%', '', '\u091C\u094D\u091E'],
['\\^', '', '\u0924\u094D\u0930'],
['\\&', '', '\u0915\u094D\u0937'],
['\\*', '', '\u0936\u094D\u0930'],
['\\(', '', '\u200D'],
['\\)', '', '\u200C']
];

var rules_x = [
['F', '', '\u090C'],
['N', '', '\u0933'],
['\\>', '', '\u093D'],
['\\=', '', '\u0944'],
['X', '', '\u0950'],
['e', '', '\u0951'],
['d', '', '\u0952'],
['k', '', '\u0958'],
['K', '', '\u0959'],
['i', '', '\u095A'],
['p', '', '\u095B'],
['\\[', '', '\u095C'],
['\\+', '', '\u0960'],
['R', '', '\u0961'],
['f', '', '\u0962'],
['r', '', '\u0963'],
['\\.', '', '\u0965'],
[',', '', '\u0970'],
['\\$', '', '\u20B9']
];

jQuery.narayam.addScheme( 'hi-inscript', {
    'namemsg': 'narayam-hi-inscript',
    'extended_keyboard': true,
    'lookbackLength': 0,
    'rules': rules,
    'rules_x': rules_x
} ); 