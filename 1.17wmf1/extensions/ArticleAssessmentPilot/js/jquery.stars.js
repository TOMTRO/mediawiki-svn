/*!
 * jQuery Stars v1
 * adapted by Adam Miller (acm6603@gmail.com)
 * 
 * Adapted from jQuery UI Stars v3.0.1
 * Marek "Orkan" Zajac (orkans@gmail.com)
 * http://plugins.jquery.com/project/Star_Rating_widget
 *
 */
(function($) {
$.stars = {
	defaults :  {
		inputType: 'radio', // [radio|select]
		split: 0, // decrease number of stars by splitting each star into pieces [2|3|4|...]
		disabled: false, // set to [true] to make the stars initially disabled
		cancelTitle: 'Cancel Rating',
		cancelValue: 0, // default value of Cancel btn.
		cancelShow: true,
		disableValue: true, // set to [false] to not disable the hidden input when Cancel btn is clicked, so the value will present in POST data.
		oneVoteOnly: false,
		showTitles: false,
		captionEl: null, // jQuery object - target for text captions 
		callback: null, // function(ui, type, value, event)
		/*
		 * CSS classes
		 */
		starWidth: 16, // width of the star image
		cancelClass: 'ui-stars-cancel',
		starClass: 'ui-stars-star',
		starOnClass: 'ui-stars-star-on',
		starHoverClass: 'ui-stars-star-hover',
		starDisabledClass: 'ui-stars-star-disabled',
		cancelHoverClass: 'ui-stars-cancel-hover',
		cancelDisabledClass: 'ui-stars-cancel-disabled'
	},
	create: function( ) {
		var self = this, o = this.options, starId = 0;
		this.element.data('former.stars', this.element.html());
		o.isSelect = o.inputType == 'select';
		this.$form = $(this.element).closest('form');
		this.$selec = o.isSelect ? $('select', this.element)  : null;
		this.$rboxs = o.isSelect ? $('option', this.$selec)   : $(':radio', this.element);
		/*
		 * Map all inputs from $rboxs array to Stars elements
		 */
		this.$stars = this.$rboxs.map(function(i)
		{
			var el = {
				value:      this.value,
				title:      (o.isSelect ? this.text : this.title) || this.value,
				isDefault:  (o.isSelect && this.defaultSelected) || this.defaultChecked
			};
			if(i==0) {
				o.split = typeof o.split != 'number' ? 0 : o.split;
				o.val2id = [];
				o.id2val = [];
				o.id2title = [];
				o.name = o.isSelect ? self.$selec.get(0).name : this.name;
				o.disabled = o.disabled || (o.isSelect ? $(self.$selec).attr('disabled') : $(this).attr('disabled'));
			}
			/*
			 * Consider it as a Cancel button?
			 */
			if(el.value == o.cancelValue) {
				o.cancelTitle = el.title;
				return null;
			}
			o.val2id[el.value] = starId;
			o.id2val[starId] = el.value;
			o.id2title[starId] = el.title;
			if(el.isDefault) {
				o.checked = starId;
				o.value = o.defaultValue = el.value;
				o.title = el.title;
			}
			var $s = $('<div/>').addClass(o.starClass);
			var $a = $('<a/>').attr('title', o.showTitles ? el.title : '').text(el.value);
			/*
			 * Prepare division settings
			 */
			if(o.split) {
				var oddeven = (starId % o.split);
				var stwidth = Math.floor(o.starWidth / o.split);
				$s.width(stwidth);
				$a.css('margin-left', '-' + (oddeven * stwidth) + 'px');
			}
			starId++;
			return $s.append($a).get(0);
		});
		/*
		 * How many Stars?
		 */
		o.items = starId;
		/*
		 * Remove old content
		 */
		o.isSelect ? this.$selec.remove() : this.$rboxs.remove();
		/*
		 * Append Stars interface
		 */
		this.$cancel = $('<div/>').addClass(o.cancelClass).append( $('<a/>').attr('title', o.showTitles ? o.cancelTitle : '').text(o.cancelValue) );
		o.cancelShow &= !o.disabled && !o.oneVoteOnly;
		o.cancelShow && this.element.append(this.$cancel);
		this.element.append(this.$stars);
		/*
		 * Initial selection
		 */
		if(o.checked === undefined) {
			o.checked = -1;
			o.value = o.defaultValue = o.cancelValue;
			o.title = '';
		}
		/*
		 * The only FORM element, that has been linked to the stars control. The value field is updated on each Star click event
		 */
		this.$value = $("<input type='hidden' name='"+o.name+"' value='"+o.value+"' />");
		this.element.append(this.$value);
		/*
		 * Attach stars event handler
		 */
		this.$stars.bind('click.stars', function(e) {
			if(!o.forceSelect && o.disabled) return false;
			var i = self.$stars.index(this);
			o.checked = i;
			o.value = o.id2val[i];
			o.title = o.id2title[i];
			self.$value.attr({disabled: o.disabled ? 'disabled' : '', value: o.value});
			fillTo(i, false);
			self.disableCancel();
			!o.forceSelect && self.callback(e, 'star');
		})
		.bind('mouseover.stars', function() {
			if(o.disabled) return false;
			var i = self.$stars.index(this);
			fillTo(i, true);
		})
		.bind('mouseout.stars', function() {
			if(o.disabled) return false;
			fillTo(self.options.checked, false);
		});
		/*
		 * Attach cancel event handler
		 */
		this.$cancel.bind('click.stars', function(e) {
			if(!o.forceSelect && (o.disabled || o.value == o.cancelValue)) return false;
			o.checked = -1;
			o.value = o.cancelValue;
			o.title = '';
			self.$value.val(o.value);
			o.disableValue && self.$value.attr({disabled: 'disabled'});
			fillNone();
			self.disableCancel();
			!o.forceSelect && self.callback(e, 'cancel');
		})
		.bind('mouseover.stars', function() {
			if(self.disableCancel()) return false;
			self.$cancel.addClass(o.cancelHoverClass);
			fillNone();
			self.showCap(o.cancelTitle);
		})
		.bind('mouseout.stars', function() {
			if(self.disableCancel()) return false;
			self.$cancel.removeClass(o.cancelHoverClass);
			self.$stars.triggerHandler('mouseout.stars');
		});
		/*
		 * Attach onReset event handler to the parent FORM
		 */
		this.$form.bind('reset.stars', function(){
			!o.disabled && self.select(o.defaultValue);
		});
		/*
		 * Clean up to avoid memory leaks in certain versions of IE 6
		 */
		// CHANGE: Only do this in IE, so as not to break bfcache in Firefox --catrope
		if ( window.attachEvent && !window.addEventListener ) {
			$(window).unload(function(){
				self.$cancel.unbind('.stars');
				self.$stars.unbind('.stars');
				self.$form.unbind('.stars');
				self.$selec = self.$rboxs = self.$stars = self.$value = self.$cancel = self.$form = null;
			});
		}
		/*
		 * Star selection helpers
		 */
		function fillTo(index, hover) {
			if(index != -1) {
				var addClass = hover ? o.starHoverClass : o.starOnClass;
				var remClass = hover ? o.starOnClass    : o.starHoverClass;
				self.$stars.eq(index).prevAll('.' + o.starClass).andSelf().removeClass(remClass).addClass(addClass);
				self.$stars.eq(index).nextAll('.' + o.starClass).removeClass(o.starHoverClass + ' ' + o.starOnClass);
				self.showCap(o.id2title[index]);
			}
			else fillNone();
		};
		function fillNone() {
			self.$stars.removeClass(o.starOnClass + ' ' + o.starHoverClass);
			self.showCap('');
		};
		/*
		 * Finally, set up the Stars
		 */
		this.select( o.value );
		o.disabled && this.disable();
	},
	/*
	 * Private functions
	 */
	disableCancel: function() {
		var o = this.options, disabled = o.disabled || o.oneVoteOnly || (o.value == o.cancelValue);
		if(disabled)  this.$cancel.removeClass(o.cancelHoverClass).addClass(o.cancelDisabledClass);
		else          this.$cancel.removeClass(o.cancelDisabledClass);
		this.$cancel.css('opacity', disabled ? 0.5 : 1);
		return disabled;
	},
	disableAll: function() {
		var o = this.options;
		this.disableCancel();
		if(o.disabled)  this.$stars.filter('div').addClass(o.starDisabledClass);
		else            this.$stars.filter('div').removeClass(o.starDisabledClass);
	},
	showCap: function(s) {
		var o = this.options;
		if(o.captionEl) o.captionEl.text(s);
	},
	/*
	 * Public functions
	 */
	value: function() {
		return this.options.value;
	},
	select: function( val ) {
		var o = this.options, e = (val == o.cancelValue) ? this.$cancel : this.$stars.eq(o.val2id[val]);
		o.forceSelect = true;
		e.triggerHandler('click.stars');
		o.forceSelect = false;
	},
	selectID: function(id) {
		var o = this.options, e = (id == -1) ? this.$cancel : this.$stars.eq(id);
		o.forceSelect = true;
		e.triggerHandler('click.stars');
		o.forceSelect = false;
	},
	enable: function() {
		this.options.disabled = false;
		this.disableAll();
	},
	disable: function() {
		this.options.disabled = true;
		this.disableAll();
	},
	destroy: function() {
		this.$form.unbind('.stars');
		this.$cancel.unbind('.stars').remove();
		this.$stars.unbind('.stars').remove();
		this.$value.remove();
		this.element.unbind('.stars').html(this.element.data('former.stars')).removeData('stars');
		return this;
	},
	callback: function(e, type) {
		var o = this.options;
		o.callback && o.callback(this, type, o.value, e);
		o.oneVoteOnly && !o.disabled && this.disable();
	}
}
$.fn.stars = function ( ) {
	// convert the arguments to an array
	var args = Array.prototype.slice.call(arguments);
	// default value to return -- overwritten by api calls
	var out = $( this );
	$( this ).each( function() {
		// get the context if it's already been initialized
		var context = $( this ).data( 'stars-context' );
		if ( typeof context == 'undefined' || context == null ) {
			// setup the context if it hasn't been yet
			context = $.extend( {}, {
				element: $( this ),
				options: $.stars.defaults
			}, $.stars );
		}
		// Handle various calling styles
		if ( args.length > 0 ) {
			if ( typeof args[0] == 'object' ) {
				// merge the passed options into defaults
				context.options = $.extend( {}, context.options, args[0] );
				// initialize
				$.stars.create.call( context );
			} else if ( typeof args[0] == 'string' ) {
				// API call 
				var funcName = args[0];
				// call the function, and if it returns something, store the output in our return var
				out = $.stars[funcName].call( context, args.slice(1) ) || out;
			}
		} else {
			// initialize with the defaults
			$.stars.create.call( context );
		}
		// save our context, bay-bee
		$( this ).data( 'stars-context', context );
	} );
	
	return out;
};
} )( jQuery );
