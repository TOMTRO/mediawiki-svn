<?php

/**
 * Class holding information and functionallity specific to OpenLayers.
 * This infomation and features can be used by any mapping feature. 
 * 
 * @since 0.1
 * 
 * @file Maps_OpenLayers.php
 * @ingroup MapsOpenLayers
 * 
 * @author Jeroen De Dauw
 */
class MapsOpenLayers extends MapsMappingService {
	
	/**
	 * Constructor.
	 * 
	 * @since 0.6.6
	 */	
	function __construct( $serviceName ) {
		parent::__construct(
			$serviceName,
			array( 'layers', 'openlayer' )
		);
		
		global $wgResourceModules, $egMapsScriptPath;
		
		$wgResourceModules['ext.maps.openlayers'] = array(
			'localBasePath' => dirname( __FILE__ ),
			'remoteBasePath' => $egMapsScriptPath .  '/includes/services/OpenLayers',	
			'group' => 'ext.maps',
			'scripts' =>   array(
				'OpenLayers/OpenLayers.js',
				'ext.maps.openlayers.js'
			),
			'styles' => array(
				'OpenLayers/theme/default/style.css'
			),				
			'messages' => array(
				'maps-markers'
			)
		);		
	}	
	
	/**
	 * @see MapsMappingService::addParameterInfo
	 * 
	 * @since 0.7
	 */	
	public function addParameterInfo( array &$params ) {
		global $egMapsOLLayers, $egMapsOLControls;
		
		$params['zoom']->addCriteria( new CriterionInRange( 0, 19 ) );
		$params['zoom']->setDefault( self::getDefaultZoom() );		
		
		$params['controls'] = new ListParameter( 'controls' );
		$params['controls']->setDefault( $egMapsOLControls );
		$params['controls']->addCriteria( new CriterionInArray( self::getControlNames() ) );
		$params['controls']->addManipulations(
			new ParamManipulationFunctions( 'strtolower' )
		);
		
		$params['layers'] = new ListParameter( 'layers' );
		$params['layers']->addManipulations( new MapsParamOLLayers() );
		$params['layers']->setDoManipulationOfDefault( true );
		$params['layers']->addCriteria( new CriterionOLLayer() );
		$params['layers']->setDefault( $egMapsOLLayers );
		
		//$params['imagelayers'] = new ListParameter();
	}
	
	/**
	 * @see iMappingService::getDefaultZoom
	 * 
	 * @since 0.6.5
	 */	
	public function getDefaultZoom() {
		global $egMapsOpenLayersZoom;
		return $egMapsOpenLayersZoom;
	}		
	
	/**
	 * @see MapsMappingService::getMapId
	 * 
	 * @since 0.6.5
	 */
	public function getMapId( $increment = true ) {
		static $mapsOnThisPage = 0;
		
		if ( $increment ) {
			$mapsOnThisPage++;
		}
		
		return 'open_layer_' . $mapsOnThisPage;
	}		
	
	/**
	 * @see MapsMappingService::createMarkersJs
	 * 
	 * @since 0.6.5
	 */
	public function createMarkersJs( array $markers ) {
		$markerItems = array();
		$defaultGroup = wfMsg( 'maps-markers' );

		foreach ( $markers as $marker ) {
			$markerItems[] = MapsMapper::encodeJsVar( (object)array(
				'lat' => $marker[0],
				'lon' => $marker[1],
				'title' => $marker[2],
				'label' =>$marker[3],
				'icon' => $marker[4]
			) );
		}
		
		// Create a string containing the marker JS.
		return '[' . implode( ',', $markerItems ) . ']';
	}	
	
	/**
	 * Returns the names of all supported controls. 
	 * This data is a copy of the one used to actually translate the names
	 * into the controls, since this resides client side, in OpenLayerFunctions.js. 
	 * 
	 * @return array
	 */
	public static function getControlNames() {
		return array(
			'argparser', 'attribution', 'button', 'dragfeature', 'dragpan',
			'drawfeature', 'editingtoolbar', 'getfeature', 'keyboarddefaults', 'layerswitcher',
			'measure', 'modifyfeature', 'mousedefaults', 'mouseposition', 'mousetoolbar',
			'navigation', 'navigationhistory', 'navtoolbar', 'overviewmap', 'pan',
			'panel', 'panpanel', 'panzoom', 'panzoombar', 'autopanzoom', 'permalink',
			'scale', 'scaleline', 'selectfeature', 'snapping', 'split',
			'wmsgetfeatureinfo', 'zoombox', 'zoomin', 'zoomout', 'zoompanel',
			'zoomtomaxextent'
		);
	}

	/**
	 * Returns the names of all supported dynamic layers.
	 * 
	 * @return array
	 */
	public static function getLayerNames( $includeGroups = false ) {
		global $egMapsOLAvailableLayers, $egMapsOLLayerGroups;
		
		$keys = array_keys( $egMapsOLAvailableLayers );
		
		if ( $includeGroups ) {
			$keys = array_merge( $keys, array_keys( $egMapsOLLayerGroups ) );
		}
		
		return $keys;
	}
	
	/**
	 * Adds the layer dependencies. 
	 * 
	 * @since 0.7.1
	 * 
	 * @param array $dependencies
	 */
	public function addLayerDependencies( array $dependencies ) {
		foreach ( $dependencies as $dependency ) {
			$this->addDependency( $dependency );
		}
	}
	
	/**
	 * @see MapsMappingService::getResourceModules
	 * 
	 * @since 0.7.3
	 * 
	 * @return array of string
	 */
	protected function getResourceModules() {
		return array_merge(
			parent::getResourceModules(),
			array( 'ext.maps.openlayers' )
		);
	}
	
}
