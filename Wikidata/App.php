<?php

$wgDefaultGoPrefix='Expression:';
# FIXME - get NS ids from DB (need to put this in a loader hook)
$wgNamespaceProtection[ 16 ] = array( 'editwikidata' );
$wgNamespaceProtection[ 24 ] = array( 'editwikidata' );
$wgGroupPermissions['wikidata']['editwikidata']=true;
$wgExtensionFunctions[]='setupDataContextPermissions';
$wgHooks['BeforePageDisplay'][]='addWikidataHeader';
$wgHooks['GetEditLinkTrail'][]='addWikidataEditLinkTrail';
$wgHooks['GetHistoryLinkTrail'][]='addHistoryLinkTrail';
$wgCustomHandlerPath = array('*'=>"{$IP}/extensions/Wikidata/OmegaWiki/");
$wgDefaultClassMids = array(402295);

# The term dataset prefix identifies the Wikidata instance that will
# be used as a resource for obtaining language-independent strings
# in various places of the code. If the term db prefix is empty,
# these code segments will fall back to (usually English) strings.
# If you are setting up a new Wikidata instance, you may want to
# set this to ''.
$wdTermDBDataSet='uw';

# This is the dataset that should be shown to all users by default.
# It _must_ exist for the Wikidata application to be executed 
# successfully.
$wdDefaultViewDataSet='uw';

require_once("{$IP}/extensions/Wikidata/SpecialLanguages.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialSuggest.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialSelect.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialDatasearch.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialTransaction.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialNeedsTranslation.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialImportLangNames.php");
require_once("{$IP}/extensions/Wikidata/OmegaWiki/SpecialAddCollection.php");
function addWikidataHeader() {
  global $wgOut,$wgScriptPath;
  $wgOut->addScript("<script type='text/javascript' src='{$wgScriptPath}/extensions/Wikidata/OmegaWiki/suggest.js'></script>");
  $wgOut->addLink(array('rel'=>'stylesheet','type'=>'text/css','media'=>'screen, projection','href'=>"{$wgScriptPath}/extensions/Wikidata/OmegaWiki/suggest.css"));
  $wgOut->addLink(array('rel'=>'stylesheet','type'=>'text/css','media'=>'screen, projection','href'=>"{$wgScriptPath}/extensions/Wikidata/OmegaWiki/tables.css"));                                                                                                                                                                    
}

function addWikidataEditLinkTrail(&$trail) {
  $dc=wdGetDatasetContext();
  $trail="&dataset=$dc";
}

function addHistoryLinkTrail(&$trail) {
  $dc=wdGetDatasetContext();
  $trail="&dataset=$dc";
}

function setupDataContextPermissions() {
  global $wgGroupPermissions;
  $dc=wdGetDataSetContext();
  if($dc->getPrefix()=='tt') {
    $wgGroupPermissions['wikidata']['editwikidata']=false;
  }

}

# all DMs will be put in this class by default.


?>
