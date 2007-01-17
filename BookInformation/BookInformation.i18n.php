<?php

/**
 * Internationalisation file for the Book Information extension
 *
 * @package MediaWiki
 * @subpackage Extensions
 * @author Rob Church <robchur@gmail.com>
 */
 
function efBookInformationMessages() {
	$messages = array(

/* English (Rob Church) */
'en' => array(
'bookinfo-header' => 'Book information',
'bookinfo-result-title' => 'Title:',
'bookinfo-result-author' => 'Author:',
'bookinfo-result-publisher' => 'Publisher:',
'bookinfo-result-year' => 'Year:',
'bookinfo-error-invalidisbn' => 'Invalid ISBN entered.',
'bookinfo-error-nodriver' => 'Unable to initialise an appropriate Book Information Driver.',
'bookinfo-error-noresponse' => 'No response or request timed out.',
'bookinfo-purchase' => 'Purchase this book from $1',
'bookinfo-provider' => 'Data provider: $1',
),

/* Dutch (Dirk Beetstra) */ 
'nl' => array( 
'bookinfo-header' => 'Boek informatie', 
'bookinfo-result-title' => 'Titel:', 
'bookinfo-result-author' => 'Auteur:', 
'bookinfo-result-publisher' => 'Uitgever:', 
'bookinfo-result-year' => 'Jaar:', 
'bookinfo-error-invalidisbn' => 'Incorrect ISBN ingegeven.', 
'bookinfo-error-nodriver' => 'Kon de juiste Boek Informatie Driver niet initialiseren.', 
'bookinfo-error-noresponse' => 'Geen respons of een time-out.', 
'bookinfo-purchase' => 'Koop dit boek bij $1', 
'bookinfo-provider' => 'Data geleverd door: $1', 
), 

/* Finnish (Niklas Laxström) */
'fi' => array(
'bookinfo-header' => 'Kirjan tiedot',
'bookinfo-result-title' => 'Nimi:',
'bookinfo-result-author' => 'Tekijä:',
'bookinfo-result-publisher' => 'Kustantaja:',
'bookinfo-result-year' => 'Vuosi:',
'bookinfo-error-invalidisbn' => 'Kelpaamaton ISBN.',
'bookinfo-error-nodriver' => 'Kirjatietoajurin alustus ei onnistunut.',
'bookinfo-error-noresponse' => 'Ei vastausta tai pyyntö aikakatkaistiin.',
'bookinfo-purchase' => 'Osta tämä kirja: $1',
'bookinfo-provider' => 'Tietolähde: $1',
),
	
	);
	return $messages;
}

?>