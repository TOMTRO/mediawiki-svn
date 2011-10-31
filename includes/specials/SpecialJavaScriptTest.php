<?php

class SpecialJavaScriptTest extends SpecialPage {

	/**
	 * @var $frameworks Array: Mapping of framework ids and their initilizer methods
	 * in this class. If a framework is requested but not in this array,
	 * the 'unknownframework' error is served.
	 */
	static $frameworks = array(
		'qunit' => 'initQUnitTesting',
	);

	public function __construct() {
		parent::__construct( 'JavaScriptTest' );
	}

	public function execute( $par ) {
		global $wgEnableJavaScriptTest;

		$out = $this->getOutput();

		$this->setHeaders();
		$out->disallowUserJs();

		// Abort early if we're disabled
		if ( $wgEnableJavaScriptTest !== true ) {
			$out->addWikiMsg( 'javascripttest-disabled' );
			return;
		}

		$out->addModules( 'mediawiki.special.javaScriptTest' );

		// Determine framework
		$pars = explode( '/', $par );
		$framework = strtolower( $pars[0] );

		// No framework specified
		if ( $par == '' ) {
			$out->setPagetitle( wfMsg( 'javascripttest' ) );
			$summary = $this->wrapSummaryHtml(
				wfMsg( 'javascripttest-pagetext-noframework' ) . $this->getFrameworkListHtml(),
				'noframework'
			);
			$out->addHtml( $summary );

		// Matched! Display proper title and initialize the framework
		} elseif ( isset( self::$frameworks[$framework] ) ) {
			$out->setPagetitle( wfMsg( 'javascripttest-title', wfMsg( "javascripttest-$framework-name" ) ) );
			$out->setSubtitle(  wfMsg( 'javascripttest-backlink',  Linker::linkKnown( $this->getTitle() ) ) );
			$this->{self::$frameworks[$framework]}();

		// Framework not found, display error
		} else {
			$out->setPagetitle( wfMsg( 'javascripttest' ) );
			$summary = $this->wrapSummaryHtml( '<p class="error">'
				. wfMsg( 'javascripttest-pagetext-unknownframework', $par )
				. '</p>'
				. $this->getFrameworkListHtml() );
			$out->addHtml( $summary, 'unknownframework' );
		}
	}

	/**
	 * Get a list of frameworks (including introduction paragraph and links to the framework run pages)
	 * @return String: HTML
	 */
	private function getFrameworkListHtml() {
		$list = '<ul>';
		foreach( self::$frameworks as $framework => $initFn ) {
			$list .= Html::rawElement(
				'li',
				array(),
				Linker::link( $this->getTitle( $framework ), wfMsg( "javascripttest-$framework-name" ) )
			);
		}
		$list .= '</ul>';
		$msg = wfMessage( 'javascripttest-pagetext-frameworks' )->rawParams( $list )->parseAsBlock();

		return $msg;
	}

	/**
	 * Function to wrap the summary.
	 * @param $html String: The raw HTML.
	 * @param $state String: State, one of 'noframework', 'unknownframework' or 'frameworkfound'
	 */
	private function wrapSummaryHtml( $html = '', $state ) {
		return "<div id=\"mw-javascripttest-summary\" class=\"mw-javascripttest-$state\">$html</div>";
	}

	/**
	 * Initialize the page for QUnit.
	 */
	private function initQUnitTesting() {
		global $wgJavaScriptTestConfig;

		$out = $this->getOutput();

		$out->addModules( 'mediawiki.tests.qunit.testrunner' );
		$qunitTestModules = $out->getResourceLoader()->getTestModuleNames( 'qunit' );
		$out->addModules( $qunitTestModules );

		$summary = wfMessage( 'javascripttest-qunit-intro' )
			->params( $wgJavaScriptTestConfig['qunit']['documentation'] )
			->parseAsBlock();
		$header = wfMessage( 'javascripttest-qunit-heading' )->escaped();

		$baseHtml = <<<HTML
<div id="qunit-header">$header</div>
<div id="qunit-banner"></div>
<div id="qunit-testrunner-toolbar"></div>
<div id="qunit-userAgent"></div>
<ol id="qunit-tests"></ol>
HTML;
		$out->addHtml( $this->wrapSummaryHtml( $summary, 'frameworkfound' ) . $baseHtml );

	}

	public function isListed(){
		global $wgEnableJavaScriptTest;
		return $wgEnableJavaScriptTest === true;
	}

}
