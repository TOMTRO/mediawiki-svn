/**
 * JavasSript for the Reviews MediaWiki extension.
 * @see https://www.mediawiki.org/wiki/Extension:Reviews
 *
 * @licence GNU GPL v3 or later
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function( $, mw ) { $( document ).ready( function() {

	var _this = this;

	$( '.review-control' ).reviewControl();

} ); })( window.jQuery, window.mediaWiki );
