<?

function wfSpecialRandompage()
{
	global $wgUser, $wgOut;

	$wgOut->setPageTitle( wfMsg( "randompage" ) );
	$wgOut->addHTML( "<p>(TODO: Random page)" );
}

?>
