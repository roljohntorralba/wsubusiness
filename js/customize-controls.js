/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */

(function() {

	wp.customize.bind( 'ready', function() {

		// Only show the logo size when a custom logo is uploaded
		
		wp.customize( 'custom_logo', function( setting ) {
			wp.customize.control( 'custom_logo_size', function( control ) {
				var visibility = function() {
					if ( setting.get() ) {
						control.container.slideDown( 180 );
					} else {
						control.container.slideUp( 180 );
					}
				};

				visibility();
				setting.bind( visibility );
			});
		});
	});
	

})( jQuery );
