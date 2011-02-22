<?php
/**
 * GeeQuBox.php
 * Written by David Raison
 * @license: CC-BY-SA 3.0 http://creativecommons.org/licenses/by-sa/3.0/lu/
 *
 * @file GeeQuBox.php
 * @ingroup GeeQuBox
 *
 * @author David Raison
 *
 * Uses the lightbox jquery plugin written by Leandro Vieira Pinho (CC-BY-SA) 2007,
 * http://creativecommons.org/licenses/by-sa/2.5/br/
 * http://leandrovieira.com/projects/jquery/lightbox/
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'This is a MediaWiki extension, and must be run from within MediaWiki.' );
}

$wgExtensionCredits['parserhook'][] = array(
	'path' => __FILE__,
	'name' => 'GeeQuBox',
	'version' => '0.01',
	'author' => array( '[http://www.mediawiki.org/wiki/User:Clausekwis David Raison]' ), 
	'url' => 'http://www.mediawiki.org/wiki/Extension:GeeQuBox',
	'descriptionmsg' => 'geequbox-desc'
);

// defaults
$wgGqbDefaultWidth = 640;

$wgExtensionMessagesFiles['GeeQuBox'] = dirname(__FILE__) .'/GeeQuBox.i18n.php';
$wgHooks['LanguageGetMagic'][] = 'wfGeeQuBoxLanguageGetMagic';

$gqb = new GeeQuBox;
$wgHooks['BeforeParserrenderImageGallery'][] = array($gqb,'gqbAnalyse');
$wgHooks['BeforePageDisplay'][] = array($gqb,'gqbAddLightbox');

function wfGeeQuBoxLanguageGetMagic( &$magicWords, $langCode = 'en' ) {
	$magicWords['geequbox'] = array( 0, 'geequbox' );
	return true;
}

/**
 * Class that handles all GeeQuBox operations.
 */
class GeeQuBox {

	private static $_page;
	private $_hasGallery;

	public function gqbAddLightBox( $page ) { 
		if ( !$this->_hasGallery )
			return false;

		try {
			self::$_page = $page;
			$this->_gqbReplaceHref( $page );
			$this->_gqbAddScripts( $page );
			return true;
		} catch ( Exception $e ) {
			wfDebug('GeeQuBox::'.$e->getMessage());
			return false;
		}
	}

	/**
	 * See http://svn.wikimedia.org/doc/classImageGallery.html
	 */
	public function gqbAnalyse( Parser &$parser, &$gallery ) {
		// It seems that the file objects are only added to the imagegallery object after the
		// BeforeParserrenderImageGallery hook is run. Thus it will always be empty here.
		// var_dump($gallery->isEmpty(),$gallery->count(),$gallery InstanceOf ImageGallery); 
		if ( $gallery InstanceOf ImageGallery ) {
			$this->_hasGallery = true;
			return true;
		} else return false;
	}


	private function _gqbAddScripts() {
		global $wgExtensionAssetsPath;

		$eDir = $wgExtensionAssetsPath .'/GeeQuBox/';
		self::$_page->includeJQuery();
		self::$_page->addScript( '<script type="text/javascript" src="' 
			. $eDir . 'js/jquery.lightbox-0.5.min.js"></script>' . PHP_EOL );
		self::$_page->addExtensionStyle( $eDir . '/css/jquery.lightbox-0.5.css', 'screen' );
		self::$_page->addInlineScript('$j(document).ready(function(){
			$j("div.gallerybox").each(function(el){
                                var _a = $j("div.thumb a", this);
                                var title = _a.attr("title");
                                var caption = $j("div.gallerytext >  p", this).text();
                                if ( caption != "" )
                                        _a.attr("title", title + caption);
                        });
			$j("div.gallerybox a.image").lightBox({
				imageLoading: 	"'. $eDir .'images/lightbox-ico-loading.gif",
				imageBtnClose:	"'. $eDir .'images/lightbox-btn-close.gif",
				imageBtnPrev:	"'. $eDir .'images/lightbox-btn-prev.gif",
				imageBtnNext:	"'. $eDir .'images/lightbox-btn-next.gif",
                                imageBlank:     "'. $eDir .'images/lightbox-blank.gif"
			});
		})');
		/* See _gqbreplaceHref()
                	var boxWidth = ($j(window).width() - 20);
                        var rxp = new RegExp(/([0-9]{2,})$/);	
                        $j("div.gallerybox a.image").each(function(el){
                                if(boxWidth < Number(this.search.match(rxp)[0])){
                                        this.href = this.pathname+this.search.replace(rxp,boxWidth);
                                }
                        });
		*/
		return true;
	}

	/**
	 * We need to change this: <a href="/wiki/File:8734_f8db_390.jpeg"> into
	 * the href of the actual image file (i.e. $file->getURL()) because that
	 * is what Lightbox expects. (Note that this is not too different from the SlimboxThumbs
	 * approach but there doesn't seem to be an alternative approach.)
	 */
	private function _gqbReplaceHref() {
		$pattern = '~href="/wiki/([^"]+)"\s*class="image"~';	
		$replaced = preg_replace_callback($pattern,'self::_gqbReplaceMatches',self::$_page->getHTML());

		self::$_page->clearHTML();
		self::$_page->addHTML( $replaced );
	}

	private static function _gqbReplaceMatches( $matches ) {
		global $wgGqbDefaultWidth;
		$titleObj = Title::newFromText( rawurldecode( $matches[1] ) );
	        $image = wfFindFile( $titleObj, false, false, true );
        	$realwidth = (Integer) $image->getWidth();
	        $width = ( $realwidth > $wgGqbDefaultWidth ) ? $wgGqbDefaultWidth : $realwidth;
		$iPath = ( $realwidth < $wgGqbDefaultWidth ) ? $image->getURL() : $image->createThumb($width);
		$title = self::$_page->parse( "'''[[:" . $titleObj->getFullText() . "|" . $titleObj->getText() . "]]'''" );

                return 'href="'. $iPath .'" title="'. htmlspecialchars( $title )  .'" class="image"';
	}

	/*
	 * Code used also in SlimboxThumbs to set the size of the displayed images
	 * This can only be done in js where the window.width is known.
		$out->addInlineScript( $jQ.'(document).ready(function(){
                if('.$jQ.'("table.gallery").val() != undefined){
        })' );

	*/

}

