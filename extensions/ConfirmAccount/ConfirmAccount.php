<?php
/*
 (c) Aaron Schulz 2007, GPL

 This program is free software; you can redistribute it and/or modify
 it under the terms of the GNU General Public License as published by
 the Free Software Foundation; either version 2 of the License, or
 (at your option) any later version.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 GNU General Public License for more details.

 You should have received a copy of the GNU General Public License along
 with this program; if not, write to the Free Software Foundation, Inc.,
 59 Temple Place - Suite 330, Boston, MA 02111-1307, USA.
 http://www.gnu.org/copyleft/gpl.html
*/

if ( !defined( 'MEDIAWIKI' ) ) {
	echo "ConfirmAccount extension\n";
	exit( 1 ) ;
}

$wgExtensionCredits['specialpage'][] = array(
	'path' => __FILE__,
	'name' => 'Confirm user accounts',
	'descriptionmsg' => 'confirmedit-desc',
	'author' => 'Aaron Schulz',
	'url' => 'http://www.mediawiki.org/wiki/Extension:ConfirmAccount',
);

# This extension needs email enabled!
# Otherwise users can't get their passwords...
if ( !$wgEnableEmail ) {
	echo "ConfirmAccount extension requires \$wgEnableEmail set to true \n";
	exit( 1 ) ;
}

# Set the person's bio as their userpage?
$wgMakeUserPageFromBio = true;
# Text to add to bio pages if the above option is on
$wgAutoUserBioText = '';

$wgAutoWelcomeNewUsers = true;
# Make the username of the real name?
$wgUseRealNamesOnly = true;

# How long to store rejected requests
$wgRejectedAccountMaxAge = 7 * 24 * 3600; // One week
# How long after accounts have been requested/held before they count as 'rejected'
$wgConfirmAccountRejectAge = 30 * 24 * 3600; // 1 month

# How many requests can an IP make at once?
$wgAccountRequestThrottle = 1;
# Can blocked users request accounts?
$wgAccountRequestWhileBlocked = false;

# Minimum biography specs
$wgAccountRequestMinWords = 50;

# Show ToS checkbox
$wgAccountRequestToS = true;
# Show confirmation info fields (notes,url,files if enabled)
$wgAccountRequestExtraInfo = true;
# If $wgAccountRequestExtraInfo, also enables file attachments
$wgAllowAccountRequestFiles = true;
# If files can be attached, what types can be used? (MIME data is checked)
$wgAccountRequestExts = array( 'txt', 'pdf', 'doc', 'latex', 'rtf', 'text', 'wp', 'wpd', 'sxw' );

# Prospective account access levels.
# An associative array of integer => (special page param,user group,autotext) pairs.
# The account queues are at Special:ConfirmAccount/param. The integer keys enumerate the type.
# When a request of a certain type (param) is approved, the new user:
# (a) is placed in the <user group> group (if not User or *)
# (b) If $wgMakeUserPageFromBio, <autotext> is appended his/her user page
$wgAccountRequestTypes = array(
	0 => array( 'authors', 'user', null )
);

# If set, will add {{DEFAULTSORT:sortkey}} to userpages for auto-categories.
# The sortkey will be made be replacing the first element of this array
# (regexp) with the second. Set this variable to false to avoid sortkey use.
$wgConfirmAccountSortkey = false;
// For example, the below will do {{DEFAULTSORT:firstname, lastname}}
# $wgConfirmAccountSortkey = array( '/^(.+) ([^ ]+)$/', '$2, $1' );

# IMPORTANT: do we store the user's notes and credentials
# for sucessful account request? This will be stored indefinetely
# and will be accessible to users with crediential lookup permissions
$wgConfirmAccountSaveInfo = true;

# Send an email to this address when account requestors confirm their email.
# Set to false to skip this
$wgConfirmAccountContact = false;

# If ConfirmEdit is installed and set to trigger for createaccount,
# inject catpchas for requests too?
$wgConfirmAccountCaptchas = true;

# Storage repos. Has B/C for when this used FileStore.
$wgConfirmAccountFSRepos = array(
	'accountreqs' => array( # Location of attached files for pending requests
		'name'       => 'accountreqs',
		'directory'  => isset($wgFileStore['accountreqs']) ?
			$wgFileStore['accountreqs']['directory'] : "{$IP}/images/accountreqs",
		'url'        => isset($wgFileStore['accountreqs']) ?
			$wgFileStore['accountreqs']['url'] : null,
		'hashLevels' => isset($wgFileStore['accountreqs']) ?
			$wgFileStore['accountreqs']['hash'] : 3
	),
	'accountcreds' => array( # Location of credential files
		'name'       => 'accountcreds',
		'directory'  => isset($wgFileStore['accountcreds']) ?
			$wgFileStore['accountcreds']['directory'] : "{$IP}/images/accountcreds",
		'url'        => isset($wgFileStore['accountcreds']) ?
			$wgFileStore['accountcreds']['url'] : null,
		'hashLevels' => isset($wgFileStore['accountcreds']) ?
			$wgFileStore['accountcreds']['hash'] : 3
	)
);

# Restrict account creation
$wgGroupPermissions['*']['createaccount'] = false;
$wgGroupPermissions['user']['createaccount'] = false;
# Grant account queue rights
$wgGroupPermissions['bureaucrat']['confirmaccount'] = true;
# This right has the request IP show when confirming accounts
$wgGroupPermissions['bureaucrat']['requestips'] = true;

# If credentials are stored, this right lets users look them up
$wgGroupPermissions['bureaucrat']['lookupcredentials'] = true;

$wgAvailableRights[] = 'confirmaccount'; // user can confirm account requests
$wgAvailableRights[] = 'requestips'; // user can see IPs in request queue
$wgAvailableRights[] = 'lookupcredentials'; // user can lookup info on confirmed users

# Show notice for open requests to admins?
# This is cached, but still can be expensive on sites with thousands of requests.
$wgConfirmAccountNotice = true;

$wgResourceModules['ext.confirmAccount'] = array(
	'styles' 		=> 'confirmaccount.css',
	'localBasePath' => dirname( __FILE__ ) . '/presentation/modules',
	'remoteExtPath' => 'ConfirmAccount/presentation/modules',
);

$dir = dirname( __FILE__ ) . '/presentation';
# Internationalization files
$wgExtensionMessagesFiles['ConfirmAccount'] = "$dir/ConfirmAccount.i18n.php";
$wgExtensionAliasesFiles['ConfirmAccount'] = "$dir/ConfirmAccount.alias.php";
# UI event handlers
$wgAutoloadClasses['ConfirmAccountUIHooks'] = "$dir/ConfirmAccountUI.hooks.php";

$dir = dirname( __FILE__ ) . '/presentation/specialpages';
# UI to request an account
$wgAutoloadClasses['RequestAccountPage'] = "$dir/actions/RequestAccount_body.php";
# UI to confirm accounts
$wgAutoloadClasses['ConfirmAccountsPage'] = "$dir/actions/ConfirmAccount_body.php";
# UI to see account credentials
$wgAutoloadClasses['UserCredentialsPage'] = "$dir/actions/UserCredentials_body.php";

$dir = dirname( __FILE__ ) . '/dataclasses';
# Utility functions
$wgAutoloadClasses['ConfirmAccount'] = "$dir/ConfirmAccount.class.php";
# Data access objects
$wgAutoloadClasses['UserAccountRequest'] = "$dir/UserAccountRequest.php";

$dir = dirname( __FILE__ ) . '/schema';
# Schema changes
$wgAutoloadClasses['ConfirmAccountUpdaterHooks'] = "$dir/ConfirmAccountUpdater.hooks.php";

# Make sure "login / create account" notice still as "create account"
$wgHooks['PersonalUrls'][] = 'ConfirmAccountUIHooks::setRequestLoginLinks';
# Add notice of where to request an account at UserLogin
$wgHooks['UserCreateForm'][] = 'ConfirmAccountUIHooks::addRequestLoginText';
$wgHooks['UserLoginForm'][] = 'ConfirmAccountUIHooks::addRequestLoginText';
# Check for collisions
$wgHooks['AbortNewAccount'][] = 'ConfirmAccountUIHooks::checkIfAccountNameIsPending';
# Status header like "new messages" bar
$wgHooks['SiteNoticeAfter'][] = 'ConfirmAccountUIHooks::confirmAccountsNotice';

# Register admin pages for AdminLinks extension.
$wgHooks['AdminLinks'][] = 'ConfirmAccountUIHooks::confirmAccountAdminLinks';

# Actually register some special pages
$wgHooks['SpecialPage_initList'][] = 'ConfirmAccountUIHooks::defineSpecialPages';

$wgHooks['LoadExtensionSchemaUpdates'][] = 'ConfirmAccountUpdaterHooks::addSchemaUpdates';
