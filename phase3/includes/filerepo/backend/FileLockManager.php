<?php
/**
 * FileBackend helper class for handling file locking.
 * Locks on resource keys can either be shared or exclusive.
 * 
 * Implemenations can keep track of what is locked in the process cache.
 * This can reduce hits to external resources for lock()/unlock() calls.
 * 
 * Subclasses should avoid throwing exceptions at all costs.
 */
abstract class FileLockManager {
	/* Lock types; stronger locks have high values */
	const LOCK_SH = 1; // shared lock (for reads)
	const LOCK_EX = 2; // exclusive lock (for writes)

	/**
	 * Construct a new instance from configuration
	 *
	 * @param $config Array
	 */
	public function __construct( array $config ) {}

	/**
	 * Lock the resources at the given abstract paths
	 * 
	 * @param $paths Array List of resource names
	 * @param $type integer FileLockManager::LOCK_EX, FileLockManager::LOCK_SH
	 * @return Status 
	 */
	final public function lock( array $paths, $type = self::LOCK_EX ) {
		$keys = array_unique( array_map( 'sha1', $paths ) );
		return $this->doLock( $keys, $type );
	}

	/**
	 * Unlock the resources at the given abstract paths
	 * 
	 * @param $paths Array List of storage paths
	 * @return Status 
	 */
	final public function unlock( array $paths ) {
		$keys = array_unique( array_map( 'sha1', $paths ) );
		return $this->doUnlock( $keys, 0 );
	}

	/**
	 * Lock a resource with the given key
	 * 
	 * @param $key Array List of keys to lock (40 char hex hashes)
	 * @param $type integer FileLockManager::LOCK_EX, FileLockManager::LOCK_SH
	 * @return string
	 */
	abstract protected function doLock( array $keys, $type );

	/**
	 * Unlock a resource with the given key.
	 * If $type is given, then only locks of that type should be cleared.
	 * 
	 * @param $key Array List of keys to unlock (40 char hex hashes)
	 * @param $type integer FileLockManager::LOCK_EX, FileLockManager::LOCK_SH, or 0
	 * @return string
	 */
	abstract protected function doUnlock( array $keys, $type );
}

/**
 * Simple version of FileLockManager based on using FS lock files
 *
 * This should work fine for small sites running off one server.
 * Do not use this with 'lockDir' set to an NFS mount unless the
 * NFS client is at least version 2.6.12. Otherwise, the BSD flock()
 * locks will be ignored; see http://nfs.sourceforge.net/#section_d.
 */
class FSFileLockManager extends FileLockManager {
	protected $lockDir; // global dir for all servers
	/** @var Array Map of (locked key => lock type => lock file handle) */
	protected $handles = array();

	function __construct( array $config ) {
		$this->lockDir = $config['lockDirectory'];
	}

	protected function doLock( array $keys, $type ) {
		$status = Status::newGood();

		$lockedKeys = array(); // files locked in this attempt
		foreach ( $keys as $key ) {
			$subStatus = $this->doSingleLock( $key, $type );
			$status->merge( $subStatus );
			if ( $status->isOK() ) {
				// Don't append to $lockedKeys if $key is already locked.
				// We do NOT want to unlock the key if we have to rollback.
				if ( $subStatus->isGood() ) { // no warnings/fatals?
					$lockedKeys[] = $key;
				}
			} else {
				// Abort and unlock everything
				$status->merge( $this->doUnlock( $lockedKeys, $type ) );
				return $status;
			}
		}

		return $status;
	}

	protected function doUnlock( array $keys, $type ) {
		$status = Status::newGood();

		foreach ( $keys as $key ) {
			$status->merge( $this->doSingleUnlock( $key, $type ) );
		}

		return $status;
	}

	/**
	 * Lock a single resource key
	 *
	 * @param $key string
	 * @param $type integer
	 * @return Status 
	 */
	protected function doSingleLock( $key, $type ) {
		$status = Status::newGood();

		if ( isset( $this->handles[$key][$type] ) ) {
			$status->warning( 'lockmanager-alreadylocked', $key );
		} elseif ( isset( $this->handles[$key][self::LOCK_EX] ) ) {
			$status->warning( 'lockmanager-alreadylocked', $key );
		} else {
			wfSuppressWarnings();
			$handle = fopen( $this->getLockPath( $key ), 'c' );
			wfRestoreWarnings();
			if ( !$handle ) { // lock dir missing?
				wfMkdirParents( $this->lockDir );
				wfSuppressWarnings();
				$handle = fopen( $this->getLockPath( $key ), 'c' ); // try again
				wfRestoreWarnings();
			}
			if ( $handle ) {
				// Either a shared or exclusive lock
				$lock = ( $type == self::LOCK_SH ) ? LOCK_SH : LOCK_EX;
				if ( flock( $handle, $lock | LOCK_NB ) ) {
					$this->handles[$key][$type] = $handle;
				} else {
					fclose( $handle );
					$status->fatal( 'lockmanager-fail-acquirelock', $key );
				}
			} else {
				$status->fatal( 'lockmanager-fail-openlock', $key );
			}
		}

		return $status;
	}

	/**
	 * Unlock a single resource key
	 * 
	 * @param $key string
	 * @param $type integer
	 * @return Status 
	 */
	protected function doSingleUnlock( $key, $type ) {
		$status = Status::newGood();

		if ( !isset( $this->handles[$key] ) ) {
			$status->warning( 'lockmanager-notlocked', $key );
		} elseif ( $type && !isset( $this->handles[$key][$type] ) ) {
			$status->warning( 'lockmanager-notlocked', $key );
		} else {
			foreach ( $this->handles[$key] as $lockType => $handle ) {
				if ( $type && $lockType != $type ) {
					continue; // only unlock locks of type $type
				}
				wfSuppressWarnings();
				if ( !flock( $this->handles[$key][$lockType], LOCK_UN ) ) {
					$status->fatal( 'lockmanager-fail-releaselock', $key );
				}
				if ( !fclose( $this->handles[$key][$lockType] ) ) {
					$status->warning( 'lockmanager-fail-closelock', $key );
				}
				wfRestoreWarnings();
				unset( $this->handles[$key][$lockType] );
			}
			if ( !count( $this->handles[$key] ) ) {
				wfSuppressWarnings();
				# No locks are held for the lock file anymore
				if ( !unlink( $this->getLockPath( $key ) ) ) {
					$status->warning( 'lockmanager-fail-deletelock', $key );
				}
				wfRestoreWarnings();
				unset( $this->handles[$key] );
			}
		}

		return $status;
	}

	/**
	 * Get the path to the lock file for a key
	 * @param $key string
	 * @return string
	 */
	protected function getLockPath( $key ) {
		return "{$this->lockDir}/{$key}.lock";
	}

	function __destruct() {
		// Make sure remaining files get cleared for sanity
		foreach ( $this->handles as $key => $locks ) {
			foreach ( $locks as $type => $handle ) {
				flock( $handle, LOCK_UN ); // PHP 5.3 will not do this automatically
				fclose( $handle );
			}
			unlink( $this->getLockPath( $key ) );
		}
	}
}

/**
 * Version of FileLockManager based on using DB table locks.
 * This is meant for multi-wiki systems that may share share files.
 *
 * All lock requests for a resource, identified by a hash string, will
 * map to one bucket. Each bucket maps to one or several peer DB servers,
 * each having a `file_locks` table with row-level locking.
 *
 * A majority of peer servers must agree for a lock to be acquired.
 * As long as one peer server is up, lock requests will not be blocked
 * just because another peer server cannot be contacted. A global status
 * cache can be setup to track servers that recently missed queries; such
 * servers will not be trusted for obtaining locks.
 * 
 * For performance, deadlock detection should be disabled and a small
 * lock-wait timeout should be set via server config. In innoDB, this can
 * done via the innodb_deadlock_detect and innodb_lock_wait_timeout settings.
 */
class DBFileLockManager extends FileLockManager {
	/** @var Array Map of bucket indexes to peer sets */
	protected $dbsByBucket; // (bucket index => (ldb1, ldb2, ...))
	/** @var BagOStuff */
	protected $statusCache;

	protected $trustCache; // boolean
	protected $webTimeout; // integer number of seconds
	protected $cliTimeout; // integer number of seconds
	protected $safeDelay; // integer number of seconds

	/** @var Array Map of (locked key => lock type => 1) */
	protected $locksHeld = array();
	/** $var Array Map Lock-active database connections (server name => Database) */
	protected $activeConns = array();

	/**
	 * Construct a new instance from configuration.
	 * $config paramaters include:
	 *     'dbsByBucket' : Array of 1-16 consecutive integer keys, starting from 0, with
	 *                     a list of DB names (peers) as values. Each list should have
	 *                     an odd number of items and each DB should have its own server.
	 *     'webTimeout'  : Lock timeout (seconds) for non-CLI scripts. [optional]
	 *                     This tells the DB server how long to wait before assuming
	 *                     connection failure and releasing all the locks for a session.
	 *     'cliTimeout'  : Lock timeout (seconds) for CLI scripts. [optional]
	 *                     This tells the DB server how long to wait before assuming
	 *                     connection failure and releasing all the locks for a session.
	 *     'safeDelay'   : Seconds to mistrust a DB after restart/query loss. [optional]
	 *                     This should reflect the highest max_execution_time that PHP
	 *                     scripts might use on a wiki. Locks are lost on server restart.
	 *     'cache'       : $wgMemc (if set to a global memcached instance). [optional]
	 *                     This tracks peer servers that couldn't be queried recently.
	 *     'trustCache'  : Assume cache knows all servers missing queries recently. [optional]
	 *
	 * @param Array $config 
	 */
	function __construct( array $config ) {
		$this->dbsByBucket = $config['dbsByBucket'];
		// Sanitize against bad config to prevent PHP errors
		for ( $i=0; $i < count( $this->dbsByBucket ); $i++ ) {
			if ( !isset( $this->dbsByBucket[$i] ) // not consecutive
				|| !is_array( $this->dbsByBucket[$i] ) // bad type
			) {
				$this->dbsByBucket[$i] = array();
				wfWarn( "No valid key for bucket $i in dbsByBucket." );
			}
		}
		if ( isset( $config['webTimeout'] ) ) {
			$this->webTimeout = $config['webTimeout'];
		} else {
			$met = ini_get( 'max_execution_time' );
			$this->webTimeout = $met ? $met : 60; // use some same amount if 0
		}
		$this->cliTimeout = isset( $config['cliTimeout'] )
			? $config['cliTimeout']
			: 60; // some sane amount
		$this->safeDelay = isset( $config['safeDelay'] )
			? $config['safeDelay']
			: max( $this->cliTimeout, $this->webTimeout ); // cover worst case
		if ( isset( $config['cache'] ) && $config['cache'] instanceof BagOStuff ) {
			$this->statusCache = $config['cache'];
			$this->trustCache = ( !empty( $config['trustCache'] ) && $this->safeDelay > 0 );
		} else {
			$this->statusCache = null;
			$this->trustCache = false;
		}
	}

	protected function doLock( array $keys, $type ) {
		$status = Status::newGood();

		$keysToLock = array();
		// Get locks that need to be acquired (buckets => locks)...
		foreach ( $keys as $key ) {
			if ( isset( $this->locksHeld[$key][$type] ) ) {
				$status->warning( 'lockmanager-alreadylocked', $key );
			} elseif ( isset( $this->locksHeld[$key][self::LOCK_EX] ) ) {
				$status->warning( 'lockmanager-alreadylocked', $key );
			} else {
				$bucket = $this->getBucketFromKey( $key );
				$keysToLock[$bucket][] = $key;
			}
		}

		$lockedKeys = array(); // files locked in this attempt
		// Attempt to acquire these locks...
		foreach ( $keysToLock as $bucket => $keys ) {
			// Acquire the locks for this server. Three main cases can happen:
			// (a) First server is up; common case
			// (b) First server is down but a peer is up
			// (c) First server is down and no peer are up (or none defined)
			$res = $this->doLockingQueryAll( $bucket, $keys, $type );
			if ( $res === 'cantacquire' ) {
				// Resources already locked by another process.
				// Abort and unlock everything we just locked.
				$status->fatal( 'lockmanager-fail-acquirelocks' );
				$status->merge( $this->doUnlock( $lockedKeys, $type ) );
				return $status;
			} elseif ( $res !== true ) {
				// Couldn't contact any servers for this bucket.
				// Abort and unlock everything we just locked.
				$status->fatal( 'lockmanager-fail-db-bucket', $bucket );
				$status->merge( $this->doUnlock( $lockedKeys, $type ) );
				return $status;
			}
			// Record these locks as active
			foreach ( $keys as $key ) {
				$this->locksHeld[$key][$type] = 1; // locked
			}
			// Keep track of what locks were made in this attempt
			$lockedKeys = array_merge( $lockedKeys, $keys );
		}

		return $status;
	}

	protected function doUnlock( array $keys, $type ) {
		$status = Status::newGood();

		foreach ( $keys as $key ) {
			if ( !isset( $this->locksHeld[$key] ) ) {
				$status->warning( 'lockmanager-notlocked', $key );
			} elseif ( $type && !isset( $this->locksHeld[$key][$type] ) ) {
				$status->warning( 'lockmanager-notlocked', $key );
			} else {
				foreach ( $this->locksHeld[$key] as $lockType => $x ) {
					if ( $type && $lockType != $type ) {
						continue; // only unlock locks of type $type
					}
					unset( $this->locksHeld[$key][$lockType] );
				}
				if ( !count( $this->locksHeld[$key] ) ) {
					unset( $this->locksHeld[$key] ); // no SH or EX locks left for key
				}
			}
		}

		// Reference count the locks held and COMMIT when zero
		if ( !count( $this->locksHeld ) ) {
			$this->finishLockTransactions();
		}

		return $status;
	}

	/**
	 * Get a DB connection to a lock server and acquire locks on $keys.
	 *
	 * @param $server string
	 * @param $keys Array
	 * @param $type integer FileLockManager::LOCK_EX or FileLockManager::LOCK_SH
	 * @return void
	 */
	protected function doLockingQuery( $server, array $keys, $type ) {
		if ( !isset( $this->activeConns[$server] ) ) {
			$this->activeConns[$server] = wfGetDB( DB_MASTER, array(), $server );
			$this->activeConns[$server]->begin(); // start transaction
			# If the connection drops, try to avoid letting the DB rollback
			# and release the locks before the file operations are finished.
			# This won't handle the case of server reboots however.
			$options = array();
			if ( php_sapi_name() == 'cli' ) { // maintenance scripts
				if ( $this->cliTimeout > 0 ) {
					$options['connTimeout'] = $this->cliTimeout;
				}
			} else { // web requests
				if ( $this->webTimeout > 0 ) {
					$options['connTimeout'] = $this->webTimeout;
				}
			}
			$this->activeConns[$server]->setSessionOptions( $options );
		}
		$db = $this->activeConns[$server];
		# Try to get the locks...this should be the last query of this function
		if ( $type == self::LOCK_SH ) { // reader locks
			$db->select( 'file_locks', '1',
				array( 'fl_key' => $keys ),
				__METHOD__,
				array( 'LOCK IN SHARE MODE' ) // single-row gap locks
			);
		} else { // writer locks
			$data = array();
			foreach ( $keys as $key ) {
				$data[] = array( 'fl_key' => $key );
			}
			$db->insert( 'file_locks', $data, __METHOD__ );
		}
	}

	/**
	 * Attempt to acquire locks with the peers for a bucket.
	 * This should avoid throwing any exceptions.
	 *
	 * @param $bucket integer
	 * @param $keys Array List of resource keys to lock
	 * @param $type integer FileLockManager::LOCK_EX or FileLockManager::LOCK_SH
	 * @return bool|string One of (true, 'cantacquire', 'dberrors')
	 */
	protected function doLockingQueryAll( $bucket, array $keys, $type ) {
		$yesVotes = 0; // locks made on trustable servers
		$votesLeft = count( $this->dbsByBucket[$bucket] ); // remaining servers
		$quorum = floor( $votesLeft/2 + 1 ); // simple majority
		foreach ( $this->dbsByBucket[$bucket] as $server ) {
			// Check that server is not *known* to have issues
			if ( $this->checkStatusCache( $server ) ) {
				try {
					// Attempt to acquire the lock on this server
					$this->doLockingQuery( $server, $keys, $type );
					// Check that server has no signs of lock loss
					if ( $this->checkUptime( $server ) ) {
						++$yesVotes; // success for this peer
						if ( $yesVotes >= $quorum ) {
							return true; // lock obtained
						}
					}
				} catch ( DBError $e ) {
					if ( $this->lastErrorIndicatesLocked( $server ) ) {
						return 'cantacquire'; // vetoed; resource locked
					} else { // can't connect?
						$this->cacheRecordFailure( $server );
					}
				}
			}
			$votesLeft--;
			$votesNeeded = $quorum - $yesVotes;
			if ( $votesNeeded > $votesLeft ) {
				break; // short-circuit
			}
		}
		// At this point, we must not have meet the quorum
		if ( $yesVotes > 0 && $this->trustCache ) {
			return true; // we are trusting the cache; may comprimise correctness
		}
		return 'dberrors'; // not enough votes to ensure correctness
	}

	/**
	 * Commit all changes to lock-active databases.
	 * This should avoid throwing any exceptions.
	 *
	 * @return void
	 */
	protected function finishLockTransactions() {
		foreach ( $this->activeConns as $server => $db ) {
			try {
				$db->rollback(); // finish transaction and kill any rows
			} catch ( DBError $e ) {
				// oh well; best effort
			}
		}
		$this->activeConns = array();
	}

	/**
	 * Check if the last DB error for $server indicates
	 * that a requested resource was locked by another process.
	 * This should avoid throwing any exceptions.
	 * 
	 * @param $server string
	 * @return bool
	 */
	protected function lastErrorIndicatesLocked( $server ) {
		if ( isset( $this->activeConns[$server] ) ) { // sanity
			$db = $this->activeConns[$server];
			return ( $db->wasDeadlock() || $db->wasLockTimeout() );
		}
		return false;
	}

	/**
	 * Checks if the DB server did not recently restart.
	 * This curtails the problem of locks falling off when servers restart.
	 * 
	 * @param $server string
	 * @return bool
	 */
	protected function checkUptime( $server ) {
		if ( isset( $this->activeConns[$server] ) ) { // sanity
			if ( $this->safeDelay > 0 ) {
				$db = $this->activeConns[$server];
				if ( $db->getServerUptime() < $this->safeDelay ) {
					return false;
				}
			}
			return true;
		}
		return false;
	}

	/**
	 * Checks if the DB server has not recently missed lock queries.
	 * This curtails the problem of peers occasionally not getting locks.
	 * 
	 * @param $server string
	 * @return bool
	 */
	protected function checkStatusCache( $server ) {
		if ( $this->statusCache && $this->safeDelay > 0 ) {
			$key = $this->getMissKey( $server );
			$misses = $this->statusCache->get( $key );
			if ( $misses > 0 ) {
				return false;
			}
		}
		return true;
	}

	/**
	 * Log a lock request failure to the cache.
	 *
	 * Worst case scenario is that a resource lock was only
	 * on one peer and then that peer is restarted or goes down.
	 * Clients trying to get locks need to know if a server is down.
	 *
	 * @param $server string
	 * @return bool Success
	 */
	protected function cacheRecordFailure( $server ) {
		if ( $this->statusCache && $this->safeDelay > 0 ) {
			$key = $this->getMissKey( $server );
			$misses = $this->statusCache->get( $key );
			if ( $misses ) {
				return $this->statusCache->incr( $key );
			} else {
				return $this->statusCache->add( $key, 1, $this->safeDelay );
			}
		}
		return true;
	}

	/**
	 * Get a cache key for recent query misses for a server
	 *
	 * @param $server string
	 * @return string
	 */
	protected function getMissKey( $server ) {
		return "lockmanager:querymisses:srv:$server";
	}

	/**
	 * Get the bucket for lock key.
	 * This should avoid throwing any exceptions.
	 *
	 * @param $key string (40 char hex key)
	 * @return integer
	 */
	protected function getBucketFromKey( $key ) {
		$prefix = substr( $key, 0, 2 ); // first 2 hex chars (8 bits)
		return intval( base_convert( $prefix, 16, 10 ) ) % count( $this->dbsByBucket );
	}
}

/**
 * Simple version of FileLockManager that does nothing
 */
class NullFileLockManager extends FileLockManager {
	function __construct( array $config ) {}

	protected function doLock( array $keys, $type ) {
		return Status::newGood();
	}

	protected function doUnlock( array $keys, $type ) {
		return Status::newGood();
	}
}
