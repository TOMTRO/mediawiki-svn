<?php
/**
 * Displays a pre-defined form that a user can run a query with.
 *
 * @author Yaron Koren
 */

if (!defined('MEDIAWIKI')) die();

class SFRunQuery extends SpecialPage {

	/**
	 * Constructor
	 */
	function SFRunQuery() {
		SpecialPage::SpecialPage('RunQuery');
		wfLoadExtensionMessages('SemanticForms');
	}

	function execute($query) {
		global $wgRequest;
		$this->setHeaders();
		$form_name = $wgRequest->getVal('form');

		// if query string did not contain this variable, try the URL
		if (! $form_name) {
			$form_name = $query;
		}

		self::printQueryForm($form_name);
	}

	static function printQueryForm($form_name) {
		global $wgOut, $wgRequest, $wgScriptPath, $sfgScriptPath, $sfgFormPrinter, $sfgYUIBase;

		wfLoadExtensionMessages('SemanticForms');

		// get contents of form definition file
		$form_title = Title::makeTitleSafe(SF_NS_FORM, $form_name);

		if (! $form_title || ! $form_title->exists() ) {
			$javascript_text = "";
			if ($form_name == '')
				$text = '<p class="error">' . wfMsg('sf_runquery_badurl') . "</p>\n";
			else
				$text = '<p class="error">Error: No form page was found at ' . SFUtils::linkText(SF_NS_FORM, $form_name) . ".</p>\n";
		} else {
			$s = wfMsg('sf_runquery_title', $form_title->getText());
			$wgOut->setPageTitle($s);
			$form_article = new Article($form_title);
			$form_definition = $form_article->getContent();
			$submit_url = $form_title->getLocalURL('action=submit');
			$run_query = $wgRequest->getCheck('wpRunQuery');
			$content = $wgRequest->getVal('wpTextbox1');
			$form_submitted = ($run_query);
			// if user already made some action, ignore the edited
			// page and just get data from the query string
			if ($wgRequest->getVal('query') == 'true') {
				$edit_content = null;
				$is_text_source = false;
			} elseif ($content != null) {
				$edit_content = $content;
				$is_text_source = true;
			} else {
				$edit_content = null;
				$is_text_source = true;
			}
			list ($form_text, $javascript_text, $data_text, $form_page_title) =
				$sfgFormPrinter->formHTML($form_definition, $form_submitted, $is_text_source, $edit_content, null, null, true);
			if ($form_submitted) {
				$wgOut->setArticleBodyOnly( true );
				global $wgTitle;
				$new_url = $wgTitle->getLocalURL() . "/$form_name";
				$text = SFUtils::printRedirectForm($new_url, $data_text, $wgRequest->getVal('wpSummary'), $save_page, $preview_page, $diff_page, $wgRequest->getCheck('wpMinoredit'), $wgRequest->getCheck('wpWatchthis'), $wgRequest->getVal('wpStarttime'), $wgRequest->getVal('wpEdittime'));
			} else {
				$text = "";
				// override the default title for this page if
				// a title was specified in the form
				if ($form_page_title != NULL) {
					$wgOut->setPageTitle($form_page_title);
				}
				if ($wgRequest->getCheck('wpTextbox1')) {
					global $wgParser, $wgTitle;
					$wgParser->mOptions = new ParserOptions();
					$wgParser->mOptions->initialiseFromUser($wgUser);
					$text = $wgParser->parse($content, $wgTitle, $wgParser->mOptions)->getText();
					$additional_query = wfMsg('sf_runquery_additionalquery');
					$text .= "\n<h2>$additional_query</h2>\n";
				}
				$text .=<<<END
	<form name="createbox" onsubmit="return validate_all()" action="" method="post" class="createbox">
	<input type="hidden" name="query" value="true" />

END;
				$text .= $form_text;
			}
		}
		SFUtils::addJavascriptAndCSS();
		$wgOut->addScript('		<script type="text/javascript">' . "\n" . $javascript_text . '</script>' . "\n");
		$wgOut->addHTML($text);
	}
}
