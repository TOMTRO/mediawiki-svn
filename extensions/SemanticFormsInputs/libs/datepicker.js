/**
 * Javascript code to be used with input type datepicker.
 *
 * @author Stephan Gambke
 *
 */

function SFI_DP_init ( input_id, params ) {

	var inputShow = jQuery( '#' + input_id );
	inputShow.attr( 'id', input_id + '_show' );

	var input;

	if ( ! params.partOfDTP ) {
		
		input = jQuery( '<input type="hidden" >' );
		input.attr( {
			id: input_id,
			name: inputShow.attr( 'name' ),
			value: inputShow.val()
		} );
		
		inputShow.after( input );
		inputShow.removeAttr( 'name' );
	} else {
		input = inputShow;
	}
			
	
	var re = /\d{4}\/\d{2}\/\d{2}/

	if ( params.disabled ) {

		// append inert reset button if image is set
		if ( params.resetButtonImage && ! params.partOfDTP ) {
			inputShow.after( '<button type="button" class="ui-datepicker-trigger' + params.userClasses + '" disabled><img src="' + params.resetButtonImage + '" alt="..." title="..."></button>' );
		}

		// append inert datepicker button
		inputShow.after( '<button type="button" class="ui-datepicker-trigger' + params.userClasses + '" disabled><img src="' + params.buttonImage + '" alt="..." title="..."></button>' );

		// set value for input fields
		if ( re.test( params.currValue ) ) {
			inputShow.val( jQuery.datepicker.formatDate(params.dateFormat, jQuery.datepicker.parseDate( "yy/mm/dd", params.currValue, null ), null ) );
		} else {
			inputShow.val( params.currValue );
		}
		
	} else {

		// append reset button if image is set
		if ( params.resetButtonImage && ! params.partOfDTP ) {
			
			var resetbutton = jQuery( '<button type="button" class="ui-datepicker-trigger ' + params.userClasses + '" ><img src="' + params.resetButtonImage + '" alt="..." title="..."></button>' );
			inputShow.after( resetbutton );
			resetbutton.click( function(){
				inputShow.datepicker( 'setDate', null);
			})
		}

		inputShow.datepicker( {
			'showOn': 'both',
			'buttonImage': params.buttonImage,
			'buttonImageOnly': false,
			'changeMonth': true,
			'changeYear': true,
			'altFormat': 'yy/mm/dd',
			// Today button does not work (http://dev.jqueryui.com/ticket/4045)
			// do not show button panel for now
			// TODO: show date picker button panel when bug is fixed
			'showButtonPanel': false,
			'firstDay': params.firstDay,
			'showWeek': params.showWeek,
			'dateFormat': params.dateFormat,
			'beforeShowDay': function ( date ) {return SFI_DP_checkDate( '#' + input_id + '_show', date );}
		} );

		if ( ! params.partOfDTP ) {
			inputShow.datepicker( 'option', 'altField', input );
		}

		if ( params.minDate ) {
			inputShow.datepicker( 'option', 'minDate',
				jQuery.datepicker.parseDate( 'yy/mm/dd', params.minDate, null ) );
		}

		if ( params.maxDate ) {
			inputShow.datepicker( 'option', 'maxDate',
				jQuery.datepicker.parseDate( 'yy/mm/dd', params.maxDate, null ) );
		}

		if ( params.userClasses ) {
			inputShow.datepicker( 'widget' ).addClass( params.userClasses );
			jQuery( '#' + input_id + ' + button' ).addClass( params.userClasses );
		}

		if ( params.disabledDates ) {
			
			var disabledDates = new Array();

			for (i in params.disabledDates)
				disabledDates.push([
					new Date(params.disabledDates[i][0], params.disabledDates[i][1], params.disabledDates[i][2]),
					new Date(params.disabledDates[i][3], params.disabledDates[i][4], params.disabledDates[i][5])
				]);

			inputShow.datepicker( 'option', 'disabledDates', disabledDates );

			delete disabledDates;
		}

		if ( params.highlightedDates ) {

			var highlightedDates = new Array();

			for (i in params.highlightedDates)
				highlightedDates.push([
					new Date(params.highlightedDates[i][0], params.highlightedDates[i][1], params.highlightedDates[i][2]),
					new Date(params.highlightedDates[i][3], params.highlightedDates[i][4], params.highlightedDates[i][5])
				]);

			inputShow.datepicker( 'option', 'highlightedDates', highlightedDates );

			delete highlightedDates;
		}

		if (params.disabledDays) {
			inputShow.datepicker( 'option', 'disabledDays', params.disabledDays );
		}

		if (params.highlightedDays) {
			inputShow.datepicker( 'option', 'highlightedDays', params.highlightedDays );
		}

		if ( re.test( params.currValue ) ) {
			inputShow.datepicker( 'setDate', jQuery.datepicker.parseDate( 'yy/mm/dd', params.currValue, null ) );
		} else {
			
			inputShow.val( params.currValue );
			
			if (params.partOfDTP) {
				input.val( params.currValue );
			}
		}

		// delete date when user deletes input field
		inputShow.change(function() {

			if ( this.value == '' ) {
				inputShow.datepicker( 'setDate', null );
			}

		});
	}
}

/**
 * Checks a date if it is to be enabled or highlighted
 *
 * This function is a callback function given to the jQuery datepicker to be
 * called for every date before it is displayed.
 *
 * @param input the input the datepicker works on
 * @param date the date object that is to be displayed
 * @return Array(Boolean enabled, Boolean highlighted, "") determining the style and behaviour
 */
function SFI_DP_checkDate( input, date ) {

	var jInput = jQuery( input );

	var enable = true

	var disabledDays = jInput.datepicker( 'option', 'disabledDays' );

	if ( disabledDays ) {
		enable = !disabledDays[ date.getDay() ];
	}

	if ( enable ) {
		var disabledDates = jInput.datepicker( 'option', 'disabledDates' );

		if ( disabledDates ) {
			for ( i = 0; i < disabledDates.length; ++i ) {
				if ( (date >= disabledDates[i][0] ) && ( date <= disabledDates[i][1] ) ) {
					enable = false;
					break;
				}
			}
		}
	}

	var highlight = '';

	var highlightedDays = jInput.datepicker( 'option', 'highlightedDays' );

	if ( highlightedDays && highlightedDays[ date.getDay() ] ) {
		
		highlight = 'ui-state-highlight';
		
	} else {
		
		var highlightedDates = jInput.datepicker( 'option', 'highlightedDates' );

		if ( highlightedDates ) {
			for ( var i = 0; i < highlightedDates.length; ++i ) {
				if ( ( date >= highlightedDates[i][0] ) && ( date <= highlightedDates[i][1] ) ) {
					highlight = 'ui-state-highlight';
					break;
				}
			}
		}
	}

	return [ enable, highlight, '' ];
}
