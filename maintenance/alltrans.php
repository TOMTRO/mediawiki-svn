<?php
/**
 * @package MediaWiki
 * @subpackage Maintenance
 *
 * Get all the translations messages, as defined in the English language file.
 */

require_once( 'commandLine.inc' );

$wgLang = new Language();
foreach( array_keys( $wgLang->getAllMessages() ) as $key ) {
	echo "$key\n";
}

?>
