/**
 * Creates an es.DocumentNode object.
 */
es.DocumentNode = function( nodes ) {
	if ( nodes === undefined ) {
		nodes = [];
	}
	$.extend( nodes, this );
	return nodes;
};

/**
 * Gets the range within this node that a given child node covers.
 * 
 * @method
 * @param {es.ModelNode} node
 */
es.DocumentNode.prototype.getRangeFromNode = function( node ) {
	if ( this.length ) {
		var i = 0,
			length = this.length,
			left = 0;
		while ( i < length ) {
			if ( this[i] === node ) {
				return new es.Range( left, left + this[i].getElementLength() );
			}
			left += this[i].getElementLength() + 1;
			i++;
		}
	}
	return null;
};

/**
 * Gets the content offset of a node.
 * 
 * This method is pretty expensive. If you need to get different slices of the same content, get
 * the content first, then slice it up locally.
 * 
 * @method
 * @param {es.DocumentModelNode} node Node to get offset of
 * @param {Boolean} [shallow] Do not iterate into child nodes of child nodes
 * @returns {Integer} Offset of node or -1 of node was not found
 */
es.DocumentNode.prototype.getOffsetFromNode = function( node, shallow ) {
	var offset = 0;
	if ( shallow ) {
		if ( this.length ) {
			for ( var i = 0; i < this.length; i++ ) {
				if ( this[i] === node ) {
					return offset;
				}
				offset += this[i].getElementLength() + 1;
			}
		}
	} else {
		var currentNode,
			iteration = [this, 0],
			iterations = [iteration];
		while ( iterations[0][0].length < iteration[0][1] ) {
			currentNode = iteration[0][iteration[1]];
			if ( currentNode === node ) {
				break;
			} else {
				if ( currentNode.length ) {
					// Include opening element when descending
					offset++;
					// Descend one level down
					iterations.push( [currentNode, 0] );
					iteration = iterations[iterations.length - 1];
				} else {
					// Include opening and closing when passing over
					offset += 2;
				}
			}
			iteration[1]++;
			if ( iteration[1] >= iteration[0].length ) {
				// Include closing element when ascending
				offset++;
				// Ascend one level up
				iterations.pop();
				iteration = iterations[iterations.length - 1];
			}
		}
	}
	return offset;
};

/**
 * Gets the node at a given offset.
 * 
 * This method is pretty expensive. If you need to get different slices of the same content, get
 * the content first, then slice it up locally.
 * 
 * TODO: Rewrite this method to not use recursion, because the function call overhead is expensive
 * 
 * @method
 * @param {Integer} offset Offset within this node to look for child node in
 * @param {Boolean} [shallow] Do not iterate into child nodes of child nodes
 * @returns {es.DocumentModelNode|null} Node at offset, or null if non was found
 */
es.DocumentNode.prototype.getNodeFromOffset = function( offset, shallow ) {
	var i,
		length;
	if ( shallow ) {
		if ( this.length ) {
			var left = 0,
				right;
			for ( i = 0, length = this.length; i < length; i++ ) {
				right = left + this[i].getElementLength() + 1;
				if ( offset >= left && offset < right ) {
					return this[i];
				}
				left = right;
			}
		}
		return null;
	} else {
		var nodeOffset = 0,
			nodeLength;
		for ( i = 0, length = this.length; i < length; i++ ) {
			nodeLength = this[i].getElementLength();
			if ( offset >= nodeOffset && offset < nodeOffset + nodeLength ) {
				return this[i].length ?
					this.getNodeFromOffset.call( this[i], offset - nodeOffset ) : this[i];
			}
			nodeOffset += nodeLength;
		}
		return null;
	}
};

/**
 * Gets a list of nodes and their sub-ranges which are covered by a given range.
 * 
 * @method
 * @param {es.Range} range Range to select nodes within
 * @param {Boolean} [off] Whether to include a list of nodes that are not covered by the range
 * @returns {Object} Object with 'on' and 'off' properties, 'on' being a list of objects with 'node'
 * and 'range' properties describing nodes which are covered by the range and the range within the
 * node that is covered, and 'off' being a list of nodes that are not covered by the range
 */
es.DocumentNode.prototype.selectNodes = function( range, off ) {
	range.normalize();
	var	result = { 'on': [], 'off': [] };
	for ( var i = 0, length = this.length, left = 0, right; i < length; i++ ) {
		right = left + this[i].getElementLength() + 1;
		if ( range.start >= left && range.start < right ) {
			if ( range.end < right ) {
				result.on.push( {
					'node': this[i],
					'range': new es.Range( range.start - left, range.end - left )
				} );
				if ( !off ) {
					break;
				}
			} else {
				result.on.push( {
					'node': this[i],
					'range': new es.Range( range.start - left, right - left - 1 )
				} );	
			}
		} else if ( range.end >= left && range.end < right ) {
			result.on.push( {
				'node': this[i],
				'range': new es.Range( 0, range.end - left )
			} );
			if ( !off ) {
				break;
			}
		} else if ( left >= range.start && right <= range.end ) {
			result.on.push( {
				'node': this[i],
				'range': new es.Range( 0, right - left - 1 )
			} );
		} else if( off ) {
			result.off.push( this[i] );
		}
		left = right;
	}
	return result;
};
