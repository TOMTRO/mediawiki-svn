<?php

$wgExtensionCredits['other'][] = array(
	'path' => __FILE__,
	'name' => 'MSSQLBackCompat',
	'url' => '',
	'author' => 'Sam Reed',
	'descriptionmsg' => 'codereview-desc',
);

$dir = dirname( __FILE__ ) . '/';
$wgAutoloadClasses['DatabaseMssqlOld'] = $dir . 'DatabaseMssqlOld.php';
$wgAutoloadClasses['MSSQLOldField'] = $dir . 'DatabaseMssqlOld.php';