/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function( $ ) {

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

	// Footer Copyright Text
	wp.customize( 'footer_copyright_text', function( value ) {
		value.bind( function( to ) {

			var target = $( '#colophon' );

			target.html(to);
		});
	});

})( jQuery );
