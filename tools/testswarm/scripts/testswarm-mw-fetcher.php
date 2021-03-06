<?php
/**
 * Script to prepare a MediaWiki-install from svn for TestSwarm testing.
 *
 * As of November 2nd 2011, this is still a work in progress.
 *
 * Latest version can be found in the Mediawiki repository under
 * /trunk/tools/testswarm/
 *
 * Based on http://svn.wikimedia.org/viewvc/mediawiki/trunk/tools/testswarm/scripts/testswarm-mediawiki-svn.php?revision=94359&view=markup
 *
 * @author Timo Tijhof, 2011
 * @author Antoine "hashar" Musso, 2011
 */

/**
 * One class doing everything! :D
 *
 * Subversion calls are made using the svn binary so we do not need
 * to install any PECL extension.
 *
 * @todo We might want to abstract svn commands to later use git
 * @todo Create some kind of locking system (either inside this script or outside of it),
 * to prevent this script from running if it is already running (since checking out & installing MediaWiki
 * can easily take over 5 minutes).
 *
 * @example:
 * @code
 *   $options = array(
 *     'root' => '/tmp/testswarm-mw',
 *     'svnUrl' => 'http://svn.wikimedia.org/svnroot/mediawiki/trunk/phase3',
 *   );
 *   $main = new TestSwarmMWMain( $options );
 *   $main->tryFetchNextRev();
 * @endcode
 */
class TestSwarmMWMain {

	/** Base path to run into */
	protected $root;

	/** URL to a subversion repository as supported by the Subversion cli */
	protected $svnUrl;

	/** subversion command line utility */
	protected $svnCmd = '/usr/bin/svn';

	/** Whether to enable debugging */
	protected $debugMode = false;

	/** Minimum revision to start with. At least 1 */
	protected $minRev = 1;

	/** Path to log file */
	protected $logPath;


	/** GETTERS **/

	public function getSvnCmd() { return $this->svnCmd; }
	public function getSvnUrl() { return $this->svnUrl; }
	public function getLogPath() { return $this->logPath; }


	/** SETTERS **/

	public function setLogPath( $path ) {
		$this->logPath = $path;
		return true;
	}


	/** INIT **/

	/**
	 * Init the testswarm fetcher.
	 *
	 * @param @options array: Required options are:
	 *  'root' => root path where all stuff happens
	 *  'svnUrl' => URL to the repository (or a subdirectory of it)
	 * Other options:
	 *  'svnCmd' => path/to/svn (default: /usr/bin/svn)
	 *  'debug' => (default: false)
	 *  'minRev' => int (default: 1)
	 */
	public function __construct( $options = array() ) {

		// Verify we have been given required options
		if ( !isset( $options['root'] ) || !isset( $options['svnUrl'] ) ) {
			throw new Exception( __METHOD__ . ": Required options 'root' and/or 'svnUrl' missing" );
		}

		$this->root = $options['root'];
		$this->svnUrl = $options['svnUrl'];

		// Default log file
		$this->setLogPath( "{$options['root']}/logs/default.log" );

		// Optional options 
		if ( isset( $options['svnCmd'] ) ) {
			$this->svnCmd = $options['svnCmd'];
		}

		if ( isset( $options['debug'] ) ) {
			$this->debugMode = true;
		}

		if ( isset( $options['minRev'] ) ) {
			if ( $options['minRev'] < 1 ) {
				# minRev = 0 will just screw any assumption made in this script.
				# so we really do not want it.
				throw new Exception( __METHOD__ . ": Option 'minRev' must be >= 1 " );
			}
			$this->minRev = $options['minRev'];
		}

		return $this;
	}

	/**
	 * Try to fetch the next revision (relative to the latest checkout in the checkouts directory).
	 * This is the main entry point after construction.
	 */
	public function tryFetchNextRev() {
		$this->prepareRootDirs();

		// Now find out the next revision in the remote repository
		$next = $this->getNextCheckoutRevId();
		if ( !$next ) {
			$this->debug( 'No next revision', __METHOD__ );
			return false;
		} else {
			// And install it
			$fetcher = new TestSwarmMWFetcher( &$this, $next );
			return $fetcher->run();
		}
	}


	/** SVN REVISION HELPERS **/

	/**
	 * Get latest revision fetched in the working copy.
	 * @return integer
	 */
	public function getLastCheckoutRevId() {
		$paths = $this->getPathsForRev( 0 );
		$checkoutPath = dirname( $paths['mw'] );

		// scandir() sorts in descending order if given a nonzero value as second argument.
		// PHP 5.4 accepts constant SCANDIR_SORT_DESCENDING
		$subdirs = scandir( $checkoutPath, 1 );
		$this->debug( "Scan of '{$checkoutPath}' returned:\n - /" . implode("\n - /", $subdirs ) );

		// Verify the directory is like 'r123' (it could be '.', '..' or even something completely different)
		if ( $subdirs[0][0] === 'r' ) {
			return substr( $subdirs[0], 1 );
		} else {
			return null;
		}
	}

	/**
	 * Get the first revision after the given revision in the remote repository.
	 * @param $id integer
	 * @return null|integer: Null if there is no next, other wise integer id of next revision.
	 */
	public function getNextFollowingRevId( $id ) {

		/**
		 * @todo FIXME: Takes a loooooooongg time to look up for "1:HEAD"
		 *
		 * @example:
		 * $ svn log -q -r101656:HEAD --limit 2 http://svn.wikimedia.org/svnroot/mediawiki/trunk/phase3
		 * ------------------------------------------------------------------------
		 * r101656 | aaron | 2011-11-02 19:47:04 +0100 (Wed, 02 Nov 2011)
		 * ------------------------------------------------------------------------
		 * r101666 | brion | 2011-11-02 20:36:49 +0100 (Wed, 02 Nov 2011)
		 * ------------------------------------------------------------------------
		 */
		$nextRev = $id + 1;
		$cmd = "{$this->svnCmd} log -q -r{$nextRev}:HEAD --limit 1 {$this->svnUrl}";

		$retval = null;
		$output = $this->exec( $cmd, $retval );

		if ( $retval !== 0 ) {
			throw new Exception(__METHOD__. ': Error running subversion log' );
		}

		preg_match( "/r(\d+)/m", $output, $m );

		if ( !isset( $m[1] ) ) {
			// No next revision, given id is already >= HEAD
			return null;
		}

		$followingRev = (int)$m[1];
		if ( $followingRev === 0 ) {
			throw new Exception( __METHOD__ . " Remote returned a invalid revision id: '{$m[1]}'" );
		}
		return $followingRev;
	}

	/**
	 * Get next changed revision for a given checkout
	 * @return String|Boolean: false if nothing changed, else the upstream revision just after.
	 */
	public function getNextCheckoutRevId() {
		$cur = $this->getLastCheckoutRevId();
		if ( is_null ( $cur ) ) {
			$this->debug( 'Checkouts dir empty? Looking up remote repo...', __METHOD__ );
			$next = $this->minRev;
		} else {
			$next = $this->getNextFollowingRevId( $cur );
		}

		$this->debug( __METHOD__ . ": Going to use r{$next}" );
		return $next;
	}


	/** DIRECTORY STRUCTURE **/

	public function getRootDirs() {
		return array(
			"{$this->root}/dbs",
			"{$this->root}/checkouts",
			"{$this->root}/conf",
			"{$this->root}/logs",
		);
	}

	public function prepareRootDirs() {
		foreach( $this->getRootDirs() as $dir ) {			
			if ( !file_exists( $dir ) ) {
				$this->mkdir( $dir );
			}
		}
	}

	/**
	 * This function is where most of the directory layout is kept.
	 * All other methods should use this array to determine where to look or save.
	 *
	 * @param $id integer: Revision number.
	 * @return Array of paths relevant for an install.
	 */
	public function getPathsForRev( $id ) {
		if ( !is_int( $id ) ) {
			throw new Exception( __METHOD__ . ': Given non numerical revision' );
		}

		return array(
			'db' => "{$this->root}/dbs",
			'mw' => "{$this->root}/checkouts/r{$id}",
			'globalsettings' => "{$this->root}/conf/GlobalSettings.php",
			'localsettingstpl' => "{$this->root}/conf/LocalSettings.tpl.php",
			'log' => "{$this->root}/logs/r{$id}.log",
		);
	}


	/** UTILITY FUNCTIONS **/

	/**
	 * Execute a shell command!
	 * Ripped partially from wfShellExec()
	 * Throws an exception if anything goes wrong.
	 *
	 * @param $cmd string: Command which will be passed as is (no escaping FIXME)
	 * @param &$retval reference: Will be given the command exit level
	 * @return mixed: Command output.
	 */
	public function exec( $cmd, &$retval = 0 ) {
		$this->debug( "Executing '$cmd'", __METHOD__ );

		// Pass command to shell and use ob to fetch the output
		ob_start();
		passthru( $cmd, $retval );
		$output = ob_get_contents();
		ob_end_clean();

		if ( $retval == 127 ) {
			throw new Exception( __METHOD__ . ': Probably missing executable. Check env.' );
		}

		$this->debug( "Done executing '$cmd'", __METHOD__ );

		return $output;
	}

	/**
	 * Create a directory including parents
	 *
	 * @param $path String Path to create ex: /tmp/my/foo/bar 
	 */
	public function mkdir( $path ) {
		$this->debug( "Attempting to create directory '$path'...", __METHOD__ );
		if ( !file_exists( $path ) ) {
			if ( mkdir( $path, 0777, true ) ) {
				$this->debug( "Created directory '$path'", __METHOD__ );
			} else {
				throw new Exception( __METHOD__ . ": Failed to create directory '$path'" );
			}
		} else {
			$this->debug( "Creating directory '$path' aborted. Directory already exist", __METHOD__ );
		}
	}


	/** LOGGING **/

	/**
	 * Utility function to save a message to the log file.
	 *
	 * @param $msg string: message to log. Will be prefixed with a timestamp.
	 * @param $callee string: Callee function to be logged as origin.
	 */
	public function log( $msg, $callee = '', $prefix = '' ) {
		$msg = $prefix . ( $callee !== '' ? "$callee: " : '' ) . $msg;
		$file = $this->getLogPath();

		echo "$msg\n";

		// Append to logfile
		$fhandle = fopen( $file, "w+" );
		fwrite( $fhandle, '[' . date( 'r' ) . '] ' . $msg );
		fclose( $fhandle );
	}

	/**
	 * Echo a debug message directly to the output. Ignored when not in debug mode.
	 * Messages are prefixed with "DEBUG> ".
	 * Multiline messages will be split up.
	 *
	 * In contrary to log(), these are not saved in a file (you can save them if needed,
	 * simply point output to a file from the shell; $ php foo.php > debug.log).
	 *
	 * @param $msg string: Message to print.
	 * @param $callee string.
	 */
	public function debug( $msg, $callee = '', $prefix = '' ) {
		if ( !$this->debugMode ) {
			return;
		}
		foreach( explode( "\n", $msg ) as $line ) {
			$line = $prefix . ( $callee !== '' ? "$callee: " : '' ) . $line;
			echo "DEBUG> $line\n";
		}
	}
}

class TestSwarmMWFetcher {

	/** Instance of TestSwarmMWMain */
	private $main;

	/** MediaWiki revision id being fetched */
	protected $svnRevId;

	/** Array as created by TestSwarmMWMain::getPathsForRev */
	protected $paths;

	public function __construct( TestSwarmMWMain $main, $svnRevId ) {
		// Basic validation
		if ( !is_int( $svnRevId ) ) {
			throw new Exception( __METHOD__ . ": Invalid argument. svnRevId must be an integer" );
		}

		$this->paths = $main->getPathsForRev( $svnRevId );
		$main->setLogPath( $this->paths['log'] );

		$this->main = $main;
		$this->svnRevId = $svnRevId;
	}

	/**
	 * This is the main function doing checkout and installation for
	 * a given rev.
	 *
	 * @param $id integer: Revision id to install
	 * @return
	 */
	public function run() {
		$this->main->log( "Run for r{$this->svnRevId} started", __METHOD__ );

		$this->doCheckout();
		$this->doInstall();
		$this->doAppendSettings();

		/**
		 * @todo FIXME:
		 * - Get list of tests (see  old file for how)
		 * - Make POST request to TestSwarm install to add jobs for these test runs
		 *   (CURL addjob.php with login/auth token)
		 */
	}

	/**
	 * Checkout a given revision in our specific tree.
	 * Throw an exception if anything got wrong.
	 *
	 * @todo Output is not logged.
	 */
	public function doCheckout(){
		$this->main->log( 'Checking out...', __METHOD__ );

		// Create checkout directory for this revision
		$this->main->mkdir( $this->paths['mw'] );

		// @todo FIXME: We might want to log the output of svn commands
		$cmd = "{$this->main->getSvnCmd()} checkout {$this->main->getSvnUrl()}@r{$this->svnRevId} {$this->paths['mw']}";

		$retval = null;
		$this->main->exec( $cmd, $retval );
		if ( $retval !== 0 ) {
			throw new Exception(__METHOD__ . ": Error running subversion checkout" );
		}

		// @todo: Handle errors for above commands.
	}

	/**
	 * Install the fresly checked out MediaWiki version.
	 */
	public function doInstall() {
		$this->main->log( 'Installing...', __METHOD__ );

		// Erase MW_INSTALL_PATH which would interact with the install script
		putenv( 'MW_INSTALL_PATH' );

		// If admin access is needed, shell dev should run maintenance/changePassword.php,
		// we don't need to know this password.
		$randomAdminPass = substr( sha1( $this->svnRevId . serialize( $this->paths ) . rand( 100, 999 ) ), 0, 32 );
		// For convenience, put it in debug (not in saved log)
		$this->main->debug( "Generated wikiadmin pass: {$randomAdminPass}", __METHOD__ );

		// Now simply run the CLI installer:
		$cmd = "php {$this->paths['mw']}/maintenance/install.php \
			--dbname=testwarm_mw_r{$this->svnRevId} \
			--dbtype=sqlite \
			--dbpath={$this->paths['db']} \
			--showexceptions=true \
			--confpath={$this->paths['mw']} \
			--pass={$randomAdminPass} \
			TrunkWikiR{$this->svnRevId} \
			WikiSysop
			";

		$retval = null;
		$output = $this->main->exec( $cmd, $retval );

		$this->main->log( "-- MediaWiki installer output: \n$output\n-- End of MediaWiki installer output", __METHOD__ );

		if ( $retval !== 0 ) {
			throw new Exception(__METHOD__ . ": Error running MediaWiki installer" );
		}
	}

	/**
	 * @todo FIXME: Implement :-)
	 * @param $id integer: Revision id to append settings to.
	 */
	public function doAppendSettings() {
		$this->main->log( 'Appending settings... *TODO!*', __METHOD__ );

		$localSettings = "{$this->paths['mw']}/LocalSettings.php";
		if ( !file_exists( $localSettings ) ) {
			throw new Exception(__METHOD__ . ": LocalSettings.php missing, expected at {$localSettings}" );
		}

		// Optional, only if existant
		if ( file_exists( $this->paths['localsettingstpl'] ) ) {
			// @todo
		}

		// Required, must exist to avoid having to do backwards editing
		// Make empt file if needed
		if ( !file_exists( $this->paths['globalsettings'] ) ) {
			$this->main->debug( "No GlobalSettings.php found at {$this->paths['globalsettings']}. Creating...", __METHOD__ );
			if ( touch( $this->paths['globalsettings'] ) ) {
				$this->main->debug( "Created {$this->paths['globalsettings']}", __METHOD__ );
			} else {
				throw new Exception(__METHOD__ . ": Aborting. Unable to create GlobalSettings.php" );
			}
		}
		// @todo

		/**
		 * Possible additional common settings to append to LocalSettings after install:
		 * See gerrit integration/jenkins.git:
		 * https://gerrit.wikimedia.org/r/gitweb?p=integration/jenkins.git;a=tree;f=jobs/MediaWiki-phpunit;hb=HEAD
		 *
		 * $wgShowExceptionDetails = true;
		 * $wgShowSQLErrors = true;
		 * #$wgDebugLogFile = dirname( __FILE__ ) . '/build/debug.log';
		 * $wgDebugDumpSql = true;
		 */
		return true;
	}
}
