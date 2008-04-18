<?php
/**
 * Internationalization file for Semantic MediaWiki
 *
 * @addtogroup Extensions
*/

$messages = array();

/** English
 *  @author Markus Krötzsch
 */
$messages['en'] = array(
	'smw_edithelp' => 'Editing help on properties',
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => ', and', //used in "A, B, and C"
	'smw_factbox_head' => 'Facts about $1',
	'smw_isspecprop' => 'This property is a special property in this wiki.',
	'smw_isknowntype' => 'This type is among the standard datatypes of this wiki.',
	'smw_isaliastype' => 'This type is an alias for the datatype “$1”.',
	'smw_isnotype' => 'This type “$1” is not a standard datatype in the wiki, and has not been given a user definition either.',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Sorry, URIs of the form “$1” are not allowed.',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	// Link to iCalendar files
	'smw_icalendar_link' => 'iCalendar',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "Sorry. Semantic queries have been disabled for this wiki.",
	'smw_iq_moreresults' => '&hellip; further results',
	'smw_iq_nojs' => 'Please use a JavaScript-enabled browser to view this element.',
	'smw_iq_altresults' => 'Browse the result list directly.', // available link when JS is disabled
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => 'Import functions are not avalable for namespace “$1”.',
	'smw_nonright_importtype' => '$1 can only be used for pages with namespace “$2”.',
	'smw_wrong_importtype' => '$1 can not be used for pages in the namespace “$2”.',
	'smw_no_importelement' => 'Element “$1” not available for import.',
	// Messages and strings for basic datatype processing
	'smw_parseerror' => 'The given value was not understood.', // generic error, "something" went wrong
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '“$1” cannot be used as a page name in this wiki.',
	'smw_unknowntype' => 'Unsupported type “$1” defined for property.',
	'smw_manytypes' => 'More than one type defined for property.',
	'smw_emptystring' => 'Empty strings are not accepted.',
	'smw_maxstring' => 'String representation $1 is too long for {{SITENAME}}.',
	'smw_notinenum' => '“$1” is not in the list of possible values ($2) for this property.',
	'smw_noboolean' => '“$1” is not recognized as a Boolean (true/false) value.',
	'smw_true_words' => 'true,t,yes,y', // comma-separated synonyms for Boolean TRUE besides '1', primary value first
	'smw_false_words' => 'false,f,no,n', // comma-separated synonyms for Boolean FALSE besides '0', primary value first
	'smw_nofloat' => '“$1” is no number.',
	'smw_infinite' => 'Numbers as large as “$1” are not supported on {{SITENAME}}.',
	'smw_infinite_unit' => 'Conversion into unit “$1” resulted in a number that is too large for {{SITENAME}}.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this property supports no unit conversion',
	'smw_unsupportedprefix' => 'Prefixes for numbers (“$1”) are not supported.',
	'smw_unsupportedunit' => 'Unit conversion for unit “$1” not supported.',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => 'No number found before the symbol “$1”.', // $1 is something like °
	'smw_bad_latlong' => 'Latitude and longitude must be given only once, and with valid coordinates.',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'W',
	'smw_label_latitude' => 'Latitude:',
	'smw_label_longitude' => 'Longitude:',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " Find&nbsp;online&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => 'The date “$1” was not understood (support for dates is still experimental).',
	// Errors and notices related to queries
	'smw_toomanyclosing' => 'There appear to be too many occurrences of “$1” in the query.',
	'smw_noclosingbrackets' => 'Some use of “[&#x005B;” in your query was not closed by a matching “]]”.',
	'smw_misplacedsymbol' => 'The symbol “$1” was used in a place where it is not useful.',
	'smw_unexpectedpart' => 'The part “$1” of the query was not understood. Results might not be as expected.',
	'smw_emptysubquery' => 'Some subquery has no valid condition.',
	'smw_misplacedsubquery' => 'Some subquery was used in a place where no subqueries are allowed.',
	'smw_valuesubquery' => 'Subqueries not supported for values of property “$1”.',
	'smw_overprintoutlimit' => 'The query contains too many printout requests.',
	'smw_badprintout' => 'Some print statement in the query was misshaped.',
	'smw_badtitle' => 'Sorry, but “$1” is no valid page title.',
	'smw_badqueryatom' => 'Some part “[&#x005B;&hellip;]]” of the query was not understood.',
	'smw_propvalueproblem' => 'The value of property “$1” was not understood.',
	'smw_nodisjunctions' => 'Disjunctions in queries are not supported in this wiki and part of the query was dropped ($1).',
	'smw_querytoolarge' => 'The following query conditions could not be considered due to the wikis restrictions in query size or depth: $1.',
	'smw_devel_warning' => 'This feature is currently under development, and might not be fully functional. Backup your data before using it.',
	// Messages for pages of types and properties
	'smw_type_header' => 'Properties of type “$1”',
	'smw_typearticlecount' => 'Showing $1 properties using this type.',
	'smw_attribute_header' => 'Pages using the property “$1”',
	'smw_attributearticlecount' => '<p>Showing $1 pages using this property.</p>',
	// Messages used in RSS feeds
	'smw_rss_description' => '$1 RSS feed',
	// Messages for Export RDF Special
	'exportrdf' => 'Export pages to RDF', //name of this special
	'smw_exportrdf_docu' => '<p>This page allows you to obtain data from a page in RDF format. To export pages, enter the titles in the text box below, one title per line.</p>',
	'smw_exportrdf_recursive' => 'Recursively export all related pages. Note that the result could be large!',
	'smw_exportrdf_backlinks' => 'Also export all pages that refer to the exported pages. Generates browsable RDF.',
	'smw_exportrdf_lastdate' => 'Do not export pages that were not changed since the given point in time.',
	// Messages for Properties Special
	'properties' => 'Properties',
	'smw_properties_docu' => 'The following properties are used in the wiki.',
	'smw_property_template' => '$1 of type $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'All properties should be described by a page!',
	'smw_propertylackstype' => 'No type was specified for this property (assuming type $1 for now).',
	'smw_propertyhardlyused' => 'This property is hardly used within the wiki!',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Unused Properties',
	'smw_unusedproperties_docu' => 'The following properties exist although no other page makes use of them.',
	'smw_unusedproperty_template' => '$1 of type $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Wanted Properties',
	'smw_wantedproperties_docu' => 'The following properties are used in the wiki but do not yet have a page for describing them.',
	'smw_wantedproperty_template' => '$1 ($2 uses)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => 'Click here to refresh all queries and templates on this page',
	'smw_purge' => 'Refresh',
	// Messages for Import Ontology Special
	'ontologyimport' => 'Import ontology',
	'smw_oi_docu' => 'This special page allows to import ontologies. The ontologies have to follow a certain format, specified at the <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">ontology import help page</a>.',
	'smw_oi_action' => 'Import',
	'smw_oi_return' => 'Return to <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => 'No ontology supplied, or could not load ontology.',
	'smw_oi_select' => 'Please select the statements to import, and then click the import button.',
	'smw_oi_textforall' => 'Header text to add to all imports (may be empty):',
	'smw_oi_selectall' => 'Select or unselect all statements',
	'smw_oi_statementsabout' => 'Statements about',
	'smw_oi_mapto' => 'Map entity to',
	'smw_oi_comment' => 'Add the following text:',
	'smw_oi_thisissubcategoryof' => 'A subcategory of',
	'smw_oi_thishascategory' => 'Is part of',
	'smw_oi_importedfromontology' => 'Import from ontology',
	// Messages for (data)Types Special
	'types' => 'Types',
	'smw_types_docu' => 'The following is a list of all datatypes that can be assigned to properties. Each datatype has a page where additional information can be provided.',
	'smw_typeunits' => 'Units of measurement of type “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Semantic Statistics',
	'smw_semstats_text' => 'This wiki contains <b>$1</b> property values for a total of <b>$2</b> different <a href="$3">properties</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might be <a href="$6">unused properties</a>. Properties that still lack a page are found on the <a href="$7">list of wanted properties</a>.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Flawed Properties',
	'smw_fattributes' => 'The pages listed below have an incorrectly defined property. The number of incorrect properties is given in the brackets.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI Resolver',
	'smw_uri_doc' => '<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',
	// Messages for ask Special
	'ask' => 'Semantic search',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Help:Semantic_search',
	'smw_ask_sortby' => 'Sort by column (optional)',
	'smw_ask_ascorder' => 'Ascending',
	'smw_ask_descorder' => 'Descending',
	'smw_ask_submit' => 'Find results',
	'smw_ask_editquery' => '[Edit query]',
	'smw_add_sortcondition' => '[Add sorting condition]',
	'smw_ask_hidequery' => 'Hide query',
	'smw_ask_help' => 'Querying help',
	'smw_ask_queryhead' => 'Query',
	'smw_ask_printhead' => 'Additional printouts (optional)',
	// Messages for the search by property special
	'searchbyproperty' => 'Search by property',
	'smw_sbv_docu' => '<p>Search for all pages that have a given property and value.</p>',
	'smw_sbv_noproperty' => '<p>Please enter a property.</p>',
	'smw_sbv_novalue' => '<p>Please enter a valid value for the property, or view all property values for “$1.”</p>',
	'smw_sbv_displayresult' => 'A list of all pages that have property “$1” with value “$2”',
	'smw_sbv_property' => 'Property',
	'smw_sbv_value' => 'Value',
	'smw_sbv_submit' => 'Find results',
	// Messages for the browsing special
	'browse' => 'Browse wiki',
	'smw_browse_article' => 'Enter the name of the page to start browsing from.',
	'smw_browse_go' => 'Go',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => 'Page property search',
	'smw_pp_docu' => 'Search for all the fillers of a property on a given page. Please enter both a page and a property.',
	'smw_pp_from' => 'From page',
	'smw_pp_type' => 'Property',
	'smw_pp_submit' => 'Find results',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Previous',
	'smw_result_next' => 'Next',
	'smw_result_results' => 'Results',
	'smw_result_noresults' => 'Sorry, no results.'
);

/** German
 * @author Markus Krötzsch
 * 
 * Main translations:
 * "property" --> "Attribut"
 * "type" --> "Datentyp"
 * "special properties" --> "Besondere Attribute"
 * "query" --> "Anfrage"
 * "subquery" --> Teilanfrage
 * "printout statement" --> Ausgabeanweisung
 */
$messages['de'] = array(
	'smw_edithelp' => 'Bearbeitungshilfe für Attribute',
	'smw_viewasrdf' => 'RDF-Feed',
	'smw_finallistconjunct' => ' und', //used in "A, B, and C"
	'smw_factbox_head' => 'Fakten zu $1',
	'smw_isspecprop' => 'Dieses Attribut ist ein Spezialattribut in diesem Wiki.',
	'smw_isknowntype' => 'Dieser Datentyp gehört zu den Standardtypen in diesem Wiki.',
	'smw_isaliastype' => 'Dieser Datentyp ist ein Alias für den Typ “$1”.',
	'smw_isnotype' => 'Der Datentyp “$1” ist kein Standardtyp in diesem Wiki, und hat auch keine ausreichende Definition auf seiner Seite.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'URIs der Form „$1“ sind nicht zulässig.',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	/*Messages and strings for inline queries*/
	'smw_iq_disabled' => "Semantische Anfragen sind in diesem Wiki zur Zeit nicht möglich.",
	'smw_iq_moreresults' => '… weitere Ergebnisse',
	'smw_iq_nojs' => 'Der Inhalt dieses Elementes kann mit einem Browser mit JavaScript-Unterstützung betrachtet werden.',
	'smw_iq_altresults' => 'Suchergebnisse als Liste anzeigen.', // available link when JS is disabled
	/*Messages and strings for ontology resued (import) */
	'smw_unknown_importns' => 'Für den Namensraum „$1“ sind leider keine Importfunktionen verfügbar.',
	'smw_nonright_importtype' => 'Das Element „$1“ kann nur für Seiten im Namensraum „$2“ verwendet werden.',
	'smw_wrong_importtype' => 'Das Element „$1“ kann nicht für Seiten im Namensraum „$2“ verwendet werden.',
	'smw_no_importelement' => 'Das Element „$1“ steht leider nicht zum Importieren zur Verfügung.',
	/*Messages and strings for basic datatype processing*/
	'smw_parseerror' => 'Der eingegebene Wert wurde nicht verstanden.', // generic error, "something" went wrong
	'smw_decseparator' => ',',
	'smw_kiloseparator' => '.',
	'smw_notitle' => '“$1” kann nicht als Seitenname in diesem Wiki verwendet werden.',
	'smw_unknowntype' => 'Dem Attribut wurde der unbekannte Datentyp „$1“ zugewiesen.',
	'smw_manytypes' => 'Dem Attribut wurden mehrere Datentypen zugewiesen.',
	'smw_emptystring' => 'Leere Zeichenfolgen werden nicht akzeptiert.',
	'smw_maxstring' => 'Die Zeichenkette „$1“ ist für diese Website zu lang.',
	'smw_notinenum' => '„$1“ gehört nicht zu den möglichen Werten dieses Attributs ($2).',
	'smw_noboolean' => '„$1“ ist kein Wahrheitswert (wahr/falsch).',
	'smw_true_words' => 'wahr,ja,true', // comma-separated synonyms for boolean TRUE besides '1', primary value first
	'smw_false_words' => 'falsch,nein,false', // comma-separated synonyms for boolean FALSE besides '0', primary value first
	'smw_nofloat' => '„$1“ ist keine Zahl.',
	'smw_infinite' => 'Die Zahl $1 ist zu lang.',
	'smw_infinite_unit' => 'Die Umrechnung in Einheit $1 ist nicht möglich: die Zahl ist zu lang.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'dieses Attribut unterstützt keine Umrechnung von Einheiten',
	'smw_unsupportedprefix' => 'Vorangestellte Zeichen bei Dezimalzahlen („$1“) werden nicht unterstützt.',
	'smw_unsupportedunit' => 'Umrechnung der Einheit „$1“ nicht unterstützt.',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => 'Keine Zahl vor dem “$1”-Zeichen gefunden.', // $1 is something like °
	'smw_bad_latlong' => 'Länge und Breite dürfen nur einmal und mit gültigen Werten angegeben werden.',
	'smw_label_latitude' => 'Breite:',
	'smw_label_longitude' => 'Länge:',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'O',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'W',
	/* some links for online maps; can be translated to different language versions of services, but need not*/
	'smw_service_online_maps' => " Landkarten|http://tools.wikimedia.de/~magnus/geo/geohack.php?language=de&params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	/*Messages for datetime parsing */
	'smw_nodatetime' => 'Das Datum „$1“ wurde nicht verstanden. Die Unterstützung von Kalenderdaten ist zur Zeit noch experimentell.',
	// Errors and notices related to queries
	'smw_toomanyclosing' => 'In der Anfrage kommen zu viele „$1“ vor.',
	'smw_noclosingbrackets' => 'Ein Vorkommen von „[&#x005B;“ in der Anfrage wurde nicht durch ein entsprechendes „]]“ abgeschlossen.',
	'smw_misplacedsymbol' => 'Das Symbol „$1“ wurde an einer Stelle verwendet, wo es keinen Sinn macht.',
	'smw_unexpectedpart' => 'Der Teil „$1“ der Anfrage wurde nicht verstanden. Die Ergebnisse sind eventuell nicht wie erwartet.',
	'smw_emptysubquery' => 'Keine Bedingung in Teilanfrage.',
	'smw_misplacedsubquery' => 'Eine Teilanfrage wurde an einer Stelle verwendet, an der keine Teilanfragen vorkommen dürfen.',
	'smw_valuesubquery' => 'Teilanfragen werden für Werte des Attributs „$1“ werden nicht unterstützt.',
	'smw_overprintoutlimit' => 'Die Anfrage enhält zu viele Ausgabeanweisungen.',
	'smw_badprintout' => 'Eine Ausgabeanweisung wurde nicht verstanden.',
	'smw_badtitle' => 'Leider ist „$1“ als Seitentitel nicht zulässig.',
	'smw_badqueryatom' => 'Ein Teil „[&#x005B…]]“ der Anfrage wurde nicht verstanden.',
	'smw_propvalueproblem' => 'Der Wert des Attributs „$1“ wurde nicht verstanden.',
	'smw_nodisjunctions' => 'Disjunktionen (ODER) in Anfragen sind in diesem Wiki nicht zulässig und ein Teil der Anfrage muss daher ignoriert werden ($1).',
	'smw_querytoolarge' => 'Die folgenden Anfragebedingungen konnten wegen den in diesem Wiki gültigen Beschränkungen für größe und Tiefe von Anfragen nicht berücksichtigt werden: $1.',
	'smw_devel_warning' => 'Diese Funktion befindet sich zur Zeit in Entwicklung und ist eventuell noch nicht voll einsatzfähig. Eventuell ist es ratsam, den Inhalt des Wikis vor der Benutzung dieser Funktion zu sichern.',
	// Messages for article pages of types, relations, and attributes
	'smw_type_header' => 'Attribute mit dem Datentyp „$1“',
	'smw_typearticlecount' => 'Es werden $1 Attribute mit diesem Datentyp angezeigt.',
	'smw_attribute_header' => 'Seiten mit dem Attribut „$1“',
	'smw_attributearticlecount' => '<p>Es werden $1 Seiten angezeigt, die dieses Attribut verwenden.</p>',
	// Messages used in RSS feeds
	'smw_rss_description' => 'RSS-Feed von $1',
	/*Messages for Export RDF Special*/
	'exportrdf' => 'Seite als RDF exportieren', //name of this special
	'smw_exportrdf_docu' => '<p>Hier können Informationen über einzelne Seiten im RDF-Format abgerufen werden. Bitte gib die Namen der gewünschten Seiten <i>zeilenweise</i> ein.</p>',
	'smw_exportrdf_recursive' => 'Exportiere auch alle relevanten Seiten rekursiv. Diese Einstellung kann zu sehr großen Ergebnissen führen!',
	'smw_exportrdf_backlinks' => 'Exportiere auch alle Seiten, die auf exportierte Seiten verweisen. Erzeugt RDF, das leichter durchsucht werden kann.',
	'smw_exportrdf_lastdate' => 'Exportiere keine Seiten, die seit dem angegebenen Zeitpunkt unverändert geblieben sind.',
	// Messages for Properties Special
	'properties' => 'Attribute',
	'smw_properties_docu' => 'In diesem Wiki gibt es die folgenden Attribute:',
	'smw_property_template' => '$1 mit Datentyp $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'Alle Attribute sollten durch eine Seite beschrieben werden!',
	'smw_propertylackstype' => 'Für dieses Attribut wurde kein Datentyp angegeben ($1 wird vorläufig als Typ angenommen).',
	'smw_propertyhardlyused' => 'Dieses Attribut wird im Wiki kaum verwendet!',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Verwaiste Attribute',
	'smw_unusedproperties_docu' => 'Die folgenden Attributseiten existieren, obwohl sie nicht verwendet werden.',
	'smw_unusedproperty_template' => '$1 mit Datentyp $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Gewünschte Attribute',
	'smw_wantedproperties_docu' => 'Folgende Attribute haben bisher keine erläuterende Seite, obwohl sie bereits für die Beschreibung anderer Seiten verwendet werden.',
	'smw_wantedproperty_template' => '$1 ($2 Vorkommen)', // <propname> (<count> uses)
	/* Messages for the refresh button */
	'tooltip-purge' => 'Alle Anfrageergebnisse und Vorlagen auf dieser Seite auf den neuesten Stand bringen.',
	'smw_purge' => 'aktualisieren',
	/*Messages for Import Ontology Special*/
	'ontologyimport' => 'Importiere Ontologie',
	'smw_oi_docu' => 'Diese Spezialseite erlaubt es, Informationen aus einer externen Ontologie zu importieren. Die Ontologie sollte in einem vereinfachten RDF-Format vorliegen. Weitere Informationen sind in der englischsprachigen <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">Dokumentation zum Ontologieimport</a> zu finden.',
	'smw_oi_action' => 'Importieren',
	'smw_oi_return' => 'Zurück zum <a href="$1">Ontologieimport</a>.',
	'smw_oi_noontology' => 'Keine Ontologie unterstützt, oder Ontologie kann nicht geladen werden.',
	'smw_oi_select' => 'Bitte wähle die zu importierenden Statements aus und klicke dann auf die Import-Schaltfläche.',
	'smw_oi_textforall' => 'Text, der allen Importen vorangestellt werden soll (darf leer bleiben):',
	'smw_oi_selectall' => 'Auswählen oder abwählen aller Statements',
	'smw_oi_statementsabout' => 'Statements über',
	'smw_oi_comment' => 'Füge den folgenden Text hinzu:',
	'smw_oi_thisissubcategoryof' => 'Unterkategorie von',
	'smw_oi_thishascategory' => 'Ist Teil von',
	'smw_oi_importedfromontology' => 'Importiere von Ontologie',
	/*Messages for (data)Types Special*/
	'types' => 'Datentypen',
	'smw_types_docu' => 'Die folgenden Datentypen können Attributen zugewiesen werden. Jeder Datentyp hat eine eigene Seite, auf der genauere Informationen eingetragen werden können.',
	'smw_typeunits' => 'Maßeinheiten des Datentyps “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Statistik über semantische Daten',
	'smw_semstats_text' => 'In diesem Wiki wurden <b>$1</b> Werte für insgesamt <b>$2</b> verschiedene <a href="$3">Attribute</a> eingegeben. <b>$4</b> Attribute haben eine eigene Seite und der gewünschte Datentyp ist für <b>$5</b> von diesen angegeben worden. Einige der existierenden Attribute können <a href="$6">verwaiste Attribute</a> sein. Attribute, für die noch eine Seite angelegt werden sollte, sind in der <a href="$7">Liste der gewünschten Attribute</a> aufgeführt.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Fehlerhafte Attribute',
	'smw_fattributes' => 'Die unten aufgeführten Seiten enthalten fehlerhafte Attribute. Die Anzahl der fehlerhaften Attribute ist in den Klammern angegeben.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI-Auflöser',
	'smw_uri_doc' => '<p>Der URI-Auflöser setzt die Empfehlungen »<a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>« um. Er sorgt dafür, dass Menschen nicht zu Webseiten werden.</p>',
	/*Messages for ask Special*/
	'ask' => 'Semantische Suche',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Help:Semantische_Suche',
	'smw_ask_sortby' => 'Sortiere nach Spalte (optional)',
	'smw_ask_ascorder' => 'Aufsteigend',
	'smw_ask_descorder' => 'Absteigend',
	'smw_ask_submit' => 'Finde Ergebnisse',
	'smw_ask_editquery' => '[Anfrage bearbeiten]',
	'smw_add_sortcondition' => '[Sortieranweisung hinzufügen]',
	'smw_ask_hidequery' => 'Anfrage ausblenden',
	'smw_ask_help' => 'Hilfe',
	'smw_ask_queryhead' => 'Anfrage',
	'smw_ask_printhead' => 'Zusätzliche Ausgaben (optional)',
	// Messages for the search by property special
	'searchbyproperty' => 'Suche mittels Attribut',
	'smw_sbv_docu' => '<p>Diese Spezialseite findet alle Seiten, die einen bestimmten Wert für das angegebene Attribut haben.</p>',
	'smw_sbv_noproperty' => '<p>Bitte den Namen eines Attributs eingeben</p>',
	'smw_sbv_novalue' => '<p>Bitte den gewünschten Wert eingeben oder alle Werte für das Attribut $1 ansehen.</p>',
	'smw_sbv_displayresult' => 'Eine Liste aller Seiten, die ein Attribut $1 mit dem Wert $2 haben.',
	'smw_sbv_property' => 'Attribut',
	'smw_sbv_value' => 'Wert',
	'smw_sbv_submit' => 'Finde Ergebnisse',
	// Messages for the browsing system
	'browse' => 'Wiki browsen',
	'smw_browse_article' => 'Bitte gib den Titel einer Seite ein.',
	'smw_browse_go' => 'Los',
	'smw_browse_more' => '…',
	// Messages for the page property special
	'pageproperty' => 'Attributswerte einer Seite',
	'smw_pp_docu' => 'Suche nach allen Werten, die ein bestimmtes Attribut für die angegebene Seite hat.',
	'smw_pp_from' => 'Seite',
	'smw_pp_type' => 'Attribut',
	'smw_pp_submit' => 'Ergebnisse anzeigen',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Zurück',
	'smw_result_next' => 'Vorwärts',
	'smw_result_results' => 'Ergebnisse',
	'smw_result_noresults' => 'Keine Ergebnisse gefunden.'
);

/** French
 * @author Pierre Matringe
 */
$messages['fr'] = array(
	'smw_edithelp' => 'Aide à la rédaction de relations et d\'attributs',
	'smw_viewasrdf' => 'Voir comme RDF',
	'smw_finallistconjunct' => ' et',					//utilisé dans "A, B, et C"
	'smw_factbox_head' => 'Faits relatifs à $1 &mdash; Recherche de pages similaires avec <span class="smwsearchicon">+</span>.',
	'smw_isspecprop' => 'Cette propriété est une propriété spéciale sur ce wiki.',
	'smw_isknowntype' => 'Ce type fait partie des types de données standards de ce wiki.',
	'smw_isaliastype' => 'Ce type est un alias du type de données “$1”.',
	'smw_isnotype' => 'Le type “$1” n\'est pas un type de données standard sur ce wiki, et n\'a pas non plus été n\'a pas non plus été défini par un utilisateur.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Désolé. Les URIs du domaine $1 ne sont pas disponible à cet emplacement',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	/*Messages and strings for inline queries*/
	'smw_iq_disabled' => "Désolé. Les recherches dans les articles de ce wiki ne sont pas autorisées.",
	'smw_iq_moreresults' => '&hellip; autres résultats',
	'smw_iq_nojs' => 'Utilisez un navigateur avec JavaScript pour voir cet élément.',
	'smw_iq_altresults' => 'Parcourir directement la liste des résultats.',
	/*Messages and strings for ontology resued (import) */
	'smw_unknown_importns' => 'Aucune fonction d\'import n\'est disponible pour l\'espace de nommage "$1".',
	'smw_nonright_importtype' => 'L\'élément "$1" ne peut être employé que pour des articles de l\'espace de nommage "$2".',
	'smw_wrong_importtype' => 'L\'élément "$1" ne peut être employé pour des articles de l\'espace de nommage domaine "$2".',
	'smw_no_importelement' => 'L\'élément "$1" n\'est pas disponible pour l\'importation.',
	/*Messages and strings for basic datatype processing*/
	'smw_decseparator' => ',',
	'smw_kiloseparator' => '.',
	'smw_notitle' => '“$1” ne peut être utilisé comme nom de page sur ce wiki.',
	'smw_unknowntype' => 'Le type de données "$1" non supporté a été retourné à l\'attribut.',
	'smw_manytypes' => 'Plusieurs types de données ont été assignés à l\'attribut.',
	'smw_emptystring' => 'Les chaînes vides ne sont pas acceptées.',
	'smw_maxstring' => 'La chaîne de représentation $1 est trop grande pour ce site.',
	'smw_notinenum' => '\"$1\" ne fait pas partie des valeurs possibles ($2) pour cet attribut.',
	'smw_noboolean' => '\"$1\" n\'est pas reconnu comme une valeur boléenne (vrai/faux).',
	'smw_true_words' => 'vrai,v,oui,true',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => 'faux,f,non,false',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_nofloat' => '"$1" n\'est pas un nombre.',
	'smw_infinite' => 'Le nombre $1 est trop long.',
	'smw_infinite_unit' => 'La conversion dans l\'unité $1 est impossible : le nombre est trop long.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'Cet attribut ne supporte aucune conversion d\'unité',
	'smw_unsupportedprefix' => 'Des préfixes ("$1") ne sont pas supportés actuellement',
	'smw_unsupportedunit' => 'La conversion de l\'unité "$1" n\'est pas supportée',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => 'Aucun nombre trouvé avant le symbole “$1”.', // $1 is something like °
	'smw_bad_latlong' => 'Latitude et longitude ne doivent être indiqués qu\'une seule fois, et avec des coordonnées valides.',
	'smw_label_latitude' => 'Latitude :',
	'smw_label_longitude' => 'Longitude :',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'O',
	/* some links for online maps; can be translated to different language versions of services, but need not*/
	'smw_service_online_maps' => " Cartes géographiques|http://tools.wikimedia.de/~magnus/geo/geohack.php?language=fr&params=\$9_\$7_\$10_\$8\n Google maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	/*Messages for datetime parsing */
	'smw_nodatetime' => 'La date "$1" n\'a pas été comprise. Le support des données calendaires est encore expérimental.',
	// Errors and notices related to queries //
	'smw_toomanyclosing' => 'Il semble y avoir trop d\'occurences de “$1” dans la requête.',
	'smw_noclosingbrackets' => 'Certains “[[” dans votre requête n\'ont pas été clos par des “]]” correspondants.',
	'smw_misplacedsymbol' => 'Le symbole “$1” a été utilisé à un endroit où il n\'est pas utile.',
	'smw_unexpectedpart' => 'La partie “$1” de la requête n\'a pas été comprise. Les Résultats peuvent être inattendus.',
	'smw_emptysubquery' => 'Certaines sous-requêtes ont une condition non-valide.',
	'smw_misplacedsubquery' => 'Certaines sous-requêtes ont été utilisées à un endroit où aucune sous-requête n\'est permise.',
	'smw_valuesubquery' => 'Sous-requête non supportée pour les valeurs de la propriété “$1”.',
	'smw_overprintoutlimit' => 'La requête contient trop d\'instructions de formatage.',
	'smw_badprintout' => 'Certaines instructions de formatage dans la requête n\'ont pas été comprises.',
	'smw_badtitle' => 'Désolé, mais “$1” n\'est pas un titre de page valable.',
	'smw_badqueryatom' => 'Les parties “[[…]]” de la requête n\'ont pas été comprises.',
	'smw_propvalueproblem' => 'La valeur de la propriété “$1” n\'a pas été comprises.',
	'smw_nodisjunctions' => 'Les disjonctions dans les requêtes ne sont pas supportées sur ce wiki et des parties de la requête ont été ignorées($1).',
	'smw_querytoolarge' => 'Les conditions suivantes de la requête n\'ont pu être évaluées en raison des restrictions de ce wiki à la taille ou à la profondeur des requêtes : $1.',
	'smw_devel_warning' => 'Cette fonction est encore en développement et n\'est peut-être pas encore opérationnelle. Il est peut-être judicieux de faire une sauvegarde du contenu du wiki avant toute utilisation de cette fonction.',
	// Messages for article pages of types, relations, and attributes
	'smw_type_header' => 'Attributs de type “$1”',
	'smw_typearticlecount' => 'Afficher les attributs de $1 en utilisant ce type.',
	'smw_attribute_header' => 'Pages utilisant l\'attribut “$1”',
	'smw_attributearticlecount' => '<p>Afficher $1 pages utilisant cet attribut.</p>',
	// Messages used in RSS feeds
	'smw_rss_description' => '$1 fil RSS',
	/*Messages for Export RDF Special*/
	'exportrdf' => 'Exporter l\'article en RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Sur cette page, des parties du contenu d\'un article peuvent être exportées dans le format RDF. Veuillez entrer le nom des pages souhaitées dans la boîte de texte ci-dessous, <i>un nom par ligne </i>.</p>',
	'smw_exportrdf_recursive' => 'Exporter également toutes les pages pertinentes de manière récursive. Cette possibilité peut aboutir à un très grand nombre de résultats !',
	'smw_exportrdf_backlinks' => 'Exporter également toutes les pages qui renvoient à des pages exportées. Produit un RDF dans lequel la navigation est facilitée.',
	'smw_exportrdf_lastdate' => 'Ne pas exporter les pages non modifiées depuis le moment indiqué.',
	// Messages for Properties Special
	'properties' => 'Propriétés',
	'smw_properties_docu' => 'Sur ce wiki, sont utilisées les propriétés suivantes.',
	'smw_property_template' => '$1 du type $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'Toute propriété devrait être décrite par une page !',
	'smw_propertylackstype' => 'Aucun type n\'a été spécifié pour cette propriété (type actuellement supposé : §1.',
	'smw_propertyhardlyused' => 'Cette propriété est très utilisée sur ce wiki !',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Propriétés inutilisées',
	'smw_unusedproperties_docu' => 'Les propriétés suivantes existent, bien qu\'aucune page ne les utilise.',
	'smw_unusedproperty_template' => '$1 de type $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Propriétés demandées',
	'smw_wantedproperties_docu' => 'Les propriétés suivantes sont utilisées sur ce wiki mes n\'ont pas encore de page pour les décrire.',
	'smw_wantedproperty_template' => '$1 ($2 utilisations)', // <propname> (<count> uses)
	/* Messages for the refresh button */
	'tooltip-purge' => 'Réactualiser toutes les recherches et tous les brouillons de cette page.',
	'smw_purge' => 'Réactualiser',
	/*Messages for Import Ontology Special*/
	'ontologyimport' => 'Importer une ontologie',
	'smw_oi_docu' => 'Cette page spéciale permet d\'importer des informations d\'une ontologie externe. Cette ontologie doit être dans un format RDF simplifié. Des informations supplémentaires sont disponibles dans la <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">Documentation relative à l\'import d\'ontologie</a> en langues anglaise.',
	'smw_oi_action' => 'Importer',
	'smw_oi_return' => 'Revenir à <a href="$1">Importer l\'ontologie</a>.',	//Différence avec la version anglaise
	'smw_oi_noontology' => 'Aucune ontologie fournie, ou impossible de charger l\'ontologie.',
	'smw_oi_select' => 'Veuillez sélectionner le texte à importer, puis cliquez sur le bouton « importer ».',
	'smw_oi_textforall' => 'Texte à ajouter en en-tête à toutes les importations (peut rester vice :',
	'smw_oi_selectall' => 'Sélectionner ou désélectionner tous les textes',
	'smw_oi_statementsabout' => 'Textes sur',
	'smw_oi_mapto' => 'Carte de l\'entité sur',
	'smw_oi_comment' => 'Ajouter le texte suivant :',
	'smw_oi_thisissubcategoryof' => 'Sous-catégorie de',
	'smw_oi_thishascategory' => 'Fait partie de',
	'smw_oi_importedfromontology' => 'Importer de l\'ontologie',
	/*Messages for (data)Types Special*/
	'types' => 'Types de données',
	'smw_types_docu' => 'Les types de données suivants peuvent être assignées aux attributs. Chaque type de données a son propre article, dans lequel peuvent figurer des informations plus précises.',
	'smw_typeunits' => 'Unités de measure de type “$1” : $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Statistiques sémantiques',
	'smw_semstats_text' => 'Ce wiki contient <b>$1</b> valeurs de propriété pour un total de <b>$2</b> <a href="$3">propriétés</a> différentes. <b>$4</b> propriétés ont leur propre page, et le type de données voulu est spécifié pour <b>$5</b> de celles-ci. Certaines des propriétés existantes peuvent faire partient des <a href="$6">propriétés inutilisées</a>. Les propriétés qui n\'ont pas encore de page se trouvent sur la <a href="$7">liste des propriétés demandées</a>.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Attributs défectueux',
	'smw_fattributes' => 'Les pages ci-dessous ont un attribut qui n\'est pas défini correctement. Le nombre d\'attributs incorrects est donné entre les parenthèses.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'Résolveur d\'URI',
	'smw_uri_doc' => '<p>Le résolveur d\'URI implémente la <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">Conclusion du TAG du W3C à propos du httpRange-14</a>. Il peut veiller à ce que les humains ne deviennent pas des sites web.',
	/*Messages for ask Special*/
	/*Messages for ask Special*/
	'ask' => 'Recherche sémantique',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Aide:Recherche_s%C3%A9mantique',
	'smw_ask_sortby' => 'Trier par colonnes',
	'smw_ask_ascorder' => 'Croissant',
	'smw_ask_descorder' => 'Décroissant',
	'smw_ask_submit' => 'Trouver des résultats',
	'smw_ask_editquery' => '[Éditer la requête]',
	'smw_ask_hidequery' => 'Masquer la requête',
	'smw_ask_help' => 'Aide à la requête',
	'smw_ask_queryhead' => 'Requête',
	'smw_ask_printhead' => 'Conditions supplémentaires (facultatif)',
	// Messages for the search by property special
	'searchbyproperty' => 'Rechercher par attribut',
	'smw_sbv_docu' => '<p>Rechercher toutes les pages qui ont un attribut donné avec un certaine valeur.</p>',
	'smw_sbv_noproperty' => '<p>Veuillez entrer un attribut.</p>',
	'smw_sbv_novalue' => '<p>Veuillez entrer une valeur ou consulter toutes les valeurs des attributs pour $1.</p>',
	'smw_sbv_displayresult' => 'Liste de toutes les pages qui ont un attribut $1 avec la valeur $2.',
	'smw_sbv_property' => 'Attribut',
	'smw_sbv_value' => 'Valeur',
	'smw_sbv_submit' => 'Trouver des résultats',
	// Messages for the browsing system
	'browse' => 'Parcourir le wiki',
	'smw_browse_article' => 'Entrez le nom de la page à partir de laquelle commencer la navigation.',
	'smw_browse_go' => 'Démarrer',
	'smw_browse_more' => '…',
	// Messages for the page property special
	'pageproperty' => 'Rechercher dans les propriétés de la page',
	'smw_pp_docu' => 'Rechercher toutes les valeurs d\'une propriété dans une page donnée. Veuillez entrer la page et une propriété.',
	'smw_pp_from' => 'De la page',
	'smw_pp_type' => 'Propriété',
	'smw_pp_submit' => 'Afficher les résultats',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Précédent',
	'smw_result_next' => 'Suivant',
	'smw_result_results' => 'Résultats',
	'smw_result_noresults' => 'Désolé, aucun résultat.',
);

/** Spanish
 * @author Javier Calzada Prado
 * @author Carmen Jorge García-Reyes
 */
$messages['es'] = array(
	'smw_edithelp' => 'Ayuda a la redacción de relaciones y atributos',
	'smw_viewasrdf' => 'Ver como RDF',
	'smw_finallistconjunct' => ' y',					//utilizado en "A, B, y C"
	'smw_factbox_head' => 'Hechos relativos a à $1 — Búsqueda de páginas similares con <span class="smwsearchicon">+</span>.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",					// http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#
	'smw_baduri' => 'Lo sentimos. Las URIs del dominio $1 no están disponibles en este emplazamiento',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	/*Messages and strings for inline queries*/
	'smw_iq_disabled' => "Lo sentimos. Las búsquedas en los artículos de este wiki no están autorizadas.",
	'smw_iq_moreresults' => '&hellip; siguientes resultados',
	'smw_iq_nojs' => 'Use un navegador con JavaScript habilitado para ver este elemento.',
	/*Messages and strings for ontology resued (import) */
	'smw_unknown_importns' => 'Ninguna función de importación está disponible para el espacio de nombres "$1".',
	'smw_nonright_importtype' => 'El elemento "$1" no puede ser empleado más que para los artículos del espacio de nombres "$2".',
	'smw_wrong_importtype' => 'El elemento "$1" no puede ser utilizado para los artículos del espacio de nombres dominio "$2".',
	'smw_no_importelement' => 'El elemento "$1" no está disponible para la importación.',
	/*Messages and strings for basic datatype processing*/
	'smw_decseparator' => ',',
	'smw_kiloseparator' => '.',
	'smw_unknowntype' => 'El tipo de datos "$1" no soportado ha sido devuelto al atributo.',
	'smw_manytypes' => 'Demasiados tipos de datos han sido asignados al atributo.',
	'smw_emptystring' => 'No se aceptan cadenas vacías.',
	'smw_maxstring' => 'La representación de la cadena $1 es demasiado grande para este sitio.',
	'smw_notinenum' => '"$1" no esta en la lista de posibles valores ($2) para este atributo.',
	'smw_noboolean' => '"$1" no es reconocido como un valor booleano (verdadero/falso).',
	'smw_true_words' => 'verdadero,t,si,s,true',
	'smw_false_words' => 'falso,f,no,n,false',
	'smw_nofloat' => '"$1" no es un número.',
	'smw_infinite' => 'El número $1 es demasiado largo.',
	'smw_infinite_unit' => 'La conversión en la unidad $1 es imposible : el número es demasiado largo.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'Este atributo no soporta ninguna conversión de unidad',
	'smw_unsupportedprefix' => 'prefijos ("$1") no esta soportados actualmente',
	'smw_unsupportedunit' => 'La conversión de la unidad "$1" no está soportada',
	// Messages for geo coordinates parsing
	'smw_label_latitude' => 'Latitud :',
	'smw_label_longitude' => 'Longitud :',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'O',
	/* some links for online maps; can be translated to different language versions of services, but need not*/
	'smw_service_online_maps' => " Mapas&nbsp;geográficos|http://tools.wikimedia.de/~magnus/geo/geohack.php?language=es&params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	/*Messages for datetime parsing */
	'smw_nodatetime' => 'La fecha "$1" no ha sido comprendida. El soporte de datos de calendario son todavía experimentales.',
	'smw_devel_warning' => 'Esta función está aún en desarrollo y quizá aun no sea operativa. Es quizá recomendable hacer una copia de seguridad del wiki antes de utilizar esta función.',
	// Messages for article pages of types, relations, and attributes
	'smw_type_header' => 'Atributos de tipo “$1”',
	'smw_typearticlecount' => 'Mostrando $1 atributos usando este tipo.',
	'smw_attribute_header' => 'Paginas usando el atributo “$1”',
	'smw_attributearticlecount' => '<p>Mostrando $1 páginas usando este atributo.</p>',
	/*Messages for Export RDF Special*/
	'exportrdf' => 'Exportar el artículo como RDF', //name of this special
	'smw_exportrdf_docu' => '<p> En esta página, las partes de contenido de un artículo pueden ser exportadas a formato RDF. Introduzca el nombre de las páginas deseadas en el cuadro de texto que se encuentra debajo, <i>un nombre por línea </i>.<p/>',
	'smw_exportrdf_recursive' => 'Exportar igualmente todas las páginas pertinentes de forma recurrente. Esta posibilidad puede conseguir un gran número de resultados !',
	'smw_exportrdf_backlinks' => 'Exportar igualmente todas las páginas que reenvían a páginas exportadas. Resulta un RDF en el que se facilita la navegación.',
	/* Messages for the refresh button */
	'tooltip-purge' => 'Volver a actualizar todas las búsquedas y borradores de esta página.',
	'smw_purge' => 'Volver a actualizar',
	/*Messages for Import Ontology Special*/
	// Messages for Import Ontology Special
	'ontologyimport' => 'Importar la ontología',
	'smw_oi_docu' => 'Esta página especial permite importar datos de una ontología externa. Dicha ontología debe estar en un formato RDF simplificado. Información adicional disponible en <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">Documentación relativa a la importación de ontologías en lengua inglesa.',
	'smw_oi_action' => 'Importar',
	'smw_oi_return' => 'Volver a <a href="$1">Importar la ontología</a>.',	//Différence avec la version anglaise
	/*Messages for (data)Types Special*/
	'types' => 'Tipos de datos',
	'smw_types_docu' => 'Los tipos de datos siguientes pueden ser asignados a los atributos. Cada tipo de datos tiene su propio artículo, en el que puede figurar información más precisa.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Flawed Attributes',
	'smw_fattributes' => 'The pages listed below have an incorrectly defined attribute. The number of incorrect attributes is given in the brackets.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'Traductor de URI',
	'smw_uri_doc' => '<p>El traductor de URI implementa <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. Esto se preocupa de cosas que los humanos no lo hacen en los sitios web..</p>',
	/*Messages for ask Special*/
	'ask' => 'Búsqueda semántica',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Help:Búsqueda semántica',
	'smw_ask_sortby' => 'Ordenar por columna',
	'smw_ask_ascorder' => 'Ascendente',
	'smw_ask_descorder' => 'Descendente',
	'smw_ask_submit' => 'Buscar resultados',
	// Messages for the search by property special
	'searchbyproperty' => 'Buscar por atributo',
	'smw_sbv_docu' => '<p>Buscar por todas las páginas que tiene un atributo y valor dado.</p>',
	'smw_sbv_noproperty' => '<p>Por favor introduzca un atributo.</p>',
	'smw_sbv_novalue' => '<p>Por favor introduzca un valor, o ver todos los valores de atributo para $1.</p>',
	'smw_sbv_displayresult' => 'Una lista de todas las páginas que tienen un atributo $1 con el valor $2.',
	'smw_sbv_property' => 'Atributo',
	'smw_sbv_value' => 'Valor',
	'smw_sbv_submit' => 'Buscar resultados',
	// Messages for the browsing system
	'browse' => 'Explorar artículos',
	'smw_browse_article' => 'Introduzca el nombre de la página para empezar a explorar.',
	'smw_browse_go' => 'Ir',
	'smw_browse_more' => '&hellip;',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Anterior',
	'smw_result_next' => 'Siguiente',
	'smw_result_results' => 'Resultados',
	'smw_result_noresults' => 'Lo siento, no hay resultados.'
);

/** Hebrew
 * @author Udi Oron אודי אורון
 */
$messages['he'] = array(
	'smw_edithelp' => 'עזרה בנושא עריכת יחסים ותכונות',
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => ', וגם', //used in "A, B, and C"
	'smw_factbox_head' => 'עובדות על אודות $1 &mdash; לחץ <span class="smwsearchicon">+</span> בכדי למצוא דפים דומים.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	/*Messages and strings for inline queries*/
	'smw_iq_moreresults' => '&hellip; תוצאות נוספות',
	/*Messages and strings for basic datatype processing*/
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_unknowntype' => '[אופס! טיפוס לא מוכר "$1" הוגדר עבור תכונה זו]',
	'smw_manytypes' => '[אופס! הוגדר יותר מטיפוס אחד לתכונה זו]',
	'smw_emptystring' => '[אופס! לא ניתן להשתמש כאן במחרוזות ריקות]',
	'smw_maxstring' => '[מצטערת, ייצוג המחרוזת כ-$1 ארוך מדי עבור אתר זה.]',
	'smw_notinenum' => '[אופס! "$1" לא נמצא בערכים האפשריים ($2) לתכונה זו]',
	'smw_noboolean' => '[אופס! "$1" אינה תכונה מטיפוס נכון-לאנכון]',
	'smw_true_words' => 't,yes,y,כן,נכון,אמת,חיובי,כ',	// comma-separated synonyms for boolean TRUE besides 'true' and '1' TODO: "true" needs to be added now, and main synonym should be first
	'smw_false_words' => 'f,no,n,לא,לא נכון,לא-נכון,שקר,שלישי,ל',	// comma-separated synonyms for boolean FALSE besides 'false' and '0' TODO: "false" needs to be added now, and main synonym should be first
	'smw_nofloat' => '[אופס! "$1" אינו מספר מטיפוס נקודה צפה]', // TODO Change "floating-point" number to just "number"
	'smw_infinite' => '[מצטרת, $1 הוא מספר גדול מדי לאתר זה .]',
	'smw_infinite_unit' => '[מצטערת, תוצאת ההמרה ליחידה $1 היא מספר גדול מדי לאתר זה.]',
	//'smw_unexpectedunit' => 'תכונה זו אינה תומכת בהמרה מטיפוס לטיפוס',
	'smw_unsupportedunit' => 'אין תמיכה להמרת יחידות לטיפוס "$1"',
	// Messages for geo coordinates parsing
	'smw_label_latitude' => 'קו רוחב:',
	'smw_label_longitude' => 'קו אורך:',
	'smw_abb_north' => 'צפון',
	'smw_abb_east' => 'מזרח',
	'smw_abb_south' => 'דרום',
	'smw_abb_west' => 'מערב',
	/* some links for online maps; can be translated to different language versions of services, but need not*/
	'smw_service_online_maps' => " חפש&nbsp;מפות|http://tools.wikimedia.de/~magnus/geo/geohack.php?language=he&params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	/*Messages for datetime parsing */
	'smw_nodatetime' => '[אופס! התאריך "$1" אינו מובן. מצד שני התמיכה בתאריכים היא עדיין ניסיונית.]',
	/* Messages for the refresh button */
	'tooltip-purge' => 'לחץ כאן הכדי לרענן את כל התבניות והשאילתות בדף זה',
	'smw_purge' => 'רענן תבניות ושאילתות',
	/*Messages for (data)Types Special*/
	'types' => 'טיפוסים',
	'smw_types_docu' => 'ברשימה זו מופיעים כל טיפוסי המידע שתכונות יכולות להשתמש בהם . לכל טיפוס מידע יש דף המסביר על אודותיו.',
	/*Messages for ask Special*/
	'ask' => 'חיפוש סמנטי',
	'smw_ask_sortby' => 'מיין לפי טור',
	'smw_ask_ascorder' => 'בסדר עולה',
	'smw_ask_descorder' => 'בסדר יורד',
	'smw_ask_submit' => 'חפש תוצאות',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'הקודם',
	'smw_result_next' => 'הבא',
	'smw_result_results' => 'תוצאות',
	'smw_result_noresults' => 'מצטערת, אין תוצאות'
);


/** Dutch
 * @author Siebrand Mazeland
 */
$messages['nl'] = array(
	'smw_edithelp' => 'Bewerkingshulp bij eigenschappen',
	'smw_viewasrdf' => 'RDF-feed',
	'smw_finallistconjunct' => ', en', //used in "A, B, and C"
	'smw_factbox_head' => 'Feiten over $1',
	'smw_isspecprop' => 'Dit is een speciale eigenschap in de wiki.',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Sorry, URI\'s uit de reeks “$1” zijn hier niet beschikbaar.',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "Sorry. Zoekopdrachten binnen tekst zijn uitgeschakeld in deze wiki.",
	'smw_iq_moreresults' => '&hellip; overige resultaten',
	'smw_iq_nojs' => 'Gebruiker een browser waarin JavaScript is ingeschakeld om dit element te zien.',
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => 'Importfuncties zijn niet beschikbaar voor de naamruimte “$1”.',
	'smw_nonright_importtype' => '$1 kan alleen gebruikt worden voor pagina\'s in de naamruimte “$2”.',
	'smw_wrong_importtype' => '$1 kan niet gebruikt worden in pagina\'s in de naamruimte “$2”.',
	'smw_no_importelement' => 'Element “$1” is niet beschikbaar voor import.',
	// Messages and strings for basic datatype processing
	'smw_decseparator' => ',',
	'smw_kiloseparator' => '.',
	'smw_unknowntype' => 'Type “$1” is niet beschikbaar voor de gedefinieerde eigenschap.',
	'smw_manytypes' => 'Meer dan één type gedefinieerd voor eigenschap.',
	'smw_emptystring' => 'Lege strings zijn niet toegestaan.',
	'smw_maxstring' => 'Stringrepresentatie $1 is te lang voor deze site.',
	'smw_notinenum' => '“$1” komt niet voor in de lijst met mogelijke waarden ($2) voor deze eigenschap.',
	'smw_noboolean' => '“$1” is niet herkend als een booleaanse waarde (waar/onwaar).',
	'smw_true_words' => 'waar,w,ja,j,true',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => 'onwaar,o,nee,n,false',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_nofloat' => '“$1” is geen getal.',
	'smw_infinite' => 'Getallen zo groot als “$1” zijn niet ondersteund door deze site.',
	'smw_infinite_unit' => 'Conversie naar eenheid “$1” resulteerde in een getal dat te groot is voor deze site.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this property supports no unit conversion',
	'smw_unsupportedprefix' => 'Voorvoegsels voor getallen (“$1”) worden niet ondersteund.',
	'smw_unsupportedunit' => 'Eenheidconversie voor eenheid “$1” is niet ondersteund.',
	// Messages for geo coordinates parsing
	'smw_label_latitude' => 'Breedte:',
	'smw_label_longitude' => 'Lengte:',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'O',
	'smw_abb_south' => 'Z',
	'smw_abb_west' => 'W',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => 'De datum “$1” werd niet begrepen (ondersteuning voor datums is nog experimenteel).',
	// Errors and notices related to queries
	'smw_toomanyclosing' => '“$1” lijkt te vaak voor te komen in de zoekopdracht.',
	'smw_noclosingbrackets' => 'In uw zoekopdracht is het gebruik van “[&#x005B;” niet gesloten door een bijbehorende “]]”.',
	'smw_misplacedsymbol' => 'Het symbool “$1” is gebruikt op een plaats waar het niet gebruikt hoort te worden.',
	'smw_unexpectedpart' => 'Het deel “$1” van de zoekopdracht is niet begrepen. De resultaten kunnen afwijken van de verwachting.',
	'smw_emptysubquery' => 'Er is een subzoekopdracht met een onjuiste conditie.',
	'smw_misplacedsubquery' => 'Er is een subzoekopdracht gebruikt op een plaats waar subzoekopdrachten niet gebruikt mogen worden.',
	'smw_valuesubquery' => 'Subzoekopdrachten worden niet ondersteund voor waarden van eigenschap “$1”.',
	'smw_overprintoutlimit' => 'De zoekopdracht bevat te veel printoutverzoeken.',
	'smw_badprintout' => 'Er is een print statement in de zoekopdracht onjuist geformuleerd.',
	'smw_badtitle' => 'Sorry, maar “$1” is geen geldige paginanaam.',
	'smw_badqueryatom' => 'Een onderdeel “[&#x005B;&hellip;]]” van de zoekopdrtacht is niet begrepen.',
	'smw_propvalueproblem' => 'De waarde van eigenschap “$1” is niet begrepen.',
	'smw_nodisjunctions' => 'Scheidingen in zoekopdrachten worden niet ondersteund in deze wiki en er is een deel van de zoekopdracht genegeerd ($1).',
	'smw_querytoolarge' => 'De volgende zoekopdrachtcondities zijn niet in acht genomen vanwege beperkingen in de grootte of diepte van zoekopdrachten in deze wiki: $1.',
	'smw_devel_warning' => 'Deze functie wordt op het moment ontwikkeld en is wellicht niet volledig functioneel. Maak een back-up voordat u deze functie gebruikt.',
	// Messages for pages of types and properties
	'smw_type_header' => 'Eigenschappen voor type “$1”',
	'smw_typearticlecount' => 'Er zijn $1 eigenschappen die gebruik maken van dit type.',
	'smw_attribute_header' => 'Pagina\'s die de eigenschap “$1” gebruiken',
	'smw_attributearticlecount' => '<p>Er zijn $1 pagina\'s die deze eigenschap gebruiken.</p>',
	// Messages for Export RDF Special
	'exportrdf' => 'Export pagina\'s naar RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Deze pagina maakt het mogelijk gegevens te verkrijgen van een pagina in RDF-formaat. Geef titels in het onderstaande invoerveld in om pagina\'s te exporteren. Iedere pagina op een eigen regel.</p>',
	'smw_exportrdf_recursive' => 'Exporteer alle gerelateerde pagina\'s recursief. Het resultaat kan groot zijn!',
	'smw_exportrdf_backlinks' => 'Exporteer ook alle pagina\'s die verwijzen naar de te exporteren pagina\'s. Genereert door te bladeren RDF.',
	'smw_exportrdf_lastdate' => 'Exporteer geen pagina\'s die sinds het opgegeven punt niet gewijzigd zijn.',
	// Messages for Properties Special
	'properties' => 'Eigenschappen',
	'smw_properties_docu' => 'De volgende eigenschappen worden in de wiki gebruikt.',
	'smw_property_template' => '$1 van type $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'Alle eigenschappen moeten op een pagina beschreven worden!',
	'smw_propertylackstype' => 'Er is geen type opgegeven voor deze eigenschap (type $1 wordt verondersteld).',
	'smw_propertyhardlyused' => 'Deze eigenschap wordt vrijwel niet gebruikt in de wiki!',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Ongebruikte eigenschappen',
	'smw_unusedproperties_docu' => 'De volgende eigenschappen bestaan, hoewel ze niet gebruikt worden.',
	'smw_unusedproperty_template' => '$1 van type $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Gewenste eigenschappen',
	'smw_wantedproperties_docu' => 'De volgende eigenschapen worden gebruikt in de wiki, maar hebben geen pagina waarop ze worden beschreven.',
	'smw_wantedproperty_template' => '$1 ($2 keren gebruikt)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => 'Klik hier om alle zoekopdrachten en sjablonen op deze pagina bij te werken',
	'smw_purge' => 'Verversen',
	// Messages for Import Ontology Special
	'ontologyimport' => 'Importeer ontologie',
	'smw_oi_docu' => 'Via deze speciale pagina is het mogelijk een ontologie te importeren. Een ontologie moet een bepaalde opmaak hebben, die is gespecificeerd op de <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">ontologie importhelppagina</a>.',
	'smw_oi_action' => 'Importeer',
	'smw_oi_return' => 'Keer terug naar <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => 'Geen ontologie opgegeven, of de ontologie kon niet geladen worden.',
	'smw_oi_select' => 'Selecteer alstublieft de te importeren declaraties en klik dan op de knop Importeer.',
	'smw_oi_textforall' => 'Koptekst voor alle imports (mag leeg blijven):',
	'smw_oi_selectall' => 'Selecteer of deselecteer alle declaraties',
	'smw_oi_statementsabout' => 'Declaraties over',
	'smw_oi_mapto' => 'Koppel entiteit aan',
	'smw_oi_comment' => 'Voeg de volgende tekst toe:',
	'smw_oi_thisissubcategoryof' => 'Een subcategorie van',
	'smw_oi_thishascategory' => 'Is deel van',
	'smw_oi_importedfromontology' => 'Importeer van ontologie',
	// Messages for (data)Types Special
	'types' => 'Typen',
	'smw_types_docu' => 'Hieronder staat een lijst van alle datatypen die aan eigenschappen kunnen worden toegewezen. Ieder datatype heeft een pagina waar aanvullende informatie opgegeven kan worden.',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Semantische statistieken',
	'smw_semstats_text' => 'Deze wiki bevat <b>$1</b> eigenschapwaaren voor <b>$2</b> verschillden <a href="$3">eigenschappen</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might by <a href="$6">unused properties</a>. Eigenschappen waar nog geen pagina voor is zijn te vinden op de <a href="$7">lijst met gewenste eigenschappen</a>.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Incomplete eigenschappen',
	'smw_fattributes' => 'De onderstaande pagina\s hebben een onjuist gedefinieerde eigenschap. Het aantal onjuiste eigenschappen staat tussen de haakjes.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI-resolver',
	'smw_uri_doc' => '<p>De URI-resolver implementeert de <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. Het zorgt ervoor dat mensen niet veranderen in websites.</p>',
	// Messages for ask Special
	'ask' => 'Semantisch zoeken',
	'smw_ask_sortby' => 'Sort op kolom',
	'smw_ask_ascorder' => 'Oplopend',
	'smw_ask_descorder' => 'Aflopend',
	'smw_ask_submit' => 'Zoek resultaten',
	// Messages for the search by property special
	'searchbyproperty' => 'Zoek op eigenschap',
	'smw_sbv_docu' => '<p>Zoek naar alle pagina\'s die een bepaalde eigenschap en waarde hebben.</p>',
	'smw_sbv_noproperty' => '<p>Voer alstublieft een eigenschap in.</p>',
	'smw_sbv_novalue' => '<p>Voer alstublieft een geldige waarde in voor de eigenschap, of bekijk alle waarden voor eigenschap “$1.”</p>',
	'smw_sbv_displayresult' => 'Een lijst met alle pagina\'s waarop eigenschap “$1” de waarde “$2” heeft',
	'smw_sbv_property' => 'Eigenschap',
	'smw_sbv_value' => 'Waarde',
	'smw_sbv_submit' => 'Zoek resultaten',
	// Messages for the browsing special
	'browse' => 'Browse wiki',
	'smw_browse_article' => 'Voer de naam in van de pagina waar u met browsen wilt beginnen.',
	'smw_browse_go' => 'OK',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => 'Eigenschap pagina zoeken',
	'smw_pp_docu' => 'Zoek naar alle fillers voor een eigenschap op een gegeven pagina. Voer alstublieft zowel een pagina als een eigenschap in.',
	'smw_pp_from' => 'Van pagina',
	'smw_pp_type' => 'Eigenschap',
	'smw_pp_submit' => 'Zoek resultaten',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Vorige',
	'smw_result_next' => 'Volgende',
	'smw_result_results' => 'Resultaten',
	'smw_result_noresults' => 'Sorry, geen resultaten.'
);

/** Polish
 * @author Łukasz Bolikowski
 *
 * To further translators: some key terms appear * in multiple strings.
 * If you wish to change them, please be consistent.  The following
 * translations are currently used:
 *   relation = relacja
 *   attribute = atrybut
 *   property = własność
 *   subject article = artykuł podmiotowy
 *   object article = artykuł przedmiotowy
 *   statement = zdanie
 *   conversion = konwersja
 *   search (n) = szukanie
 *   sorry, oops ~ niestety, ojej
 * These ones may need to be refined:
 *   to support = wspierać
 *   on this site = w tym miejscu
 */
$messages['pl'] = array(
	'smw_edithelp' => 'Pomoc edycyjna odnośnie relacji i atrybutów',
	'smw_finallistconjunct' => ' i', //used in "A, B, and C"
	'smw_factbox_head' => 'Fakty o $1 &mdash; Kliknij <span class="smwsearchicon">+</span> aby znaleźć podobne strony.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Niestety, URI z przestrzeni "$1" nie są w tym miejscu dostępne.',
	/*Messages and strings for inline queries*/
	'smw_iq_disabled' => "Niestety, w tym wiki wyłączono możliwość tworzenia zapytań w artykułach.",
	'smw_iq_moreresults' => '&hellip; dalsze wyniki',
	'smw_iq_nojs' => 'Aby obejrzeć ten element, włącz w przeglądarce obsługę JavaScript.', // TODO: check if this is a sentence (Markus pruned it ;)
	/*Messages and strings for ontology resued (import) */
	'smw_unknown_importns' => 'Nie ma możliwości importu z przestrzeni nazw "$1".',
	'smw_nonright_importtype' => '$1 może być użyte tylko dla artykułów z przestrzeni nazw "$2".',
	'smw_wrong_importtype' => '$1 nie może być użyte dla artykułów z przestrzeni nazw "$2".',
	'smw_no_importelement' => 'Nie można zaimportować elementu "$1".',
	/*Messages and strings for basic datatype processing*/
	'smw_decseparator' => ',',
	'smw_kiloseparator' => '.',
	'smw_unknowntype' => '"$1" jako typ atrybutu nie jest wspierany.',
	'smw_manytypes' => 'Zdefiniowano więcej niż jeden typ dla atrybutu.',
	'smw_emptystring' => 'Puste łańcuchy znakowe są niedozwolone.',
	'smw_maxstring' => 'Reprezentacja znakowa $1 jest za długa jak na to miejsce.',
	'smw_notinenum' => '“$1” nie jest na liście dozwolonych wartości ($2) dla tego atrybutu.',
	'smw_noboolean' => '“$1” nie zostało rozpoznane jako wartość logiczna (prawda/fałsz).',
	'smw_true_words' => 'prawda,t,yes,y,tak,true',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => 'fałsz,f,no,n,nie,false',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_infinite' => 'Liczby tak duże jak $1 nie są w tym miejscu wspierane.',
	'smw_infinite_unit' => 'Konwersja do jednostki $1 zwróciła liczbę, która jest za duża jak na to miejsce.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'ten atrybut nie wspiera konwersji jednostek',
	'smw_unsupportedprefix' => 'Przedrostki dla liczb (“$1”) nie są obecnie wspierane.',
	'smw_unsupportedunit' => 'Konwersja dla jednostki "$1" nie jest wspierana.',
	// Messages for geo coordinates parsing
	'smw_label_latitude' => 'Długość:',
	'smw_label_longitude' => 'Szerokość:',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'W',
	/*Messages for datetime parsing */
	'smw_nodatetime' => 'Data "$1" nie została zrozumiana. Wsparcie dla dat jest jednak wciąż w fazie eksperymentalnej.',
	'smw_devel_warning' => 'Ta opcja jest obecnie w fazie rozwoju, może nie być w pełni funkcjonalna. Przed użyciem zabezpiecz swoje dane.',
	// Messages for article pages of types, relations, and attributes
	'smw_type_header' => 'Atrybuty typu “$1”',
	'smw_typearticlecount' => 'Pokazano $1 atrybutów używających tego typu.',
	'smw_attribute_header' => 'Strony używające atrybutu “$1”',
	'smw_attributearticlecount' => '<p>Pokazano $1 stron używających tego atrybutu.</p>',
	/*Messages for Export RDF Special*/
	'exportrdf' => 'Eksport stron do RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Ta strona pozwala eksportować fragmenty artykułu w formacie RDF.  Aby wyeksportować artykuły, wpisz ich tytuły w poniższym polu tekstowym, po jednym tytule w wierszu.</p>',
	'smw_exportrdf_recursive' => 'Rekursywny eksport wszystkich powiązanych stron.  Zwróć uwagę, że wynik może być olbrzymi!',
	'smw_exportrdf_backlinks' => 'Eksportuj także wszystkie strony, które odwołują się do eksportowanych stron.  Tworzy przeglądalny RDF.',
	/* Messages for the refresh button */
	'tooltip-purge' => 'Kliknij tutaj, aby odświeżyć wszystkie zapytania i szablony na tej stronie',
	'smw_purge' => 'Odśwież',
	/*Messages for Import Ontology Special*/
	'ontologyimport' => 'Importuj ontologię',
	'smw_oi_docu' => 'Ta strona specjalna pozwala na import ontologii.  Ontologie muszą być reprezentowane w odpowiednim formacie, opisanym na <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">stronie pomocy poświęconej importowi ontologii</a>.',
	'smw_oi_action' => 'Import',
	'smw_oi_return' => 'Powrót do <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => 'Nie podano ontologii, lub podana ontologia nie mogła być załadowana.',
	'smw_oi_select' => 'Wybierz zdania do importu, a następnie kliknij przycisk importu.',
	'smw_oi_textforall' => 'Nagłówek do dodania dla wszystkich importów (może być pusty):',
	'smw_oi_selectall' => 'Zaznacz lub odznacz wszystkie zdania',
	'smw_oi_statementsabout' => 'Zdania o',
	'smw_oi_mapto' => 'Mapuj encję na',
	'smw_oi_comment' => 'Dodaj następujący tekst:',
	'smw_oi_thisissubcategoryof' => 'Jest podkategorią',
	'smw_oi_thishascategory' => 'Jest częścią',
	'smw_oi_importedfromontology' => 'Import z ontologii',
	/*Messages for (data)Types Special*/
	'types' => 'Typy',
	'smw_types_docu' => 'Poniżej znajduje się lista wszystkich typów które mogą być przypisane atrybutom.  Każdy typ posiada artykuł, w którym mogą znajdować się dodatkowe informacje.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'Resolver URI',
	'smw_uri_doc' => '<p>Resolver URI implementuje <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. Dzięki temu ludzie nie zamieniają się w strony WWW ;)</p>', //TODO: is this the intended meaning?
	/*Messages for ask Special*/
	'ask' => 'Szukanie semantyczne',
	'smw_ask_sortby' => 'Sortuj po kolumnie',
	'smw_ask_ascorder' => 'Rosnąco',
	'smw_ask_descorder' => 'Malejąco',
	'smw_ask_submit' => 'Szukaj wyników',
	// Messages for the search by property special
	'searchbyproperty' => 'Szukaj po atrybucie',
	'smw_sbv_docu' => '<p>Szukanie wszystkich stron, które mają dany atrybut i wartość.</p>',
	'smw_sbv_noproperty' => '<p>Wpisz atrybut.</p>',
	'smw_sbv_novalue' => '<p>Wpisz wartość, lub zobacz wszystkie wartości atrybutów dla $1.</p>',
	'smw_sbv_displayresult' => 'Lista wszystkich stron, które mają atrybut $1 z wartością $2.',
	'smw_sbv_property' => 'Atrybut',
	'smw_sbv_value' => 'Wartość',
	'smw_sbv_submit' => 'Znajdź wyniki',
	// Messages for the browsing system
	'browse' => 'Przeglądaj artykuły',
	'smw_browse_article' => 'Wpisz nazwę artykułu, od którego chcesz rozpocząć przeglądanie.',
	'smw_browse_go' => 'Idź',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => 'Szukanie własności stron',
	'smw_pp_docu' => 'Szukanie wszystkich wartości danej własności na danej stronie. Proszę podać zarówno stronę, jak i własność.',
	'smw_pp_from' => 'Od strony',
	'smw_pp_type' => 'Własność',
	'smw_pp_submit' => 'Znajdź wyniki',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Poprzednie',
	'smw_result_next' => 'Następne',
	'smw_result_results' => 'Wyniki',
	'smw_result_noresults' => 'Niestety, brak wyników.'
);

/** Russian
 * @author Dmitry Khoroshev
 */
$messages['ru'] = array(
	'smw_edithelp' => 'Редактирование справки по свойствам',
	'smw_viewasrdf' => 'RDF источник',
	'smw_finallistconjunct' => ' и', //used in "A, B, and C"
	'smw_factbox_head' => 'Факты: $1',
	'smw_isspecprop' => 'Это свойство является специальным для данного сайта.',
	'smw_isknowntype' => 'Этот тип данных принадлежит к стандартным типам данных данного сайта.',
	'smw_isaliastype' => 'Этот тип данных является альтернативным именем типа данных “$1”.',
	'smw_isnotype' => 'Тип данных “$1” не был определен.',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Извините, но ссылки из диапазона "$1" не доступны отсюда.',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "Извините, но встроенные запросы отключены для этого сайта.",
	'smw_iq_moreresults' => '&hellip; следующие результаты',
	'smw_iq_nojs' => 'Используйте браузер с поддержкой JavaScript для просмотра данного элемента.',
	'smw_iq_altresults' => 'Просмотреть список результатов.', // available link when JS is disabled
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => 'Ошибка: Функции импорта не доступны для пространства имен "$1".',
	'smw_nonright_importtype' => 'Ошибка: $1 может быть использован только для статей с пространством имен "$2".',
	'smw_wrong_importtype' => 'Ошибка: $1 не может быть использован для статей с пространством имен "$2".',
	'smw_no_importelement' => 'Ошибка: Элемент "$1" не доступен для импорта.',
	// Messages and strings for basic datatype processing
	'smw_decseparator' => ',',
	'smw_kiloseparator' => ' ',
	'smw_notitle' => '“$1” не может быть использован как заголовок статьи на данном сайте.',
	'smw_unknowntype' => 'Тип "$1" не поддерживается для данного свойства.',
	'smw_manytypes' => 'Более одного типа определено для свойства.',
	'smw_emptystring' => 'Пустые строки недопустимы.',
	'smw_maxstring' => 'Ошибка: Строковое представление $1 слишком длинное для этого сайта.',
	'smw_notinenum' => '"$1" не входит в список допустимых значений ($2) для этого свойства.',
	'smw_noboolean' => '"$1" не является булевым значением (да/нет).',
	'smw_true_words' => 'да,t,yes,д,истина,и,true',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => 'нет,f,no,n,н,ложь,л,false',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_nofloat' => '"$1" не является числом.',
	'smw_infinite' => 'Ошибка: Столь длинные числа как $1 не поддерживаются этим сайтом.',
	'smw_infinite_unit' => 'Ошибка: Преобразование значения в единицы измерения “$1” привело к слишком длинному числу для этого сайта.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this attribute supports no unit conversion',
	'smw_unsupportedprefix' => 'Префиксы для чисел ("$1") не поддерживаются в настоящее время.',
	'smw_unsupportedunit' => 'Преобразование единиц измерения для "$1" не поддерживается.',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => 'Числовое значение перед символом “$1” отсутствует.', // $1 is something like °
	'smw_bad_latlong' => 'Широта и долгота должны быть заданы только один раз, и с корректными координатами.',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'W',
	'smw_label_latitude' => 'Широта:',
	'smw_label_longitude' => 'Долгота:',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " найти&nbsp;на&nbsp;карте|http://tools.wikimedia.de/~magnus/geo/geohack.php?language=ru&params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => 'Дата "$1" не распознана (поддержка дат находится в разработке).',
	// Errors and notices related to queries
	'smw_toomanyclosing' => 'Ошибка: Слишком много вхождений “$1” в данном запросе.',
	'smw_noclosingbrackets' => 'Ошибка: Открывающаяся пара скобок “[&#x005B;” не была закрыта парой соответствующих ей закрывающих скобок “]]” в данном запросе.',
	'smw_misplacedsymbol' => 'Ошибка: Использование символа “$1” в данном месте лишено смысла.',
	'smw_unexpectedpart' => 'Ошибка: Часть “$1” запроса не была распознана. Результаты могут отличаться от ожидаемых.',
	'smw_emptysubquery' => 'Ошибка: В одном из подзапросов не указано правильного знака условия.',
	'smw_misplacedsubquery' => 'Ошибка: Подзапрос используется в месте, где подзапросы не разрешены.',
	'smw_valuesubquery' => 'Ошибка: Подзапросы не поддерживаются для значений свойства “$1”.',
	'smw_overprintoutlimit' => 'Ошибка: Запрос содержит слишком много требований вывода.',
	'smw_badprintout' => 'Ошибка: Некоторое выражение вывода в запросе неправильно составлено.',
	'smw_badtitle' => 'Извините, но “$1” не является правильным заголовком статьи.',
	'smw_badqueryatom' => 'Ошибка: Часть запроса “[&#x005B;&hellip;]]” не была разобрана.',
	'smw_propvalueproblem' => 'Ошибка: Значение свойства “$1” не разобрано.',
	'smw_nodisjunctions' => 'Ошибка: Дизъюнкции (логическое ИЛИ) не поддерживаются данным сайтом, поэтому использующая их часть запроса была проигнорирована ($1).',
	'smw_querytoolarge' => 'Ошибка: Указанные условия запроса “$1” не могут быть выполнены из-за ограничения на глубину или размер запроса.',
	'smw_devel_warning' => 'Эта функция в настоящее время находится в разработке. Сделайте резервную копию прежде чем её использовать.',
	// Messages for article pages of types, relations, and attributes
	'smw_type_header' => 'Свойства типа “$1”',
	'smw_typearticlecount' => 'Отображается $1 свойств этого типа.',
	'smw_attribute_header' => 'Страницы, использующие свойство “$1”',
	'smw_attributearticlecount' => '<p>Отображается $1 страниц, использующих это свойство.</p>',
	// Messages used in RSS feeds
	'smw_rss_description' => '$1 источник RSS',
	// Messages for Export RDF Special
    'exportrdf' => 'Экспорт страниц в RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Эта страница позволяет экспортировать части статьи в формате RDF. Наберите заголовки необходимых статей по одному на строку.</p>',
	'smw_exportrdf_recursive' => 'Рекурсивный экспорт всех связанных страниц. Результат этой операции может быть очень большим!',
	'smw_exportrdf_backlinks' => 'Также экспортировать все страницы, которые ссылаются на экспортируемые страницы. Генерирует RDF с поддержкой полноценной навигации.',
	'smw_exportrdf_lastdate' => 'Не экспортировать страницы, которые не менялись с указанной даты.',
	// Messages for Properties Special
	'properties' => 'Свойства',
	'smw_properties_docu' => 'Следующие свойства используются на данном сайте.',
	'smw_property_template' => '$1 имеет тип $2, количество использований ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'Каждое свойство должно иметь свою страницу описания!',
	'smw_propertylackstype' => 'Данному свойству не сопоставлен тип данных (по умолчанию будет использоваться тип $1).',
	'smw_propertyhardlyused' => 'Это свойство изначально предопределено для данного сайта!',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Неиспользуемые свойства',
	'smw_unusedproperties_docu' => 'Следующие свойства определены, но не используются ни в одной из статей.',
	'smw_unusedproperty_template' => '$1 имеет тип $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Неописанные свойства',
	'smw_wantedproperties_docu' => 'Следующие свойства используются в статьях данного сайта, но не имеют соответствующих им страниц описаний.',
	'smw_wantedproperty_template' => '$1 ($2 использований)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => 'Нажмите здесь для обновления всех запросов и шаблонов на этой странице',
	'smw_purge' => 'Обновить',
	// Messages for Import Ontology Special
	'ontologyimport' => 'Импорт онтологии',
	'smw_oi_docu' => 'Это специальная страница для импорта онтологий. Формат онтологии приведен на <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">странице справки</a>.',
	'smw_oi_action' => 'Импорт',
	'smw_oi_return' => 'Вернуться к <a href="$1">Импорту онтологий</a>.',
	'smw_oi_noontology' => 'Онтология не задана или не может быть загружена.',
	'smw_oi_select' => 'Пожалуйста, выберите утверждения для импорта и нажмите кнопку Импорт.',
	'smw_oi_textforall' => 'Текст заголовка для импорта (может быть пустым):',
	'smw_oi_selectall' => 'Включите/отключите все утверждения',
	'smw_oi_statementsabout' => 'Утверждения о',
	'smw_oi_mapto' => 'Отобразить сущность на',
	'smw_oi_comment' => 'Добавьте текст:',
	'smw_oi_thisissubcategoryof' => 'Является подкатегорией для',
	'smw_oi_thishascategory' => 'Является частью',
	'smw_oi_importedfromontology' => 'Импортировать из онтологии',
	// Messages for (data)Types Special
	'types' => 'Типы',
	'smw_types_docu' => 'Список поддерживаемых типов свойств. Каждый тип имеет страницу, на которую можно поместить его расширенное описание.',
	'smw_typeunits' => 'Единицы измерения типа “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Семантическая статистика',
	'smw_semstats_text' => 'Данный сайт содержит <b>$1</b> значений свойств, общее количество различных <a href="$3">свойств</a> равно <b>$2</b>. <b>$4</b> свойств имеют страницу описания. Определенный тип данных задан на соответствующей странице описания для <b>$5</b> из общего числа свойств. Некоторые из существующих свойств могут <a href="$6">не использоваться</a>. Свойства, для которых не созданы страницы описания, могут быть найдены по специальной ссылке <a href="$7">список неописанных свойств</a>.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Поврежденные свойства',
	'smw_fattributes' => 'Статьи, указанные ниже, содержат неправильно определенные свойства. Количество неверных свойств указано в скобках.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'Преобразователь URI',
	'smw_uri_doc' => '<p>Преобразователь URI осуществляет <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C поиск http тэгов с использованием Range-14</a>. Данная возможность упрощает поиск семантической информации.</p>',
	// Messages for ask Special
	'ask' => 'Семантический поиск',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Help:Семантический поиск',
	'smw_ask_sortby' => 'Сортировать по столбцу',
	'smw_ask_ascorder' => 'По возрастанию',
	'smw_ask_descorder' => 'По убыванию',
	'smw_ask_submit' => 'Найти',
	'smw_ask_editquery' => '[Редактировать запрос]',
	'smw_add_sortcondition' => '[Добавить условие сортировки]',
	'smw_ask_hidequery' => 'Скрыть запрос',
	'smw_ask_help' => 'Помощь по составлению запросов',
	'smw_ask_queryhead' => 'Запрос',
	'smw_ask_printhead' => 'Дополнительные поля вывода (не являются обязательными)',
	// Messages for the search by property special
	'searchbyproperty' => 'Искать по свойству',
	'smw_sbv_docu' => '<p>Искать все страницы, которые содержат указаннок свойство и значение.</p>',
	'smw_sbv_noproperty' => '<p>Укажите свойство.</p>',
	'smw_sbv_novalue' => '<p>Укажите значение или просмотрите все значения свойства $1.</p>',
	'smw_sbv_displayresult' => 'Список всех страниц, которые содержат свойство $1 со значением $2.',
	'smw_sbv_property' => 'Свойство',
	'smw_sbv_value' => 'значение',
	'smw_sbv_submit' => 'Найти',
	// Messages for the browsing system
	'browse' => 'Просмотреть сайт',
	'smw_browse_article' => 'Введите имя страницы для начала просмотра.',
	'smw_browse_go' => 'Перейти',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => 'Страница поиска свойств',
	'smw_pp_docu' => 'Искать все значения свойства на указанной странице. Пожалуйста введите имя страницы и имя свойства.',
	'smw_pp_from' => 'Со страницы',
	'smw_pp_type' => 'Свойство',
	'smw_pp_submit' => 'Поиск результатов',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Предыдущая',
	'smw_result_next' => 'Следующая',
	'smw_result_results' => 'Результаты',
	'smw_result_noresults' => 'Извините, но ничего не найдено.'
);

/** Slovak
 * @author helix84
 */
$messages['sk'] = array(
	'smw_edithelp' => 'Pomoc pri upravovaní vzťahov a atribútov',
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => ' a', //used in "A, B, and C"
	'smw_factbox_head' => 'Skutočnosti o $1 &mdash; Kliknutím na <span class="smwsearchicon">+</span> vyhľadáte podobné stránky.',
	/*URIs that should not be used in objects in cases where users can provide URIs */
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Prepáčte, URI z rozsahu "$1" na tomto mieste nie sú dostupné.',
	/*Messages and strings for inline queries*/
	'smw_iq_disabled' => "Prepáčte. Inline queries have been disabled for this wiki.",
	'smw_iq_moreresults' => '&hellip; ďalšie výsledky',
	/*Messages and strings for ontology resued (import) */
	'smw_unknown_importns' => 'Funkcie importu nie sú dostupné pre menný priestor "$1".',
	'smw_nonright_importtype' => '$1 je možné použiť iba pre stránky z menného priestoru "$2".',
	'smw_wrong_importtype' => '$1 nie je možné použiť pre stránky z menného priestoru "$2".',
	'smw_no_importelement' => 'Prvok "$1" nie je dostupný na import.',
	/*Messages and strings for basic datatype processing*/
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_unknowntype' => 'Pre atribút je definovaný nepodporovaný typ "$1".',
	'smw_manytypes' => 'Pre atribút bol definovaný viac ako jeden typ.',
	'smw_emptystring' => 'Prázdne reťazcie nie sú akceptované.',
	'smw_maxstring' => 'Reprezentácia reťazca $1 je pre túro stránku príliš dlhá.',
	'smw_noboolean' => '"$1" nebolo rozpoznané ako platná hodnota typy boolean (áno/nie).',
	'smw_true_words' => 'áno,true',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => 'nie,false',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_nofloat' => '"$1" nie je číslo s plávajúcou desatinnou čiarkou.', // TODO Change "floating-point" number to just "number"
	'smw_infinite' => 'Čísla také dlhé ako $1 nie sú na tejto stránke podporované.',
	'smw_infinite_unit' => 'Konverzia na jednotky $1 dala ako výsledok číslo, ktoré je pre túto stránku príliš dlhé.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'tento atribút nepodporuje konverziu jednotiek',
	'smw_unsupportedunit' => 'konverzia jednotiek "$1" nie je podporované',
	// Messages for geo coordinates parsing
	'smw_label_latitude' => 'Zemepisná šírka:',
	'smw_label_longitude' => 'Zemepisná dĺžka:',
	'smw_abb_north' => 'S',
	'smw_abb_east' => 'V',
	'smw_abb_south' => 'J',
	'smw_abb_west' => 'Z',
	/*Messages for datetime parsing */
	'smw_nodatetime' => 'Nevedel som interpretovať dátum "$1". Ale podpora dátumov je stále v experimentálno štádiu.',
	'smw_devel_warning' => 'Táto vlastnosť je momentálne vo vývoji a nemusí byť celkom funkčná. Predtým, než ju použijete si zálohujte dáta.',
	// Messages for article pages of types, relations, and attributes
	/*Messages for Export RDF Special*/
	'exportrdf' => 'Exportovať stránky do RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Táto stránka vám umožňuje exportovať časti stránok do formátu RDF. Po zadaní názvov stránok do spodného textového poľa, jeden názov na riadok, môžete exportovať stránky.</p>',
	'smw_exportrdf_recursive' => 'Rekurzívne exportovať všetky súvisiace stránky. Pozor, výsledok môže byť veľmi veľký!',
	'smw_exportrdf_backlinks' => 'Tieť exportovať všetky stránky, ktoré odkazujú na exportované stránky. Vytvorí prehliadateľné RDF.',
	/* Messages for the refresh button */
	'tooltip-purge' => 'Kliknutím sem obnovíte všetky dotazy a šablóny na tejto stránke',
	'smw_purge' => 'Obnoviť',
	/*Messages for Import Ontology Special*/
	'ontologyimport' => 'Importovať ontológiu',
	'smw_oi_docu' => 'Táto špeciálna stránka umožňuje import ontológií. Ontológie musia dodržiavať istý formát, špecifkovaný na <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">stránke pomocníka pre import ontógie</a>.',
	'smw_oi_action' => 'Import',
	'smw_oi_return' => 'Návrat na <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => 'Ontológia nie je podporovaná alebo nebolo možné načítať ontológiu.',
	'smw_oi_select' => 'Prosím, vyberte výroky, ktoré sa majú importovať a porom kliknite na tlačidlo import.',
	'smw_oi_textforall' => 'Text hlavičky, ktorý sa pridá k všetkým importom (môže byť prázdny):',
	'smw_oi_selectall' => 'Vybrať alebo odobrať všetky výroky o',
	'smw_oi_statementsabout' => 'Výroky o',
	'smw_oi_mapto' => 'Mapuje entitu na',
	'smw_oi_comment' => 'Pridá nasledovný text:',
	'smw_oi_thisissubcategoryof' => 'Je podkategóriou',
	'smw_oi_thishascategory' => 'Je časťou',
	'smw_oi_importedfromontology' => 'Import z ontológie',
	/*Messages for (data)Types Special*/
	'types' => 'Typy',
	'smw_types_docu' => 'Nasleduje zoznam všetkých údajových typov, ktoré je možné priradiť atribútom. Každý údajový typ má stránku, kde je možné poskytnúť dodatočné informácie.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Chybných atribútov',
	'smw_fattributes' => 'Nižšie uvedené stránky majú nesprávne definovaný atribút. Počet nesprávnych atribútov udáva číslo v zátvorkách.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI Resolver',
	'smw_uri_doc' => '<p>URI resolver sa stará o implementáciu <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG hľadanie na httpRange-14</a>. Stará sa o to, aby sa ľudia nestali webstránkami.</p>',
	/*Messages for ask Special*/
	'ask' => 'Sémantické vyhľadávanie',
	'smw_ask_sortby' => 'Zoradiť podľa stĺpca',
	'smw_ask_ascorder' => 'Vzostupne',
	'smw_ask_descorder' => 'Zostupne',
	'smw_ask_submit' => 'Nájdi výsledky',
	// Messages for the search by value special // TODO: consider re-translation (look at new English version)
	'searchbyproperty' => 'Hľadať podľa hodnoty atribútu',
	'smw_sbv_docu' => '<p>Hľadať na wiki článok, ktorý má atribút s istou hodnotou.</p>',
	'smw_sbv_noproperty' => '<p>Nebol poskytnutý atribút. Prosím, poskytnite ho vo formulári.</p>',
	'smw_sbv_novalue' => '<p>Nebola poskytnutá hodnota. Prosím, poskytnite ju vo formulári alebo zobrazte všetky atribúty typu $1</p>',
	'smw_sbv_displayresult' => 'Zoznam všetkých článkov, ktoré majú atribút $1 $2.',
	'smw_sbv_property' => 'Atribút:',
	'smw_sbv_value' => 'Hodnota:',
	'smw_sbv_submit' => 'Hľadať výsledky',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Späť',
	'smw_result_next' => 'Ďalej',
	'smw_result_results' => 'Výsledky',
	'smw_result_noresults' => 'Prepáčte, žiadne výsledky.'
);

/** Taiwan Chinese 中文(台灣)‬ (‪中文(台灣)‬)
 * @author Roc Michael
 */
$messages['zh-tw'] = array(
	'smw_edithelp' => '與關聯(relations)及屬性(attributes)有關的編輯協助',  //(Editing help on relations and attributes)
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => '， 和',    //(, and) used in "A, B, and C"
	'smw_factbox_head' => '關於$1 的小檔案', //(Facts about $1)
	'smw_isspecprop' => '在此wiki系統內，此一性質為一種特殊性質', //(This property is a special property in this wiki.)
	'smw_isknowntype' => '此一型態係為這個wiki系統內的標準的資料型態之一',//(This type is among the standard datatypes of this wiki.)
	'smw_isaliastype' => '此一型態係為資料型態“$1”的別稱',//(This type is an alias for the datatype “$1”.)
	'smw_isnotype' => '在此wiki系統內，此一“$1”型態並非是一項標準的資料型態，並且尚未被用戶賦予其定義',
	//(This type “$1” is not a standard datatype in the wiki, and has not been given a user definition either.) URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => '抱歉，在此處無法取得從“$1”範圍的，URIs. (譯註原文為：Sorry, URIs of the form “$1” are not allowed.)',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "抱歉，線上查詢在此wiki已被設定為無效", //"Sorry. Semantic queries have been disabled for this wiki."
	'smw_iq_moreresults' => '&hellip; 進階查詢',	//'&hellip; further results'
	'smw_iq_nojs' => '請使用內建JavaScript的瀏覽器以瀏覽此元素.',	//'Use a JavaScript-enabled browser to view this element.' // TODO: check translation (Markus pruned it ;)
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => '匯入功能對“$1”的名字空間無效”.', 	//'Import functions are not avalable for namespace “$1”.
	'smw_nonright_importtype' => '$1僅能用於名字空間為“$2”的頁面。',	//'$1 can only be used for pages with namespace “$2”.'
	'smw_wrong_importtype' => '$1無法用於名字空間為“$2”的頁面。',	//'$1 can not be used for pages in the namespace “$2”.'
	'smw_no_importelement' => '無法匯入“$1”元素',	//'Element “$1” not available for import.'
	// Messages and strings for basic datatype processing
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '在此wiki內，是無法用“$1”來當作頁面名稱的',	//'“$1” cannot be used as a page name in this wiki.'
	'smw_unknowntype' => '不支援為性質所定義的“$1”形態。',	//'Unsupported type “$1” defined for property.'
	'smw_manytypes' => '定義此性質的型態已超過了一種以上。',	//'More than one type defined for property.'
	'smw_emptystring' => '不接受空白字串。',	//'Empty strings are not accepted.'
	'smw_maxstring' => '對本站而言，$1所代表的字串太長了。',	//'String representation $1 is too long for this site.'
	'smw_notinenum' => '“$1” 並非在此屬性有可能的值 ($2)的清單之中',	// '“$1” is not in the list of possible values ($2) for this property.'
	'smw_noboolean' => '“$1”無法被視為布林值(true/false)。',	//'“$1” is not recognized as a boolean (true/false) value.'
	'smw_true_words' => '是,t,yes,y,true',	// comma-separated synonyms for boolean TRUE besides '1'
	'smw_false_words' => '否,f,no,n,false',	// comma-separated synonyms for boolean FALSE besides '0'
	'smw_nofloat' => '“$1” 並非為是數字',	// '“$1” is no number.'
	'smw_infinite' => '在此站內並不支援像是“$1”如此龐大的數目字。',	//'Numbers as large as “$1” are not supported on this site.'
	'smw_infinite_unit' => '對此站而言轉換“$1”單位所產生的數目字過於龐大。',	// 'Conversion into unit “$1” resulted in a number that is too large for this site.'
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this property supports no unit conversion',
	'smw_unsupportedprefix' => '數字(“$1”) 的字首目前尚未被支援',	//'Prefixes for numbers (“$1”) are not supported.'
	'smw_unsupportedunit' => '單位轉換無法適用於“$1”此一單位',	//'Unit conversion for unit “$1” not supported.'
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => '在“$1”此一單位之前並無數目字', //'No number found before the symbol “$1”.'	// $1 is something like °
	'smw_bad_latlong' => '緯度和經度只能以有效的座標值標示一次',	//'Latitude and longitude must be given only once, and with valid coordinates.'
	'smw_abb_north' => 'N',    //北
	'smw_abb_east' => 'E',     //東
	'smw_abb_south' => 'S',    //南
	'smw_abb_west' => 'W',     //西
	'smw_label_latitude' => '緯度：',	// 'Latitude:'
	'smw_label_longitude' => '經度：',	//'Longitude:'
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",	//" find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6"
	// Messages for datetime parsing
	'smw_nodatetime' => '日期值“$1”無法被識別，對日期值的支援目前尚屬實驗性質。',	//'The date “$1” was not understood (support for dates is still experimental).'
	// Errors and notices related to queries
	'smw_toomanyclosing' => '在此查詢中“$1”顯然出現太多次了',	// 'There appear to be too many occurrences of “$1” in the query.'
	'smw_noclosingbrackets' => '在您的查詢中“[&#x005B;” 並未以對應的“]]”來予以封閉',	// 'Some use of “[&#x005B;” in your query was not closed by a matching “]]”.'
	'smw_misplacedsymbol' => '“$1”此一符號用於某項無用之處',	//'The symbol “$1” was used in a place where it is not useful.'
	'smw_unexpectedpart' => '查詢的“$1”部份無法被識別，可能會出現預料之外的結果',	// 'The part “$1” of the query was not understood. Results might not be as expected.'
	'smw_emptysubquery' => '某些子查詢並不具備有效的查詢條件',	//'Some subquery has no valid condition.'
	'smw_misplacedsubquery' => '某些子查詢被用在不宜於使用子查詢之處',	//'Some subquery was used in a place where no subqueries are allowed.'
	'smw_valuesubquery' => '“$1”質性的值並不適用於子查詢',	//'Subqueries not supported for values of property “$1”.',	//'Subqueries not supported for values of property “$1”.'
	'smw_overprintoutlimit' => '此查詢含有太多的輸出要求',	//'The query contains too many printout requests.'
	'smw_badprintout' => '在此查詢中，有些輸出敘述已被弄錯了',  //'Some print statement in the query was misshaped.'
	'smw_badtitle' => '抱歉！“$1” 並非是有效的頁面名稱',	//'Sorry, but “$1” is no valid page title.',
	'smw_badqueryatom' => '在此查詢中，部份的“[#x005B;&hellip]]”無法被識別。',	//'Some part “[#x005B;&hellip]]” of the query was not understood.',
	'smw_propvalueproblem' => '質性“$1”的值無法被識別',	//'The value of property “$1” was not understood.',
	'smw_nodisjunctions' => '在此wiki系統內分開查詢是不被支援的，並有部份查詢已被遺漏 ($1)。(譯註原文為：Disjunctions in queries are not supported in this wiki and part of the query was dropped ($1).)',
	'smw_querytoolarge' => '基於此wiki系統對查詢的規模及在深度方面的限制，以下的查詢條件無法被接受：$1',	//The following query conditions could not be considered due to the wikis restrictions in query size or depth: $1.
	'smw_devel_warning' => '此元件尚於開發中，也許無法完成發揮功效，在使用它之前，請先備份您的資料',	//'This feature is currently under development, and might not be fully functional. Backup your data before using it.',
	// Messages for pages of types and properties
	'smw_type_header' => '“$1”型態的性質',	//'Properties of type “$1”',
	'smw_typearticlecount' => '以此型態顯示 $1 性質',	//'Showing $1 properties using this type.',
	'smw_attribute_header' => '使用性質“$1”的頁面',	//'Pages using the property “$1”',
	'smw_attributearticlecount' => '<p>以此性質顯示$1頁面.</p>',	//'<p>Showing $1 pages using this property.</p>',
	// Messages for Export RDF Special
	'exportrdf' => '輸出頁面至RDF 。',	//'Export pages to RDF', //name of this special
	'smw_exportrdf_docu' => '<p>此一頁面可讓您獲取RDF格式頁面的資料，要輸出頁面，請在下方的文字框內鍵入頁面的抬頭，一項一行。</p>',	//'<p>This page allows you to obtain data from a page in RDF format. To export pages, enter the titles in the text box below, one title per line.</p>',
	'smw_exportrdf_recursive' => '逐項輸出所有的相關的頁面，請注意輸出的結果可能頗為龐大。',	//'Recursively export all related pages. Note that the result could be large!',
	'smw_exportrdf_backlinks' => '並且輸出與輸出頁面有關的頁面，產生可供人閱讀的RDF。(browsable RDF)',	//'Also export all pages that refer to the exported pages. Generates browsable RDF.',
	'smw_exportrdf_lastdate' => '無須輸出那些在所設之時間點以後就未再被更動過的頁面',	//'Do not export pages that were not changed since the given point in time.',
	// Messages for Properties Special
	'properties' => '性質',	//'Properties',
	'smw_properties_docu' => '以下的性質已被用於此wiki內',	//'The following properties are used in the wiki.',
	'smw_property_template' => ' $1 　型態為：$2　使用次數：($3)',	//'$1 of type $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => '所有的性質應以某一頁面加以描述。',	//'All properties should be described by a page!',
	'smw_propertylackstype' => '此一性質尚未被指定形態，先暫定為$1型態。',	//'No type was specified for this property (assuming type $1 for now).',
	'smw_propertyhardlyused' => '此一性質難以用於此wiki內',	//'This property is hardly used within the wiki!',
	// Messages for Unused Properties Special
	'unusedproperties' => '未使用的性質',	//'Unused Properties',
	'smw_unusedproperties_docu' => '下方的性質雖已存在，但無其他的頁面使用它們。',	//'The following properties exist although no other page makes use of them.',
	'smw_unusedproperty_template' => '$2型態的$1',	//'$1 of type $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => '待建立的性質',	//'Wanted Properties',
	'smw_wantedproperties_docu' => '下方的性質雖已用於此wiki內，但卻未事先以任何頁面去定義它們。',	//'The following properties are used in the wiki but do not yet have a page for describing them.',
	'smw_wantedproperty_template' => '$1 (已用於$2處)',	//'$1 ($2 uses)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => '按此處以更新此頁全部的查詢項目及樣板。',	//'Click here to refresh all queries and templates on this page',
	'smw_purge' => '更新',	//'Refresh',
	// Messages for Import Ontology Special
	'ontologyimport' => '輸入知識本體(ontology)',	//'Import ontology',
	'smw_oi_docu' => '此特殊頁可用以輸入知識本體(ontology)，此知識本體(ontology)必須依循特定的格式，此特定格式在<a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">知識本體(ontology)的匯入求助頁面。</a>',	//'This special page allows to import ontologies. The ontologies have to follow a certain format, specified at the <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">ontology import help page</a>.',
	'smw_oi_action' => '輸入',	//'Import',
	'smw_oi_return' => '返回<a href="$1">Special:OntologyImport</a>',	//'Return to <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => '無知識本體(ontology)可提供或者無法載入知識本體',	//'No ontology supplied, or could not load ontology.',
	'smw_oi_select' => '請選擇某敘述以輸入然後按輸入鍵',	//'Please select the statements to import, and then click the import button.',
	'smw_oi_textforall' => '用以添加於所有輸入的標題文字(也許是空白)：',	//'Header text to add to all imports (may be empty):',
	'smw_oi_selectall' => '選取或放棄選取全部的敘述',	//'Select or unselect all statements',
	'smw_oi_statementsabout' => '相關描述',	//'Statements about',
	'smw_oi_mapto' => '對映本質(entity)至',	//'Map entity to',
	'smw_oi_comment' => '添加以下的文字：',	//'Add the following text:',
	'smw_oi_thisissubcategoryof' => '所屬的次分類',	//'A subcategory of',
	'smw_oi_thishascategory' => '此部分附屬於(Is part of)',	//'Is part of',
	'smw_oi_importedfromontology' => '從知識本體(ontology)輸入',	//'Import from ontology',
	// Messages for (data)Types Special
	'types' => '型態',	//'Types',
	'smw_types_docu' => '以下為所有資料型態的清單，資料型態可用於指定性質，每項資料型態皆有提供附加資訊的頁面。',	//'The following is a list of all datatypes that can be assigned to properties. Each datatype has a page where additional information can be provided.',
	'smw_typeunits' => '“$1”型態的量測單位：$2',	//'Units of measurement of type “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => '語意統計(Semantic Statistics)',	//'Semantic Statistics',
	'smw_semstats_text' => '此wiki含有<b>$1</b>性質的值以用於總計<b>$2</b> 不同於 <a href="$3">性質</a>。 <b>$4</b>性質有著專屬的專面，且預期所需的資料型態因著<b>$5</b>，而已被指定了，有些現有的性質也許為<a href="$6">未使用的性質</a>。您可在 <a href="$7">待建立的性質清單</a>中，找到那些尚未建立專屬頁面的性質。(譯註原文為：This wiki contains <b>$1</b> property values for a total of <b>$2</b> different <a href="$3">properties</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might by <a href="$6">unused properties</a>. Properties that still lack a page are found on the <a href="$7">list of wanted properties</a>.This wiki contains <b>$1</b> property values for a total of <b>$2</b> different <a href="$3">properties</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might by <a href="$6">unused properties</a>. Properties that still lack a page are found on the <a href="$7">list of wanted properties</a>.)',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => '錯誤的性質',	//'Flawed Properties',
	'smw_fattributes' => '在下方處被列出的頁面有著一項非正確定義的屬性，非正確的屬性的數量置於中括號內',	//'The pages listed below have an incorrectly defined property. The number of incorrect properties is given in the brackets.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI Resolver',	//'URI Resolver',
	'smw_uri_doc' => '<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',	//'<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',
	// Messages for ask Special
	'ask' => '語意搜尋',	//'Semantic search',
	'smw_ask_sortby' => '依欄位排序',       //(Sort by column)
	'smw_ask_ascorder' => '升冪',        //(Ascending)
	'smw_ask_descorder' => '降冪',       //(Descending)
	'smw_ask_submit' => '搜尋的結果',       //(Find results)	
	'smw_ask_editquery' => '[編輯查詢]', // '[Edit query]'
	'smw_ask_hidequery' => '隱藏查詢', // 'Hide query'
	'smw_ask_help' => '查詢協助', // 'Querying help'
	'smw_ask_queryhead' => '查詢', // 'Query'
	'smw_ask_printhead' => '其他查詢(選擇性的)', // 'Additional printouts (optional)'
	// Messages for the search by property special
	'searchbyproperty' => '依性質搜尋',	//'Search by property',
	'smw_sbv_docu' => '<p>依所指定的性質及其值來搜尋頁面</p>',	//'<p>Search for all pages that have a given property and value.</p>',
	'smw_sbv_noproperty' => '請輸入某項性質',	//'<p>Please enter a property.</p>',
	'smw_sbv_novalue' => '<p>請為該性質輸入一項有效值，或請查閱“$1.”的全部的性質的值</p>',	//'<p>Please enter a valid value for the property, or view all property values for “$1.”</p>',
	'smw_sbv_displayresult' => '所有“$1”性質項目中，皆帶有“$2”值的頁面清單',	//'A list of all pages that have property “$1” with value “$2”',
	'smw_sbv_property' => '性質',	//'Property',
	'smw_sbv_value' => '值',	//'Value',
	'smw_sbv_submit' => '搜尋的結果',	//'Find results',
	// Messages for the browsing special
	'browse' => '瀏覽wiki',	//'Browse wiki',
	'smw_browse_article' => '在開始瀏覽的表單中輸入頁面名稱',	//'Enter the name of the page to start browsing from.',
	'smw_browse_go' => '前往',	//'Go',
	'smw_browse_more' => '&hellip;',	//'&hellip;',
	// Messages for the page property special
	'pageproperty' => '頁面性質搜尋',	//'Page property search',
	'smw_pp_docu' => '搜尋某一頁面全部性質的過濾條件，請同時輸入頁面及性質',	//'Search for all the fillers of a property on a given page. Please enter both a page and a property.',
	'smw_pp_from' => '開始頁面(From page)',
	'smw_pp_type' => '性質',	//'Property',
	'smw_pp_submit' => '搜尋的結果',	//'Find results',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => '前一頁',        //(Previous)
	'smw_result_next' => '下一頁',        //(Next)
	'smw_result_results' => '結果',      //(Results)
	'smw_result_noresults' => '抱歉，無您所要的結果。'    //(Sorry, no results.)	
);

/** Mainland Chinese
 * @author Roc Michael
 */
$messages['zh-cn'] = array(
	'smw_edithelp' => '与关联(relations)及属性(attributes)有关的编辑协助',  //(Editing help on relations and attributes)
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => '， 和',    //(, and) used in "A, B, and C"
	'smw_factbox_head' => '关于$1 的小文件', //(Facts about $1)
	'smw_isspecprop' => '在此wiki系统内，此一性质为一种特殊性质', //(This property is a special property in this wiki.)
	'smw_isknowntype' => '此一型态系为这个wiki系统内的标准的资料型态之一',//(This type is among the standard datatypes of this wiki.)
	'smw_isaliastype' => '此一型态系为资料型态“$1＂的别称',//(This type is an alias for the datatype “$1＂.)
	'smw_isnotype' => '在此wiki系统内，此一“$1＂型态并非是一项标准的资料型态，并且尚未被用户赋予其定义',
	//(This type “$1＂ is not a standard datatype in the wiki, and has not been given a user definition either.) URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => '抱歉，在此处无法取得从“$1＂范围的，URIs. (译注原文为：Sorry, URIs of the form “$1＂ are not allowed.)',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "抱歉，联机查询在此wiki已被设置为无效", //"Sorry. Semantic queries have been disabled for this wiki."
	'smw_iq_moreresults' => '&hellip; 高级查询',	//'&hellip; further results'
	'smw_iq_nojs' => '请使用内建JavaScript的浏览器以浏览此元素.',	//'Use a JavaScript-enabled browser to view this element.' // TODO: check translation (Markus pruned it ;)
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => '导入功能对“$1＂的名字空间无效＂.', 	//'Import functions are not avalable for namespace “$1＂.
	'smw_nonright_importtype' => '$1仅能用于名字空间为“$2＂的页面。',	//'$1 can only be used for pages with namespace “$2＂.'
	'smw_wrong_importtype' => '$1无法用于名字空间为“$2＂的页面。',	//'$1 can not be used for pages in the namespace “$2＂.'
	'smw_no_importelement' => '无法导入“$1＂元素',	//'Element “$1＂ not available for import.'
	// Messages and strings for basic datatype processing
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '在此wiki内，是无法用“$1＂来当作页面名称的',	//'“$1＂ cannot be used as a page name in this wiki.'
	'smw_unknowntype' => '不支持为性质所定义的“$1＂形态。',	//'Unsupported type “$1＂ defined for property.'
	'smw_manytypes' => '定义此性质的型态已超过了一种以上。',	//'More than one type defined for property.'
	'smw_emptystring' => '不接受空白字串。',	//'Empty strings are not accepted.'
	'smw_maxstring' => '对本站而言，$1所代表的字串太长了。',	//'String representation $1 is too long for this site.'
	'smw_notinenum' => '“$1＂ 并非在此属性有可能的值 ($2)的列表之中',	// '“$1＂ is not in the list of possible values ($2) for this property.'
	'smw_noboolean' => '“$1＂无法被视为布林值(true/false)。',	//'“$1＂ is not recognized as a boolean (true/false) value.'
	'smw_true_words' => '是,t,yes,y,true',	// comma-separated synonyms for boolean TRUE besides '1'
	'smw_false_words' => '否,f,no,n,false',	// comma-separated synonyms for boolean FALSE besides '0'
	'smw_nofloat' => '“$1＂ 并非为是数字',	// '“$1＂ is no number.'
	'smw_infinite' => '在此站内并不支持像是“$1＂如此庞大的数目字。',	//'Numbers as large as “$1＂ are not supported on this site.'
	'smw_infinite_unit' => '对此站而言转换“$1＂单位所产生的数目字过于庞大。',	// 'Conversion into unit “$1＂ resulted in a number that is too large for this site.'
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this property supports no unit conversion',
	'smw_unsupportedprefix' => '数字(“$1＂) 的字首目前尚未被支持',	//'Prefixes for numbers (“$1＂) are not supported.'
	'smw_unsupportedunit' => '单位转换无法适用于“$1＂此一单位',	//'Unit conversion for unit “$1＂ not supported.'
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => '在“$1＂此一单位之前并无数目字', //'No number found before the symbol “$1＂.'	// $1 is something like °
	'smw_bad_latlong' => '纬度和经度只能以有效的座标值标示一次',	//'Latitude and longitude must be given only once, and with valid coordinates.'
	'smw_abb_north' => 'N',    //北
	'smw_abb_east' => 'E',     //东
	'smw_abb_south' => 'S',    //南
	'smw_abb_west' => 'W',     //西
	'smw_label_latitude' => '纬度：',	// 'Latitude:'
	'smw_label_longitude' => '经度：',	//'Longitude:'
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",	//" find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6"
	// Messages for datetime parsing
	'smw_nodatetime' => '日期值“$1＂无法被识别，对日期值的支持目前尚属实验性质。',	//'The date “$1＂ was not understood (support for dates is still experimental).'
	// Errors and notices related to queries
	'smw_toomanyclosing' => '在此查询中“$1＂显然出现太多次了',	// 'There appear to be too many occurrences of “$1＂ in the query.'
	'smw_noclosingbrackets' => '在您的查询中“[&#x005B;＂ 并未以对应的“]]＂来予以封闭',	// 'Some use of “[&#x005B;＂ in your query was not closed by a matching “]]＂.'
	'smw_misplacedsymbol' => '“$1＂此一符号用于某项无用之处',	//'The symbol “$1＂ was used in a place where it is not useful.'
	'smw_unexpectedpart' => '查询的“$1＂部份无法被识别，可能会出现预料之外的结果',	// 'The part “$1＂ of the query was not understood. Results might not be as expected.'
	'smw_emptysubquery' => '某些子查询并不具备有效的查询条件',	//'Some subquery has no valid condition.'
	'smw_misplacedsubquery' => '某些子查询被用在不宜于使用子查询之处',	//'Some subquery was used in a place where no subqueries are allowed.'
	'smw_valuesubquery' => '“$1＂质性的值并不适用于子查询',	//'Subqueries not supported for values of property “$1＂.',	//'Subqueries not supported for values of property “$1＂.'
	'smw_overprintoutlimit' => '此查询含有太多的输出要求',	//'The query contains too many printout requests.'
	'smw_badprintout' => '在此查询中，有些输出叙述已被弄错了',  //'Some print statement in the query was misshaped.'
	'smw_badtitle' => '抱歉！“$1＂ 并非是有效的页面名称',	//'Sorry, but “$1＂ is no valid page title.',
	'smw_badqueryatom' => '在此查询中，部份的“[#x005B;&hellip]]＂无法被识别。',	//'Some part “[#x005B;&hellip]]＂ of the query was not understood.',
	'smw_propvalueproblem' => '质性“$1＂的值无法被识别',	//'The value of property “$1＂ was not understood.',
	'smw_nodisjunctions' => '在此wiki系统内分开查询是不被支持的，并有部份查询已被遗漏 ($1)。(译注原文为：Disjunctions in queries are not supported in this wiki and part of the query was dropped ($1).)',
	'smw_querytoolarge' => '基于此wiki系统对查询的规模及在深度方面的限制，以下的查询条件无法被接受：$1',	//The following query conditions could not be considered due to the wikis restrictions in query size or depth: $1.
	'smw_devel_warning' => '此元件尚于开发中，也许无法完成发挥功效，在使用它之前，请先备份您的资料',	//'This feature is currently under development, and might not be fully functional. Backup your data before using it.',
	// Messages for pages of types and properties
	'smw_type_header' => '“$1＂型态的性质',	//'Properties of type “$1＂',
	'smw_typearticlecount' => '以此型态显示 $1 性质',	//'Showing $1 properties using this type.',
	'smw_attribute_header' => '使用性质“$1＂的页面',	//'Pages using the property “$1＂',
	'smw_attributearticlecount' => '<p>以此性质显示$1页面.</p>',	//'<p>Showing $1 pages using this property.</p>',
	// Messages for Export RDF Special
	'exportrdf' => '输出页面至RDF 。',	//'Export pages to RDF', //name of this special
	'smw_exportrdf_docu' => '<p>此一页面可让您获取RDF格式页面的资料，要输出页面，请在下方的文字框内键入页面的抬头，一项一行。</p>',	//'<p>This page allows you to obtain data from a page in RDF format. To export pages, enter the titles in the text box below, one title per line.</p>',
	'smw_exportrdf_recursive' => '逐项输出所有的相关的页面，请注意输出的结果可能颇为庞大。',	//'Recursively export all related pages. Note that the result could be large!',
	'smw_exportrdf_backlinks' => '并且输出与输出页面有关的页面，产生可供人阅读的RDF。(browsable RDF)',	//'Also export all pages that refer to the exported pages. Generates browsable RDF.',
	'smw_exportrdf_lastdate' => '无须输出那些在所设之时间点以后就未再被更动过的页面',	//'Do not export pages that were not changed since the given point in time.',
	// Messages for Properties Special
	'properties' => '性质',	//'Properties',
	'smw_properties_docu' => '以下的性质已被用于此wiki内',	//'The following properties are used in the wiki.',
	'smw_property_template' => ' $1 　型态为：$2　使用次数：($3)',	//'$1 of type $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => '所有的性质应以某一页面加以描述。',	//'All properties should be described by a page!',
	'smw_propertylackstype' => '此一性质尚未被指定形态，先暂定为$1型态。',	//'No type was specified for this property (assuming type $1 for now).',
	'smw_propertyhardlyused' => '此一性质难以用于此wiki内',	//'This property is hardly used within the wiki!',
	// Messages for Unused Properties Special
	'unusedproperties' => '未使用的性质',	//'Unused Properties',
	'smw_unusedproperties_docu' => '下方的性质虽已存在，但无其他的页面使用它们。',	//'The following properties exist although no other page makes use of them.',
	'smw_unusedproperty_template' => '$2型态的$1',	//'$1 of type $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => '待建立的性质',	//'Wanted Properties',
	'smw_wantedproperties_docu' => '下方的性质虽已用于此wiki内，但却未事先以任何页面去定义它们。',	//'The following properties are used in the wiki but do not yet have a page for describing them.',
	'smw_wantedproperty_template' => '$1 (已用于$2处)',	//'$1 ($2 uses)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => '按此处以更新此页全部的查询项目及样板。',	//'Click here to refresh all queries and templates on this page',
	'smw_purge' => '更新',	//'Refresh',
	// Messages for Import Ontology Special
	'ontologyimport' => '输入知识本体(ontology)',	//'Import ontology',
	'smw_oi_docu' => '此特殊页可用以输入知识本体(ontology)，此知识本体(ontology)必须依循特定的格式，此特定格式在<a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">知识本体(ontology)的导入求助页面。</a>',	//'This special page allows to import ontologies. The ontologies have to follow a certain format, specified at the <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">ontology import help page</a>.',
	'smw_oi_action' => '输入',	//'Import',
	'smw_oi_return' => '回车<a href="$1">Special:OntologyImport</a>',	//'Return to <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => '无知识本体(ontology)可提供或者无法载入知识本体',	//'No ontology supplied, or could not load ontology.',
	'smw_oi_select' => '请选择某叙述以输入然后按输入键',	//'Please select the statements to import, and then click the import button.',
	'smw_oi_textforall' => '用以添加于所有输入的标题文字(也许是空白)：',	//'Header text to add to all imports (may be empty):',
	'smw_oi_selectall' => '选取或放弃选取全部的叙述',	//'Select or unselect all statements',
	'smw_oi_statementsabout' => '相关描述',	//'Statements about',
	'smw_oi_mapto' => '对映本质(entity)至',	//'Map entity to',
	'smw_oi_comment' => '添加以下的文字：',	//'Add the following text:',
	'smw_oi_thisissubcategoryof' => '所属的次分类',	//'A subcategory of',
	'smw_oi_thishascategory' => '此部分附属于(Is part of)',	//'Is part of',
	'smw_oi_importedfromontology' => '从知识本体(ontology)输入',	//'Import from ontology',
	// Messages for (data)Types Special
	'types' => '型态',	//'Types',
	'smw_types_docu' => '以下为所有资料型态的列表，资料型态可用于指定性质，每项资料型态皆有提供附加信息的页面。',	//'The following is a list of all datatypes that can be assigned to properties. Each datatype has a page where additional information can be provided.',
	'smw_typeunits' => '“$1＂型态的量测单位：$2',	//'Units of measurement of type “$1＂: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => '语意统计(Semantic Statistics)',	//'Semantic Statistics',
	'smw_semstats_text' => '此wiki含有<b>$1</b>性质的值以用于总计<b>$2</b> 不同于 <a href="$3">性质</a>。 <b>$4</b>性质有着专属的专面，且预期所需的资料型态因着<b>$5</b>，而已被指定了，有些现有的性质也许为<a href="$6">未使用的性质</a>。您可在 <a href="$7">待建立的性质列表</a>中，找到那些尚未建立专属页面的性质。(译注原文为：This wiki contains <b>$1</b> property values for a total of <b>$2</b> different <a href="$3">properties</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might by <a href="$6">unused properties</a>. Properties that still lack a page are found on the <a href="$7">list of wanted properties</a>.This wiki contains <b>$1</b> property values for a total of <b>$2</b> different <a href="$3">properties</a>. <b>$4</b> properties have an own page, and the intended datatype is specified for <b>$5</b> of those. Some of the existing properties might by <a href="$6">unused properties</a>. Properties that still lack a page are found on the <a href="$7">list of wanted properties</a>.)',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => '错误的性质',	//'Flawed Properties',
	'smw_fattributes' => '在下方处被列出的页面有着一项非正确定义的属性，非正确的属性的数量置于中括号内',	//'The pages listed below have an incorrectly defined property. The number of incorrect properties is given in the brackets.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI Resolver',	//'URI Resolver',
	'smw_uri_doc' => '<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',	//'<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',
	// Messages for ask Special
	'ask' => '语意搜寻',	//'Semantic search',
	'smw_ask_sortby' => '依栏位排序',       //(Sort by column)
	'smw_ask_ascorder' => '升幂',        //(Ascending)
	'smw_ask_descorder' => '降幂',       //(Descending)
	'smw_ask_submit' => '搜自导引结果',       //(Find results)	
	'smw_ask_editquery' => '[编辑查询]',  //'[Edit query]'
	'smw_ask_hidequery' => '隐藏查询', // 'Hide query'
	'smw_ask_help' => '查询协助',   //'Querying help'
	'smw_ask_queryhead' => '查询', //'Query'
	'smw_ask_printhead' => '其他查询(选择性的)', // 'Additional printouts (optional)'
	// Messages for the search by property special
	'searchbyproperty' => '依性质搜寻',	//'Search by property',
	'smw_sbv_docu' => '<p>依所指定的性质及其值来搜寻页面</p>',	//'<p>Search for all pages that have a given property and value.</p>',
	'smw_sbv_noproperty' => '请输入某项性质',	//'<p>Please enter a property.</p>',
	'smw_sbv_novalue' => '<p>请为该性质输入一项有效值，或请查阅“$1.＂的全部的性质的值</p>',	//'<p>Please enter a valid value for the property, or view all property values for “$1.＂</p>',
	'smw_sbv_displayresult' => '所有“$1＂性质项目中，皆带有“$2＂值的页面列表',	//'A list of all pages that have property “$1＂ with value “$2＂',
	'smw_sbv_property' => '性质',	//'Property',
	'smw_sbv_value' => '值',	//'Value',
	'smw_sbv_submit' => '搜自导引结果',	//'Find results',
	// Messages for the browsing special
	'browse' => '浏览wiki',	//'Browse wiki',
	'smw_browse_article' => '在开始浏览的表单中输入页面名称',	//'Enter the name of the page to start browsing from.',
	'smw_browse_go' => '前往',	//'Go',
	'smw_browse_more' => '&hellip;',	//'&hellip;',
	// Messages for the page property special
	'pageproperty' => '页面性质搜寻',	//'Page property search',
	'smw_pp_docu' => '搜寻某一页面全部性质的过滤条件，请同时输入页面及性质',	//'Search for all the fillers of a property on a given page. Please enter both a page and a property.',
	'smw_pp_from' => '开始页面(From page)',
	'smw_pp_type' => '性质',	//'Property',
	'smw_pp_submit' => '搜自导引结果',	//'Find results',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => '前一页',        //(Previous)
	'smw_result_next' => '下一页',        //(Next)
	'smw_result_results' => '结果',      //(Results)
	'smw_result_noresults' => '抱歉，无您所要的结果。'    //(Sorry, no results.)	
);

/** Korean
 * autotranslated
 */
$messages['ko'] = array(
	'smw_edithelp' => '도움말을 수정하려면 속성을',
	'smw_viewasrdf' => '으로 볼 rdf',
	'smw_finallistconjunct' => ', 그리고', //used in "A, B, and C"
	'smw_factbox_head' => '사실에 대한 $1',
	'smw_isspecprop' => '이 속성은이 위키는 특별한 속성입니다.',
	'smw_isknowntype' => '이 유형은 표준 데이터 형식의들 사이에이 위키.',
	'smw_isaliastype' => '이 유형은 데이터의 별칭을 “$1”.',
	'smw_isnotype' => '이 유형이 “$1” 아닌 표준 데이터 형식은 위키가, 그리고 사용자 정의를 부여하지 않았습니다.',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => '죄송합니다, uri의 범위에서 “$1” 해당 장소에서 사용할 수 없다.',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "죄송합니다. 이 위키에 대한 의미 론적 검색어가 해제되었습니다.",
	'smw_iq_moreresults' => '&hellip; 다른 경기 결과',
	'smw_iq_nojs' => '자바 스크립트 - 활성화된 브라우저를 사용하는이 요소를 참조하거나, 직접 <a href="$1">찾아보기 결과 목록</a>.',
	'smw_iq_altresults' => 'Browse the result list directly.', // available link when JS is disabled
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => '져올 네임 스페이스를 사용할 수있는 기능이없습니다 “$1”.',
	'smw_nonright_importtype' => '$1 페이지에 대해서만 사용할 수있습니다 네임 스페이스 “$2”.',
	'smw_wrong_importtype' => '$1 페이지에 대해 사용할 수없습니다 네임 스페이스 “$2”.',
	'smw_no_importelement' => '원소 “$1” 에 사용할 수없습니다 져올.',
	// Messages and strings for basic datatype processing
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '“$1” 대한 이름으로 사용하실 수없습니다이 위키는 페이지입니다.',
	'smw_unknowntype' => '지원되지 않는 종류 “$1” 정의에 대한 속성을.',
	'smw_manytypes' => '하나 이상의 속성에 대한 정의를 입력합니다.',
	'smw_emptystring' => '빈 문자열은 허용되지 않습니다.',
	'smw_maxstring' => '문자열 표현 $1 이 너무 긴이 사이트에 대한.',
	'smw_notinenum' => '“$1” 이 아닙니다의 목록에서이 속성능한 값 ($2) 에 대한.',
	'smw_noboolean' => '“$1” 가 인식되지 않습니다으로 부울 (참 / 거짓) 값.',
	'smw_true_words' => '참,예,진정한',	// comma-separated synonyms for boolean TRUE besides '1', principal value first
	'smw_false_words' => '거짓,아니오',	// comma-separated synonyms for boolean FALSE besides '0', principal value first
	'smw_nofloat' => '“$1” 이 아닌 숫자입니다.',
	'smw_infinite' => '숫자와 대형으로 “$1” 는 지원되지 않습니다이 사이트에서.',
	'smw_infinite_unit' => '전환으로 단위를 “$1” 결과는이 사이트에 대한 숫자가 너무 큽니다.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => '이 속성을 지원 아니오 단위 변환',
	'smw_unsupportedprefix' => '접두사에 대한 숫자 (“$1”) 는 지원되지 않습니다.',
	'smw_unsupportedunit' => '단위 변환에 대한 단위를 “$1” 이 지원되지 않습니다.',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => '전에 번호를 찾을 수 없음을 상징 “$1”.', // $1 is something like ° or whatever Korean uses for degrees of arc.
	'smw_bad_latlong' => '위도와 경도를 한 번만 부여해야합니다, 그리고 올바른 좌표와 함께합니다.',
	'smw_abb_north' => '북',
	'smw_abb_east' => '동부',
	'smw_abb_south' => '남쪽',
	'smw_abb_west' => '서부',
	'smw_label_latitude' => '위도:',
	'smw_label_longitude' => '경도:',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " find&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => '의 날짜 “$1” 는 이해할 수 없다. 날짜는 아직 실험 단계에 대한 지원을합니다.',
	// Errors and notices related to queries
	'smw_toomanyclosing' => '이 쿼리에서 사용하는 표현이 “$1” 너무 많은 시간입니다.',
	'smw_noclosingbrackets' => '일부의 사용 "[[" 검색어에 의해 폐쇄되지 않았습니다 매칭 "]]".',
	'smw_misplacedsymbol' => '의 상징 "$1" 이전에 사용하는 장소에 유용 않다.',
	'smw_unexpectedpart' => '이 부분은 "$1" 의 쿼리는 이해할 수 없다. 결과가 예상대로되지 않을 수도있습니다.',
	'smw_emptysubquery' => '특정 쿼리 조건이없습니다.',
	'smw_misplacedsubquery' => '등장하는 장소에서 하위 쿼리 질의를 사용할 수 없음.',
	'smw_valuesubquery' => '의 속성에 대한 값을 질의를 지원하지 않습니다 “$1”.',
	'smw_overprintoutlimit' => '쿼리에 너무 많은 인쇄를 요청합니다.',
	'smw_badprintout' => '검색어에 인쇄 성명 커보였다.',
	'smw_badtitle' => '죄송하지만, "$1" 이 올바르지 않습니다 페이지 이름입니다.',
	'smw_badqueryatom' => '일부 “[&#x005B;&hellip;]]” 의 쿼리는 식별할 수없는.',
	'smw_propvalueproblem' => '의 값은 속성 "$1" 는 이해할 수 없다',
	'smw_nodisjunctions' => '진술과 함께 "또는" 이 검색어는이 위키에서 지원되지 않습니다하고 검색어의 일부를 제외했습니다 ($1).',
	'smw_querytoolarge' => '다음과 같은 검색어를 조건을 초과 쿼리 크기에 대한 제한이 위키 또는 깊이: $1.',
	'smw_devel_warning' => '이 기능은 현재 개발, 그리고 의도한대로 작동하지 않을 수도있습니다. 을 만들어야합니다은 위키의 데이터를 저장하기 전에이를 사용합니다.',
	// Messages for pages of types and properties
	'smw_type_header' => '등록 정보의 유형 “$1”',
	'smw_typearticlecount' => '이 유형을 사용하여 보여주 $1 의 등록 정보를합니다.',
	'smw_attribute_header' => '페이지를 사용하여 속성이 “$1”',
	'smw_attributearticlecount' => '<p>이 속성을 사용하여 보여주 $1 페이지입니다.</p>',
	// Messages for Export RDF Special
	'exportrdf' => '수출에 페이지를 RDF', //name of this special
	'smw_exportrdf_docu' => '<p>이 페이지를 사용하면 RDF 포맷의 페이지에서 데이터를 구하려합니다. 을 수출 페이지, 아래 텍스트 상자에 제목을 입력을 한 줄에 제목입니다.</p>',
	'smw_exportrdf_recursive' => '재귀적으로 모든 관련 페이지에 수출합니다. 참고 사항이 될 결과에 큰!',
	'smw_exportrdf_backlinks' => '또한 내보낸 페이지를 참조하는 모든 페이지 내보내기합니다. 일람 RDF를 생성합니다.',
	'smw_exportrdf_lastdate' => '수출하지 마십시오하는 페이지가 주어진 시점 이후에 변경되지 않았습니다.',
	// Messages for Properties Special
	'properties' => '등록 정보',
	'smw_properties_docu' => '위키에 다음과 같은 속성을하는 데 사용됩니다.',
	'smw_property_template' => '$1 달러의 유형 $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => '등록 정보를 모두 한 페이지에 의해 설명해야한다!',
	'smw_propertylackstype' => '이 속성에 대해 지정된 유형이었다 없음 (정하면 종류 $1 에 대한 현재).',
	'smw_propertyhardlyused' => '이 속성은 거의 사용 내에있는 위키!',
	// Messages for Unused Properties Special
	'unusedproperties' => '사용하지 않는 속성을',
	'smw_unusedproperties_docu' => '다음과 같은 속성이 존재 다른 페이지를 활용합니다 비록 그들이없습니다.',
	'smw_unusedproperty_template' => '$1 달러의 유형 $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => '원하는 속성을',
	'smw_wantedproperties_docu' => '위키에서 사용되는 다음과 같은 속성이 있지만 아직없는 그들을 설명하는 페이지입니다.',
	'smw_wantedproperty_template' => '$1 ($2 사용)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => '여기를 클릭하여이 페이지를 새로 고치 모든 쿼리와 템플릿',
	'smw_purge' => '새로 고침',
	// Messages for Import Ontology Special
	'ontologyimport' => '져올 존재론',
	'smw_oi_docu' => '이 특별 페이지를 통해를가 져올 존재론. 가 존재론 필요가 다음과 일정한 형식, 지정된 부분에 <a href="http://wiki.ontoworld.org/index.php/help:ontology_import"> 존재론 져올 도움말 페이지 </a>.',
	'smw_oi_action' => '져올',
	'smw_oi_return' => '돌아 <a href="$1"> 스페셜 : 존재론져올</a>.',
	'smw_oi_noontology' => '아니오 존재론 제공하거나 로드할 수없습니다 존재론.',
	'smw_oi_select' => '문장을 선택하십시오를가 져올을 누른가 져오기 버튼을 클릭하십시오.',
	'smw_oi_textforall' => '헤더 텍스트를 추가 모든 수입 (수있습니다 빈):',
	'smw_oi_selectall' => '모든 문장을 선택하거나 선택을 해제',
	'smw_oi_statementsabout' => '제표에 대한',
	'smw_oi_mapto' => '지도 사업체에',
	'smw_oi_comment' => '다음 텍스트를 추가:',
	'smw_oi_thisissubcategoryof' => '하위 카테고리 중',
	'smw_oi_thishascategory' => '의 일부인',
	'smw_oi_importedfromontology' => '에서가 져올 존재론',
	// Messages for (data)Types Special
	'types' => '유형',
	'smw_types_docu' => '다음은 목록에있는 모든 데이터를 속성을 할당할 수있습니다. 각 데이터 형식이있는 페이지가 어디에 추가 정보를 제공할 수있습니다.',
	'smw_typeunits' => '측정 단위의 유형 “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => '의미 론적 통계',
	'smw_semstats_text' => '이 위키를 포함 <b>$1</b> 속성에 대한 값을 총 <b>$2</b> 서로 다른 <a href="$3">등록 정보</a>입니다. <b>$4</b> 속성을 갖고 자신의 페이지를, 그리고 의도에 대한 데이터 형식이 지정되어 <b>$5</b>의 해당합니다. 기존의 등록 정보의 일부에 의해 수도 <a href="$6">사용하지 않는 속성을 </a>입니다. 속성이 여전히 부족에서 찾을 수있는 페이지는 <a href="$7">목록은 싶었다 등록 정보 </a>입니다.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => '결함 속성',
	'smw_fattributes' => '아래에 나열된 페이지를 잘못 정의된 속성을 갖고있습니다. 잘못된 속성의 개수가 주어질 브래킷에있습니다.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => '열린우리당 확인자',
	'smw_uri_doc' => '<p>열린우리당 확인자 <a href="http://www.w3.org/2001/tag/issues.html#httprange-14"> w3c 태그를 구현합니다 규명에 httprange-14</a>입니다. 인간을 치료하는 데 걸리는 웹사이트로 나타나지 않습니다.</p>',
	// Messages for ask Special
	'ask' => '의미 론적 검색',
	'smw_ask_sortby' => '열로 정렬',
	'smw_ask_ascorder' => '오름차순',
	'smw_ask_descorder' => '내림차순',
	'smw_ask_submit' => '검색 결과 찾기',
	// Messages for the search by property special
	'searchbyproperty' => '검색을 통해 재산',
	'smw_sbv_docu' => '<p>주어진 속성이있는 모든 페이지를 검색 및 값입니다.</p>',
	'smw_sbv_noproperty' => '<p>한 속성을 입력하세요.</p>',
	'smw_sbv_novalue' => '<p>유효한 값을 입력하시기 바랍니다의 재산, 또는 내용에 대한 모든 속성 값을 “$1.”</p>',
	'smw_sbv_displayresult' => '모든 페이지의 목록이있는 속성이 "$1" 와 값 “$2”',
	'smw_sbv_property' => '부동산',
	'smw_sbv_value' => '값',
	'smw_sbv_submit' => '검색 결과 찾기',
	// Messages for the browsing special
	'browse' => '위키 뉴스',
	'smw_browse_article' => '페이지의 이름을 입력하여 검색을 시작합니다.',
	'smw_browse_go' => '바둑',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => '검색 페이지에서 등록 정보에서',
	'smw_pp_docu' => '검색에 대한 모든 fillers의 속성이 주어진 페이지에서입니다. 한 페이지와 속성을 모두 입력하시기 바랍니다.',
	'smw_pp_from' => '페이지에서',
	'smw_pp_type' => '부동산',
	'smw_pp_submit' => '검색 결과 찾기',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => '이전',
	'smw_result_next' => '내년',
	'smw_result_results' => '결과',
	'smw_result_noresults' => '죄송합니다, 결과가없습니다.'
);

/** Italian
 * @author Davide Eynard, David Laniado
 */
$messages['it'] = array(
	'smw_edithelp' => 'Aiuto sulla modifica delle propriet&agrave;', 
	'smw_viewasrdf' => 'Feed RDF ',
	'smw_finallistconjunct' => ' e', //used in "A, B, and C"
	'smw_factbox_head' => 'Fatti riguardanti $1',
	'smw_isspecprop' => 'Questa propriet&agrave; &egrave; una propriet&agrave; speciale all\'interno di questo wiki.',
	'smw_isknowntype' => 'Questo tipo &egrave; fra i tipi di dato standard di questo wiki',
	'smw_isaliastype' => 'Questo tipo &egrave; un alias per il tipo di dato “$1”.',
	'smw_isnotype' => 'Il tipo “$1” non &egrave; un tipo di dato standard nel wiki, n&eacute; &egrave; stato ancora definito dall\'utente.',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => 'Spiacenti. Gli URI del tipo “$1” non sono consentiti.',
	// Link to RSS feeds
	'smw_rss_link' => 'RSS',
	// Messages and strings for inline queries
	'smw_iq_disabled' => 'Spiacenti. Le query semantiche sono state disabilitate per questo wiki.',
	'smw_iq_moreresults' => '&hellip; risultati successivi',
	'smw_iq_nojs' => 'Per favore, usate un browser che supporti Javascript per visualizzare questo elemento.',
	'smw_iq_altresults' => 'Visualizza direttamente l\'elenco dei risultati.', // available link when JS is disabled
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => 'Le funzioni di importazione non sono disponibili per il namespace “$1”.',
	'smw_nonright_importtype' => '$1 pu&ograve; essere utilizzato solo per pagine con namespace “$2”.',
	'smw_wrong_importtype' => '$1 non pu&ograve; essere utilizzate per pagine nel namespace “$2”.',
	'smw_no_importelement' => 'L\'elemento “$1” non &egrave; disponibile per l\'importazione.',
	// Messages and strings for basic datatype processing
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '“$1” non pu&ograve; essere utilizzato come nome di una pagina all\'interno di questo wiki.',
	'smw_unknowntype' => '&Egrave; stato definito un tipo non supportato “$1” per la propriet&agrave;.',
	'smw_manytypes' => '&Egrave; stato definito pi&ugrave; di un tipo per la propriet&agrave;.',
	'smw_emptystring' => 'Le stringhe vuote non sono accettate.',
	'smw_maxstring' => 'La stringa $1 &egrave; troppo lunga per {{SITENAME}}.',
	'smw_notinenum' => '“$1” non &egrave; nella lista dei valori possibili ($2) per questa propriet&agrave;.',
	'smw_noboolean' => '“$1” non &egrave; riconosciuto come valore Booleano (vero/falso).',
	'smw_true_words' => 'vero,v,si,s,true,t,yes,y', // comma-separated synonyms for Boolean TRUE besides '1', primary value first
	'smw_false_words' => 'falso,f,no,n,false', // comma-separated synonyms for Boolean FALSE besides '0', primary value first
	'smw_nofloat' => '“$1” non &egrave; un numero.',
	'smw_infinite' => 'I numeri grandi come “$1” non sono supportati su {{SITENAME}}.',
	'smw_infinite_unit' => 'La conversione nell\'unit&agrave; di misura “$1” ha generato un numero che &egrave; troppo grande per {{SITENAME}}.',
	// Currently unused, floats silently store units.  'smw_unexpectedunit' => 'this property supports no unit conversion',
	'smw_unsupportedprefix' => 'I prefissi per i numeri (“$1”) non sono supportati.',
	'smw_unsupportedunit' => 'La conversione per l\'unit&agrave; di misura “$1” non &egrave; supportata.',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => 'Non &egrave; stato trovato nessun numero prima del simbolo “$1”.', // $1 is something like °
	'smw_bad_latlong' => 'Latitudine e longitudine devono essere inserite solo una volta, e con coordinate valide.',
	'smw_abb_north' => 'N',
	'smw_abb_east' => 'E',
	'smw_abb_south' => 'S',
	'smw_abb_west' => 'O',
	'smw_label_latitude' => 'Latitudine:',
	'smw_label_longitude' => 'Longitudine:',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " Find&nbsp;online&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => 'Non &egrave; stato possibile comprendere la data “$1” (il supporto per le date &egrave; ancora sperimentale).',
	// Errors and notices related to queries
	'smw_toomanyclosing' => 'Sembrano esserci troppe ripetizioni di “$1” all\'interno della query.',
	'smw_noclosingbrackets' => 'Alcune "[&#x005B;” all\'interno della query non sono state chiuse con le corrispondenti “]]”.',
	'smw_misplacedsymbol' => 'Il simbolo “$1” &grave; stato usato in un punto in cui &egrave; inutile.',
	'smw_unexpectedpart' => 'Non &egrave; stato possibile comprendere la parte “$1” della query. Il risultato potrebbe essere diverso da quello atteso.',
	'smw_emptysubquery' => 'Qualche subquery ha una condizione non valida.',
	'smw_misplacedsubquery' => 'Qualche subquery &egrave; stata utilizzata in una posizione in cui non era consentito.',
	'smw_valuesubquery' => 'Le subquery non sono supportate per i valori della propriet&agrave; “$1”.',
	'smw_overprintoutlimit' => 'La query contiene troppe richieste di printout.',
	'smw_badprintout' => 'Comando print malformato all\'interno della query.',
	'smw_badtitle' => 'Spiacenti, “$1” non &egrave; un titolo valido.',
	'smw_badqueryatom' => 'Non &egrave; stato possibile comprendere parte “[&#x005B;&hellip;]]” della query.',
	'smw_propvalueproblem' => 'Non &egrave; stato possibile comprendere il valore della propriet&agrave; “$1”.',
	'smw_nodisjunctions' => 'La disgiunzione all\'interno delle query non &egrave; supportata in questo wiki, quindi parte della query &egrave; stata ignorata ($1).',
	'smw_querytoolarge' => 'Le seguenti condizioni all\'interno della query non sono state considerate a causa delle restrizioni di dimensione o profondit&agrave; delle query impostate per questo wiki: $1.',
	'smw_devel_warning' => 'Questa funzione &egrave; attualmente in fase di sviluppo e potrebbe non essere completamente funzionante: si consiglia di eseguire un backup dei dati prima di usarla.',
	// Messages for pages of types and properties
	'smw_type_header' => 'Propriet&agrave; del tipo “$1”',
	'smw_typearticlecount' => 'Visualizzazione di $1 propriet&agrave; che usano questo tipo.', 
	'smw_attribute_header' => 'Pagine che usano la propriet&agrave; “$1”',
	'smw_attributearticlecount' => '<p>Visualizzazione di $1 pagine che usano questa propriet&agrave;.</p>', 
	// Messages used in RSS feeds
	'smw_rss_description' => '$1 RSS feed',
	// Messages for Export RDF Special
	'exportrdf' => 'Esporta le pagine in RDF', //name of this special
	'smw_exportrdf_docu' => '<p>Questa pagina consente di ottenere dati da una pagina in formato RDF. Per esportare delle pagine, inseritene i titoli nella casella di testo sottostante, un titolo per riga.</p>',
	'smw_exportrdf_recursive' => 'Esporta ricorsivamente tutte le pagine correlate. Nota: il risultato potrebbe essere molto grande!',
	'smw_exportrdf_backlinks' => 'Esporta anche le pagine che si riferiscono a quelle esportate. Genera un RDF navigabile.',
	'smw_exportrdf_lastdate' => 'Non esportare le pagine che non hanno sub&igrave;to modifiche dal momento specificato.',
	// Messages for Properties Special
	'properties' => 'Propriet&agrave;',
	'smw_properties_docu' => 'Le seguenti propriet&agrave; sono utilizzate all\'interno del wiki.',
	'smw_property_template' => '$1 di tipo $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => 'Tutte le propriet&agrave; dovrebbero essere descritte da una pagina!',
	'smw_propertylackstype' => 'Non &egrave; stato specificato nessun tipo per questa propriet&agrave; (per il momento si suppone sia di tipo $1).',
	'smw_propertyhardlyused' => 'Questa propriet&agrave; non &egrave; quasi mai usata nel wiki!',
	// Messages for Unused Properties Special
	'unusedproperties' => 'Propiet&agrave; non utilizzate',
	'smw_unusedproperties_docu' => 'Le seguenti propriet&agrave; esistono nonostante nessun\'altra pagina ne faccia uso.',
	'smw_unusedproperty_template' => '$1 di tipo $2', // <propname> of type <type>	
	// Messages for Wanted Properties Special
	'wantedproperties' => 'Propriet&agrave; senza descrizione',
	'smw_wantedproperties_docu' => 'Le seguenti propriet&agrave; sono usate nel wiki ma non hanno ancora una pagina che le descriva.',
	'smw_wantedproperty_template' => '$1 ($2 usi)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => 'Clicca qui per riaggiornare tutte le query e i template di questa pagina',
	'smw_purge' => 'Aggiorna',
	// Messages for Import Ontology Special
	'ontologyimport' => 'Importa ontologia',
	'smw_oi_docu' => 'Questa pagina speciale permette di importare ontologie. Le ontologie devono seguire un certo formato, specificato nella <a href="http://semantic-mediawiki.org/index.php/Help:Ontology_import">pagina di aiuto per l\'importazione di ontologie (in inglese)</a>.',
	'smw_oi_action' => 'Importa',
	'smw_oi_return' => 'Ritorna a <a href="$1">Special:OntologyImport</a>.',
	'smw_oi_noontology' => 'Nessuna ontologia fornita, o non &egrave; stato possibile caricare l\'ontologia.',
	'smw_oi_select' => 'Per favore selezionare le asserzioni da importare, e poi cliccare il tasto di importazione.',
	'smw_oi_textforall' => 'Testo di intestazione da aggiungere a tutti gli import (pu&ograve; essere vuoto):',
	'smw_oi_selectall' => 'Seleziona o deseleziona tutte le asserzioni',
	'smw_oi_statementsabout' => 'Asserzioni su',
	'smw_oi_mapto' => 'Mappa entit&agrave; con',
	'smw_oi_comment' => 'Aggiungere il testo seguente:',
	'smw_oi_thisissubcategoryof' => 'Sottoclasse di',
	'smw_oi_thishascategory' => '&Egrave; parte di',
	'smw_oi_importedfromontology' => 'Importa da ontologia',
	// Messages for (data)Types Special
	'types' => 'Tipi',
	'smw_types_docu' => 'La seguente &egrave; una lista di tutti i tipi di dati che possono essere assegnati alle propiet&agrave;. Ogni tipo di dato ha una pagina dove si possono trovare informazioni aggiuntive.',
	'smw_typeunits' => 'Unit&agrave; di misura di tipo “$1”: $2',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => 'Statistiche Semantiche',
	'smw_semstats_text' => 'Questo wiki contiene <b>$1</b> valori di propriet&agrave; per un totale di <b>$2</b> differenti <a href="$3">propriet&agrave;</a>. <b>$4</b> propriet&agrave; hanno una propria pagina, e il tipo di dato inteso &egrave; specificato per <b>$5</b> di queste. Alcune delle propriet&agrave; esistenti possono essere <a href="$6">propriet&agrave; non utilizzate</a>.  Le propriet&agrave; che ancora non hanno una pagina si possono trovare nella <a href="$7">lista delle propriet&agrave; senza descrizione</a>.',
	/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Propriet&agrave; scorrette',
	'smw_fattributes' => 'Le pagine elencate di seguito hanno una propriet&agrave; definita in modo non corretto. Il numero di propriet&agrave; incorrette &egrave; indicato fra parentesi.',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'Risolutore di URI',
	'smw_uri_doc' => '<p>Il risolutore di URI implementa il <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. Fa in modo che gli esseri umani non diventino siti Web.',
	// Messages for ask Special
	'ask' => 'Ricerca semantica',
	'smw_ask_sortby' => 'Ordina per colonna (opzionale)',
	'smw_ask_ascorder' => 'Crescente',
	'smw_ask_descorder' => 'Decrescente',
	'smw_ask_submit' => 'Trova risultati',
	'smw_ask_editquery' => '[Modifica query]',
	'smw_ask_hidequery' => 'Nascondi query',
	'smw_ask_help' => 'Help sulle query',
	'smw_ask_queryhead' => 'Query',
	'smw_ask_printhead' => 'Output aggiuntivi (opzionali)',
	// Messages for the search by property special
	'searchbyproperty' => 'Cerca per propriet&agrave;',
	'smw_sbv_docu' => '<p>Cerca tutte le pagine che hanno propriet&agrave; e valore specificati.</p>',
	'smw_sbv_noproperty' => '<p>Per favore inserire una propriet&agrave;.</p>',
	'smw_sbv_novalue' => '<p>Per favore inserire un valore valido per la propriet&agrave;, o visualizzare tutti i valori di propriet&agrave; per “$1.”</p>',
	'smw_sbv_displayresult' => 'Lista di tutte le pagine che hanno propriet&agrave; “$1” con valore “$2”',
	'smw_sbv_property' => 'Propriet&agrave;',
	'smw_sbv_value' => 'Valore',
	'smw_sbv_submit' => 'Trova risultati',
	// Messages for the browsing special
	'browse' => 'Esplora il wiki',
	'smw_browse_article' => 'Inserire il nome della pagina da cui iniziare l\'esplorazione',
	'smw_browse_go' => 'Vai',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => 'Ricerca propriet&agrave; della pagina',
	'smw_pp_docu' => 'Cerca tutti i valori che soddisfano una propriet&agrave; su una data pagina. Inserire sia la pagina sia la propriet&agrave;',
	'smw_pp_from' => 'Da pagina',
	'smw_pp_type' => 'Propriet&agrave;',
	'smw_pp_submit' => 'Trova risultati',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => 'Precedente',
	'smw_result_next' => 'Successivo',
	'smw_result_results' => 'Risultati',
	'smw_result_noresults' => 'Spiacenti, nessun risultato.'
);

/** Arabic
 * @author Mahmoud Zouari  mahmoudzouari@yahoo.fr http://www.cri.ensmp.fr
 */
$messages['ar'] = array(
	'smw_edithelp' => ' تغيير المساعدة خصائص ',
	'smw_viewasrdf' => 'RDF feed',
	'smw_finallistconjunct' => ', و', //used in "A, B, and C"
	'smw_factbox_head' => 'حقائق عن $1',
	'smw_isspecprop' => 'هذه الممتلكات هى ممتلكات خاصة في هذا الويكي',
	'smw_isknowntype' => '.هذا النوع هو من بين انواع البيانات الموحدة من هذا الويكي',
	'smw_isaliastype' => 'هذا النوع هو الاسم المستعار لنوع البيانات “$1”.',
	'smw_isnotype' => 'هذا النوع “$1” هو ليس معيار البيانات في ويكي ، ولم يعط تعريفا من قبل المستخدمين',
	// URIs that should not be used in objects in cases where users can provide URIs
	'smw_uri_blacklist' => " http://www.w3.org/1999/02/22-rdf-syntax-ns#\n http://www.w3.org/2000/01/rdf-schema#\n http://www.w3.org/2002/07/owl#",
	'smw_baduri' => ' ، من شكل "$ 1" غير مسموح بها uris عذرا .',
	// Link to RSS feeds
	'smw_rss_link' => 'رس س',
	// Messages and strings for inline queries
	'smw_iq_disabled' => "عذرا. الاستفسارات الدلاليه جرى تعطيلها في هذا الويكي.",
	'smw_iq_moreresults' => '&hellip; مزيد من النتائج ',
	'smw_iq_nojs' => 'الرجاء استخدام المتصفح الذي يمكن جافا سكريبت لعرض هذا العنصر.',
	'smw_iq_altresults' => 'استعرض قائمة النتائج مباشرة.', // available link when JS is disabled
	// Messages and strings for ontology resued (import)
	'smw_unknown_importns' => 'امكانيه استيراد ليست متوفره لاسم الفضاء “$1”.',
	'smw_nonright_importtype' => '$1 لا يمكن ان تستخدم الا لصفحات مع اسم الفضاء “$2”.',
	'smw_no_importelement' => ' غير متاح للاستيراد “$1”  عنصر ',
	// Messages and strings for basic datatype processing
	'smw_decseparator' => '.',
	'smw_kiloseparator' => ',',
	'smw_notitle' => '“$1” لا يمكن أن تستخدم مثل هذا الاسم في صفحة ويكي.',
	'smw_unknowntype' => ' نوع غير مدعوم "$ 1" لتعريف الممتلكات.',
	'smw_manytypes' => '.أكثر من نوع واحد لتعريف الخاصيه',
	'smw_emptystring' => '.الجمل الفارغة غير مقبولة',
	'smw_maxstring' => '{{SITENAME}} طويل جدا لل $1 سلسلة احرف ترميز ',
	'smw_notinenum' => '( "$ 2") لهذه الممتلكات ليس في قائمة القيم المحتملة “$1” ',
	'smw_noboolean' => '  (لا تعتبر قيمة منطقيه (صحيح / غير صحيح “$1”',
	'smw_true_words' => ' صحيح ،ص ، نعم ، ن ', // comma-separated synonyms for Boolean TRUE besides '1', primary value first
	'smw_false_words' => ' ليس صحيحا ،ص  ، لا ', // comma-separated synonyms for Boolean FALSE besides '0', primary value first
	'smw_nofloat' => ' ليس العدد“$1”',
	'smw_infinite' => '{{SITENAME}} ليست مدعومه في “$1” ارقام كبيرة حسب  ',
	'smw_infinite_unit' => '{{SITENAME}} اسفر ذلك عدد كبير جدا بالنسبة الى“$1” تحويلها الى وحدة ',
	// Currently unused, floats silently store units. 'smw_unexpectedunit' => ' هذه الخاصيه لا تدعم وحدة التحويل',
	'smw_unsupportedprefix' => ' غير مدعوم (“$1”) البادءات لارقام',
	'smw_unsupportedunit' => ' غير مدعوم “$1”  وحده لتحويل وحدة ',
	// Messages for geo coordinates parsing
	'smw_lonely_unit' => ' “$1” لا توجد أي عدد قبل الرمز ', // $1 is something like ° 
	'smw_bad_latlong' => '.خطوط الطول والعرض يجب ان تعطى مرة واحدة فقط ، واحداثيات صحيحة',
	'smw_abb_north' => 'شمال',
	'smw_abb_east' => 'شرق',
	'smw_abb_south' => 'جنوب',
	'smw_abb_west' => 'غرب',
	'smw_label_latitude' => ':خطوط الطول',
	'smw_label_longitude' => ':خطوط العرض ',
	// some links for online maps; can be translated to different language versions of services, but need not
	'smw_service_online_maps' => " Find&nbsp;online&nbsp;maps|http://tools.wikimedia.de/~magnus/geo/geohack.php?params=\$9_\$7_\$10_\$8\n Google&nbsp;maps|http://maps.google.com/maps?ll=\$11\$9,\$12\$10&spn=0.1,0.1&t=k\n Mapquest|http://www.mapquest.com/maps/map.adp?searchtype=address&formtype=latlong&latlongtype=degrees&latdeg=\$11\$1&latmin=\$3&latsec=\$5&longdeg=\$12\$2&longmin=\$4&longsec=\$6&zoom=6",
	// Messages for datetime parsing
	'smw_nodatetime' => 'لم يفهم الدعم للتواريخ لا تزال تجريبيه)). “$1”  تاريخ',
	// Errors and notices related to queries
	'smw_toomanyclosing' => ' في الاستعلام“$1”  يبدو ان هناك الكثير من الحوادث',
	'smw_noclosingbrackets' => ' “]]” في بحثك لم تكن مغلقة باستخدام “[&#x005B;” بعض استخدام  ',
	'smw_misplacedsymbol' => ' تم استخدامه في مكان حيث انها ليست مفيدة “$1”   الرمز',
	'smw_unexpectedpart' => ' للاستفسار لا يفهم. النتائج قد لا تكون كما هو متوقع “$1”  هذا الجزء ',
	'smw_emptysubquery' => '.بعض الاستفسارات ليس لها شرطا صحيحا',
	'smw_misplacedsubquery' => 'استفسار الفرعي استخدم في مكان لا يسمح الاستفسارات الفرعية',
	'smw_valuesubquery' => ' “$1” الاستفسارات الفرعية لا يدعم قيم خاصيه  ',
	'smw_overprintoutlimit' => '.هذا الاستعلام تحتوي على عدد كبير جدا من طلبات العرض على الشاشه',
	'smw_badprintout' => '.بعض المطبوعات في بيان الاستعلام لم تتشكل بصورة صحيحة',
	'smw_badtitle' => ' ليس عنوان صفحه صحيح. “$1” عذرا ، ولكن ',
	'smw_badqueryatom' => ' لم يكن يفهم“[&#x005B;&hellip;]]” أجزاء من  ',
	'smw_propvalueproblem' => ' لم يكن يفهم“$1” قيمة الخاصيه ',
	'smw_nodisjunctions' => 'المفارق في استعلامات ليست مدعومه في هذا الويكي وجزء من الاستعلام رفض $1.',
	'smw_querytoolarge' => '	
هذه شروط استفسار لا يمكن اعتباره نتيجة لقيود الويكي في الحجم أو عمق استفسار $1.'
,
	'smw_devel_warning' => 'هذه السمة هي حاليا قيد التطوير ، وربما لا يكون كاملا وظيفيه. احفظ البيانات قبل استخدامها',
	// Messages for pages of types and properties
	'smw_type_header' => ' “$1” خصائص النوع',
	'smw_typearticlecount' => ' باستخدام هذا النوع $1 خصائص عرض ',
	'smw_attribute_header' => '“$1” هذه الصفحات تستخدم الخصائص ',
	'smw_attributearticlecount' => '<p>  الخصائص باستخدام هذه $1 صفحات عرض </p>',
	// Messages used in RSS feeds
	'smw_rss_description' => '$1 [رس س] تخول ',
	// Messages for Export RDF Special
	'exportrdf' => 'آردی‌اف إل صفحات تصدير ', //name of this special
	'smw_exportrdf_docu' => '<p> هذه الصفحه تتيح لك الحصول على بيانات من صفحة في شكل آردی‌اف. التصدير الى صفحات ، أدخل العناوين في مربع النص أدناه ، عنوان واحد لكل سطر. </p>',
	'smw_exportrdf_recursive' => ' تصدير جميع الصفحات ذات الصلة بشكل تكراري. علما انه يمكن ان تكون النتيجة كبيرة',
	'smw_exportrdf_backlinks' => ' ايضا تصدير كل الصفحات التي تشير الى الصفحات  تم تصديرها', // Generates browsable RDF not traslated
	'smw_exportrdf_lastdate' => ' لا تصدر الصفحات التي لم تتغير منذ نقطة زمنيه محددة',
	// Messages for Properties Special
	'properties' => ' الخصائص ',
	'smw_properties_docu' => '.التالية تستخدم في ويكي الخصائص',
	'smw_property_template' => '$1 من نوع $2 ($3)', // <propname> of type <type> (<count>)
	'smw_propertylackspage' => '! جميع الخصائص ينبغي ان توصف بصفحة',
	'smw_propertylackstype' => ' ("$1" لالان نوع الخاصيه ليست محددة (على افتراض نوع ',
	'smw_propertyhardlyused' => ' هذه الخاصيه لا يكاد يستخدم داخل يكي',
	// Messages for Unused Properties Special
	'unusedproperties' => ' خصائص معطله',
	'smw_unusedproperties_docu' => ' ا الخصائص التالية تظهر على الرغم من عدم وجود صفحة اخرى يستفيد منها ',
	'smw_unusedproperty_template' => '$1 من نوع $2', // <propname> of type <type>
	// Messages for Wanted Properties Special
	'wantedproperties' => ' الخصائص التي تحتاجها ',
	'smw_wantedproperties_docu' => '. التالية تستخدم في ويكي ولكن ليس لديها حتى الآن صفحة لوصفها ا الخصائص.',
	'smw_wantedproperty_template' => '$1 ($2 الاستعمالات)', // <propname> (<count> uses)
	// Messages for the refresh button
	'tooltip-purge' => ' اضغط هنا لتحديث كافة الاستفسارات والقوالب على هذه الصفحه',
	'smw_purge' => 'تحديث',
	// Messages for Import Ontology Special
	'ontologyimport' => 'استيراد أنتولوجي',
	
'smw_oi_docu' => ' استيراد صفحة المساعدة أنتولوجي <a href="http://wiki.ontoworld.org/index.php/Help:Ontology_import">  هذه صفحة خاصة تسمح باستيراد أنتولوجي. فان أنتولوجي
 يجب اتباع شكل معين ، كما هو محدد في </a>.',
	'smw_oi_action' => ' استيراد ',
	'smw_oi_return' => ' <a href="$1">Special:OntologyImport</a> العودة الى ',
	'smw_oi_noontology' => ' لا توجد أنتولوجي ، او تعذر تحميل أنتولوجي ',
	'smw_oi_select' => ' رجاء اختر بيانات الاستيراد ، وبعد ذلك انقر على زر استيراد ',
	'smw_oi_textforall' => ' بداية النص الذي سيضاف الى جميع الواردات( قد تكون فارغه) ',
	'smw_oi_selectall' => ' اختر او احذف جميع البيانات ',
	'smw_oi_statementsabout' => ' بيانات حول ',
	'smw_oi_mapto' => ' خريطه لكيان ',
	'smw_oi_comment' => ' يضاف النص التالي : ',
	'smw_oi_thisissubcategoryof' => ' فئة فرعية لل ',
	'smw_oi_thishascategory' => ' هي جزء من ',
	'smw_oi_importedfromontology' => ' الاستيراد منالأنتولوجيا ',
	// Messages for (data)Types Special
	'types' => ' أنواع ',
	'smw_types_docu' => ' فيما يلى قائمة من جميع انواع البيانات التي يمكن أن تسند الى الخصائص. كل البيانات له صفحة فيها معلومات اضافية يمكن توفيرها. ',
	'smw_typeunits' => ' $2 : “$1” وحدات القياس من النوع',
	/*Messages for SemanticStatistics Special*/
	'semanticstatistics' => ' احصاءات دلاليه ',
	'smw_semstats_text' => '<a href="$7"> قائمة المطلوبين الخصائص </a> الخصائص التي لا تزال تفتقر الى صفحة موجودة على <a href="$6"> معطله</a> <b>$5</b> . بعض من الخصائص الموجودة قد تكون<b>$4</b> خواص لها صفحة خاصة بها ، والمقصود هو نوع البيانات المحدد ل </a> مختلفة  <a href="$3"> الخصائص <b>$1</b> خصائص القيم مجموعة <b>$2</b> يتضمن هذا يكي ',
	
/*Messages for Flawed Attributes Special --disabled--*/
	'flawedattributes' => 'Flawed Properties',
	'smw_fattributes' => ' خصائص الصفحات المذكورة ادناه لم تعرف بشكل صحيح. عدد الخصائص غير صحيح يرد في الاقواس. ',
	// Name of the URI Resolver Special (no content)
	'uriresolver' => 'URI Resolver',
	'smw_uri_doc' => '<p>The URI resolver implements the <a href="http://www.w3.org/2001/tag/issues.html#httpRange-14">W3C TAG finding on httpRange-14</a>. It takes care that humans don\'t turn into websites.</p>',
	// Messages for ask Special
	'ask' => ' البحث الدلالي ',
	'smw_ask_doculink' => 'http://semantic-mediawiki.org/wiki/Help:Semantic_search',
	'smw_ask_sortby' => ' الترتيب حسب العمود (اختياري)',
	'smw_ask_ascorder' => ' صعود ',
	'smw_ask_descorder' => ' تنازلي',
	'smw_ask_submit' => ' ايجاد نتائج ',
	'smw_ask_editquery' => '[تحرير استفسار]',
	'smw_add_sortcondition' => '[اضافة شرط الترتيب]',
	'smw_ask_hidequery' => ' اخفاء الاستعلام ',
	'smw_ask_help' => ' سؤال مساعدة ',
	'smw_ask_queryhead' => ' إستفسار ',
	'smw_ask_printhead' => ' مطبوعات اضافية (اختياري)',
	// Messages for the search by property special
	'searchbyproperty' => ' البحث حسب الخصائص ',
	'smw_sbv_docu' => '<p> البحث عن كل الصفحات التي لها خصائص معينة وقيمه </p>',
	'smw_sbv_noproperty' => '<p>. الرجاء ادخال خاصيه </p>',
	'smw_sbv_novalue' => '<p> “$1.” الرجاء ادخال قيمة الخصائص ، أو اعرض كل قيم الخصائص </p>',
	'smw_sbv_displayresult' => '“$2”  مع قيمه “$1” قائمة بجميع الصفحات التي لديه الخصائص ',
	'smw_sbv_property' => ' خاصيه',
	'smw_sbv_value' => ' القيمه',
	'smw_sbv_submit' => ' ايجاد نتائج ',
	// Messages for the browsing special
	'browse' => ' استعرض يكي ',
	'smw_browse_article' => ' ادخل اسم الصفحه لتبدأ التصفح',
	'smw_browse_go' => ' الاطلاق ',
	'smw_browse_more' => '&hellip;',
	// Messages for the page property special
	'pageproperty' => ' بحث عن خصائص الصفحه ',
	'smw_pp_docu' => ' البحث عن جميع قيم سمة على صفحة معينة. الرجاء ادخال كل صفحة وميزة',
	'smw_pp_from' => ' من صفحة ',
	'smw_pp_type' => ' الخاصيه ',
	'smw_pp_submit' => ' ايجاد نتائج ',
	// Generic messages for result navigation in all kinds of search pages
	'smw_result_prev' => ' السابق ',
	'smw_result_next' => ' القادم ',
	'smw_result_results' => ' النتائج ',
	'smw_result_noresults' => '. عفوا ، لا توجد نتائج '
);


