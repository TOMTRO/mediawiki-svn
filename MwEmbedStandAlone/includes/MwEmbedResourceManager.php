<?php
/**
 * MwEmbedResourceManager adds some convenience functions for loading mwEmbed 'modules'.
 *  Its shared between the mwEmbedStandAlone and the MwEmbed extension
 * 
 * @file
 * @ingroup Extensions
 */

class MwEmbedResourceManager {
	
	protected static $moduleSet = array();
	
	/**
	 * Register mwEmbeed resource set 
	 * 
	 * Adds modules to ResourceLoader
	 */
	public static function register( $mwEmbedResourcePath ) {
		global $IP, $wgExtensionMessagesFiles;
		$fullResourcePath = $IP .'/'. $mwEmbedResourcePath;
		
		// Get the module name from the end of the path: 
		$modulePathParts = explode( '/', $mwEmbedResourcePath );
		$moduleName =  array_pop ( $modulePathParts );
		if( !is_dir( $fullResourcePath ) ){
			throw new MWException( __METHOD__ . " not given readable path: "  . htmlspecialchars( $mwEmbedResourcePath ) );
		}
		
		if( substr( $mwEmbedResourcePath, -1 ) == '/' ){
			throw new MWException(  __METHOD__ . " path has trailing slash: " . htmlspecialchars( $mwEmbedResourcePath) );
		}
		
		// Add the messages to the extension messages set: 
		$wgExtensionMessagesFiles[ 'MwEmbed.' . $moduleName ] = $fullResourcePath . '/' . $moduleName . '.i18n.php';				
		
		// Get the mwEmbed module config		
		$moduleInfo = require_once( $fullResourcePath . '/' . $moduleName . '.php' );
		$resourceList = $moduleInfo['resources'];
		// Look for special 'messages' => 'moduleFile' key and load all modules file messages:
		foreach( $resourceList as $name => $resources ){
			if( isset( $resources['messageFile'] ) && is_file( $fullResourcePath . '/' .$resources['messageFile'] ) ){
				$resourceList[ $name ][ 'messages' ] = array();
				include( $fullResourcePath . '/' .$resources['messageFile'] );
				foreach( $messages['en'] as $msgKey => $na ){		
					 $resourceList[ $name ][ 'messages' ][] = $msgKey;
				}
			}
		};
		
		// If the module has a loader.js add it to the resource list: 
		if( is_file( $fullResourcePath . '/loader.js' ) ){
			$resourceList[$moduleName. '.loader'] = array( 'loaderScripts' => 'loader.js' );
		}
		// @@TODO add $moduleInfo['config']
		
		// Add the resource list into the module set with its provided path 
		self::$moduleSet[ $mwEmbedResourcePath ] = $resourceList;		
	}
	
	/**
	 * ResourceLoaderRegisterModules hook
	 * 
	 * Adds any mwEmbedResources to the ResourceLoader
	 */
	public static function registerModules( &$resourceLoader ) {
		global $IP;
		// Register all the resources with the resource loader
		foreach( self::$moduleSet as $path => $modules ) {
			foreach ( $modules as $name => $resources ) {							
				$resourceLoader->register(					
					// Resource loader expects trailing slash: 
					$name, new MwEmbedResourceLoaderFileModule( $resources, "$IP/$path", $path)
				);
			}
		}		
		// Continue module processing
		return true;
	}
	
	// Add the mwEmbed module to the page: 
	public static function addMwEmbedModule(  &$out, &$sk ){		
		// Add the mwEmbed module to the output
		$out->addModules( 'mwEmbed' );
		return true;	
	}
}