/**
 * JavaScript to populate the shared gadgets tab on the preferences page.
 *
 * @author Roan Kattouw
 * @copyright © 2011 Roan Kattouw
 * @license GNU General Public Licence 2.0 or later
 */
( function( $ ) {
	/**
	 * Fixes the description and the categorization for shared gadgets in the preferences form.
	 * This hides the container td for shared gadgets preferences, reorders them by moving them
	 * into a new td in the right order, updates their label texts, then replaces the old td with
	 * the new one.
	 * @param gadgetsByCategory {Object} Map of { categoryID: { gadgetID: gadgetDescription } }
	 * @param categoryNames {Object} Map of { categoryID: categoryDescription }
	 */
	function fixPreferenceForm( gadgetsByCategory, categoryNames ) {
		var 	$oldContainer = $( '#mw-prefsection-gadgetsshared' ).find( '.mw-input' ),
			$newContainer = $( '<td>' ).addClass( 'mw-input' ),
			$spinner = $oldContainer.closest( '.mw-gadgetsshared-item-unloaded' ),
			category, gadget, $oldItem;
		for ( category in gadgetsByCategory ) {
			if ( category !== '' ) {
				$newContainer.append( $( '<h1>' ).text( categoryNames[category] ) );
			}
			for ( gadget in gadgetsByCategory[category] ) {
				// Find the item belonging to this gadget in $oldContainer
				$oldItem = $oldContainer
					.find( '#mw-input-wpgadgetsshared-' + gadget )
					.closest( '.mw-htmlform-multiselect-item' );
				// Update the label text
				$oldItem.find( 'label' ).text( gadgetsByCategory[category][gadget] );
				// Move the item from $oldContainer to $newContainer
				$newContainer.append( $oldItem );
			}
		}
		$oldContainer.replaceWith( $newContainer );
		// Unhide the container by removing the unloaded class, and remove the spinner too
		$spinner.removeClass( 'mw-gadgetsshared-item-unloaded mw-ajax-loader' );
	}

	// Temporary testing data
	var categoryNames = {
		'foo': 'The Foreign Category of Foo'
	};
	// TODO: Actually fetch this info using AJAX
	// TODO: This structure allows cross-pollination of categories when multiple foreign repos are involved, do we want that?
	// I guess probably not, because we wouldn't even know where to pull the category message from to begin with.
	// Probably needs an extra level for the repo.
	var gadgetsByCategory = {
		'': {
			'b': 'Gadget B',
			'UTCLiveClock': 'A clock that displays UTC time blah blah blah'
		},
		'foo': {
			'a': 'Gadget A'
		}
	};

	$( function() {
		// TODO make all of this nicer once we have AJAX
		// Add spinner
		$( '#mw-prefsection-gadgetsshared').find( '.mw-gadgetsshared-item-unloaded' ).addClass( 'mw-ajax-loader' );
		// Simulate AJAX delay
		setTimeout( function() { fixPreferenceForm( gadgetsByCategory, categoryNames ) }, 2000 );
	} );

} )( jQuery );
