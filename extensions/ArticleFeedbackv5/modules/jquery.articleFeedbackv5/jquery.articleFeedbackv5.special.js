( function ( $ ) {
	$.articleFeedbackv5special = {};

	// TODO: Pass this in from the PHP side. Add it to mwConfig or w/e?
	//$.articleFeedbackv5special.page   = mw.config.get( 'wgPageId' );
	$.articleFeedbackv5special.page   = hackPageId;
	$.articleFeedbackv5special.filter = 'visible';
	$.articleFeedbackv5special.sort   = 'newest';
	$.articleFeedbackv5special.limit  = 5;
	$.articleFeedbackv5special.offset = 0;

	$.articleFeedbackv5special.apiUrl = mw.config.get( 'wgScriptPath' ) 
	 + '/api.php';


	$.articleFeedbackv5special.setBinds = function() {
		$( '#aft5-filter' ).bind( 'change', function(e) {
			$.articleFeedbackv5special.filter = $(this).val();
			$.articleFeedbackv5special.loadFeedback();
			return false;
		} );
		$( '#aft5-sort' ).bind( 'change', function(e) {
			$.articleFeedbackv5special.sort = $(this).val();
			$.articleFeedbackv5special.loadFeedback();
			return false;
		} );
		$( '#aft5-more' ).bind( 'click', function(e) {
			$.articleFeedbackv5special.offset += 
			 $.articleFeedbackv5special.limit;
			$.articleFeedbackv5special.loadFeedback();
			return false;
		} );
		$( '.aft5-abuse-link' ).live( 'click', function(e) {
			var id = $( this ).attr( 'id' ).replace( 'aft5-abuse-link-', '' );
			$.articleFeedbackv5special.abuseFeedback( id );
			return false;
		} );
		$( '.aft5-hide-link' ).live( 'click', function(e) {
			var id = $( this ).attr( 'id' ).replace( 'aft5-hide-link-', '' );
			$.articleFeedbackv5special.hideFeedback( id );
			return false;
		} );
	}

	$.articleFeedbackv5special.hideFeedback = function ( id ) {
		$.articleFeedbackv5special.flagFeedback( id, 'hide' );
	}

	$.articleFeedbackv5special.abuseFeedback = function ( id ) {
		$.articleFeedbackv5special.flagFeedback( id, 'abuse' );
	}

	// TODO: User ID?
	$.articleFeedbackv5special.flagFeedback = function ( id, type ) {
		$.ajax( {
			'url'     : $.articleFeedbackv5special.apiUrl,
			'type'    : 'POST',
'action': 'articlefeedbackv5',
			'dataType': 'json',
			'data'    : {
				'affeedbackid': id,
				'afflagtype'  : type,
				'format'      : 'json',
				'maxage'      : 0,
				'list'        : 'articlefeedbackv5-flag-feedback',
			},
			'success': function ( data ) {
				// TODO check output and error if needed
				$( '#aft5-' + type + '-link-' + id ).html(
					type + ' flag saved !'
				);
			}
			// TODO have a callback for failures.
		} );
		return false;
	}

	$.articleFeedbackv5special.loadFeedback = function () {
		$.ajax( {
			'url'     : $.articleFeedbackv5special.apiUrl,
			'type'    : 'GET',
			'dataType': 'json',
			'data'    : {
				'afpageid': $.articleFeedbackv5special.page,
				'affilter': $.articleFeedbackv5special.filter,
				'afsort'  : $.articleFeedbackv5special.sort,
				'aflimit' : $.articleFeedbackv5special.limit,
				'afoffset': $.articleFeedbackv5special.offset,
				'action'  : 'query',
				'format'  : 'json',
				'list'    : 'articlefeedbackv5-view-feedback',
				'maxage'  : 0,
			},
			'success': function ( data ) {
				// TODO check output and error if needed
				$( '#aft5-show-feedback' ).html(
$( '#aft5-show-feedback' ).html() + data.query['articlefeedbackv5-view-feedback'].feedback
				);
			}
			// TODO have a callback for failures.
		} );
		return false;
	}
} )( jQuery );

$( document ).ready( function() {
	$.articleFeedbackv5special.setBinds();
	$.articleFeedbackv5special.loadFeedback();
} );
