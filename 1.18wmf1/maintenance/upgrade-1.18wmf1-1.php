<?php

require( dirname( __FILE__ ) . '/commandLine.inc' );

doAllSchemaChanges();

function doAllSchemaChanges() {
	global $wgLBFactoryConf, $wgConf;

	$sectionLoads = $wgLBFactoryConf['sectionLoads'];
	$sectionsByDB = $wgLBFactoryConf['sectionsByDB'];
	$rootPass = trim( wfShellExec( '/home/wikipedia/bin/mysql_root_pass' ) );

	// Compile wiki lists
	$wikisBySection = array();
	foreach ( $wgConf->getLocalDatabases() as $wiki ) {
		if ( isset( $sectionsByDB[$wiki] ) ) {
			$wikisBySection[$sectionsByDB[$wiki]][] = $wiki;
		} else {
			$wikisBySection['DEFAULT'][] = $wiki;
		}
	}

	// Do the upgrades
	foreach ( $sectionLoads as $section => $loads ) {
		$master = true;
		foreach ( $loads as $server => $load ) {
			if ( $master ) {
				echo "Skipping $section master $server\n";
				$master = false;
				continue;
			}

			$db = new DatabaseMysql(
				$server,
				'root',
				$rootPass,
				false, /* dbName */
				0, /* flags, no transactions */
				'' /* prefix */
			);

			foreach ( $wikisBySection[$section] as $wiki ) {
				$db->selectDB( $wiki );
				upgradeWiki( $db );
				while ( $db->getLag() > 10 ) {
					echo "Waiting for $server to catch up to master.\n";
					sleep( 60 );
				}
			}
		}
	}

	echo "All done (except masters).\n";
}

function upgradeWiki( $db ) {
	$wiki = $db->getDBname();
	$server = $db->getServer();

	$upgradeLogRow = $db->selectRow( 'updatelog',
		'ul_key',
		array( 'ul_key' => '1.18wmf1-1' ),
		__FUNCTION__ );
	if ( $upgradeLogRow ) {
		echo $db->getDBname() . ": already done\n";
		return;
	}

	echo "$server $wiki 1.18wmf1-1";

	sourceUpgradeFile( $db, dirname( __FILE__ ) .'/schema-changes-1.18wmf1-1.sql' );
	
	if ( isFlaggedRevsWiki( $wiki ) ) {
		echo " FlaggedRevs";
		sourceUpgradeFile( $db, dirname(__FILE__).'/../extensions/FlaggedRevs/schema/mysql/' . 
			'patch-fr_page_rev-index-wmf1.8.sql' );
	}

	if ( $db->fieldExists( 'article_feedback', 'aa_page_id' ) ) {
		echo " aa_page_id index";
		sourceUpgradeFile( $db, dirname( __FILE__ ) . '/../extensions/ArticleFeedback/sql/AddArticleFeedbackPageIndex.sql' );
	}

	$db->insert( 'updatelog', 
		array( 'ul_key' => '1.18wmf1-1' ),
		__FUNCTION__ );
	echo " ok\n";
}

function isFlaggedRevsWiki( $wiki ) {
	static $dblist;
	global $IP;

	if ( $dblist === null ) {
		$dblist = array_map( 'trim', file( "$IP/../flaggedrevs.dblist" ) );
	}
	return in_array( $wiki, $dblist );
}

function sourceUpgradeFile( $db, $file ) {
	if ( !file_exists( $file ) ) {
		echo "File missing: $file\n";
		exit( 1 );
	}
	$db->sourceFile( $file );
}


