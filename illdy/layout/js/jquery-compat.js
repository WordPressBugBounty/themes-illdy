/**
 * jQuery 4 compatibility shim for the bundled plugins.
 *
 * jQuery 4.0 removed $.camelCase, $.type, $.isFunction, $.isArray, $.trim,
 * $.isNumeric and $.now. Owl Carousel 2.0.0 calls $.camelCase every time it
 * fires an event, so on jQuery 4 its first trigger throws and takes the rest
 * of document-ready down with it.
 *
 * The event aliases (.bind(), .delegate(), .click(), ...) are only deprecated
 * in 4.0 and still ship, but fancyBox, countTo and the sticky header call them
 * and a later major or the slim build drops them, so they are covered too.
 * .andSelf() went in jQuery 3.0 and was only ever restored by jQuery Migrate;
 * Owl Carousel calls it whenever it adds an item, so it is aliased to
 * .addBack() for sites that drop Migrate (see illdy_load_jquery_migrate).
 *
 * Every definition is guarded, so on jQuery 3.x this file does nothing. Not
 * `.load()`, which was both an AJAX method and an event alias and cannot be
 * shimmed unambiguously.
 *
 * @package Illdy
 */
( function ( $ ) {
	'use strict';

	if ( ! $ || ! $.fn ) {
		return;
	}

	if ( 'function' !== typeof $.fn.bind ) {
		$.fn.bind = function ( types, data, fn ) {
			return this.on( types, null, data, fn );
		};
	}

	if ( 'function' !== typeof $.fn.unbind ) {
		$.fn.unbind = function ( types, fn ) {
			return this.off( types, null, fn );
		};
	}

	if ( 'function' !== typeof $.fn.andSelf ) {
		$.fn.andSelf = $.fn.addBack;
	}

	if ( 'function' !== typeof $.fn.delegate ) {
		// Note the argument order flip: .delegate(selector, types, ...) maps to
		// .on(types, selector, ...).
		$.fn.delegate = function ( selector, types, data, fn ) {
			return this.on( types, selector, data, fn );
		};
	}

	if ( 'function' !== typeof $.fn.undelegate ) {
		$.fn.undelegate = function ( selector, types, fn ) {
			return 1 === arguments.length ?
				this.off( selector, '**' ) :
				this.off( types, selector || '**', fn );
		};
	}

	/*
	 * The per-event shorthand methods. fancyBox calls .click()/.focus() and the
	 * sticky header .resize()/.scroll(); any third-party widget may use others.
	 */
	'blur focus focusin focusout resize scroll click dblclick mousedown mouseup mousemove mouseover mouseout mouseenter mouseleave change select submit keydown keypress keyup contextmenu'
		.split( ' ' )
		.forEach( function ( name ) {
			if ( 'function' !== typeof $.fn[ name ] ) {
				$.fn[ name ] = function ( data, fn ) {
					return arguments.length > 0 ?
						this.on( name, null, data, fn ) :
						this.trigger( name );
				};
			}
		} );

	/*
	 * Utilities removed in jQuery 4. Owl Carousel uses $.camelCase() and
	 * $.isNumeric(); fancyBox $.type(), $.isFunction(), $.isArray(), $.trim()
	 * and $.isNumeric().
	 */
	if ( 'function' !== typeof $.type ) {
		var class2type = {};
		'Boolean Number String Function Array Date RegExp Object Error Symbol'
			.split( ' ' )
			.forEach( function ( name ) {
				class2type[ '[object ' + name + ']' ] = name.toLowerCase();
			} );

		$.type = function ( obj ) {
			if ( null == obj ) {
				return obj + '';
			}
			return 'object' === typeof obj || 'function' === typeof obj ?
				class2type[ Object.prototype.toString.call( obj ) ] || 'object' :
				typeof obj;
		};
	}

	if ( 'function' !== typeof $.isFunction ) {
		$.isFunction = function ( obj ) {
			return 'function' === typeof obj && 'number' !== typeof obj.nodeType;
		};
	}

	if ( 'function' !== typeof $.isArray ) {
		$.isArray = Array.isArray;
	}

	if ( 'function' !== typeof $.trim ) {
		$.trim = function ( text ) {
			return null == text ? '' : ( text + '' ).replace( /^[\s\uFEFF\xA0]+|[\s\uFEFF\xA0]+$/g, '' );
		};
	}

	if ( 'function' !== typeof $.isNumeric ) {
		$.isNumeric = function ( obj ) {
			var type = $.type( obj );
			return ( 'number' === type || 'string' === type ) && ! isNaN( obj - parseFloat( obj ) );
		};
	}

	if ( 'function' !== typeof $.camelCase ) {
		// jQuery 3's implementation, including its "-ms-" special case.
		$.camelCase = function ( string ) {
			return String( string ).replace( /^-ms-/, 'ms-' ).replace( /-([a-z])/g, function ( all, letter ) {
				return letter.toUpperCase();
			} );
		};
	}

	if ( 'function' !== typeof $.now ) {
		$.now = Date.now;
	}
}( jQuery ) );
