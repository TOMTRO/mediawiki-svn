<?php
if ( !defined( 'MEDIAWIKI' ) ) {
	echo "FlaggedRevs extension\n";
	exit( 1 );
}

class OldReviewedPages extends SpecialPage
{
	public function __construct() {
		parent::__construct( 'OldReviewedPages' );
		$this->includable( true );
		wfLoadExtensionMessages( 'OldReviewedPages' );
		wfLoadExtensionMessages( 'FlaggedRevs' );
	}

	public function execute( $par ) {
		global $wgRequest, $wgUser, $wgOut;
		$this->setHeaders();
		$this->skin = $wgUser->getSkin();
		$this->namespace = $wgRequest->getIntOrNull( 'namespace' );
		$this->level = $wgRequest->getIntOrNull( 'level' );
		$this->category = trim( $wgRequest->getVal( 'category' ) );
		$this->size = $wgRequest->getIntOrNull( 'size' );
		$this->watched = $wgRequest->getCheck( 'watched' );
		$feedType = $wgRequest->getVal( 'feed' );
		if( $feedType ) {
			return $this->feed( $feedType );
		}
		$this->setSyndicated();
		$this->showList( $par );
	}
	
	protected function setSyndicated() {
		global $wgOut, $wgRequest;
		$queryParams = array(
			'namespace' => $wgRequest->getIntOrNull( 'namespace' ),
			'level'     => $wgRequest->getIntOrNull( 'level' ),
			'category'  => $wgRequest->getVal( 'category' ),
		);
		$wgOut->setSyndicated( true );
		$wgOut->setFeedAppendQuery( wfArrayToCGI( $queryParams ) );
	}

	public function showList( $par ) {
		global $wgOut, $wgScript, $wgUser, $wgFlaggedRevsNamespaces;
		$limit = $this->parseParams( $par );
		$pager = new OldReviewedPagesPager( $this, $this->namespace, $this->level,
			$this->category, $this->size, $this->watched );
		$pager->mLimit = $limit ? $limit : $pager->mLimit;
		// Viewing the page normally...
		if( !$this->including() ) {
			$action = htmlspecialchars( $wgScript );
			$wgOut->addHTML( 
				"<form action=\"$action\" method=\"get\">\n" .
				'<fieldset><legend>' . wfMsg('oldreviewedpages-legend') . '</legend>' .
				Xml::hidden( 'title', $this->getTitle()->getPrefixedDBKey() )
			);
			# Display dropdowns as needed
			if( count($wgFlaggedRevsNamespaces) > 1 ) {
				$wgOut->addHTML( FlaggedRevsXML::getNamespaceMenu( $this->namespace, '' ) . '&nbsp;' );
			}
			if( FlaggedRevs::qualityVersions() ) {
				$wgOut->addHTML( FlaggedRevsXML::getLevelMenu( $this->level ) . '&nbsp;' );
			}
			$wgOut->addHTML(
				Xml::label( wfMsg("oldreviewed-category"), 'wpCategory' ) . '&nbsp;' . 
				Xml::input( 'category', 30, $this->category, array('id' => 'wpCategory') ) . '<br/>' .
				Xml::label( wfMsg('oldreviewed-size'), 'wpSize' ) . '&nbsp;' .
				Xml::input( 'size', 5, $this->size, array( 'id' => 'wpSize' ) ) . '&nbsp;' .
				( $wgUser->getId() ?
					Xml::label( wfMsg('oldreviewed-watched'), 'wpWatched' ) . '&nbsp;' .
					Xml::check( 'watched', $this->watched, array( 'id' => 'wpWatched' ) )
					: "" 
				) .
				'&nbsp;&nbsp;' . Xml::submitButton( wfMsg( 'allpagessubmit' ) ) . "\n" .
				"</fieldset></form>"
			);
			$wgOut->addHTML( wfMsgExt('oldreviewedpages-list', array('parse') ) );
			if( $pager->getNumRows() ) {
				$wgOut->addHTML( $pager->getNavigationBar() );
				$wgOut->addHTML( $pager->getBody() );
				$wgOut->addHTML( $pager->getNavigationBar() );
			} else {
				$wgOut->addHTML( wfMsgExt('oldreviewedpages-none', array('parse') ) );
			}
		// If this page is transcluded...
		} else {
			if( $pager->getNumRows() ) {
				$wgOut->addHTML( $pager->getBody() );
			} else {
				$wgOut->addHTML( wfMsgExt('oldreviewedpages-none', array('parse') ) );
			}
		}
	}
	
	protected function parseParams( $par ) {
		global $wgLang;
		$bits = preg_split( '/\s*,\s*/', trim( $par ) );
		$limit = false;
		foreach( $bits as $bit ) {
			if( is_numeric( $bit ) )
				$limit = intval( $bit );
			$m = array();
			if( preg_match( '/^limit=(\d+)$/', $bit, $m ) )
				$limit = intval($m[1]);
			if( preg_match( '/^namespace=(.*)$/', $bit, $m ) ) {
				$ns = $wgLang->getNsIndex( $m[1] );
				if( $ns !== false ) {
					$this->namespace = $ns;
				}
			}
			if( preg_match( '/^category=(.+)$/', $bit, $m ) ) {
				$this->category = $m[1];
			}
		}
		return $limit;
	}
	
	/**
	 * Output a subscription feed listing recent edits to this page.
	 * @param string $type
	 */
	protected function feed( $type ) {
		global $wgFeed, $wgFeedClasses, $wgRequest;
		if( !$wgFeed ) {
			global $wgOut;
			$wgOut->addWikiMsg( 'feed-unavailable' );
			return;
		}
		if( !isset( $wgFeedClasses[$type] ) ) {
			global $wgOut;
			$wgOut->addWikiMsg( 'feed-invalid' );
			return;
		}
		$feed = new $wgFeedClasses[$type](
			$this->feedTitle(),
			wfMsg( 'tagline' ),
			$this->getTitle()->getFullUrl() );

		$pager = new OldReviewedPagesPager( $this, $this->namespace, $this->category );
		$limit = $wgRequest->getInt( 'limit', 50 );
		global $wgFeedLimit;
		$pager->mLimit = min( $wgFeedLimit, $limit );

		$feed->outHeader();
		if( $pager->getNumRows() > 0 ) {
			while( $row = $pager->mResult->fetchObject() ) {
				$feed->outItem( $this->feedItem( $row ) );
			}
		}
		$feed->outFooter();
	}
	
	protected function feedTitle() {
		global $wgContLanguageCode, $wgSitename;
		$page = SpecialPage::getPage( 'OldReviewedPages' );
		$desc = $page->getDescription();
		return "$wgSitename - $desc [$wgContLanguageCode]";
	}

	protected function feedItem( $row ) {
		$title = Title::MakeTitle( $row->page_namespace, $row->page_title );
		if( $title ) {
			$date = $row->fp_pending_since;
			$comments = $title->getTalkPage()->getFullURL();
			$curRev = Revision::newFromTitle( $title );
			return new FeedItem(
				$title->getPrefixedText(),
				FeedUtils::formatDiffRow( $title, $row->fp_stable, $curRev->getId(), $row->fp_pending_since, $curRev->getComment() ),
				$title->getFullURL(),
				$date,
				$curRev->getUserText(),
				$comments);
		} else {
			return NULL;
		}
	}
	
	public function formatRow( $row ) {
		global $wgLang, $wgUser, $wgMemc;

		$title = Title::makeTitle( $row->page_namespace, $row->page_title );
		$link = $this->skin->makeKnownLinkObj( $title );
		$css = $stxt = $review = $quality = $underReview = '';
		$stxt = ChangesList::showCharacterDifference( $row->rev_len, $row->page_len );
		$review = $this->skin->makeKnownLinkObj( $title, wfMsg('oldreviewed-diff'),
			"diff=cur&oldid={$row->fp_stable}&diffonly=0" );
		# Show quality level if there are several
		if( FlaggedRevs::qualityVersions() ) {
			$quality = $row->fp_quality ?
				wfMsgHtml('revreview-lev-quality') : wfMsgHtml('revreview-lev-sighted');
			$quality = " <b>[{$quality}]</b>";
		}
		# Is anybody watching?
		if( !$this->including() && $wgUser->isAllowed( 'unreviewedpages' ) ) {
			$uw = UnreviewedPages::usersWatching( $title );
			$watching = $uw ? 
				wfMsgExt('oldreviewedpages-watched','parsemag',$uw,$uw) : wfMsgHtml('oldreviewedpages-unwatched');
			$watching = " {$watching}";
		} else {
			$uw = -1;
			$watching = ''; // leave out data
		}
		# Get how long the first unreviewed edit has been waiting...
		if( $row->fp_pending_since ) {
			static $currentTime;
			$currentTime = wfTimestamp( TS_UNIX ); // now
			$firstPendingTime = wfTimestamp( TS_UNIX, $row->fp_pending_since );
			$hours = ($currentTime - $firstPendingTime)/3600;
			// After three days, just use days
			if( $hours > (3*24) ) {
				$days = round($hours/24,0);
				$age = wfMsgExt('oldreviewedpages-days',array('parsemag'),$days);
			// If one or more hours, use hours
			} else if( $hours >= 1 ) {
				$hours = round($hours,0);
				$age = wfMsgExt('oldreviewedpages-hours',array('parsemag'),$hours);
			} else {
				$age = wfMsg('oldreviewedpages-recent'); // hot off the press :)
			}
			// Oh-noes!
			$css = self::getLineClass( $hours, $uw );
			$css = $css ? " class='$css'" : "";
		} else {
			$age = ""; // wtf?
		}
		$key = wfMemcKey( 'stableDiffs', 'underReview', $row->fp_stable, $row->page_latest );
		# Show if a user is looking at this page
		if( ($val = $wgMemc->get($key)) ) {
			$underReview = " <b class='fr-under-review'>".wfMsgHtml('oldreviewedpages-viewing').'</b>';
		}

		return( "<li{$css}>{$link} {$stxt} ({$review}) <i>{$age}</i>{$quality}{$watching}{$underReview}</li>" );
	}
	
	/**
	 * Get the timestamp of the next revision
	 *
	 * @param integer $revision  Revision ID. Get the revision that was after this one.
	 * @param integer $page, page ID
	 */
	protected function getNextRevisionTimestamp( $revision, $page ) {
		$dbr = wfGetDB( DB_SLAVE );
		return $dbr->selectField( 'revision', 'rev_timestamp',
			array(
				'rev_page' => $page,
				'rev_id > ' . intval( $revision )
			),
			__METHOD__,
			array( 'ORDER BY' => 'rev_id' )
		);
	}
	
	protected static function getLineClass( $hours, $uw ) {
		if( $uw == 0 )
			return 'fr-unreviewed-unwatched';
		else
			return "";
	}
}

/**
 * Query to list out unreviewed pages
 */
class OldReviewedPagesPager extends AlphabeticPager {
	public $mForm, $mConds;
	private $category, $namespace;

	function __construct( $form, $namespace, $level=NULL, $category='', $size=NULL, $watched=false ) {
		$this->mForm = $form;
		# Must be a content page...
		global $wgFlaggedRevsNamespaces;
		if( is_null($namespace) ) {
			$namespace = $wgFlaggedRevsNamespaces;
		} else {
			$namespace = intval($namespace);
		}
		# Sanity check
		if( !in_array($namespace,$wgFlaggedRevsNamespaces) ) {
			$namespace = $wgFlaggedRevsNamespaces;
		}
		$this->namespace = $namespace;
		$this->level = $level;
		$this->category = $category ? str_replace(' ','_',$category) : NULL;
		$this->size = $size ? $size : NULL;
		$this->watched = (bool)$watched;
		parent::__construct();
		// Don't get to expensive
		$this->mLimitsShown = array( 20, 50, 100 );
		$this->mLimit = min( $this->mLimit, 100 );
	}

	function formatRow( $row ) {
		return $this->mForm->formatRow( $row );
	}
	
	function getDefaultDirections() {
		return false;
	}

	function getQueryInfo() {
		global $wgUser;
		$conds = $this->mConds;
		$tables = array( 'flaggedpages', 'page', 'revision' );
		$fields = array('page_namespace','page_title','page_len','fp_stable','fp_quality',
			'fp_pending_since','rev_len','page_latest');
		$conds[] = 'page_id = fp_page_id';
		# Overconstrain rev_page to force PK use
		$conds[] = 'rev_page = fp_page_id AND rev_id = fp_stable';
		$conds[] = 'fp_pending_since IS NOT NULL';
		# Filter namespace
		if( $this->namespace !== NULL ) {
			$conds['page_namespace'] = $this->namespace;
		}
		$useIndex = array('flaggedpages' => 'fp_pending_since','page' => 'PRIMARY');
		# Filter by review level
		if( !is_null($this->level) && $this->level >= 0 ) {
			# 0 = sighted; 1 = quality/pristine
			$conds[] = ( $this->level == 0 ) ? 'fp_quality = 0' : 'fp_quality >= 1';
		}
		# Filter by category
		if( $this->category ) {
			$tables[] = 'categorylinks';
			$conds[] = 'cl_from = page_id';
			$conds['cl_to'] = $this->category;
			$useIndex['categorylinks'] = 'cl_from';
		}
		# Filter by watchlist
		if( $this->watched && $uid = $wgUser->getId() ) {
			$tables[] = 'watchlist';
			$conds[] = "wl_user = '$uid'";
			$conds[] = 'page_namespace = wl_namespace';
			$conds[] = 'page_title = wl_title';
		}
		# Filter by bytes changed
		if( $this->size ) {
			$conds[] = 'ABS(page_len - rev_len) < '.intval($this->size);
		}
		return array(
			'tables'  => $tables,
			'fields'  => $fields,
			'conds'   => $conds,
			'options' => array( 'USE INDEX' => $useIndex )
		);
	}

	function getIndexField() {
		return 'fp_pending_since';
	}
	
	function getStartBody() {
		wfProfileIn( __METHOD__ );
		# Do a link batch query
		$lb = new LinkBatch();
		while( $row = $this->mResult->fetchObject() ) {
			$lb->add( $row->page_namespace, $row->page_title );
		}
		$lb->execute();
		wfProfileOut( __METHOD__ );
		return '<ul>';
	}
	
	function getEndBody() {
		return '</ul>';
	}
}
