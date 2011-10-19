<?php

/**
 * CheckUser API Query Module
 */
class ApiQueryCheckUser extends ApiQueryBase {
	public function __construct( $query, $moduleName ) {
		parent::__construct( $query, $moduleName, 'cu' );
	}

	public function execute() {
		global $wgUser, $wgCheckUserForceSummary;

		$db = $this->getDB( DB_SLAVE );
		$params = $this->extractRequestParams();

		if ( !$wgUser->isAllowed( 'checkuser' ) ) {
			$this->dieUsage( 'You need the checkuser right', 'permissionerror' );
		}

		if ( $wgCheckUserForceSummary && is_null( $params['reason'] ) ) {
			$this->dieUsage( 'You need define reason for check', 'missingdata' );
		}

		$limit = $params['limit'];
		$target = $params['target'];
		$reason = wfMsgForContent( 'checkuser-reason-api', $params['reason'] );
		$time = wfTimestamp( TS_MW,
			strtotime( 'now' ) - ( strtotime( $params['timecond'] ? $params['timecond'] : '2 weeks' ) - strtotime( 'now'
			) )
		);
		if ( !$time ) {
			$this->dieUsage( 'You need use correct time limit (like "2 weeks")', 'invalidtime' );
		}

		$this->addTables( 'cu_changes' );
		$this->addOption( 'LIMIT', $limit + 1 );
		$this->addOption( 'ORDER BY', 'cuc_timestamp DESC' );
		$this->addWhere( "cuc_timestamp > $time" );

		switch ( $params['request'] ) {
			case 'userips':
				$user_id = User::idFromName( $target );
				if ( !$user_id ) {
					$this->dieUsage( 'Target user does not exist', 'nosuchuser' );
				}

				$this->addFields( array( 'cuc_timestamp', 'cuc_ip', 'cuc_xff' ) );
				$this->addWhere( "cuc_user_text = '$target'" );
				$res = $this->select( __METHOD__ );
				$result = $this->getResult();

				$ips = array();
				foreach ( $res as $row ) {
					$timestamp = $row->cuc_timestamp;
					$ip = strval( $row->cuc_ip );
					$xff = $row->cuc_xff;

					if ( !isset( $ips[$ip] ) ) {
						$ips[$ip]['end'] = $timestamp;
						$ips[$ip]['editcount'] = 1;
					} else {
						$ips[$ip]['start'] = $timestamp;
						$ips[$ip]['editcount']++;
					}
				}

				$count = 0;
				foreach ( array_keys( $ips ) as $ip ) {
					$ips[$count] = $ips[$ip];
					$ips[$count]['address'] = $ip;
					unset( $ips[$ip] );
					$count++;
				}

				CheckUser::addLogEntry( 'userips', 'user', $target, $reason, $user_id );
				$result->addValue( array( 'query', $this->getModuleName() ), 'userips', $ips );
				$result->setIndexedTagName_internal( array( 'query', $this->getModuleName(), 'userips' ), 'ip' );
				break;

			case 'edits':
				if ( IP::isIPAddress( $target ) && isset( $params['xff'] ) ) {
					$cond = CheckUser::getIpConds( $db, $target, true );
					if ( !$cond ) {
						$this->dieUsage( 'IP or range is invalid', 'invalidip' );
					}
					$this->addWhere( "$cond" );
					$log_type = array( 'ipedits-xff', 'ip' );
				} elseif ( IP::isIPAddress( $target ) ) {
					$cond = CheckUser::getIpConds( $db, $target );
					if ( !$cond ) {
						$this->dieUsage( 'IP or range is invalid', 'invalidip' );
					}
					$this->addWhere( "$cond" );
					$log_type = array( 'ipedits', 'ip' );
				} else {
					$user_id = User::idFromName( $target );
					if ( !$user_id ) {
						$this->dieUsage( 'Target user is not exists', 'nosuchuser' );
					}
					$this->addWhere( "cuc_user_text = '$target'" );
					$log_type = array( 'useredits', 'user' );
				}

				$this->addFields( array( 'cuc_namespace', 'cuc_title', 'cuc_user_text', 'cuc_actiontext', 'cuc_comment', 'cuc_minor', 'cuc_timestamp', 'cuc_ip', 'cuc_xff', 'cuc_agent' )
				);

				$res = $this->select( __METHOD__ );
				$result = $this->getResult();

				$edits = array();
				$count = 0;
				foreach ( $res as $row ) {
					$edits[$count]['timestamp'] = $row->cuc_timestamp;
					$edits[$count]['ns'] = $row->cuc_namespace;
					$edits[$count]['title'] = $row->cuc_title;
					$edits[$count]['user'] = $row->cuc_user_text;
					if ( $row->cuc_actiontext ) {
						$edits[$count]['summary'] = $row->cuc_actiontext;
					} elseif ( $row->cuc_comment ) {
						$edits[$count]['summary'] = $row->cuc_comment;
					}
					if ( $row->cuc_minor ) {
						$edits[$count]['minor'] = 'm';
					}
					$edits[$count]['ip'] = $row->cuc_ip;
					if ( $row->cuc_xff ) {
						$edits[$count]['xff'] = $row->cuc_xff;
					}
					$edits[$count]['agent'] = $row->cuc_agent;
					$count++;
				}

				CheckUser::addLogEntry( $log_type[0], $log_type[1], $target, $reason, $user_id ? $user_id : '0' );
				$result->addValue( array( 'query', $this->getModuleName() ), 'edits', $edits );
				$result->setIndexedTagName_internal( array( 'query', $this->getModuleName(), 'edits' ), 'action' );
				break;

			case 'ipusers':
				if ( IP::isIPAddress( $target ) && isset( $params['xff'] ) ) {
					$cond = CheckUser::getIpConds( $db, $target, true );
					$this->addWhere( $cond );
				} elseif ( IP::isIPAddress( $target ) ) {
					$cond = CheckUser::getIpConds( $db, $target );
					$this->addWhere( $cond );
					$log_type = 'ipusers';
				} else {
					$this->dieUsage( 'IP or range is invalid', 'invalidip' );
				}

				$this->addFields( array( 'cuc_user_text', 'cuc_timestamp', 'cuc_ip', 'cuc_agent' ) );

				$res = $this->select( __METHOD__ );
				$result = $this->getResult();

				$users = array();
				foreach ( $res as $row ) {
					$user = $row->cuc_user_text;
					$ip = $row->cuc_ip;
					$agent = $row->cuc_agent;

					if ( !isset( $users[$user] ) ) {
						$users[$user]['end'] = $row->cuc_timestamp;
						$users[$user]['editcount'] = 1;
						$users[$user]['ips'][] = $ip;
						$users[$user]['agents'][] = $agent;
					} else {
						$users[$user]['start'] = $row->cuc_timestamp;
						$users[$user]['editcount']++;
						if ( !in_array( $ip, $users[$user]['ips'] ) ) {
							$users[$user]['ips'][] = $ip;
						}
						if ( !in_array( $agent, $users[$user]['agents'] ) ) {
							$users[$user]['agents'][] = $agent;
						}
					}
				}

				$count = 0;
				foreach ( array_keys( $users ) as $user ) {
					$users[$count] = $users[$user];
					$users[$count]['name'] = $user;
					unset( $users[$user] );

					$result->setIndexedTagName( $users[$count]['ips'], 'ip' );
					$result->setIndexedTagName( $users[$count]['agents'], 'agent' );

					$count++;
				}

				CheckUser::addLogEntry( $log_type, 'ip', $target, $reason );
				$result->addValue( array( 'query', $this->getModuleName() ), 'ipusers', $users );
				$result->setIndexedTagName_internal( array( 'query', $this->getModuleName(), 'ipusers' ), 'user' );
				break;

			default:
				$this->dieUsage( 'Invalid request mode', 'invalidmode' );
		}
	}

	public function mustBePosted() {
		return true;
	}

	public function isWriteMode() {
		return true;
	}

	public function getAllowedParams() {
		return array(
			'request' => array(
				ApiBase::PARAM_REQUIRED => false,
				ApiBase::PARAM_TYPE => array(
					'userips',
					'edits',
					'ipusers',
				)
			),
			'target' => array(
				ApiBase::PARAM_REQUIRED => true,
			),
			'reason' => null,
			'limit' => array(
				ApiBase::PARAM_DFLT => 1000,
				ApiBase::PARAM_TYPE => 'limit',
				ApiBase::PARAM_MIN => 1,
				ApiBase::PARAM_MAX => 5000,
				ApiBase::PARAM_MAX2 => 5000,
			),
			'timecond' => null,
		);
	}

	public function getParamDescription() {
		return array(
			'request' => array(
				'Type of CheckUser request',
				' userips - get IP of target user',
				' edits   - get changes from target IP or range',
				' ipusers - get users from target IP or range',
			),
			'target' => "Username or IP-address/range to perform check",
			'reason' => 'Reason to check',
			'limit' => 'Limit of rows',
			'timecond' => 'Time limit of user data (like "2 weeks")',
		);
	}

	public function getDescription() {
		return 'Allows check which IPs are used by a given username and which usernames are used by a given IP';
	}

	public function getPossibleErrors() {
		return array_merge( parent::getPossibleErrors(),
			array(
				array( 'nosuchuser' ),
				array( 'invalidip' ),
				array( 'permissionerror' ),
				array( 'invalidmode' ),
				array( 'missingdata' ),
			)
		);
	}

	public function getExamples() {
		return array(
			'api.php?action=query&list=checkuser&curequest=userips&cutarget=Jimbo_Wales',
			'api.php?action=query&list=checkuser&curequest=edits&cutarget=127.0.0.1/16/xff&cureason=Some_check',
		);
	}

	public function getHelpUrls() {
		return 'http://www.mediawiki.org/wiki/Extension:CheckUser#API';
	}

	public function getVersion() {
		return __CLASS__ . ': $Id$';
	}
}