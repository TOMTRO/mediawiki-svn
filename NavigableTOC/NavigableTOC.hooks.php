<?php
/**
 * Hooks for Usability Initiative NavigableTOC extension
 *
 * @file
 * @ingroup Extensions
 */

class NavigableTOCHooks {

	/* Static Functions */

	/**
	 * EditPage::showEditForm:initial hook
	 * Adds the TOC to the edit form
	 */
	 public static function addTOC( &$ep ) {
		global $wgNavigableTOCStyleVersion, $wgParser, $wgUser;
		global $wgEnableParserCache;

		// Adds script to document
		UsabilityInitiativeHooks::initialize();
		UsabilityInitiativeHooks::addScript(
			'NavigableTOC/NavigableTOC.js', $wgNavigableTOCStyleVersion
		);
		UsabilityInitiativeHooks::addStyle(
			'NavigableTOC/NavigableTOC.css', $wgNavigableTOCStyleVersion
		);
		$ep->editFormTextTop .= '<div id="navigableTOC"></div>';
		return true;
	}
}
