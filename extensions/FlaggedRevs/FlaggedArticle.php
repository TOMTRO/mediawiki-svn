<?php

class FlaggedArticle extends Article {
	public $isDiffFromStable = false;
	protected $stableRev = null;
	protected $pageconfig = null;
	protected $flags = null;
	protected $reviewNotice = '';
	protected $file = NULL;
	/**
	 * Does the config and current URL params allow
	 * for overriding by stable revisions?
	 */
    public function pageOverride() {
    	global $wgUser, $wgRequest;
    	# This only applies to viewing content pages
		$action = $wgRequest->getVal( 'action', 'view' );
    	if( ($action !='view' && $action !='purge') || !$this->isReviewable() )
			return false;
    	# Does not apply to diffs/old revision. Explicit requests
		# for a certain stable version will be handled elsewhere.
    	if( $wgRequest->getVal('oldid') || $wgRequest->getVal('diff') || $wgRequest->getVal('stableid') )
			return false;
		# Check user preferences
		if( $wgUser->getOption('flaggedrevsstable') )
			return !( $wgRequest->getIntOrNull('stable') === 0 );
		# Get page configuration
		$config = $this->getVisibilitySettings();
    	# Does the stable version override the current one?
    	if( $config['override'] ) {
    		global $wgFlaggedRevsExceptions;
    		# Viewer sees current by default (editors, insiders, ect...) ?
    		foreach( $wgFlaggedRevsExceptions as $group ) {
    			if( $group == 'user' ) {
    				if( $wgUser->getID() ) {
    					return ( $wgRequest->getIntOrNull('stable') === 1 );
					}
    			} else if( in_array( $group, $wgUser->getGroups() ) ) {
    				return ( $wgRequest->getIntOrNull('stable') === 1 );
    			}
    		}
			# Viewer sees stable by default
    		return !( $wgRequest->getIntOrNull('stable') === 0 );
    	# We are explicity requesting the stable version?
		} else if( $wgRequest->getIntOrNull('stable') === 1 ) {
			return true;
		}
		return false;
	}

	 /**
	 * Is this user shown the stable version by default for this page?
	 */
	public function showStableByDefault() {
		global $wgFlaggedRevsOverride, $wgFlaggedRevsExceptions, $wgUser;
		# Get page configuration
		$config = $this->getVisibilitySettings();
		if( !$config['override'] )
			return false;
    	# Viewer sees current by default (editors, insiders, ect...) ?
    	foreach( $wgFlaggedRevsExceptions as $group ) {
    		if( $group == 'user' ) {
    			if( !$wgUser->isAnon() )
    				return false;
    		} else if( in_array( $group, $wgUser->getGroups() ) ) {
    			return false;
    		}
    	}
		return true;
	}

	 /**
	 * Is this article reviewable?
	 */
	public function isReviewable() {
		return FlaggedRevs::isPageReviewable( $this->getTitle() );
	}
	
	 /**
	 * Output review notice
	 */
	private function displayTag() {
		global $wgOut;
		$wgOut->appendSubtitle( $this->reviewNotice );
		return true;
	}
	
	 /**
	 * Replaces a page with the last stable version if possible
	 * Adds stable version status/info tags and notes
	 * Adds a quick review form on the bottom if needed
	 */
	public function setPageContent( $article, &$outputDone, &$pcache ) {
		global $wgRequest, $wgOut, $wgUser, $wgLang;
		# Only trigger for reviewable pages
		if( !FlaggedRevs::isPageReviewable( $article->getTitle() ) ) {
			return true;
		}
		# Only trigger on article view for content pages, not for protect/delete/hist...
		$action = $wgRequest->getVal( 'action', 'view' );
		if( ($action !='view' && $action !='purge') || !$article || !$article->exists() )
			return true;
		# Do not clutter up diffs any further...
		if( $wgRequest->getVal('diff') ) {
    		return true;
		} else if( $wgRequest->getVal('oldid') ) {
			# We may have nav links like "direction=prev&oldid=x"
			$revID = $article->getOldIDFromRequest();
			$frev = FlaggedRevs::getFlaggedRev( $article->getTitle(), $revID );
			# Give a notice if this rev ID corresponds to a reviewed version...
			if( !is_null($frev) ) {
				$time = $wgLang->date( $frev->getTimestamp(), true );
				$flags = $frev->getTags();
				$quality = FlaggedRevs::isQuality( $flags );
				$msg = $quality ? 'revreview-quality-source' : 'revreview-basic-source';
				$tag = wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time );
				# Hide clutter
				if( !FlaggedRevs::useSimpleUI() && !empty($flags) ) {
					$tag .= " <a id='mw-revisiontoggle' class='flaggedrevs_toggle' style='display:none;'" .
						" onclick='toggleRevRatings()' title='" . wfMsgHtml('revreview-toggle-title') . "' >" . 
						wfMsg( 'revreview-toggle' ) . "</a>";
					$tag .= "<span id='mw-revisionratings' style='display:block;'><br/>" .
						wfMsgHtml('revreview-oldrating') . FlaggedRevsXML::addTagRatings( $flags ) . '</span>';
				}
				$tag = "<div id='mw-revisiontag-old' class='flaggedrevs_notice plainlinks'>$tag</div>";
				$wgOut->addHTML( $tag );
			}
			return true;
		}
		$simpleTag = $old = $stable = false;
		$tag = $notes = $pending = '';
		# Check the newest stable version.
		$frev = $this->getStableRev( true );
		$stableId = $frev ? $frev->getRevId() : 0;
		# Also, check for any explicitly requested old stable version...
		$reqId = $wgRequest->getVal('stableid');
		if( $reqId === "best" ) {
			$reqId = FlaggedRevs::getPrimeFlaggedRevId( $article );
		}
		if( $stableId && $reqId ) {
			if( $reqId != $stableId ) {
				$frev = FlaggedRevs::getFlaggedRev( $article->getTitle(), $reqId, true );
				$old = true; // old reviewed version requested by ID
				if( !$frev ) {
					$wgOut->addWikiText( wfMsg('revreview-invalid') );
					$wgOut->returnToMain( false, $article->getTitle() );
					# Tell MW that parser output is done
					$outputDone = true;
					$pcache = false;
					return true;
				}
			} else {
				$stable = true; // stable version requested by ID
			}
		}
		// Is there a stable version?
		if( !is_null($frev) ) {
			# Get flags and date
			$time = $wgLang->date( $frev->getTimestamp(), true );
			$flags = $frev->getTags();
			# Get quality level
			$quality = FlaggedRevs::isQuality( $flags );
			$pristine =  FlaggedRevs::isPristine( $flags );
			// Looking at some specific old stable revision ("&stableid=x")
			// set to override given the relevant conditions. If the user is
			// requesting the stable revision ("&stableid=x"), defer to override 
			// behavior below, since it is the same as ("&stable=1").
			if( $old ) {
				$revs_since = FlaggedRevs::getRevCountSince( $article, $frev->getRevId() );
				$text = $frev->getTextForParse();
       			$parserOut = FlaggedRevs::parseStableText( $article, $text, $frev->getRevId() );
				# Construct some tagging for non-printable outputs. Note that the pending
				# notice has all this info already, so don't do this if we added that already.
				if( !$wgOut->isPrintable() ) {
					$css = $quality ? 'fr-icon-quality' : 'fr-icon-stable';
					$tooltip = $quality ? 'revreview-quality-title' : 'revreview-stable-title';
					$tooltip = wfMsgHtml($tooltip);
					// Simple icon-based UI
					if( FlaggedRevs::useSimpleUI() ) {
						$msg = $quality ? 'revreview-quick-quality-old' : 'revreview-quick-basic-old';
						$html = "<span class='{$css}' title=\"{$tooltip}\"></span>" . 
							wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time );
						$tag .= FlaggedRevsXML::prettyRatingBox( $frev, $html, $revs_since, true, false, $old );
					// Standard UI
					} else {
						$msg = $quality ? 'revreview-quality-old' : 'revreview-basic-old';
						$tag .= "<span class='{$css}' title=\"{$tooltip}\"></span>" . 
							wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time );
						# Hide clutter
						if( !empty($flags) ) {
							$tag .= " <a id='mw-revisiontoggle' class='flaggedrevs_toggle' style='display:none;'" .
								" onclick='toggleRevRatings()' title='" . wfMsgHtml('revreview-toggle-title') . "' >" . 
								wfMsg( 'revreview-toggle' ) . "</a>";
							$tag .= "<span id='mw-revisionratings' style='display:block;'><br/>" .
								wfMsgHtml('revreview-oldrating') . FlaggedRevsXML::addTagRatings( $flags ) . '</span>';
						}
					}
				}
				# Output HTML
       			$wgOut->addParserOutput( $parserOut );
				$wgOut->setRevisionId( $frev->getRevId() );
				$notes = $this->ReviewNotes( $frev );
				# Tell MW that parser output is done
				$outputDone = true;
				$pcache = false;
			// Looking at some specific old revision or if FlaggedRevs is not
			// set to override given the relevant conditions. If the user is
			// requesting the stable revision ("&stableid=x"), defer to override 
			// behavior below, since it is the same as ("&stable=1").
			} else if( !$stable && !$this->pageOverride() ) {
				$revs_since = FlaggedRevs::getRevCountSince( $article, $frev->getRevId() );
				$synced = FlaggedRevs::flaggedRevIsSynced( $frev, $article );
				# Give notice to newewer users if an unreviewed edit was completed...
				if( $wgRequest->getVal('shownotice') && !$synced && !$wgUser->isAllowed('review') ) {
					$tooltip = wfMsgHtml('revreview-draft-title');
					$pending = "<span class='fr-icon-current' title=\"{$tooltip}\"></span>" . 
						wfMsgExt('revreview-edited',array('parseinline'),$frev->getRevId(),$revs_since);
					$pending = "<div id='mw-reviewnotice' class='flaggedrevs_preview plainlinks'>$pending</div>";
					# Notice should always use subtitle
					$this->reviewNotice = $pending;
				}
				# If they are synced, do special styling
				$simpleTag = !$synced;
				# Construct some tagging for non-printable outputs. Note that the pending
				# notice has all this info already, so don't do this if we added that already.
				if( !$wgOut->isPrintable() && !$pending ) {
					$css = 'fr-icon-current'; // default
					$tooltip = 'revreview-draft-title';
					// Simple icon-based UI
					if( FlaggedRevs::useSimpleUI() ) {
						if( $synced ) {
							$msg = $quality ? 'revreview-quick-quality-same' : 'revreview-quick-basic-same';
							$css = $quality ? 'fr-icon-quality' : 'fr-icon-stable';
							$tooltip = $quality ? 'revreview-quality-title' : 'revreview-stable-title';
							$msgHTML = wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $revs_since );
						} else {
							$msg = $quality ? 'revreview-quick-see-quality' : 'revreview-quick-see-basic';
							$msgHTML = wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $revs_since );
						}
						$tooltip = wfMsgHtml($tooltip);
						$msgHTML = "<span class='{$css}' title=\"{$tooltip}\"></span>$msgHTML";
						$tag .= FlaggedRevsXML::prettyRatingBox( $frev, $msgHTML, $revs_since, $synced, $synced, $old );
					// Standard UI
					} else {
						if( $synced ) {
							$msg = $quality ? 'revreview-quality-same' : 'revreview-basic-same';
							$css = $quality ? 'fr-icon-quality' : 'fr-icon-stable';
							$tooltip = $quality ? 'revreview-quality-title' : 'revreview-stable-title';
							$msgHTML = wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time, $revs_since );
						} else {
							$msg = $quality ? 'revreview-newest-quality' : 'revreview-newest-basic';
							$msg .= ($revs_since == 0) ? '-i' : '';
							$msgHTML = wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time, $revs_since );
						}
						$tooltip = wfMsgHtml($tooltip);
						$tag .= "<span class='{$css}' title=\"{$tooltip}\"></span>" . $msgHTML;
						# Hide clutter
						if( !empty($flags) ) {
							$tag .= " <a id='mw-revisiontoggle' class='flaggedrevs_toggle' style='display:none;'" .
								" onclick='toggleRevRatings()' title='" . wfMsgHtml('revreview-toggle-title') . "' >" . 
								wfMsg( 'revreview-toggle' ) . "</a>";
							$tag .= "<span id='mw-revisionratings' style='display:block;'><br/>" .
								wfMsgHtml('revreview-oldrating') . FlaggedRevsXML::addTagRatings( $flags ) . '</span>';
						}
					}
				}
			// The relevant conditions are met to override the page with the stable version.
			} else {
       			# We will be looking at the reviewed revision...
       			$revs_since = FlaggedRevs::getRevCountSince( $article, $frev->getRevId() );
				# Get parsed stable version
				$parserOut = FlaggedRevs::getPageCache( $article );
				if( $parserOut==false ) {
					$text = $frev->getTextForParse();
       				$parserOut = FlaggedRevs::parseStableText( $article, $text, $frev->getRevId() );
       				# Update the stable version cache
       				FlaggedRevs::updatePageCache( $article, $parserOut );
       			}
				$synced = FlaggedRevs::flaggedRevIsSynced( $frev, $article, $parserOut, null );
				# Construct some tagging
				if( !$wgOut->isPrintable() ) {
					$css = $quality ? 'fr-icon-quality' : 'fr-icon-stable';
					$tooltip = $quality ? 'revreview-quality-title' : 'revreview-stable-title';
					$tooltip = wfMsgHtml($tooltip);
					// Simple icon-based UI
					if( FlaggedRevs::useSimpleUI() ) {
						$msg = $quality ? 'revreview-quick-quality' : 'revreview-quick-basic';
						$msg = $synced ? "{$msg}-same" : $msg;
						$html = "<span class='{$css}' title=\"{$tooltip}\"></span>" .
							wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $revs_since );
						
						$tag = FlaggedRevsXML::prettyRatingBox( $frev, $html, $revs_since, true, $synced );
					// Standard UI
					} else {
						$msg = $quality ? 'revreview-quality' : 'revreview-basic';
						if( $synced ) {
							$msg .= '-same';
						} else if( $revs_since == 0 ) {
							$msg .= '-i';
						}
						$tag = "<span class='{$css} plainlinks' title=\"{$tooltip}\"></span>" .
							wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time, $revs_since );
						if( !empty($flags) ) {
							$tag .= " <a id='mw-revisiontoggle' class='flaggedrevs_toggle' style='display:none;'" .
								" onclick='toggleRevRatings()' title='" . wfMsgHtml('revreview-toggle-title') . "' >" . 
								wfMsg('revreview-toggle') . "</a>";
							$tag .= "<span id='mw-revisionratings' style='display:block;'><br/>" . 
								FlaggedRevsXML::addTagRatings( $flags ) . '</span>';
						}
					}
				}
				# Output HTML
       			$wgOut->addParserOutput( $parserOut );
				$wgOut->setRevisionId( $frev->getRevId() );
				$notes = $this->ReviewNotes( $frev );
				# Tell MW that parser output is done
				$outputDone = true;
				$pcache = false;
			}
			# Some checks for which tag CSS to use
			if( FlaggedRevs::useSimpleUI() )
				$tagClass = 'flaggedrevs_short';
			else if( $simpleTag )
				$tagClass = 'flaggedrevs_notice';
			else if( $pristine )
				$tagClass = 'flaggedrevs_pristine';
			else if( $quality )
				$tagClass = 'flaggedrevs_quality';
			else
				$tagClass = 'flaggedrevs_basic';
			# Wrap tag contents in a div
			if( $tag !='' )
				$tag = "<div id='mw-revisiontag' class='$tagClass plainlinks'>$tag</div>";
			# Set UI html
			$this->reviewNotice .= $tag;
			# Add revision notes
			$wgOut->mBodytext = $wgOut->mBodytext . $notes;
		// Add "no reviewed version" tag, but not for main page or printable output.
		} else if( !$wgOut->isPrintable() && !FlaggedRevs::isMainPage( $article->getTitle() ) ) {
			// Simple icon-based UI
			if( FlaggedRevs::useSimpleUI() ) {
				$msg = $old ? 'revreview-quick-invalid' : 'revreview-quick-none';
				$tag .= "<span class='fr-icon-current plainlinks'></span>" .
					wfMsgExt($msg,array('parseinline'));
				$tag = "<div id='mw-revisiontag' class='flaggedrevs_short plainlinks'>$tag</div>";
				$this->reviewNotice .= $tag;
			// Standard UI
			} else {
				$msg = $old ? 'revreview-invalid' : 'revreview-noflagged';
				$tag = "<div id='mw-revisiontag' class='flaggedrevs_notice plainlinks'>" .
					wfMsgExt($msg, array('parseinline')) . "</div>";
				$this->reviewNotice .= $tag;
			}
		}
		$this->displayTag();

		return true;
    }
	
	/**
	* Set the image revision to display
	*/
	public function setImageVersion() {
		global $wgArticle;
		if( !$wgArticle instanceof ImagePage ) {
			return false;
		}
		if( $this->getTitle()->getNamespace() == NS_IMAGE && $this->isReviewable() ) {
			global $wgRequest;
			# A reviewed version may have explicitly been requested...
			$frev = null;
			if( $reqId = $wgRequest->getVal('stableid') ) {
				$frev = FlaggedRevs::getFlaggedRev( $this->getTitle(), $reqId );
			} else if( $this->pageOverride() ) {
				$frev = $this->getStableRev( true );
			}
			if( !is_null($frev) ) {
				$timestamp = $frev->getFileTimestamp();
				// B/C, may be stored in associated image version metadata table
				if( !$timestamp ) {
					$dbr = wfGetDB( DB_SLAVE );
					$timestamp = $dbr->selectField( 'flaggedimages', 
						'fi_img_timestamp',
						array( 'fi_rev_id' => $frev->getRevId(),
							'fi_name' => $this->getTitle()->getDBkey() ),
						__METHOD__ );
				}
				# NOTE: if not found, this will use the current
				$wgArticle = new ImagePage( $this->getTitle(), $timestamp );
			}
			$this->file = $wgArticle->getFile();
		}
		return true;
	}

    /**
	 * Adds latest stable version tag to page when editing
	 */
    public function addToEditView( $editform ) {
		global $wgRequest, $wgOut;
		# Talk pages cannot be validated
		if( !$editform->mArticle || !$this->isReviewable() )
			return false;
		# Find out revision id
		if( $editform->mArticle->mRevision ) {
       		$revid = $editform->mArticle->mRevision->mId;
		} else {
       		$revid = $editform->mArticle->getLatest();
       	}
		# Grab the ratings for this revision if any
		if( !$revid )
			return true;
		# Set new body html text as that of now
		$tag = $warning = '';
		# Check the newest stable version
		$frev = $this->getStableRev();
		if( !is_null($frev) ) {
			global $wgLang, $wgUser, $wgFlaggedRevsAutoReview;

			$time = $wgLang->date( $frev->getTimestamp(), true );
			$flags = $frev->getTags();
			$revs_since = FlaggedRevs::getRevCountSince( $editform->mArticle, $frev->getRevId() );
			# Construct some tagging
			$quality = FlaggedRevs::isQuality( $flags );
			# If this will be autoreviewed, notify the user...
			if( $wgFlaggedRevsAutoReview && $wgUser->isAllowed('review') ) {
				# If we are editing some reviewed revision, any changes this user
				# makes will be autoreviewed...
				$ofrev = FlaggedRevs::getFlaggedRev( $editform->mArticle->getTitle(), $revid );
				if( !is_null($ofrev) ) {
					$msg = ( $revid==$frev->getRevId() ) ? 'revreview-auto-w' : 'revreview-auto-w-old';
					$warning = "<div id='mw-autoreviewtag' class='flaggedrevs_warning plainlinks'>" .
						wfMsgExt($msg,array('parseinline')) . "</div>";
				}
			}
			if( $frev->getRevId() != $revid ) {
				# Streamlined UI
				if( FlaggedRevs::useSimpleUI() ) {
					$msg = $quality ? 'revreview-newest-quality' : 'revreview-newest-basic';
					$msg .= ($revs_since == 0) ? '-i' : '';
					$tag = "<span class='fr-checkbox'></span>" . 
						wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time, $revs_since );
					$tag = "<div id='mw-revisiontag-edit' class='flaggedrevs_editnotice plainlinks'>$tag</div>";
				# Standard UI
				} else {
					$msg = $quality ? 'revreview-newest-quality' : 'revreview-newest-basic';
					$msg .= ($revs_since == 0) ? '-i' : '';
					$tag = "<span class='fr-checkbox'></span>" . 
						wfMsgExt( $msg, array('parseinline'), $frev->getRevId(), $time, $revs_since );
					# Hide clutter
					if( !empty($flags) ) {
						$tag .= " <a id='mw-revisiontoggle' class='flaggedrevs_toggle' style='display:none;'" .
							" onclick='toggleRevRatings()' title='" . wfMsgHtml('revreview-toggle-title') . "' >" . 
							wfMsg( 'revreview-toggle' ) . "</a>";
						$tag .= '<span id="mw-revisionratings" style="display:block;"><br/>' .
							wfMsg('revreview-oldrating') . FlaggedRevsXML::addTagRatings( $flags ) . '</span>';
					}
					$tag = "<div id='mw-revisiontag-edit' class='flaggedrevs_editnotice plainlinks'>$tag</div>";
				}
			}
			$wgOut->addHTML( $tag . $warning );
			# Show diff to stable, to make things less confusing
			$leftNote = $quality ? 'revreview-quality-title' : 'revreview-stable-title';
			$rightNote = 'revreview-draft-title';
			$text = $frev->getRevText();
			if( $text !==false && $wgRequest->getIntOrNull('showdiff') && strcmp($text,$editform->textbox1) !== 0 ) {
				$diffEngine = new DifferenceEngine();
				$diffEngine->showDiffStyle();
				$wgOut->addHtml(
					"<div>" .
					"<table border='0' width='98%' cellpadding='0' cellspacing='4' class='diff'>" .
					"<col class='diff-marker' />" .
					"<col class='diff-content' />" .
					"<col class='diff-marker' />" .
					"<col class='diff-content' />" .
					"<tr>" .
						"<td colspan='2' width='50%' align='center' class='diff-otitle'><b>[" . wfMsgHtml($leftNote) . "]</b></td>" .
						"<td colspan='2' width='50%' align='center' class='diff-ntitle'><b>[" . wfMsgHtml($rightNote) . "]</b></td>" .
					"</tr>" .
					$diffEngine->generateDiffBody( $text, $editform->textbox1 ) .
					"</table>" .
					"</div>\n" );
			}
		}
		return true;
    }

	 /**
	 * Add review form to pages when necessary
	 */
    public function addReviewForm( $out ) {
    	global $wgRequest, $wgArticle;

		if( !$wgArticle || !$wgArticle->exists() || !$this->isReviewable() )
			return true;
		# Check if page is protected
		$action = $wgRequest->getVal( 'action', 'view' );
		if( ($action !='view' && $action !='purge') || !$wgArticle->getTitle()->quickUserCan( 'edit' ) ) {
			return true;
		}
		# Add review form
		$this->addQuickReview( $out, (bool)$wgRequest->getVal('diff') );

		return true;
    }
	
	 /**
	 * Adds a patrol link to non-reviewable pages
	 */
	public function addPatrolLink( $article, &$outputDone, &$pcache ) {
		global $wgRequest, $wgOut, $wgUser, $wgLang;
		# For unreviewable pages, allow for basic patrolling
		if( FlaggedRevs::isPagePatrollable( $article->getTitle() ) ) {
			# If we have been passed an &rcid= parameter, we want to give the user a
			# chance to mark this new article as patrolled.
			$rcid = $wgRequest->getIntOrNull( 'rcid' );
			if( !is_null( $rcid ) && $rcid != 0 && $wgUser->isAllowed( 'review' ) ) {
				$reviewtitle = SpecialPage::getTitleFor( 'RevisionReview' );
				$wgOut->addHTML( "<div class='patrollink'>" .
					wfMsgHtml( 'markaspatrolledlink',
					$wgUser->getSkin()->makeKnownLinkObj( $reviewtitle, wfMsgHtml('markaspatrolledtext'),
						"patrolonly=1&target={$article->getTitle()->getPrefixedUrl()}&rcid={$rcid}" .
						"&token=" . urlencode( $wgUser->editToken( $article->getTitle()->getPrefixedText(), $rcid ) ) )
			 		) .
					'</div>'
			 	);
			}
		}
		return true;
	}
	 /**
	 * Add link to stable version setting to protection form
	 */
    public function addVisibilityLink( $out ) {
    	global $wgUser, $wgRequest;

    	if( !$this->isReviewable() )
    		return true;

    	$action = $wgRequest->getVal( 'action', 'view' );
    	if( $action=='protect' || $action=='unprotect' ) {
			# Check for an overridabe revision
			$frev = $this->getStableRev( true );
			if( !$frev )
				return true;
			$title = SpecialPage::getTitleFor( 'Stabilization' );
			# Give a link to the page to configure the stable version
			$out->mBodytext = "<span class='plainlinks'>" .
				wfMsgExt( 'revreview-visibility',array('parseinline'), $title->getPrefixedText() ) .
				"</span>" . $out->mBodytext;
		}
		return true;
    }

	 /**
	 * Add stable version tabs. Rename some of the others if necessary.
	 */
    public function setActionTabs( $sktmp, &$content_actions ) {
    	global $wgRequest, $wgUser, $wgFlaggedRevsOverride, $wgFlaggedRevTabs;
		# Get the subject page, not all skins have it :(
		if( !isset($sktmp->mTitle) )
			return true;
		$title = $sktmp->mTitle->getSubjectPage();
		# Non-content pages cannot be validated
		if( !FlaggedRevs::isPageReviewable( $title ) || !$title->exists() )
			return true;
		$article = new Article( $title );
		$action = $wgRequest->getVal( 'action', 'view' );
		# If we are viewing a page normally, and it was overridden,
		# change the edit tab to a "current revision" tab
       	$frev = $this->getStableRev( true );
       	# No quality revs? Find the last reviewed one
       	if( is_null($frev) ) {
			return true;
		}
       	# Be clear about what is being edited...
		$synced = FlaggedRevs::flaggedRevIsSynced( $frev, $article );
       	if( !$sktmp->mTitle->isTalkPage() && !$synced ) {
       		if( isset( $content_actions['edit'] ) ) {
				if( $this->showStableByDefault() )
					$content_actions['edit']['text'] = wfMsg('revreview-edit');
				# If the user is requesting the draft or some revision, they don't need a diff.
				if( $this->pageOverride() )
					$content_actions['edit']['href'] = $title->getLocalUrl( 'action=edit&showdiff=1' );
       		} if( isset( $content_actions['viewsource'] ) ) {
				if( $this->showStableByDefault() )
					$content_actions['viewsource']['text'] = wfMsg('revreview-source');
				# If the user is requesting the draft or some revision, they don't need a diff.
				if( $this->pageOverride() )
					$content_actions['viewsource']['href'] = $title->getLocalUrl( 'action=edit&showdiff=1' );
			}
       	}
		# We can change the behavoir of stable version for this page to be different
		# than the site default.
		if( !$sktmp->mTitle->isTalkPage() && $wgUser->isAllowed('stablesettings') ) {
			$stabTitle = SpecialPage::getTitleFor( 'Stabilization' );
			if( !isset($content_actions['protect']) && !isset($content_actions['unprotect']) ) {
				$content_actions['default'] = array(
					'class' => false,
					'text' => wfmsg('stabilization-tab'),
					'href' => $stabTitle->getLocalUrl('page='.$title->getPrefixedUrl())
				);
			}
		}
		// Add auxillary tabs...
     	if( !$wgFlaggedRevTabs || $synced )
       		return true;
		// We are looking at the stable version
		if( $this->pageOverride() || $wgRequest->getVal('stableid') ) {
			$DraftTabcss = '';
			$StableTabcss = 'selected';
		// We are looking at the talk page or diffs/hist/oldids
		} else if( !in_array($action,array('view','purge','edit')) || $sktmp->mTitle->isTalkPage() ) {
			$DraftTabcss = '';
			$StableTabcss = '';
		// We are looking at the current revision or in edit mode
		} else {
			$DraftTabcss = 'selected';
			$StableTabcss = '';
		}
		$new_actions = array(); $first = true;
		# Straighten out order, set the tab AFTER the main tab is set
		foreach( $content_actions as $tab_action => $data ) {
			# Main page tab...
			if( $first ) {
				$first = false;
				if( $synced ) {
					$new_actions[$tab_action] = $data; // keep it
				} else {
					# Add new tabs after first one
					$new_actions['stable'] = array(
						'class' => $StableTabcss,
						'text' => wfMsg('revreview-stable'),
						'href' => $title->getLocalUrl( 'stable=1' )
					);
					$new_actions['current'] = array(
						'class' => $DraftTabcss,
						'text' => wfMsg('revreview-current'),
						'href' => $title->getLocalUrl( 'stable=0' )
						);
				}
			# The others...
			} else {
				$new_actions[$tab_action] = $data;
			}
       	}
       	# Reset static array
       	$content_actions = $new_actions;
    	return true;
    }

	 /**
	 * Add link to stable version of reviewed revisions
	 */
    public function addToHistLine( $row, &$s ) {
    	global $wgUser;
		# Non-content pages cannot be validated. Stable version must exist.
		if( !$this->isReviewable() || !$this->getStableRev() )
			return true;
		# Use same DB object
		$this->dbr = isset($this->dbr) ? $this->dbr : wfGetDB( DB_SLAVE );
		$skin = $wgUser->getSkin();
    	list($link,$css) = FlaggedRevs::makeStableVersionLink( $this->getTitle(), $row->rev_id, $skin, $this->dbr );
    	if( $link ) {
    		$s = "<span class='$css'>$s</span> <small><strong>[$link]</strong></small>";
		}
		return true;
    }

	 /**
	 * Add link to stable version of reviewed revisions
	 */
    public function addToFileHistLine( $file, &$s, &$css ) {
    	global $wgUser;
		# Non-content pages cannot be validated. Stable version must exist.
		if( !$this->isReviewable() || !$this->getStableRev() )
			return true;
		# Use same DB object
		$this->dbr = isset($this->dbr) ? $this->dbr : wfGetDB( DB_SLAVE );
		$skin = $wgUser->getSkin();
		# See if this is reivewed
		$quality = $this->dbr->selectField( 'flaggedrevs', 'fr_quality',
			array( 'fr_img_sha1' => $file->getSha1(), 'fr_img_timestamp' => $file->getTimestamp() ),
			__METHOD__ );
		if( $quality === false ) {
			return true;
		}
		$css = FlaggedRevsXML::getQualityColor( $quality );
		return true;
    }

	/**
	 * @param FlaggedRevision $frev
	 * @return string, revision review notes
	 */
    public function ReviewNotes( $frev ) {
    	global $wgUser;
    	if( !FlaggedRevs::allowComments() || !$frev || !$frev->getComment() ) {
			return '';
		}
   		$notes = "<div class='flaggedrevs_notes plainlinks'>";
   		$notes .= wfMsgExt('revreview-note', array('parseinline'), User::whoIs( $frev->getUser() ) );
   		$notes .= '<br/><i>' . $wgUser->getSkin()->formatComment( $frev->getComment() ) . '</i></div>';
    	return $notes;
    }

	/**
	* When comparing the stable revision to the current after editing a page, show
	* a tag with some explaination for the diff.
	*/
	public function addDiffNoticeAndIncludes( $diff, $OldRev, $NewRev ) {
		global $wgRequest, $wgUser, $wgOut;

		if( $wgOut->isPrintable() || !FlaggedRevs::isPageReviewable( $NewRev->getTitle() ) )
			return true;
		# Check if this might be the diff to stable. If so, enhance it.
		if( $NewRev->isCurrent() && $OldRev ) {
			$frev = $this->getStableRev();
			if( $frev && $frev->getRevId() == $OldRev->getID() ) {
				$changeList = array();
				$skin = $wgUser->getSkin();
				
				# Make a list of each changed template...
				$dbr = wfGetDB( DB_SLAVE );
				global $wgUseStableTemplates;
				// Get templates where the current and stable are not the same revision
				if( $wgUseStableTemplates ) {
					$ret = $dbr->select( array('flaggedtemplates','page','flaggedpages'),
						array( 'ft_namespace', 'ft_title', 'fp_stable AS rev_id' ),
						array( 'ft_rev_id' => $frev->getRevId(),
							'page_namespace = ft_namespace',
							'page_title = ft_title',
							'fp_page_id = page_id',
							'fp_stable != page_latest' ),
						__METHOD__ );
				// Get templates that are newer than the ones of the stable version of this page
				} else {
					$ret = $dbr->select( array('flaggedtemplates','page'),
						array( 'ft_namespace', 'ft_title', 'ft_tmp_rev_id AS rev_id' ),
						array( 'ft_rev_id' => $frev->getRevId(),
							'page_namespace = ft_namespace',
							'page_title = ft_title',
							'ft_tmp_rev_id != page_latest' ),
						__METHOD__ );
				}
				while( $row = $dbr->fetchObject( $ret ) ) {
					$title = Title::makeTitle( $row->ft_namespace, $row->ft_title );
					$changeList[] = $skin->makeKnownLinkObj( $title, $title->GetPrefixedText(),
						"diff=cur&oldid=" . $row->rev_id );
				}
				
				# And images...
				global $wgUseStableImages;
				// Get images where the current and stable are not the same revision
				if( $wgUseStableImages ) {
					$ret = $dbr->select( array('flaggedimages','page','flaggedpages','flaggedrevs','image'),
						array( 'fi_name' ),
						array( 'fi_rev_id' => $frev->getRevId(),
							'page_namespace' => NS_IMAGE,
							'page_title = fi_name',
							'fp_page_id = page_id',
							'fr_page_id = page_id',
							'fr_rev_id = fp_stable',
							'img_name = fi_name',
							'fr_img_sha1 != img_sha1' ),
						__METHOD__ );
				// Get images that are newer than the ones of the stable version of this page
				} else {
					$ret = $dbr->select( array('flaggedimages','image'),
						array( 'fi_name' ),
						array( 'fi_rev_id' => $frev->getRevId(),
							'fi_name = img_name',
							'fi_img_sha1 != img_sha1' ),
						__METHOD__ );
				}
				while( $row = $dbr->fetchObject( $ret ) ) {
					$title = Title::makeTitle( NS_IMAGE, $row->fi_name );
					$changeList[] = $skin->makeKnownLinkObj( $title );
				}
				
				# Some important information...
				if( ($wgUseStableTemplates || $wgUseStableImages) && !empty($changeList) ) {
					$notice = '<br/>'.wfMsgExt('revreview-update-use', array('parseinline'));
				} else {
					$notice = "";
				}
				# If the user is allowed to review, prompt them!
				if( empty($changeList) && $wgUser->isAllowed('review') ) {
					$wgOut->addHTML( "<div id='mw-difftostable' class='flaggedrevs_diffnotice plainlinks'>" .
						wfMsgExt('revreview-update-none', array('parseinline')).$notice.'</div>' );
				} else if( !empty($changeList) && $wgUser->isAllowed('review') ) {
					$changeList = implode(', ',$changeList);
					$wgOut->addHTML( "<div id='mw-difftostable' class='flaggedrevs_diffnotice plainlinks'>" .
						wfMsgExt('revreview-update', array('parseinline')).'&nbsp;'.$changeList.$notice.'</div>' );
				} else if( !empty($changeList) ) {
					$changeList = implode(', ',$changeList);
					$wgOut->addHTML( "<div id='mw-difftostable' class='flaggedrevs_diffnotice plainlinks'>" .
						wfMsgExt('revreview-update-includes', array('parseinline')).'&nbsp;'.$changeList.$notice.'</div>' );
				}
				# Set flag for review form to tell it to autoselect tag settings from the
				# old revision unless the current one is tagged to.
				if( !FlaggedRevs::getFlaggedRev( $diff->mTitle, $NewRev->getID() ) ) {
					$this->isDiffFromStable = true;
				}
			}
		}
		$newRevQ = FlaggedRevs::getRevQuality( $NewRev->getTitle(), $NewRev->getId() );
		$oldRevQ = $OldRev ? FlaggedRevs::getRevQuality( $NewRev->getTitle(), $OldRev->getId() ) : false;
		# Diff between two revisions
		if( $OldRev ) {
			$wgOut->addHTML( "<table class='fr-diff-ratings' width='100%'><tr>" );
			
			$css = FlaggedRevsXML::getQualityColor( $oldRevQ );
			if( $oldRevQ !== false ) {
				$msg = $oldRevQ ? 'hist-quality' : 'hist-stable';
			} else {
				$msg = 'hist-draft';
			}
			$wgOut->addHTML( "<td width='50%' align='center'>" );
			$wgOut->addHTML( "<span class='$css'><b>[" . wfMsgHtml( $msg ) . "]</b></span>" );

			$css = FlaggedRevsXML::getQualityColor( $newRevQ );
			if( $newRevQ !== false ) {
				$msg = $newRevQ ? 'hist-quality' : 'hist-stable';
			} else {
				$msg = 'hist-draft';
			}
			$wgOut->addHTML( "</td><td width='50%' align='center'>" );
			$wgOut->addHTML( "<span class='$css'><b>[" . wfMsgHtml( $msg ) . "]</b></span>" );

			$wgOut->addHTML( '</td></tr></table>' );
		# New page "diffs" - just one rev
		} else {
			if( $newRevQ !== false ) {
				$msg = $newRevQ ? 'hist-quality' : 'hist-stable';
			} else {
				$msg = 'hist-draft';
			}
			$wgOut->addHTML( "<table class='fr-diff-ratings' width='100%'><tr><td class='fr-$msg' align='center'>" );
			$wgOut->addHTML( "<b>[" . wfMsgHtml( $msg ) . "]</b>" );
			$wgOut->addHTML( '</td></tr></table>' );
		}
		
		return true;
	}
	
	/**
	* Add a link to patrol non-reviewable pages.
	* Also add a diff to stable for other pages if possible.
	*/
	public function addPatrolAndDiffLink( $diff, $OldRev, $NewRev ) {
		global $wgUser, $wgOut;
		// Is there a stable version?
		if( FlaggedRevs::isPageReviewable( $NewRev->getTitle() ) ) {
			if( !$OldRev ) {
				return true;
			}
			$frev = $this->getStableRev();
			if( $frev && $frev->getRevId() == $OldRev->getID() && $NewRev->isCurrent() ) {
				$this->isDiffFromStable = true;
			}
			# Give a link to the diff-to-stable if needed
			if( $frev && !$this->isDiffFromStable ) {
				$article = new Article( $NewRev->getTitle() );
				# Is the stable revision using the same revision as the current?
				if( $article->getLatest() != $frev->getRevId() ) {
					$patrol = '(' . $wgUser->getSkin()->makeKnownLinkObj( $NewRev->getTitle(),
						wfMsgHtml( 'review-diff2stable' ), "oldid={$frev->getRevId()}&diff=cur" ) . ')';
					$wgOut->addHTML( "<div class='fr-diff-to-stable' align='center'>$patrol</div>" );
				}
			}
		// Prepare a change patrol link, if applicable
		} else if( FlaggedRevs::isPagePatrollable( $NewRev->getTitle() ) && $wgUser->isAllowed( 'review' ) ) {
			// If we've been given an explicit change identifier, use it; saves time
			if( $diff->mRcidMarkPatrolled ) {
				$rcid = $diff->mRcidMarkPatrolled;
			} else {
				# Look for an unpatrolled change corresponding to this diff
				$dbr = wfGetDB( DB_SLAVE );
				$change = RecentChange::newFromConds(
					array(
						# Add redundant user,timestamp condition so we can use the existing index
						'rc_user_text'  => $diff->mNewRev->getRawUserText(),
						'rc_timestamp'  => $dbr->timestamp( $diff->mNewRev->getTimestamp() ),
						'rc_this_oldid' => $diff->mNewid,
						'rc_last_oldid' => $diff->mOldid,
						'rc_patrolled'  => 0
					),
					__METHOD__
				);
				if( $change instanceof RecentChange ) {
					$rcid = $change->mAttribs['rc_id'];
				} else {
					$rcid = 0; // None found
				}
			}
			// Build the link
			if( $rcid ) {
				$reviewtitle = SpecialPage::getTitleFor( 'RevisionReview' );
				$patrol = '[' . $wgUser->getSkin()->makeKnownLinkObj( $reviewtitle, wfMsgHtml( 'revreview-patrol' ),
					"patrolonly=1&target=" . $NewRev->getTitle()->getPrefixedUrl() . "&rcid={$rcid}" .
					"&token=" . urlencode( $wgUser->editToken( $NewRev->getTitle()->getPrefixedText(), $rcid ) ) ) . ']';
			} else {
				$patrol = '';
			}
			$wgOut->addHTML( '<div align=center>' . $patrol . '</div>' );
		}
		return true;
	}

	/**
	* Redirect users out to review the changes to the stable version.
	* Only for people who can review and for pages that have a stable version.
	*/
    public function injectReviewDiffURLParams( $article, &$sectionanchor, &$extraq ) {
    	global $wgUser, $wgReviewChangesAfterEdit;
		# Don't show this for the talk page
		if( !$this->isReviewable() || $article->getTitle()->isTalkPage() )
			return true;
		# Get the stable version, from master
    	$frev = $this->getStableRev( false, true );
		if( !$frev )
			return true;
		$latest = $article->getTitle()->getLatestRevID(GAID_FOR_UPDATE);
		// If we are supposed to review after edit, and it was not autoreviewed,
		// and the user can actually make new stable version, take us to the diff...
		if( $wgReviewChangesAfterEdit && $frev && $latest > $frev->getRevId() && $frev->userCanSetFlags() ) {
			$extraq .= "oldid={$frev->getRevId()}&diff=cur";
		// ...otherwise, go to the current revision after completing an edit.
		} else {
			if( $frev ){
				$extraq .= "stable=0";
				if( !$wgUser->isAllowed('review') && $this->showStableByDefault() ) {
					$extraq .= "&shownotice=1";
				}
			}
		}
		return true;
	}
	
	/**
	* Add a hidden revision ID field to edit form.
	* Needed for autoreview so it can select the flags from said revision.
	*/
	public function addRevisionIDField( $editform, $out ) {
		global $wgRequest;
		# Find out revision id
		if( $editform->mArticle->mRevision ) {
       		$revid = $editform->mArticle->mRevision->mId;
		} else {
			$latest = $editform->mTitle->getLatestRevID(GAID_FOR_UPDATE);
       		$revid = $latest;
       	}
		# If undoing a few consecutive top edits, we know the base ID
		if( $undo = $wgRequest->getIntOrNull('undo') ) {
			$undoafter = $wgRequest->getIntOrNull('undoafter');
			$latest = isset($latest) ? $latest : $editform->mTitle->getLatestRevID(GAID_FOR_UPDATE);
			if( $undoafter && $undo == $editform->mArticle->getLatest() ) {
				$revid = $undoafter;
			}
		}
		$out->addHTML( "\n" . Xml::hidden( 'baseRevId', $revid ) );
		return true;
	}

	/**
	 * Get latest quality rev, if not, the latest reviewed one
	 * @param Bool $getText, get text and params columns?
	 * @param Bool $forUpdate, use DB master and avoid page table?
	 * @return Row
	 */
	public function getStableRev( $getText=false, $forUpdate=false ) {
		if( $this->stableRev === false ) {
			return null; // We already looked and found nothing...
		}
        # Cached results available?
        if( !is_null($this->stableRev) ) {
			return $this->stableRev;
		}
		# Get the content page, skip talk
		$title = $this->getTitle()->getSubjectPage();
		# Do we have one?
		$srev = FlaggedRevs::getStablePageRev( $title, $getText, $forUpdate );
        if( $srev ) {
			$this->stableRev = $srev;
			return $srev;
	    } else {
            $this->stableRev = false;
            return null;
        }
	}

    /**
	 * Get visiblity restrictions on page
	 * @param Bool $forUpdate, use DB master?
	 * @returns Array (select,override)
	*/
    public function getVisibilitySettings( $forUpdate=false ) {
        # Cached results available?
		if( !is_null($this->pageconfig) ) {
			return $this->pageconfig;
		}
		# Get the content page, skip talk
		$title = $this->getTitle()->getSubjectPage();

		$config = FlaggedRevs::getPageVisibilitySettings( $title, $forUpdate );
		$this->pageconfig = $config;

		return $config;
	}

	/**
	 * @param int $rev_id
	 * @eturns Array, output of the flags for a given revision
	 */
    public function getFlagsForRevision( $rev_id ) {
    	# Cached results?
    	if( isset($this->flags[$rev_id]) && $this->flags[$rev_id] )
    		return $this->flags[$rev_id];
    	# Get the flags
    	$flags = FlaggedRevs::getRevisionTags( $this->getTitle(), $rev_id );
		# Try to cache results
		$this->flags[$rev_id] = $flags;

		return $flags;
	}
	
	 /**
	 * Adds a brief review form to a page.
	 * @param OutputPage $out
	 * @param Title $title
	 * @param bool $top, should this form always go on top?
	 */
	public function addQuickReview( $out, $top = false ) {
		global $wgOut, $wgUser, $wgRequest, $wgFlaggedRevsOverride;
		# User must have review rights
		if( !$wgUser->isAllowed( 'review' ) ) {
			return;
		}
		# Revision being displayed
		$id = $out->mRevisionId;
		# Must be a valid non-printable output
		if( !$id || $out->isPrintable() ) {
			return;
		}
		if( !isset($out->mTemplateIds) || !isset($out->fr_ImageSHA1Keys) ) {
			return; // something went terribly wrong...
		}
		$skin = $wgUser->getSkin();
		
		# Variable for sites with no flags, otherwise discarded
		$approve = $wgRequest->getBool('wpApprove');
		# See if the version being displayed is flagged...
		$oldflags = $this->getFlagsForRevision( $id );
		# If we are reviewing updates to a page, start off with the stable revision's
		# flags. Otherwise, we just fill them in with the selected revision's flags.
		if( $this->isDiffFromStable ) {
			$srev = $this->getStableRev( true );
			$flags = $srev->getTags();
			# Check if user is allowed to renew the stable version. 
			# If not, then get the flags for the new revision itself.
			if( !RevisionReview::userCanSetFlags( $oldflags ) ) {
				$flags = $oldflags;
			}
		} else {
			$flags = $this->getFlagsForRevision( $id );
		}

		$reviewtitle = SpecialPage::getTitleFor( 'RevisionReview' );
		$action = $reviewtitle->getLocalUrl( 'action=submit' );
		$form = Xml::openElement( 'form', array( 'method' => 'post', 'action' => $action ) );
		$form .= Xml::openElement( 'fieldset', array('class' => 'flaggedrevs_reviewform') );
		$form .= "<legend>" . wfMsgHtml( 'revreview-flag', $id ) . "</legend>\n";

		if( $wgFlaggedRevsOverride ) {
			$form .= wfMsgExt( 'revreview-text', array('parse') );
		} else {
			$form .= wfMsgExt( 'revreview-text2', array('parse') );
		}

		# Current user has too few rights to change at least one flag, thus entire form disabled
		$disabled = !RevisionReview::userCanSetFlags( $flags );
		if( $disabled ) {
			$form .= Xml::openElement( 'div', array('class' => 'fr-rating-controls-disabled',
				'id' => 'fr-rating-controls-disabled') );
			$toggle = array( 'disabled' => "disabled" );
		} else {
			$form .= Xml::openElement( 'div', array('class' => 'fr-rating-controls', 'id' => 'fr-rating-controls') );
			$toggle = array();
		}
		$size = count(FlaggedRevs::$dimensions,1) - count(FlaggedRevs::$dimensions);

		$form .= Xml::openElement( 'span', array('id' => 'mw-ratingselects') );
		# Loop through all different flag types
		foreach( FlaggedRevs::$dimensions as $quality => $levels ) {
			$label = array();
			$selected = ( isset($flags[$quality]) ) ? $flags[$quality] : 1;
			if( $disabled ) {
				$label[$selected] = $levels[$selected];
			# else collect all quality levels of a flag current user can set
			} else {
				foreach( $levels as $i => $name ) {
					if ( !RevisionReview::userCan($quality, $i) ) {
						break;
					}
					$label[$i] = $name;
				}
			}
			$quantity = count( $label );
			$form .= Xml::openElement( 'span', array('class' => 'fr-rating-options') ) . "\n";
			$form .= "<b>" . wfMsgHtml("revreview-$quality") . ":</b> ";
			# If the sum of qualities of all flags is above 6, use drop down boxes
			# 6 is an arbitrary value choosen according to screen space and usability
			if( $size > 6 ) {
				$attribs = array( 'name' => "wp$quality", 'onchange' => "updateRatingForm()" ) + $toggle;
				$form .= Xml::openElement( 'select', $attribs );
				foreach( $label as $i => $name ) {
					$optionClass = array( 'class' => "fr-rating-option-$i" );
					$form .= Xml::option( wfMsg( "revreview-$name" ), $i, ($i == $selected), $optionClass )
						."\n";
				}
				$form .= Xml::closeElement('select')."\n";
			# If there are more than two qualities (none, 1 and more) current user gets radio buttons
			} else if( $quantity > 2 ) {
				foreach( $label as $i => $name ) {
					$attribs = array( 'class' => "fr-rating-option-$i", 'onchange' => "updateRatingForm()" );
					$form .= Xml::radioLabel( wfMsg( "revreview-$name" ), "wp$quality", $i, "wp$quality".$i,
						($i == $selected), $attribs ) . "\n";
				}
			# Otherwise make checkboxes (two qualities available for current user
			# and disabled fields in case we are below the magic 6)
			} else {
				$i = ( $disabled ) ? $selected : 1;
				$attribs = array( 'class' => "fr-rating-option-$i", 'onchange' => "updateRatingForm()" ) + $toggle;
				$form .= Xml::checkLabel( wfMsg( "revreview-$label[$i]" ), "wp$quality", "wp$quality".$i,
					($selected == $i), $attribs ) . "\n";
			}
			$form .= Xml::closeElement( 'span' );
		}
		# If there were none, make one checkbox to approve/unapprove
		if( empty(FlaggedRevs::$dimensions) ) {
			$form .= Xml::openElement( 'span', array('class' => 'fr-rating-options') ) . "\n";
			$form .= Xml::checkLabel( wfMsg( "revreview-approved" ), "wpApprove", "wpApprove", 1 ) . "\n";
			$form .= Xml::closeElement( 'span' );
		}
		$form .= Xml::closeElement( 'span' );
		
		if( FlaggedRevs::allowComments() && $wgUser->isAllowed( 'validate' ) ) {
			$form .= "<div id='mw-notebox'>\n";
			$form .= "<p>".wfMsgHtml( 'revreview-notes' ) . "</p>\n";
			$form .= Xml::openElement( 'textarea', array('name' => 'wpNotes', 'id' => 'wpNotes',
				'class' => 'fr-notes-box', 'rows' => '2', 'cols' => '80') ) . Xml::closeElement('textarea') . "\n";
			$form .= "</div>\n";
		}

		$imageParams = $templateParams = '';
		# Hack, add NS:title -> rev ID mapping
		foreach( $out->mTemplateIds as $namespace => $title ) {
			foreach( $title as $dbkey => $revid ) {
				$title = Title::makeTitle( $namespace, $dbkey );
				$templateParams .= $title->getPrefixedText() . "|" . $revid . "#";
			}
		}
		# Hack, image -> timestamp mapping
		foreach( $out->fr_ImageSHA1Keys as $dbkey => $timeAndSHA1 ) {
			foreach( $timeAndSHA1 as $time => $sha1 ) {
				$imageParams .= $dbkey . "|" . $time . "|" . $sha1 . "#";
			}
		}
		# For image pages, note the current image version
		if( $this->getTitle()->getNamespace() == NS_IMAGE && $this->file ) {
			$imageParams .= $this->getTitle()->getDBkey() . "|" . $this->file->getTimestamp() . "|" . $this->file->getSha1() . "#";
		}

		$form .= Xml::openElement( 'span', array('style' => 'white-space: nowrap;') );
		# Hide comment if needed
		if( !$disabled ) {
			$form .= "<span id='mw-commentbox' style='clear:both'>" . Xml::inputLabel( wfMsg('revreview-log'), 'wpReason', 
				'wpReason', 50, '', array('class' => 'fr-comment-box') ) . "&nbsp;&nbsp;&nbsp;</span>";
		}
		$form .= Xml::submitButton( wfMsgHtml('revreview-submit'), 
			array('id' => 'mw-submitbutton','class' => 'fr-comment-box')+$toggle);
		$form .= Xml::closeElement( 'span' );
		
		$form .= Xml::closeElement( 'div' );
		
		# Hidden params
		$form .= Xml::hidden( 'title', $reviewtitle->getPrefixedText() ) . "\n";
		$form .= Xml::hidden( 'target', $this->getTitle()->getPrefixedText() ) . "\n";
		$form .= Xml::hidden( 'oldid', $id ) . "\n";
		$form .= Xml::hidden( 'action', 'submit') . "\n";
		$form .= Xml::hidden( 'wpEditToken', $wgUser->editToken() ) . "\n";
		# Add review parameters
		$form .= Xml::hidden( 'templateParams', $templateParams ) . "\n";
		$form .= Xml::hidden( 'imageParams', $imageParams ) . "\n";
		# Pass this in if given; useful for new page patrol
		$form .= Xml::hidden( 'rcid', $wgRequest->getVal('rcid') ) . "\n";
		# Special token to discourage fiddling...
		$checkCode = RevisionReview::getValidationKey( $templateParams, $imageParams, $wgUser->getID(), $id );
		$form .= Xml::hidden( 'validatedParams', $checkCode ) . "\n";
		
		$form .= Xml::closeElement( 'fieldset' );
		$form .= Xml::closeElement( 'form' );

		if( $top ) {
			$out->mBodytext = $form . $out->mBodytext;
		} else {
			$wgOut->addHTML( $form );
		}
    }
	
	 /**
	 * Set permalink to stable version if we are viewing a stable version.
	 * Also sets the citation link if that extension is on.
	 */
    public function setPermaLink( $sktmp, &$nav_urls, &$revid, &$id ) {
		# Non-content pages cannot be validated
		if( !$this->pageOverride() )
			return true;
		# Check for an overridabe revision
		$frev = $this->getStableRev( true );
		if( !$frev )
			return true;
		# Replace "permalink" with an actual permanent link
		$nav_urls['permalink'] = array(
			'text' => wfMsg( 'permalink' ),
			'href' => $this->getTitle()->getFullURL( "stableid={$frev->getRevId()}" )
		);
		# Are we using the popular cite extension?
		global $wgHooks;
		if( in_array('wfSpecialCiteNav',$wgHooks['SkinTemplateBuildNavUrlsNav_urlsAfterPermalink']) ) {
			if( $this->isReviewable() && $revid !== 0 ) {
				$nav_urls['cite'] = array(
					'text' => wfMsg( 'cite_article_link' ),
					'href' => $sktmp->makeSpecialUrl( 'Cite', "page=" . wfUrlencode( "{$sktmp->thispage}" ) . "&id={$frev->getRevId()}" )
				);
			}
		}
		return true;
    }
	
	 /**
	 * If viewing a stable version, adjust the last modified header
	 */
	public function setLastModified( $sktmp, &$tpl ) {
		global $wgArticle, $wgLang, $wgRequest;
		# Non-content pages cannot be validated
		if( !$this->isReviewable() )
			return true;
		# Old stable versions
		if( $wgRequest->getIntOrNull('stableid') ) {
			$tpl->set('lastmod', false);
			return true;
		}
		# Check for an overridabe revision
		if( !$this->pageOverride() )
			return true;
		$frev = $this->getStableRev( true );
		if( !$frev || $frev->getRevId() == $wgArticle->getLatest() )
			return true;
		# Get the timestamp of this revision
		$timestamp = $frev->getRevTimestamp();
		if( $timestamp ) {
			$d = $wgLang->date( $timestamp, true );
			$t = $wgLang->time( $timestamp, true );
			$s = ' ' . wfMsg( 'lastmodifiedat', $d, $t );
		} else {
			$s = '';
		}
		if( wfGetLB()->getLaggedSlaveMode() ) {
			$s .= ' <strong>' . wfMsg( 'laggedslavemode' ) . '</strong>';
		}
		$tpl->set( 'lastmod', $s );
		
		return true;
	}

	/**
	* Updates parser cache output to included needed versioning params.
	*/
	public function maybeUpdateMainCache( $article, &$outputDone, &$pcache ) {
		global $wgUser, $wgRequest;

		$action = $wgRequest->getVal( 'action', 'view' );
		# Only trigger on article view for content pages, not for protect/delete/hist
		if( ($action !='view' && $action !='purge') || !$wgUser->isAllowed( 'review' ) )
			return true;
		if( !$article || !$article->exists() || !FlaggedRevs::isPageReviewable( $article->getTitle() ) )
			return true;

		$parserCache = ParserCache::singleton();
		$parserOut = $parserCache->get( $article, $wgUser );
		if( $parserOut ) {
			# Clear older, incomplete, cached versions
			# We need the IDs of templates and timestamps of images used
			if( !isset($parserOut->fr_newestTemplateID) || !isset($parserOut->fr_newestImageTime) )
				$article->getTitle()->invalidateCache();
		}
		return true;
	}
}
