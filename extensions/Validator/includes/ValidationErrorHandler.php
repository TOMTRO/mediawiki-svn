<?php

/**
 * Static class for error handling.
 * 
 * @since 0.4
 * 
 * @file Validator_ErrorHandler.php
 * @ingroup Validator
 * 
 * @author Jeroen De Dauw
 */
final class ValidationErrorHandler {
	
	/**
	 * @since 0.4
	 * 
	 * @var array of ValidationError
	 */
	protected static $errors;
	
	/**
	 * Adds a single ValidationError.
	 * 
	 * @since 0.4
	 * 
	 * @param string $errorMessage
	 * @param integer $severity
	 */
	public static function addError( ValidationError $error ) {
		self::$errors[$error->element ? $error->element : 'unknown'][] = $error;
	}
	
	/**
	 * Adds a list of ValidationError.
	 * 
	 * @since 0.4
	 * 
	 * @param array $errors
	 */	
	public static function addErrors( array $errors ) {
		foreach ( $errors as $error ) {
			self::addError( $error );
		}
	}
	
	/**
	 * Returns a list of all registered errors.
	 * 
	 * @since 0.4
	 * 
	 * @return array of ValidationError
	 */
	public static function getErrors() {
		return self::$errors;
	}
	
}