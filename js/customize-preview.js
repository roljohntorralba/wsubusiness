/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {

	// Primary color.
	/*
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html(),
				color;

			if( 'custom' === to ){
				// If a custom primary color is selected, use the currently set primary_color_hue
				color = wp.customize.get().primary_color_hue;
			} else {
				// If the "default" option is selected, get the default primary_color_hue
				color = 223;
			}

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( color + ',' );
			style.html( css ).data( 'hue', color );
		});
	});
	*/

	// Primary color hue.
	/*
	wp.customize( 'primary_color_hue', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-theme-colors' ),
				hue = style.data( 'hue' ),
				css = style.html();

			// Equivalent to css.replaceAll, with hue followed by comma to prevent values with units from being changed.
			css = css.split( hue + ',' ).join( to + ',' );
			style.html( css ).data( 'hue', to );
		});
	});

	// Image filter.
	wp.customize( 'image_filter', function( value ) {
		value.bind( function( to ) {
			if ( to ) {
				$( 'body' ).addClass( 'image-filters-enabled' );
			} else {
				$( 'body' ).removeClass( 'image-filters-enabled' );
			}
		} );
	} );
	*/

	// Header Text Color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-header-text-css' ),
				css = style.html(),
				regexHex = /#([a-f0-9]{3}){1,2}\b/gi; // regex pattern to select all HEX colors

			css = css.replace( regexHex, to );
			style.html( css );
		});
	});

	// Header Filter Color.
	wp.customize( 'header_filter_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-header-filter-css' ),
				css = style.html(),
				regexHex = /#([a-f0-9]{3}){1,2}\b/gi; // regex pattern to select all HEX colors

			css = css.replace( regexHex, to );
			style.html( css );
		});
	});

	// Primary Color.
	wp.customize( 'primary_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-primary-css' ),
				css = style.html(),
				regexHex = /#([a-f0-9]{3}){1,2}\b/gi; // regex pattern to select all HEX colors

			css = css.replace( regexHex, to );
			style.html( css );
		});
	});

	// Text Color.
	wp.customize( 'text_color', function( value ) {
		value.bind( function( to ) {

			// Update custom color CSS.
			var style = $( '#custom-colors-css' ),
				css = style.html(),
				regexHex = /#([a-f0-9]{3}){1,2}\b/gi; // regex pattern to select all HEX colors

			css = css.replace( regexHex, to );
			style.html( css );
		});
	});

	// Footer Background Color.
	wp.customize( 'footer_bg_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var target = $( '.site-footer' );
			target.css('background-color', to);
		});
	});
	// Footer Text Color.
	wp.customize( 'footer_text_color', function( value ) {
		value.bind( function( to ) {
			// Update custom color CSS.
			var target = $( '.site-footer, .site-footer a' );
			target.css('color', to);
		});
	});


})( jQuery );
