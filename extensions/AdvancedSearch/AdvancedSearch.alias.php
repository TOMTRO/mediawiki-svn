<?php
/**
 * Aliases for AdvancedSearch extension.
 *
 * @file
 * @ingroup Extensions
 */

$specialPageAliases = array();

/** English */
$specialPageAliases['en'] = array(
	'AdvancedSearch' => array( 'AdvancedSearch' )
);

/** Finnish (Suomi) */
$specialPageAliases['fi'] = array(
	'AdvancedSearch' => array( 'Kehittynyt haku' )
);

/**
 * For backwards compatibility with MediaWiki 1.15 and earlier.
 */
$aliases =& $specialPageAliases;