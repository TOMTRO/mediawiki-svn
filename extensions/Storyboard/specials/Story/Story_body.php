<?php
/**
 * File holding the SpecialStory class defining a special page to view a specific story for permalink purpouses.
 *
 * @file Story_body.php
 * @ingroup Storyboard
 * @ingroup SpecialPage
 *
 * @author Jeroen De Dauw
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

class SpecialStory extends IncludableSpecialPage {

	public function __construct() {
		parent::__construct( 'Story' );
	}

	public function execute( $title ) {
		wfProfileIn( __METHOD__ );
		
		global $wgOut, $wgRequest;		
		
		$action = $wgRequest->getVal( 'action' );
		
		if ( $action == 'save' ) {
			$this->saveStoryAndShowResult();
		} else if ( trim( $title ) != '' || $wgRequest->getIntOrNull( 'id' ) ) {
			$this->queryAndShowStory( $title, $action );
		} else {
			$wgOut->addWikiMsg( 'storyboard-nostorytitle' );	
		}
		
		wfProfileOut( __METHOD__ );
	}
	
	/**
	 * Queries for the requested story and shows it in either display or edit mode when it's found.
	 */
	private function queryAndShowStory( $title, $action ) {
		global $wgOut, $wgRequest;
		
		if ( trim( $title ) != '' ) {
			$conds = array(
				'story_title' => str_replace( '_', ' ', $title )
			);
		} else {
			$id = $wgRequest->getIntOrNull( 'id' );
			$conds = array(
				'story_id' => $id
			);		
		}
		
		$dbr = wfGetDB( DB_SLAVE );		
		
		$story = $dbr->selectRow(
			'storyboard',
			array(
				'story_id',
				'story_author_name',
				'story_title',
				'story_text',
				'story_created',
				'story_is_published',
			),
			$conds
		);

		if ( $story ) {
			if ( $action == 'edit' ) {
				$this->showStoryForm( $story );
			} else {
				if ( $story->story_is_published == 1 ) {
					$this->showStory( $story );
				}
				else {
					$wgOut->addWikiMsg( 'storyboard-unpublished' );
				}	
			}
		}
		else {
			$wgOut->addWikiMsg( 'storyboard-nosuchstory' );
		}		
	}
	
	/**
	 * Ouputs the story in regular display mode.
	 * 
	 * @param $story
	 */
	private function showStory( $story ) {
		global $wgOut;
		
		
		
		$wgOut->addHTML( '' ); // TODO: add output
	}
	
	/**
	 * Outputs a form to edit the story with. Code based on <storysubmission>.
	 * 
	 * @param $story
	 */	
	private function showStoryForm( $story ) {
		global $wgOut, $wgRequest, $wgUser, $wgJsMimeType, $egStoryboardScriptPath, $egStorysubmissionWidth, $egStoryboardMaxStoryLen, $egStoryboardMinStoryLen;
		
		$wgOut->addStyle( $egStoryboardScriptPath . '/storyboard.css' );
		$wgOut->addScriptFile( $egStoryboardScriptPath . '/storyboard.js' );
		
		$fieldSize = 50;
		
		$width = $egStorysubmissionWidth;
		
		$maxLen = $wgRequest->getVal( 'maxlength' );
		if ( !is_int( $maxLen ) ) $maxLen = $egStoryboardMaxStoryLen;
		
		$minLen = $wgRequest->getVal( 'minlength' );
		if ( !is_int( $minLen ) ) $minLen = $egStoryboardMinStoryLen;
		
		//$submissionUrl = $wgParser->getTitle()->getLocalURL( 'action=save' );
		$submissionUrl = ''; // TODO: get title
		
		$formBody = "<table width='$width'>";
		
		$defaultName = '';
		if ( $wgUser->isLoggedIn() ) {
			$defaultName = $wgUser->getRealName() !== '' ? $wgUser->getRealName() : $wgUser->getName();
		}
		$formBody .= '<tr>' .
			Html::element( 'td', array( 'width' => '100%' ), wfMsg( 'storyboard-yourname' ) ) .
			'<td>' .
			Html::input( 'name', $defaultName, 'text', array( 'size' => $fieldSize )
			) . '</td></tr>';
		
		$formBody .= '<tr>' .
			Html::element( 'td', array( 'width' => '100%' ), wfMsg( 'storyboard-location' ) ) .
			'<td>' . Html::input( 'location', '', 'text', array( 'size' => $fieldSize )
			) . '</td></tr>';
		
		$formBody .= '<tr>' .
			Html::element( 'td', array( 'width' => '100%' ), wfMsg( 'storyboard-occupation' ) ) .
			'<td>' . Html::input( 'occupation', '', 'text', array( 'size' => $fieldSize )
			) . '</td></tr>';

		$formBody .= '<tr>' .
			Html::element( 'td', array( 'width' => '100%' ), wfMsg( 'storyboard-contact' ) ) .
			'<td>' . Html::input( 'contact', '', 'text', array( 'size' => $fieldSize )
			) . '</td></tr>';
			
		$formBody .= '<tr>' .
			Html::element( 'td', array( 'width' => '100%' ), wfMsg( 'storyboard-storytitle' ) ) .
			'<td>' . Html::input( 'storytitle', '', 'text', array( 'size' => $fieldSize )
			) . '</td></tr>';
		
		$formBody .= '<tr><td colspan="2">' .
			wfMsg( 'storyboard-story' ) .
			Html::element(
				'div',
				array( 'class' => 'storysubmission-charcount', 'id' => 'storysubmission-charlimitinfo' ),
				wfMsgExt( 'storyboard-charsneeded', 'parsemag', $minLen )
			) .
			'<br />' .
			Html::element(
				'textarea',
				array(
					'id' => 'storytext',
					'name' => 'storytext',
					'rows' => 7,
					'onkeyup' => "stbValidateStory( this, $minLen, $maxLen, 'storysubmission-charlimitinfo', 'storysubmission-button' )",
				),
				null
			) .
			'</td></tr>';

		$formBody .= '<tr><td colspan="2"><input type="checkbox" id="storyboard-agreement" />&nbsp;' .
			htmlspecialchars( wfMsg( 'storyboard-agreement' ) ) .
			'</td></tr>';
			
		$formBody .= '<tr><td colspan="2">' .
			Html::input( '', wfMsg( 'htmlform-submit' ), 'submit', array( 'id' => 'storysubmission-button' ) ) .
			'</td></tr>';
			
		$formBody .= '</table>';
		
		$formBody .= Html::hidden( 'wpEditToken', $wgUser->editToken() );
		
		$formBody = Html::rawElement(
			'form',
			array(
				'id' => 'storyform',
				'name' => 'storyform',
				'method' => 'post',
				'action' => $submissionUrl,
				'onsubmit' => 'return stbValidateSubmission( "storyboard-agreement" );'
			),
			$formBody
		);		
		
		$wgOut->addHTML( $formBody );		
	}
	
	/**
	 * Saves the story after a story edit form has been submitted and shows a result.
	 */
	private function saveStoryAndShowResult() {
		global $wgOut;
		
		// TODO: save story
		
		$wgOut->addHTML( '' ); // TODO: add output
	}
}