/**
 * Creates an es.TableBlockRowModel object.
 * 
 * @class
 * @constructor
 * @param documentModel {es.DocumentModel}
 * @param attributes {Object}
 * @property documentModel {es.DocumentModel}
 * @property attributes {Object}
 */
es.TableBlockCellModel = function( documentModel, attributes ) {
	es.ModelListItem.call( this );
	this.documentModel = documentModel || null;
	this.attributes = attributes || {};
};

/**
 * Creates an TableBlockCellModel object from a plain object.
 * 
 * @method
 * @static
 * @param obj {Object}
 */
es.TableBlockCellModel.newFromPlainObject = function( obj ) {
	return new es.TableBlockCellModel(
		// Cells - if given, convert plain document object to es.DocumentModel objects
		!$.isPlainObject( obj.document ) ? null : es.DocumentModel.newFromPlainObject( obj.document ),
		// Attributes - if given, make a deep copy of attributes
		!$.isPlainObject( obj.attributes ) ? {} : $.extend( true, {}, obj.attributes )
	);
};

/* Methods */

/**
 * Creates a view for this model
 */
es.TableBlockCellModel.prototype.createView = function() {
	return new es.TableBlockCellView( this );
};

/**
 * Gets the length of all content.
 * 
 * @method
 * @returns {Integer} Length of all content
 */
es.TableBlockCellModel.prototype.getContentLength = function() {
	return this.cells.getContentLength();
};

/**
 * Gets a plain table cell object.
 * 
 * @method
 * @returns obj {Object}
 */
es.TableBlockCellModel.prototype.getPlainObject = function() {
	/*
	var obj = {};
	if ( this.documentModel ) {
		obj.document = this.documentModel;
	}
	if ( !$.isEmptyObject( this.attributes ) ) {
		obj.attributes = $.extend( true, {}, this.attributes );
	}
	return obj;
	*/
};

es.TableBlockCellModel.prototype.commit = function( transaction ) {
	// TODO
};

es.TableBlockCellModel.prototype.rollback = function( transaction ) {
	// TODO
};

es.TableBlockCellModel.prototype.prepareInsertContent = function( offset, content ) {
	// TODO
};

es.TableBlockCellModel.prototype.prepareRemoveContent = function( range ) {
	// TODO
};

es.TableBlockCellModel.prototype.prepareAnnotateContent = function( range, annotation ) {
	// TODO
};

es.TableBlockCellModel.prototype.insertContent = function( offset, content ) {
	// TODO
};

es.TableBlockCellModel.prototype.removeContent = function( range ) {
	// TODO
};

es.TableBlockCellModel.prototype.annotateContent = function( range, annotation ) {
	// TODO
};

/* Inheritance */

es.extend( es.TableBlockCellModel, es.ModelListItem );