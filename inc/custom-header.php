<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php the_header_image_tag(); ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package WebsiteSetup_Business
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses wsubusiness_header_style()
 */
function wsubusiness_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'wsubusiness_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '#000000',
		'width'                  => 1440,
		'height'                 => 600,
		'flex-height'            => true,
		'wp-head-callback'       => 'wsubusiness_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'wsubusiness_custom_header_setup' );

if ( ! function_exists( 'wsubusiness_header_style' ) ) :
	/**
	 * Styles the header image and text displayed on the blog.
	 *
	 * @see wsubusiness_custom_header_setup().
	 */
	function wsubusiness_header_style() {
		$header_text_color = get_header_textcolor();
		$header_filter_color = get_theme_mod( 'header_filter_color', '#003acf' );

		/*
		 * If no custom options for text are set, let's bail.
		 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
		 */
		if ( !get_header_image() && get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
			return;
		}

		// If we get this far, we have custom styles. Let's do this.
		if( get_theme_support( 'custom-header', 'default-text-color' ) !== $header_text_color ) :
			?>
			<style type="text/css" id="custom-header-text-css">
			<?php
			// Has the text been hidden?
			if ( ! display_header_text() ) :
				?>
				.site-title,
				.site-description {
					position: absolute;
					clip: rect(1px, 1px, 1px, 1px);
				}
			<?php
			// If the user has set a custom color for the text use that.
			else :
				?>
				.site-title a,
				.site-description,
				.main-navigation a:after,
				.main-navigation .main-menu > li.menu-item-has-children:after,
				.main-navigation li,
				.site-header .entry-meta,
				.site-header .entry-title {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}

				.main-navigation a,
				.site-featured-image a {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
					transition: opacity 0.2s ease-in-out;
				}
				.main-navigation a:hover,
				.site-featured-image a:hover,
				.main-navigation a:active,
				.site-featured-image a:active {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
					opacity: 0.6;
				}
				.main-navigation a:focus,
				.site-featured-image a:focus {
					color: #<?php echo esc_attr( $header_text_color ); ?>;
				}
			<?php endif; ?>
			</style>
			<?php
		endif;
		
		// Only show the header filter color CSS if a header image is set 
		if( get_header_image() ) :
			?>
			<style type="text/css" id="custom-header-filter-css">
				.image-filters-enabled .site-header.featured-image .site-featured-image:before,
				.image-filters-enabled .site-header.featured-image .site-featured-image:after,
				.image-filters-enabled .entry .post-thumbnail:before,
				.image-filters-enabled .entry .post-thumbnail:after {
					background-color: <?php echo esc_attr( $header_filter_color ); ?>;
				}
			</style>
			<?php
		endif;
	}
endif;
