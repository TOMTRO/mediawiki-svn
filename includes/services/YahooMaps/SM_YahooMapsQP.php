<?php

/**
 * A query printer for maps using the Yahoo Maps API.
 *
 * @file SM_YahooMapsQP.php
 * @ingroup SMYahooMaps
 *
 * @author Jeroen De Dauw
 */
class SMYahooMapsQP extends SMMapPrinter {

	/**
	 * @see SMMapPrinter::getServiceName
	 */		
	protected function getServiceName() {
		return 'yahoomaps';
	}	
	
	/**
	 * @see SMMapPrinter::addSpecificMapHTML
	 */
	public function addSpecificMapHTML() {
		return Html::element(
			'div',
			array(
				'id' => $this->service->getMapId(),
				'style' => "width: $this->width; height: $this->height; background-color: #cccccc; overflow: hidden;",
			),
			wfMsg( 'maps-loading-map' )
		);
	}

	/**
	 * Returns type info, descriptions and allowed values for this QP's parameters after adding the
	 * specific ones to the list.
	 * 
	 * @return array
	 */
    public function getParameters() {
        $params = parent::getParameters();
        
        $allowedTypes = MapsYahooMaps::getTypeNames();
        
        $params[] = array( 'name' => 'controls', 'type' => 'enum-list', 'description' => wfMsg( 'semanticmaps_paramdesc_controls' ), 'values' => MapsYahooMaps::getControlNames() );
        $params[] = array( 'name' => 'types', 'type' => 'enum-list', 'description' => wfMsg( 'semanticmaps_paramdesc_types' ), 'values' => $allowedTypes );
        $params[] = array( 'name' => 'type', 'type' => 'enumeration', 'description' => wfMsg( 'semanticmaps_paramdesc_type' ), 'values' => $allowedTypes );
        $params[] = array( 'name' => 'autozoom', 'type' => 'enumeration', 'description' => wfMsg( 'semanticmaps_paramdesc_autozoom' ), 'values' => array( 'on', 'off' ) );
        
        return $params;
    }
	
}