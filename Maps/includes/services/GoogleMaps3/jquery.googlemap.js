/**
 * JavasSript for Google Maps v3 maps in the Maps extension.
 * @see http://www.mediawiki.org/wiki/Extension:Maps
 * 
 * @author Jeroen De Dauw <jeroendedauw at gmail dot com>
 */

(function( $, mw ){ $.fn.googlemaps = function( options ) {

	var _this = this;
	
	/**
	 * All markers that are currently on the map.
	 * @type {Array}
	 * @private
	 */
	this.markers = [];
	
	/**
	 * Creates a new marker with the provided data,
	 * adds it to the map, and returns it.
	 * @param {Object} markerData Contains the fields lat, lon, title, text and icon
	 * @return {google.maps.Marker}
	 */
	this.addMarker = function( markerData ) {
		var markerOptions = {
			map: this.map,
			position: new google.maps.LatLng( markerData.lat , markerData.lon ),
			title: markerData.title
		};
		
		if ( markerData.icon != '' ) {
			markerOptions.icon = markerData.icon; 
		}
		
		var marker = new google.maps.Marker( markerOptions );
		
		marker.openWindow = false;
		
		if ( markerData.text != '' ) {
			marker.text = markerData.text;
			google.maps.event.addListener( marker, 'click', function() {
				if ( this.openWindow !== false ) {
					this.openWindow.close();
				}
				this.openWindow = new google.maps.InfoWindow( { content: this.text } );
				this.openWindow.closeclick = function() {
					marker.openWindow = false;
				};
				this.openWindow.open( map, this );					
			} );		
		}
		
		this.markers.push( marker );
		
		return marker;
	};
	
	/**
	 * Removes a single marker from the map.
	 * @param {google.maps.Marker} marker The marker to remove.
	 */
	this.removeMarker = function( marker ) {
		marker.setMap( null );
		
		for ( var i = this.markers.length - 1; i >= 0; i-- ) {
			if ( this.markers[i] === marker ) {
				delete this.markers[i];
				break;
			}
		}
		
		delete marker;
	};
	
	/**
	 * Removes all markers from the map.
	 */		
	this.removeMarkers = function() {
		for ( var i = this.markers.length - 1; i >= 0; i-- ) {
			this.markers[i].setMap( null );
		}
		this.markers = [];
	};
	
	var mapOptions = {
		disableDefaultUI: true,
		mapTypeId: options.type == 'earth' ? google.maps.MapTypeId.SATELLITE : eval( 'google.maps.MapTypeId.' + options.type )
	};
	this.options = options;
	
	// Map controls
	mapOptions.panControl = $.inArray( 'pan', options.controls ) != -1;
	mapOptions.zoomControl = $.inArray( 'zoom', options.controls ) != -1;
	mapOptions.mapTypeControl = $.inArray( 'type', options.controls ) != -1;
	mapOptions.scaleControl = $.inArray( 'scale', options.controls ) != -1;
	mapOptions.streetViewControl = $.inArray( 'streetview', options.controls ) != -1;

	// Map control styles
	mapOptions.zoomControlOptions = { style: eval( 'google.maps.ZoomControlStyle.' + options.zoomstyle ) }
	mapOptions.mapTypeControlOptions = { style: eval( 'google.maps.MapTypeControlStyle.' + options.typestyle ) }	

	var map = new google.maps.Map( this.get( 0 ), mapOptions );
	this.map = map;
	
	var markers = [];
	if ( !options.locations ) {
		options.locations = [];
	}
	
	// Add the markers.
	for ( var i = options.locations.length - 1; i >= 0; i-- ) {
		markers.push( this.addMarker( options.locations[i] ) );
	}
	
	// Add the Google KML/KMZ layers.
	for ( i = options.gkml.length - 1; i >= 0; i-- ) {
		var kmlLayer = new google.maps.KmlLayer( options.gkml[i], { map: map } );
	}
	
	// If there are any non-Google KML/KMZ layers, load the geoxml library and use it to add these layers.
	if ( options.kml.length != 0 ) {
		mw.loader.using( 'ext.maps.gm3.geoxml', function() {
			var geoXml = new geoXML3.parser( { map: map } );
			
			for ( i = options.kml.length - 1; i >= 0; i-- ) {
				geoXml.parse( options.kml[i] );
			}
		} );		
	}
	
	// If there are any non-Google KML/KMZ layers, load the geoxml library and use it to add these layers.
	if ( $.inArray( 'earth', options.types ) ) {
		mw.loader.using( 'ext.maps.gm3.earth', function() {
			var ge = new GoogleEarth( map );
		} );
		
		// Yay, IE seriously fails. Compat code for IE < 9. 
		if (!Array.prototype.filter)
		{
			Array.prototype.filter = function(fun /*, thisp */)
			{
				"use strict";

				if (this === void 0 || this === null)
					throw new TypeError();

				var t = Object(this);
				var len = t.length >>> 0;
				if (typeof fun !== "function")
					throw new TypeError();

				var res = [];
				var thisp = arguments[1];
				for (var i = 0; i < len; i++)
				{
					if (i in t)
					{
						var val = t[i]; // in case fun mutates this
						if (fun.call(thisp, val, i, t))
							res.push(val);
					}
				}

				return res;
			};
		}
		
		options.types.filter( function( element, index, array ) { return element != 'earth'; } );
	}
	
	// TODO: map types
	
	for ( i = options.fusiontables.length - 1; i >= 0; i-- ) {
		var ftLayer = new google.maps.FusionTablesLayer( options.fusiontables[i], { map: map } );
	}
	
	var layerMapping = {
		'traffic': 'new google.maps.TrafficLayer()',
		'bicycling': 'new google.maps.BicyclingLayer()'
	};
	
	for ( i = options.layers.length - 1; i >= 0; i-- ) {
		var layer = eval( layerMapping[options.layers[i]] );
		layer.setMap( map );
	}	
	
	var bounds;
	
	if ( ( options.centre === false || options.zoom === false ) && options.locations.length > 1 ) {
		bounds = new google.maps.LatLngBounds();

		for ( var i = markers.length - 1; i >= 0; i-- ) {
			bounds.extend( markers[i].getPosition() );
		}
	}
	
	if ( options.zoom === false ) {
		map.fitBounds( bounds );
	}
	else {
		map.setZoom( options.zoom );
	}
	
	var centre;
	
	if ( options.centre === false ) {
		if ( options.locations.length > 1 ) {
			centre = bounds.getCenter();
		}
		else if ( options.locations.length == 1 ) {
			centre = new google.maps.LatLng( options.locations[0].lat, options.locations[0].lon );
		}
		else {
			centre = new google.maps.LatLng( 0, 0 );
		}
	}
	else {
		centre = new google.maps.LatLng( options.centre.lat, options.centre.lon );
	}
	
	map.setCenter( centre );
	
	if ( options.autoinfowindows ) {
		for ( var i = markers.length - 1; i >= 0; i-- ) {
			google.maps.event.trigger( markers[i], 'click' );
		}		
	}
	
	if ( options.resizable ) {
		mw.loader.using( 'ext.maps.resizable', function() {
			_this.resizable();
		} );
	}
	
	return this;
	
}; })( jQuery, window.mediaWiki );