<?php
/**
 * ***** BEGIN LICENSE BLOCK *****
 * This file is part of QPoll.
 * Uses parts of code from Quiz extension (c) 2007 Louis-Rémi BABE. All rights reserved.
 *
 * QPoll is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * QPoll is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with QPoll; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * ***** END LICENSE BLOCK *****
 *
 * QPoll is a poll tool for MediaWiki.
 *
 * To activate this extension :
 * * Create a new directory named QPoll into the directory "extensions" of MediaWiki.
 * * Place the files from the extension archive there.
 * * Add this line at the end of your LocalSettings.php file :
 * require_once "$IP/extensions/QPoll/qp_user.php";
 *
 * @version 0.8.0a
 * @link http://www.mediawiki.org/wiki/Extension:QPoll
 * @author QuestPC <questpc@rambler.ru>
 */

if ( !defined( 'MEDIAWIKI' ) ) {
	die( "This file is part of the QPoll extension. It is not a valid entry point.\n" );
}

/**
 * Stub view is used only to display questions which has errors;
 * However, this view also shows the _miminal_ set of methods that
 * real question view has to be implemented to work with pair controller
 * and base controller.
 */
class qp_StubQuestionView extends qp_AbstractView {

	# error message which occured during the question header parsing that will be output later at rendering stage
	var $headerErrorMessage = 'Unknown error';

	# header views (list of tagarrays)
	# tagarray is a primitive view without it's own methods
	var $hviews = array();
	# array of proposal views (indexed, sortable rows)
	# these are the object instances, not simple tagarrays
	var $pviews = array();

	var $propWidth = '';

	/**
	 * @param $parser
	 * @param $frame
	 */
	function __construct( Parser $parser, PPFrame $frame ) {
		parent::__construct( $parser, $frame );
	}

	static function newFromBaseView( $baseView ) {
		return new self( $baseView->parser, $baseView->ppframe );
	}

	function isCompatibleController( $ctrl ) {
		return method_exists( $ctrl, 'parseBody' );
	}

	function setLayout( $layout, $textwidth ) {
		/* does nothing */
	}

	function setShowResults( $showresults ) {
		/* does nothing */
	}

	function setPropWidth( $propwidth ) {
		/* does nothing */
	}

	/**
	 * @param $tagarray  array / string row to add to the question's header
	 */
	function addHeader( $tagarray ) {
		$this->hviews[] = $tagarray;
	}

	function addHeaderError() {
		$this->hviews[] = array(
			array( '__tag' => 'td', 'class' => 'proposalerror', $this->headerErrorMessage )
		);
	}

	/**
	 * Adds table header row to question's view
	 * @param $row             tagarray representation of row
	 * @param $className       CSS class name of row
	 * @param $attribute_maps  translation of source attributes into html attributes (see qp_Renderer class)
	 */
	function addHeaderRow( $row, $className, array $attribute_maps = array() ) {
		$this->hviews[] = (object) array(
			'row' => $row,
			'className' => $className,
			'attribute_maps' => $attribute_maps
		);
	}

	/**
	 * Render script-generated interpretation errors, when available (quiz mode)
	 */
	function renderInterpErrors() {
		/* noop */
	}

	/**
	 * Renders question table with header and proposal views
	 */
	function renderTable() {
		$questionTable = array();
		# add header views to $questionTable
		foreach ( $this->hviews as $header ) {
			$rowattrs = array();
			$attribute_maps = array();
			if ( is_object( $header ) ) {
				$row = &$header->row;
				$rowattrs['class'] = $header->className;
				$attribute_maps = &$header->attribute_maps;
			} else {
				$row = &$header;
			}
			qp_Renderer::addRow( $questionTable, $row, $rowattrs, 'th', $attribute_maps );
		}
		return $questionTable;
	}

	/**
	 * todo: unfortunately, rendering of the question also conditionally modifies
	 * state of poll controller
	 * @modifies parent controller
	 * @return  string  html representation of the question
	 */
	function renderQuestion() {
		$output_table = array( '__tag' => 'table', '__end' => "\n", 'class' => 'object' );
		if ( $this->propWidth !== '' ) {
			$output_table['style'] = 'width:100%;';
		}
		# Determine the side border color the question.
		if ( $this->ctrl->getState() != '' ) {
			if ( isset( $output_table['class'] ) ) {
				$output_table['class'] .= ' error_mark';
			} else {
				$output_table['class'] = 'error_mark';
			}
			# set poll controller state according to question controller state
			$this->ctrl->applyStateToParent();
		}
		$output_table[] = array( '__tag' => 'tbody', '__end' => "\n", 0 => $this->renderTable() );
		$tags = array();
		if ( $this->ctrl->poll->questions->usedCount() > 1 ) {
			# display question number only if there are more than one question in poll
			$tags[] = array(
				'__tag' => 'div', '__end' => "\n", 'class' => 'header',
					array( '__tag' => 'span', 'class' => 'questionId', 0 => $this->ctrl->usedId )
			);
		}
		$tags[] = array( '__tag' => 'div', 0 => $this->rtp( $this->ctrl->mCommonQuestion ) );
		$tags = array( '__tag' => 'div', '__end' => "\n", 'class' => 'question question_mod4_' . ( $this->ctrl->usedId % 4 ), $tags );
		$tags[] = &$output_table;
		return qp_Renderer::renderTagArray( $tags );
	}

	/**
	 * @return  boolean  true when the question's proposals views support showresults attribute;
	 *                   false otherwise
	 */
	function hasShowResults() {
		return false;
	}

} /* end of qp_StubQuestionView class */
