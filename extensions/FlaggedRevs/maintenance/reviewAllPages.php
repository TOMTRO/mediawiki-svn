<?php

# Assume normal setup...
require dirname(__FILE__) . '/../../../maintenance/commandLine.inc';
require dirname(__FILE__) . '/reviewAllPages.inc';

error_reporting( E_ALL & (~E_NOTICE) );

$db = wfGetDB( DB_MASTER );

autoreview_current( $db );
