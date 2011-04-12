<?php
/**
 * @file
 * @ingroup SMWDataItems
 */

/**
 * This class implements error list data items. These data items are used to
 * pass around lists of error messages within the application. They are not
 * meant to be stored or exported, but they can be useful to a user.
 *
 * @author Markus Krötzsch
 * @ingroup SMWDataItems
 */
class SMWDIError extends SMWDataItem {

	/**
	 * List of error messages. Should always be safe for HTML.
	 * @var array of strings
	 */
	protected $m_errors;

	public function __construct( $errors, $typeid = '__err' ) {
		parent::__construct( $typeid );
		$this->m_errors = $errors;
	}

	public function getDIType() {
		return SMWDataItem::TYPE_ERROR;
	}

	public function getErrors() {
		return $this->m_errors;
	}

	public function getSortKey() {
		return 'error';
	}

	public function getSerialization() {
		return serialize( $this->m_errors );
	}

	/**
	 * Create a data item from the provided serialization string and type
	 * ID.
	 * @return SMWDIError
	 */
	public static function doUnserialize( $serialization, $typeid ) {
		return new SMWDIError( unserialize( $serialization ), $typeid );
	}

}
