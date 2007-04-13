<?php
/**
 * @author Denny Vrandecic
 *
 * This special page for Semantic MediaWiki implements a
 * view on an article displaying outgoing and incoming
 * properties.
 */

if (!defined('MEDIAWIKI')) die();

global $IP, $smwgIP;
require_once( "$IP/includes/SpecialPage.php" );
require_once( "$smwgIP/includes/storage/SMW_Store.php" );


function doSpecialBrowse($query = '') {
	SMW_SpecialBrowse::execute($query);
}

SpecialPage::addPage( new SpecialPage('Browse','',true,'doSpecialBrowse',false) );



class SMW_SpecialBrowse	 {

	static function execute($query = '') {
		global $wgRequest, $wgOut, $wgUser, $smwgIQMaxLimit;
		$skin = $wgUser->getSkin();

		// get the GET parameters
		$articletext = $wgRequest->getVal( 'article' );
		// no GET parameters? Then try the URL
		if ('' == $articletext) {
			$articletext = $query;
		}
		$article = Title::newFromText( $articletext );
		$limit = $wgRequest->getVal( 'limit' );
		if ('' == $limit) $limit =  10;
		$offset = $wgRequest->getVal( 'offset' );
		if ('' == $offset) $offset = 0;
		$mode = $wgRequest->getVal( 'mode' );
		if (('' == $mode) || ('out' == $mode)) { $mode = 'out'; } else { $mode = 'in'; }
		$html = '';
		$spectitle = Title::makeTitle( NS_SPECIAL, 'Browse' );

		// display query form
		$html .= '<form name="smwbrowse" action="' . $spectitle->escapeLocalURL() . '" method="get">' . "\n";
		$html .= '<input type="hidden" name="title" value="' . $spectitle->getPrefixedText() . '"/>' ;
		$html .= wfMsg('smw_browse_article') . "<br />\n";
		if (NULL == $article) {	$boxtext = $articletext; } else { $boxtext = $article->getFullText(); }
		$html .= '<input type="text" name="article" value="' . htmlspecialchars($boxtext) . '" />' . "\n";
		$html .= '<input type="submit" value="' . wfMsg('smw_browse_go') . "\"/>\n</form>\n";

		$vsep = '<tr><td colspan="2"><div class="smwhr"><hr /></div></td></tr>';

		if ((NULL == $article) || ('' == $articletext)) { // empty, no article name given
			$html .= wfMsg('smw_browse_docu') . "\n";
		} else { // incoming links
			$options = new SMWRequestOptions();
			// get results (get one more, to see if we have to add a link to more)
			$outrel = &smwfGetStore()->getOutRelations($article, $options);
			$atts = &smwfGetStore()->getAttributes($article, $options);
			$options->limit = $limit+1;
			$options->offset = $offset;
			$inrel = &smwfGetStore()->getInRelations($article, $options);

			$html .= "<p>&nbsp;</p>\n" . wfMsg('smw_browse_displayresult', $skin->makeLinkObj($article)) . "<br />\n";

			$html .= '<table><tr><td style="vertical-align=middle;">';

			// prepare navigation bar
			if ($offset > 0)
				$navigation = '<a href="' . htmlspecialchars($skin->makeSpecialUrl('Browse','offset=' . max(0,$offset-$limit) . '&article=' . urlencode($articletext) )) . '&mode=in">' . wfMsg('smw_result_prev') . '</a>';
			else
				$navigation = wfMsg('smw_result_prev');

			$navigation .= '&nbsp;&nbsp;&nbsp;&nbsp; <b>' . wfMsg('smw_result_results') . ' ' . ($offset+1) . '&ndash; ' . ($offset + min(count($inrel), $limit)) . '</b>&nbsp;&nbsp;&nbsp;&nbsp;';

			if (count($inrel)==($limit+1))
				$navigation .= ' <a href="' . htmlspecialchars($skin->makeSpecialUrl('Browse', 'offset=' . ($offset+$limit) . '&article=' . urlencode($articletext) ))  . '&mode=in">' . wfMsg('smw_result_next') . '</a>';
			else
				$navigation .= wfMsg('smw_result_next');

			if (count($inrel) == 0) {
				$html .= '&nbsp;';
			} else {
				// no need to show the navigation bars when there is not enough to navigate
				if (($offset>0) || (count($inrel)>$limit))
					$html .= $navigation;
				$html .= '<table>' . $vsep . "\n";
				foreach ($inrel as $result) {
					$innerlimit = 6;
					$subjectoptions = new SMWRequestOptions();
					$subjectoptions->limit = $innerlimit;
					$html .= '<tr><td style="text-align:right;">' . "\n";
					$subjects = &smwfGetStore()->getRelationSubjects($result, $article, $subjectoptions);
					$subjectcount = count($subjects);
					$more = ($subjectcount == $innerlimit);
					$innercount = 0;
					foreach ($subjects as $subject) {
						$innercount += 1;
						if (($innercount < $innerlimit) || !$more) {
							$subjectlink = SMWInfolink::newBrowsingLink('+',$subject->getFullText());
							$html .= $skin->makeKnownLinkObj($subject, smwfT($subject)) . '&nbsp;&nbsp;' . $subjectlink->getHTML($skin);
							if ($innercount<$subjectcount) $html .= ", \n";
						} else {
							$html .= '<a href="' . $skin->makeSpecialUrl('SearchByRelation', 'type=' . urlencode($result->getFullText()) . '&target=' . urlencode($article->getFullText())) . '">' . wfMsg("smw_browse_more") . "</a><br />\n";
						}
					}
					$html .= '</td><td class="smwrelright">' . $skin->makeLinkObj($result, smwfT($result)) . '</td></tr>' . $vsep . "\n";
				}
				$html .= "</table>\n";
			}
			if (($offset>0) || (count($inrel)>$limit))
				$html .= $navigation;

			$html .= '</td><td style="vertical-align:middle; text-align:center;">' . $skin->makeLinkObj($article, smwfT($article)) . '</td><td style="vertical-align:middle;">';

			if ((count($outrel) == 0) && (count($atts) == 0)) {
				$html .= '&nbsp;';
			} else {
				$html .= '<table>'. $vsep . "\n";
				foreach ($outrel as $result) {
					$objectoptions = new SMWRequestOptions();
					$html .= '<tr><td style="text-align:right;">' . "\n";
					$html .=  $skin->makeLinkObj($result, smwfT($result)) . "\n";
					$html .= '</td><td>' . "\n";
					$objects = &smwfGetStore()->getRelationObjects($article, $result, $objectoptions);
					$objectcount = count($objects);
					$count = 0;
					foreach ($objects as $object) {
						$count += 1;
						$searchlink = SMWInfolink::newBrowsingLink('+',$object->getFullText());
						$html .= $skin->makeLinkObj($object, smwfT($object)) . '&nbsp;&nbsp;' . $searchlink->getHTML($skin);
						if ($count<$objectcount) $html .= ", ";
					}
					$html .= '</td></tr>'.$vsep."\n";
				}
				foreach ($atts as $att) {
					$objectoptions = new SMWRequestOptions();
					$html .= '<tr><td style="text-align:right;">' . "\n";
					$html .=  $skin->makeKnownLinkObj($att, $att->getText()) . "\n";
					$html .= '</td><td>' . "\n";
					$objects = &smwfGetStore()->getAttributeValues($article, $att, $objectoptions);
					$objectcount = count($objects);
					$count = 0;
					foreach ($objects as $object) {
						$count += 1;
						$html .= $object->getValueDescription();
						if ($count<$objectcount) $html .= ", ";
					}
					$html .= '</td></tr>'.$vsep."\n";
				}
				$html .= "</table>\n";
			}
			$html .= "</td></tr></table>";
		}

		$wgOut->addHTML($html);
	}
}

///// Translation functions /////

/**
 * Global shortcut function for Store::translateTitle
 */
function smwfT(Title $title) {
	global $wgLang;
	return translateTitle($title, $wgLang);
}

function translateTitle(Title $title, Language $language ) {
	$db =& wfGetDB( DB_MASTER ); // TODO: can we use SLAVE here? Is '=&' needed in PHP5?
	$sql = 'll_from=' . $db->addQuotes($title->getArticleID()) .
	       ' AND ll_lang=' . $db->addQuotes($language->mCode);
	$res = $db->select( $db->tableName('langlinks'),
	                    'll_title',
	                    $sql, 'SMW::translateTitle' );
	// return result as string (only the first -- there should be only one, anyway)
	if($db->numRows( $res ) > 0) {
		$row = $db->fetchObject($res);
		$db->freeResult($res);
		return $row->ll_title; // TODO need to get rid of NS in other language
	} else {
		$db->freeResult($res);
		return $title->getText();
	}
}

?>
