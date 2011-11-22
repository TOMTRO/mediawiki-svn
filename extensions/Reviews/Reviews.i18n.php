<?php

/**
 * Internationalization file for the Reviews extension.
 *
 * @since 0.1
 *
 * @file Reviews.i18n.php
 * @ingroup Reviews
 *
 * @licence GNU GPL v3+
 * @author Jeroen De Dauw < jeroendedauw@gmail.com >
 */

$messages = array();

/** English
 * @author Jeroen De Dauw
 */
$messages['en'] = array(
	'reviews-desc' => 'Allow users to post reviews per article.',

	// Misc
	'reviews-toplink' => 'My reviews',

	// Rights
	'right-reviewsadmin' => 'Manage reviews',
	'right-review' => 'Post reviews',

	'action-reviewsadmin' => 'manage reviews',
	'action-reviewer' => 'post reviews',

	// Groups
	'group-reviewsadmin' => 'Review admins',
	'group-reviewsadmin-member' => '{{GENDER:$1|review administrator}}',
	'grouppage-reviewsadmin' => '{{ns:project}}:Review_administrators',

	'group-reviewer' => 'Reviewer',
	'group-reviewer-member' => '{{GENDER:$1|Reviewer}}',
	'grouppage-reviewer' => '{{ns:project}}:Reviewers',

	// Preferences
	'prefs-reviews' => 'Reviews',
	'reviews-prefs-showtoplink' => 'Show a link to [[Special:MyReviews|your reviews]] at the top of every page.',
	'reviews-prefs-showcontrol' => 'Show the review control at the bottom of articles.',
	'reviews-prefs-showedit' => 'Show the review control even when I already submitted a review, so I can edit it.',

	// Special pages
	'special-myreviews' => 'My reviews',
	'special-reviews' => 'Reviews',

	// Review control
	'reviews-submission-submit' => 'Submit',
	'reviews-submission-saving' => 'Saving',

	// Special:MyReviews
	'reviews-myreviews-header' => 'This page lists all reviews you posted',
);
