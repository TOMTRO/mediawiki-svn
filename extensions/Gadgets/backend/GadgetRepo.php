<?php
// TODO: Fix comment lengths, inconsistent across this project
/**
 * Abstract base class for gadget repositories, can be local or remote
 */
abstract class GadgetRepo {
	/**
	 * Constructor.
	 * @param $info array with configuration data, depends on repo type
	 */
	public function __construct( array $info ) {
		// TODO: Common config stuff for all repos?
	}
	
	/**** Abstract functions ****/
	
	/**
	 * Get the name of the ResourceLoader source of the modules
	 * returned by this repository.
	 * @return string Source name
	 */
	abstract public function getSource();
	
	/**
	 * Get the ids of the gadgets provided by this repository
	 * @return array of ids (strings)
	 */
	abstract public function getGadgetIds();
	
	/**
	 * Get a Gadget object for a given gadget id
	 * @param $id string Gadget id
	 * @return Gadget object or null if no such gadget
	 */
	abstract public function getGadget( $id );
	
	/**
	 * Clear any in-object caches this repository may have. In particular,
	 * the return values of getGadgetIds() and getGadget() may be cached.
	 * Callers may wish to clear this cache and reobtain a Gadget object
	 * when they get a conflict error.
	 */
	abstract public function clearInObjectCache();
	
	/**
	 * Check whether this repository allows write actions. If this method returns false,
	 * methods that modify the state of the repository or the gadgets in it (i.e. addGadget(),
	 * modifyGadget() and deleteGadget()) will always fail.
	 * @return bool
	 */
	abstract public function isWriteable();
	
	/**
	 * Get the Database object for the database this repository is based on, or null if this
	 * repository is not based on a database (but e.g. on a remote API)
	 * @return Database object (slave connection) or null
	 */
	abstract public function getDB();
	
	/**
	 * Modify a gadget, replacing its metadata with the
	 * metadata in the provided Gadget object. The id is taken
	 * from the Gadget object as well. If no Gadget exists by that id,
	 * it will be created.
	 * @param $gadget Gadget object
	 * @param $timestamp Timestamp to record for this action, or current timestamp if null
	 * @return Status
	 */
	abstract public function modifyGadget( Gadget $gadget, $timestamp = null );
	
	/**
	 * Irrevocably delete a gadget from the repository. Will fail
	 * if there is no gadget by the given id.
	 * @param $id string Unique id of the gadget to delete
	 * @return Status
	 */
	abstract public function deleteGadget( $id );
	
	/**** Public functions ****/
	
	/**
	 * Get the localized title for a given category in a given language.
	 * 
	 * The "gadgetcategory-$category" message is used, if it exists.
	 * If it doesn't exist, ucfirst( $category ) is returned.
	 * 
	 * @param $category string Category ID
	 * @param $lang string Language code. If null, $wgLang is used
	 * @return string Localized category title
	 */
	public static function getCategoryTitle( $category, $lang = null ) {
		$msg = wfMessage( "gadgetcategory-$category" );
		if ( $lang !== null ) {
			$msg = $msg->inLanguage( $lang );
		}
		if ( !$msg->exists() ) {
			global $wgLang;
			$langObj = $lang === null ? $wgLang : Language::factory( $lang );
			return $lang->ucfirst( $category );
		}
		return $msg->plain();
	}
	
}
