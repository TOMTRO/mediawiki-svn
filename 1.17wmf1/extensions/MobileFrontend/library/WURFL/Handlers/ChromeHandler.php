<?php
/**
 * WURFL API
 *
 * LICENSE
 *
 * This file is released under the GNU General Public License. Refer to the
 * COPYING file distributed with this package.
 *
 * Copyright (c) 2008-2009, WURFL-Pro S.r.l., Rome, Italy
 *
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    $id$
 */

/**
 * ChromeUserAgentHanlder
 *
 *
 * @category   WURFL
 * @package    WURFL_Handlers
 * @copyright  WURFL-PRO SRL, Rome, Italy
 * @license
 * @version    $id$
 */
class WURFL_Handlers_ChromeHandler extends WURFL_Handlers_Handler {
	
	protected $prefix = "CHROME";
	
	function __construct($wurflContext, $userAgentNormalizer = null) {
		parent::__construct ( $wurflContext, $userAgentNormalizer );
	}
	
	/**
	 * Intercept all UAs Containing Chrome and are not mobile browsers
	 *
	 * @param string $userAgent
	 * @return boolean
	 */
	public function canHandle($userAgent) {
		if (WURFL_Handlers_Utils::isMobileBrowser ( $userAgent )) {
			return false;
		}
		return WURFL_Handlers_Utils::checkIfContains ( $userAgent, "Chrome" );
	}

}