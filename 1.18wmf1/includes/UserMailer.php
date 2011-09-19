<?php
/**
 * Classes used to send e-mails
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License along
 * with this program; if not, write to the Free Software Foundation, Inc.,
 * 51 Franklin Street, Fifth Floor, Boston, MA 02110-1301, USA.
 * http://www.gnu.org/copyleft/gpl.html
 *
 * @file
 * @author <brion@pobox.com>
 * @author <mail@tgries.de>
 * @author Tim Starling
 */


/**
 * Stores a single person's name and email address.
 * These are passed in via the constructor, and will be returned in SMTP
 * header format when requested.
 */
class MailAddress {
	/**
	 * @param $address string|User string with an email address, or a User object
	 * @param $name String: human-readable name if a string address is given
	 * @param $realName String: human-readable real name if a string address is given
	 */
	function __construct( $address, $name = null, $realName = null ) {
		if ( is_object( $address ) && $address instanceof User ) {
			$this->address = $address->getEmail();
			$this->name = $address->getName();
			$this->realName = $address->getRealName();
		} else {
			$this->address = strval( $address );
			$this->name = strval( $name );
			$this->realName = strval( $realName );
		}
	}

	/**
	 * Return formatted and quoted address to insert into SMTP headers
	 * @return string
	 */
	function toString() {
		# PHP's mail() implementation under Windows is somewhat shite, and
		# can't handle "Joe Bloggs <joe@bloggs.com>" format email addresses,
		# so don't bother generating them
		if ( $this->address ) {
			if ( $this->name != '' && !wfIsWindows() ) {
				global $wgEnotifUseRealName;
				$name = ( $wgEnotifUseRealName && $this->realName ) ? $this->realName : $this->name;
				$quoted = UserMailer::quotedPrintable( $name );
				if ( strpos( $quoted, '.' ) !== false || strpos( $quoted, ',' ) !== false ) {
					$quoted = '"' . $quoted . '"';
				}
				return "$quoted <{$this->address}>";
			} else {
				return $this->address;
			}
		}
	}

	function __toString() {
		return $this->toString();
	}
}


/**
 * Collection of static functions for sending mail
 */
class UserMailer {
	static $mErrorString;

	/**
	 * Send mail using a PEAR mailer
	 *
	 * @param $mailer
	 * @param $dest
	 * @param $headers
	 * @param $body
	 *
	 * @return Status
	 */
	protected static function sendWithPear( $mailer, $dest, $headers, $body ) {
		$mailResult = $mailer->send( $dest, $headers, $body );

		# Based on the result return an error string,
		if ( PEAR::isError( $mailResult ) ) {
			wfDebug( "PEAR::Mail failed: " . $mailResult->getMessage() . "\n" );
			return Status::newFatal( 'pear-mail-error', $mailResult->getMessage() );
		} else {
			return Status::newGood();
		}
	}

	/**
	 * This function will perform a direct (authenticated) login to
	 * a SMTP Server to use for mail relaying if 'wgSMTP' specifies an
	 * array of parameters. It requires PEAR:Mail to do that.
	 * Otherwise it just uses the standard PHP 'mail' function.
	 *
	 * @param $to MailAddress: recipient's email (or an array of them)
	 * @param $from MailAddress: sender's email
	 * @param $subject String: email's subject.
	 * @param $body String: email's text.
	 * @param $replyto MailAddress: optional reply-to email (default: null).
	 * @param $contentType String: optional custom Content-Type (default: text/plain; charset=UTF-8)
	 * @return Status object
	 */
	public static function send( $to, $from, $subject, $body, $replyto = null, $contentType = 'text/plain; charset=UTF-8') {
		global $wgSMTP, $wgEnotifImpersonal;
		global $wgEnotifMaxRecips, $wgAdditionalMailParams;

		if ( is_array( $to ) ) {
			$emails = '';
			// This wouldn't be necessary if implode() worked on arrays of
			// objects using __toString(). http://bugs.php.net/bug.php?id=36612
			foreach ( $to as $t ) {
				$emails .= $t->toString() . ",";
			}
			$emails = rtrim( $emails, ',' );
			wfDebug( __METHOD__ . ': sending mail to ' . $emails . "\n" );
		} else {
			wfDebug( __METHOD__ . ': sending mail to ' . implode( ',', array( $to->toString() ) ) . "\n" );
		}

		if ( is_array( $wgSMTP ) ) {
			if ( function_exists( 'stream_resolve_include_path' ) ) {
				$found = stream_resolve_include_path( 'Mail.php' );
			} else {
				$found = Fallback::stream_resolve_include_path( 'Mail.php' );
			}
			if ( !$found ) {
				throw new MWException( 'PEAR mail package is not installed' );
			}
			require_once( 'Mail.php' );

			$msgid = str_replace( " ", "_", microtime() );
			if ( function_exists( 'posix_getpid' ) ) {
				$msgid .= '.' . posix_getpid();
			}

			if ( is_array( $to ) ) {
				$dest = array();
				foreach ( $to as $u ) {
					$dest[] = $u->address;
				}
			} else {
				$dest = $to->address;
			}

			$headers['From'] = $from->toString();
			$headers['Return-Path'] = $from->toString();

			if ( $wgEnotifImpersonal ) {
				$headers['To'] = 'undisclosed-recipients:;';
			}
			else {
				$headers['To'] = implode( ", ", (array )$dest );
			}

			if ( $replyto ) {
				$headers['Reply-To'] = $replyto->toString();
			}
			$headers['Subject'] = self::quotedPrintable( $subject );
			$headers['Date'] = date( 'r' );
			$headers['MIME-Version'] = '1.0';
			$headers['Content-type'] = ( is_null( $contentType ) ?
					'text/plain; charset=UTF-8' : $contentType );
			$headers['Content-transfer-encoding'] = '8bit';
			// @todo FIXME
			$headers['Message-ID'] = "<$msgid@" . $wgSMTP['IDHost'] . '>';
			$headers['X-Mailer'] = 'MediaWiki mailer';

			wfSuppressWarnings();

			// Create the mail object using the Mail::factory method
			$mail_object =& Mail::factory( 'smtp', $wgSMTP );
			if ( PEAR::isError( $mail_object ) ) {
				wfDebug( "PEAR::Mail factory failed: " . $mail_object->getMessage() . "\n" );
				wfRestoreWarnings();
				return Status::newFatal( 'pear-mail-error', $mail_object->getMessage() );
			}

			wfDebug( "Sending mail via PEAR::Mail to $dest\n" );
			$chunks = array_chunk( (array)$dest, $wgEnotifMaxRecips );
			foreach ( $chunks as $chunk ) {
				$status = self::sendWithPear( $mail_object, $chunk, $headers, $body );
				if ( !$status->isOK() ) {
					wfRestoreWarnings();
					return $status;
				}
			}
			wfRestoreWarnings();
			return Status::newGood();
		} else	{
			# Line endings need to be different on Unix and Windows due to
			# the bug described at http://trac.wordpress.org/ticket/2603
			if ( wfIsWindows() ) {
				$body = str_replace( "\n", "\r\n", $body );
				$endl = "\r\n";
			} else {
				$endl = "\n";
			}

			$headers = array(
				"MIME-Version: 1.0",
				"Content-type: $contentType",
				"Content-Transfer-Encoding: 8bit",
				"X-Mailer: MediaWiki mailer",
				"From: " . $from->toString(),
			);
			if ( $replyto ) {
				$headers[] = "Reply-To: " . $replyto->toString();
			}

			$headers = implode( $endl, $headers );

			wfDebug( "Sending mail via internal mail() function\n" );

			self::$mErrorString = '';
			$html_errors = ini_get( 'html_errors' );
			ini_set( 'html_errors', '0' );
			set_error_handler( 'UserMailer::errorHandler' );

			if ( !is_array( $to ) ) {
				$to = array( $to );
			}
			foreach ( $to as $recip ) {
				$sent = mail( $recip->toString(), self::quotedPrintable( $subject ), $body, $headers, $wgAdditionalMailParams );
			}

			restore_error_handler();
			ini_set( 'html_errors', $html_errors );

			if ( self::$mErrorString ) {
				wfDebug( "Error sending mail: " . self::$mErrorString . "\n" );
				return Status::newFatal( 'php-mail-error', self::$mErrorString );
			} elseif ( ! $sent ) {
				// mail function only tells if there's an error
				wfDebug( "Error sending mail\n" );
				return Status::newFatal( 'php-mail-error-unknown' );
			} else {
				return Status::newGood();
			}
		}
	}

	/**
	 * Set the mail error message in self::$mErrorString
	 *
	 * @param $code Integer: error number
	 * @param $string String: error message
	 */
	static function errorHandler( $code, $string ) {
		self::$mErrorString = preg_replace( '/^mail\(\)(\s*\[.*?\])?: /', '', $string );
	}

	/**
	 * Converts a string into a valid RFC 822 "phrase", such as is used for the sender name
	 * @param $phrase string
	 * @return string
	 */
	public static function rfc822Phrase( $phrase ) {
		$phrase = strtr( $phrase, array( "\r" => '', "\n" => '', '"' => '' ) );
		return '"' . $phrase . '"';
	}

	/**
	 * Converts a string into quoted-printable format
	 * @since 1.17
	 */
	public static function quotedPrintable( $string, $charset = '' ) {
		# Probably incomplete; see RFC 2045
		if( empty( $charset ) ) {
			$charset = 'UTF-8';
		}
		$charset = strtoupper( $charset );
		$charset = str_replace( 'ISO-8859', 'ISO8859', $charset ); // ?

		$illegal = '\x00-\x08\x0b\x0c\x0e-\x1f\x7f-\xff=';
		$replace = $illegal . '\t ?_';
		if( !preg_match( "/[$illegal]/", $string ) ) {
			return $string;
		}
		$out = "=?$charset?Q?";
		$out .= preg_replace_callback( "/([$replace])/",
			array( __CLASS__, 'quotedPrintableCallback' ), $string );
		$out .= '?=';
		return $out;
	}

	protected static function quotedPrintableCallback( $matches ) {
		return sprintf( "=%02X", ord( $matches[1] ) );
	}
}

/**
 * This module processes the email notifications when the current page is
 * changed. It looks up the table watchlist to find out which users are watching
 * that page.
 *
 * The current implementation sends independent emails to each watching user for
 * the following reason:
 *
 * - Each watching user will be notified about the page edit time expressed in
 * his/her local time (UTC is shown additionally). To achieve this, we need to
 * find the individual timeoffset of each watching user from the preferences..
 *
 * Suggested improvement to slack down the number of sent emails: We could think
 * of sending out bulk mails (bcc:user1,user2...) for all these users having the
 * same timeoffset in their preferences.
 *
 * Visit the documentation pages under http://meta.wikipedia.com/Enotif
 *
 *
 */
class EmailNotification {
	protected $to, $subject, $body, $replyto, $from;
	protected $user, $title, $timestamp, $summary, $minorEdit, $oldid, $composed_common, $editor;
	protected $mailTargets = array();

	/**
	 * Send emails corresponding to the user $editor editing the page $title.
	 * Also updates wl_notificationtimestamp.
	 *
	 * May be deferred via the job queue.
	 *
	 * @param $editor User object
	 * @param $title Title object
	 * @param $timestamp
	 * @param $summary
	 * @param $minorEdit
	 * @param $oldid (default: false)
	 */
	public function notifyOnPageChange( $editor, $title, $timestamp, $summary, $minorEdit, $oldid = false ) {
		global $wgEnotifUseJobQ, $wgEnotifWatchlist, $wgShowUpdatedMarker;

		if ( $title->getNamespace() < 0 ) {
			return;
		}

		// Build a list of users to notfiy
		$watchers = array();
		if ( $wgEnotifWatchlist || $wgShowUpdatedMarker ) {
			$dbw = wfGetDB( DB_MASTER );
			$res = $dbw->select( array( 'watchlist' ),
				array( 'wl_user' ),
				array(
					'wl_title' => $title->getDBkey(),
					'wl_namespace' => $title->getNamespace(),
					'wl_user != ' . intval( $editor->getID() ),
					'wl_notificationtimestamp IS NULL',
				), __METHOD__
			);
			foreach ( $res as $row ) {
				$watchers[] = intval( $row->wl_user );
			}
			if ( $watchers ) {
				// Update wl_notificationtimestamp for all watching users except
				// the editor
				$dbw->begin();
				$dbw->update( 'watchlist',
					array( /* SET */
						'wl_notificationtimestamp' => $dbw->timestamp( $timestamp )
					), array( /* WHERE */
						'wl_title' => $title->getDBkey(),
						'wl_namespace' => $title->getNamespace(),
						'wl_user' => $watchers
					), __METHOD__
				);
				$dbw->commit();
			}
		}

		if ( $wgEnotifUseJobQ ) {
			$params = array(
				"editor" => $editor->getName(),
				"editorID" => $editor->getID(),
				"timestamp" => $timestamp,
				"summary" => $summary,
				"minorEdit" => $minorEdit,
				"oldid" => $oldid,
				"watchers" => $watchers );
			$job = new EnotifNotifyJob( $title, $params );
			$job->insert();
		} else {
			$this->actuallyNotifyOnPageChange( $editor, $title, $timestamp, $summary, $minorEdit, $oldid, $watchers );
		}

	}

	/**
	 * Immediate version of notifyOnPageChange().
	 *
	 * Send emails corresponding to the user $editor editing the page $title.
	 * Also updates wl_notificationtimestamp.
	 *
	 * @param $editor User object
	 * @param $title Title object
	 * @param $timestamp string Edit timestamp
	 * @param $summary string Edit summary
	 * @param $minorEdit bool
	 * @param $oldid int Revision ID
	 * @param $watchers array of user IDs
	 */
	public function actuallyNotifyOnPageChange( $editor, $title, $timestamp, $summary, $minorEdit, $oldid, $watchers ) {
		# we use $wgPasswordSender as sender's address
		global $wgEnotifWatchlist;
		global $wgEnotifMinorEdits, $wgEnotifUserTalk;

		wfProfileIn( __METHOD__ );

		# The following code is only run, if several conditions are met:
		# 1. EmailNotification for pages (other than user_talk pages) must be enabled
		# 2. minor edits (changes) are only regarded if the global flag indicates so

		$isUserTalkPage = ( $title->getNamespace() == NS_USER_TALK );

		$this->title = $title;
		$this->timestamp = $timestamp;
		$this->summary = $summary;
		$this->minorEdit = $minorEdit;
		$this->oldid = $oldid;
		$this->editor = $editor;
		$this->composed_common = false;

		$userTalkId = false;

		if ( !$minorEdit || ( $wgEnotifMinorEdits && !$editor->isAllowed( 'nominornewtalk' ) ) ) {
			if ( $wgEnotifUserTalk && $isUserTalkPage ) {
				$targetUser = User::newFromName( $title->getText() );
				if ( !$targetUser || $targetUser->isAnon() ) {
					wfDebug( __METHOD__ . ": user talk page edited, but user does not exist\n" );
				} elseif ( $targetUser->getId() == $editor->getId() ) {
					wfDebug( __METHOD__ . ": user edited their own talk page, no notification sent\n" );
				} elseif ( $targetUser->getOption( 'enotifusertalkpages' ) &&
					( !$minorEdit || $targetUser->getOption( 'enotifminoredits' ) ) )
				{
					if ( $targetUser->isEmailConfirmed() ) {
						wfDebug( __METHOD__ . ": sending talk page update notification\n" );
						$this->compose( $targetUser );
						$userTalkId = $targetUser->getId();
					} else {
						wfDebug( __METHOD__ . ": talk page owner doesn't have validated email\n" );
					}
				} else {
					wfDebug( __METHOD__ . ": talk page owner doesn't want notifications\n" );
				}
			}

			if ( $wgEnotifWatchlist ) {
				// Send updates to watchers other than the current editor
				$userArray = UserArray::newFromIDs( $watchers );
				foreach ( $userArray as $watchingUser ) {
					if ( $watchingUser->getOption( 'enotifwatchlistpages' ) &&
						( !$minorEdit || $watchingUser->getOption( 'enotifminoredits' ) ) &&
						$watchingUser->isEmailConfirmed() &&
						$watchingUser->getID() != $userTalkId )
					{
						$this->compose( $watchingUser );
					}
				}
			}
		}

		global $wgUsersNotifiedOnAllChanges;
		foreach ( $wgUsersNotifiedOnAllChanges as $name ) {
			$user = User::newFromName( $name );
			$this->compose( $user );
		}

		$this->sendMails();
		wfProfileOut( __METHOD__ );
	}

	/**
	 * Generate the generic "this page has been changed" e-mail text.
	 */
	private function composeCommonMailtext() {
		global $wgPasswordSender, $wgPasswordSenderName, $wgNoReplyAddress;
		global $wgEnotifFromEditor, $wgEnotifRevealEditorAddress;
		global $wgEnotifImpersonal, $wgEnotifUseRealName;

		$this->composed_common = true;

		$summary = ( $this->summary == '' ) ? ' - ' : $this->summary;
		$medit   = ( $this->minorEdit ) ? wfMsgForContent( 'minoredit' ) : '';

		# You as the WikiAdmin and Sysops can make use of plenty of
		# named variables when composing your notification emails while
		# simply editing the Meta pages

		$subject = wfMsgForContent( 'enotif_subject' );
		$body    = wfMsgForContent( 'enotif_body' );
		$from    = ''; /* fail safe */
		$replyto = ''; /* fail safe */
		$keys    = array();

		if ( $this->oldid ) {
			$difflink = $this->title->getCanonicalUrl( 'diff=0&oldid=' . $this->oldid );
			$keys['$NEWPAGE'] = wfMsgForContent( 'enotif_lastvisited', $difflink );
			$keys['$OLDID']   = $this->oldid;
			$keys['$CHANGEDORCREATED'] = wfMsgForContent( 'changed' );
		} else {
			$keys['$NEWPAGE'] = wfMsgForContent( 'enotif_newpagetext' );
			# clear $OLDID placeholder in the message template
			$keys['$OLDID']   = '';
			$keys['$CHANGEDORCREATED'] = wfMsgForContent( 'created' );
		}

		if ( $wgEnotifImpersonal && $this->oldid ) {
			/**
			 * For impersonal mail, show a diff link to the last
			 * revision.
			 */
			$keys['$NEWPAGE'] = wfMsgForContent( 'enotif_lastdiff',
					$this->title->getCanonicalUrl( "oldid={$this->oldid}&diff=next" ) );
		}

		$body = strtr( $body, $keys );
		$pagetitle = $this->title->getPrefixedText();
		$keys['$PAGETITLE']          = $pagetitle;
		$keys['$PAGETITLE_URL']      = $this->title->getCanonicalUrl();

		$keys['$PAGEMINOREDIT']      = $medit;
		$keys['$PAGESUMMARY']        = $summary;
		$keys['$UNWATCHURL']         = $this->title->getCanonicalUrl( 'action=unwatch' );

		$subject = strtr( $subject, $keys );

		# Reveal the page editor's address as REPLY-TO address only if
		# the user has not opted-out and the option is enabled at the
		# global configuration level.
		$editor = $this->editor;
		$name    = $wgEnotifUseRealName ? $editor->getRealName() : $editor->getName();
		$adminAddress = new MailAddress( $wgPasswordSender, $wgPasswordSenderName );
		$editorAddress = new MailAddress( $editor );
		if ( $wgEnotifRevealEditorAddress
			&& ( $editor->getEmail() != '' )
			&& $editor->getOption( 'enotifrevealaddr' ) ) {
			if ( $wgEnotifFromEditor ) {
				$from    = $editorAddress;
			} else {
				$from    = $adminAddress;
				$replyto = $editorAddress;
			}
		} else {
			$from    = $adminAddress;
			$replyto = new MailAddress( $wgNoReplyAddress );
		}

		if ( $editor->isAnon() ) {
			# real anon (user:xxx.xxx.xxx.xxx)
			$utext = wfMsgForContent( 'enotif_anon_editor', $name );
			$subject = str_replace( '$PAGEEDITOR', $utext, $subject );
			$keys['$PAGEEDITOR']       = $utext;
			$keys['$PAGEEDITOR_EMAIL'] = wfMsgForContent( 'noemailtitle' );
		} else {
			$subject = str_replace( '$PAGEEDITOR', $name, $subject );
			$keys['$PAGEEDITOR']          = $name;
			$emailPage = SpecialPage::getSafeTitleFor( 'Emailuser', $name );
			$keys['$PAGEEDITOR_EMAIL'] = $emailPage->getCanonicalUrl();
		}
		$userPage = $editor->getUserPage();
		$keys['$PAGEEDITOR_WIKI'] = $userPage->getCanonicalUrl();
		$body = strtr( $body, $keys );
		$body = wordwrap( $body, 72 );

		# now save this as the constant user-independent part of the message
		$this->from    = $from;
		$this->replyto = $replyto;
		$this->subject = $subject;
		$this->body    = $body;
	}

	/**
	 * Compose a mail to a given user and either queue it for sending, or send it now,
	 * depending on settings.
	 *
	 * Call sendMails() to send any mails that were queued.
	 */
	function compose( $user ) {
		global $wgEnotifImpersonal;

		if ( !$this->composed_common )
			$this->composeCommonMailtext();

		if ( $wgEnotifImpersonal ) {
			$this->mailTargets[] = new MailAddress( $user );
		} else {
			$this->sendPersonalised( $user );
		}
	}

	/**
	 * Send any queued mails
	 */
	function sendMails() {
		global $wgEnotifImpersonal;
		if ( $wgEnotifImpersonal ) {
			$this->sendImpersonal( $this->mailTargets );
		}
	}

	/**
	 * Does the per-user customizations to a notification e-mail (name,
	 * timestamp in proper timezone, etc) and sends it out.
	 * Returns true if the mail was sent successfully.
	 *
	 * @param $watchingUser User object
	 * @return Boolean
	 * @private
	 */
	function sendPersonalised( $watchingUser ) {
		global $wgContLang, $wgEnotifUseRealName;
		// From the PHP manual:
		//     Note:  The to parameter cannot be an address in the form of "Something <someone@example.com>".
		//     The mail command will not parse this properly while talking with the MTA.
		$to = new MailAddress( $watchingUser );
		$name = $wgEnotifUseRealName ? $watchingUser->getRealName() : $watchingUser->getName();
		$body = str_replace( '$WATCHINGUSERNAME', $name, $this->body );

		$timecorrection = $watchingUser->getOption( 'timecorrection' );

		# $PAGEEDITDATE is the time and date of the page change
		# expressed in terms of individual local time of the notification
		# recipient, i.e. watching user
		$body = str_replace(
			array( '$PAGEEDITDATEANDTIME',
				'$PAGEEDITDATE',
				'$PAGEEDITTIME' ),
			array( $wgContLang->timeanddate( $this->timestamp, true, false, $timecorrection ),
				$wgContLang->date( $this->timestamp, true, false, $timecorrection ),
				$wgContLang->time( $this->timestamp, true, false, $timecorrection ) ),
			$body );

		return UserMailer::send( $to, $this->from, $this->subject, $body, $this->replyto );
	}

	/**
	 * Same as sendPersonalised but does impersonal mail suitable for bulk
	 * mailing.  Takes an array of MailAddress objects.
	 */
	function sendImpersonal( $addresses ) {
		global $wgContLang;

		if ( empty( $addresses ) )
			return;

		$body = str_replace(
				array( '$WATCHINGUSERNAME',
					'$PAGEEDITDATE',
					'$PAGEEDITTIME' ),
				array( wfMsgForContent( 'enotif_impersonal_salutation' ),
					$wgContLang->date( $this->timestamp, true, false, false ),
					$wgContLang->time( $this->timestamp, true, false, false ) ),
				$this->body );

		return UserMailer::send( $addresses, $this->from, $this->subject, $body, $this->replyto );
	}

} # end of class EmailNotification
