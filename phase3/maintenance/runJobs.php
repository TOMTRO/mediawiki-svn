<?php
/**
 * This script starts pending jobs.
 *
 * Usage:
 *  --maxjobs <num> (default 10000)
 *  --type <job_cmd>
 *
 * @file
 * @ingroup Maintenance
 */

$optionsWithArgs = array( 'maxjobs', 'type' );
$wgUseNormalUser = true;
require_once( 'commandLine.inc' );

if ( isset( $options['maxjobs'] ) ) {
	$maxJobs = $options['maxjobs'];
} else {
	$maxJobs = 10000;
}

$type = false;
if ( isset( $options['type'] ) )
	$type = $options['type'];

$wgTitle = Title::newFromText( 'RunJobs.php' );

$dbw = wfGetDB( DB_MASTER );
$n = 0;
$conds = '';
if ($type !== false)
	$conds = "job_cmd = " . $dbw->addQuotes($type);

while ( $dbw->selectField( 'job', 'job_id', $conds, 'runJobs.php' ) ) {
	$offset=0;
	for (;;) {
		$job = ($type == false) ?
				Job::pop($offset)
				: Job::pop_type($type);

		if ($job == false)
			break;

		wfWaitForSlaves( 5 );
		$t = microtime( true );
		$offset=$job->id;
		$status = $job->run();
		$t = microtime( true ) - $t;
		$timeMs = intval( $t * 1000 );
		if ( !$job->run() ) {
			runJobsLog( $job->toString() . " t=$timeMs error={$job->error}" );
		} else {
			runJobsLog( $job->toString() . " t=$timeMs good" );
		}
		if ( $maxJobs && ++$n > $maxJobs ) {
			break 2;
		}
	}
}


function runJobsLog( $msg ) {
	print wfTimestamp( TS_DB ) . " $msg\n";
	wfDebugLog( 'runJobs', $msg );
}

