<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package WebsiteSetup_Business
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function wsubusiness_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'wsubusiness_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function wsubusiness_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'wsubusiness_pingback_header' );

/**
 * Replaces the ellipses with "... Read more" on the_excerpt() function
 */
function wsubusiness_excerpt_readmore( $more ) {
    return '... <a href="'. get_permalink($post->ID) . '" class="readmore">' . 'Read more' . '</a>';
}
add_filter('excerpt_more', 'wsubusiness_excerpt_readmore');

/**
 * Modifies the hex color's brightness by steps
 * @source https://stackoverflow.com/questions/3512311/how-to-generate-lighter-darker-color-with-php
 */
function wsubusiness_adjust_brightness($hex, $steps) {
    // Steps should be between -255 and 255. Negative = darker, positive = lighter
    $steps = max(-255, min(255, $steps));

    // Normalize into a six character long hex string
    $hex = str_replace('#', '', $hex);
    if (strlen($hex) == 3) {
        $hex = str_repeat(substr($hex,0,1), 2).str_repeat(substr($hex,1,1), 2).str_repeat(substr($hex,2,1), 2);
    }

    // Split into three parts: R, G and B
    $color_parts = str_split($hex, 2);
    $return = '#';

    foreach ($color_parts as $color) {
        $color   = hexdec($color); // Convert to decimal
        $color   = max(0,min(255,$color + $steps)); // Adjust color
        $return .= str_pad(dechex($color), 2, '0', STR_PAD_LEFT); // Make two char hex code
    }

    return $return;
}

/**
 * Disables Kirki Telemetry Module (stop sending notice)
 */
function wsubusiness_disable_telemetry( $switch ) {
	$switch = false;
	return $switch;
}
add_filter( 'kirki_telemetry', 'wsubusiness_disable_telemetry' );

/**
 * Applies wrapper div around aligned blocks.
 *
 * Copy this function into your WordPress theme's `functions.php` file
 * and change the `themeprefix` accordingly.
 *
 * @see   https://developer.wordpress.org/reference/hooks/render_block/
 * @link  https://codepen.io/webmandesign/post/gutenberg-full-width-alignment-in-wordpress-themes
 *
 * @param  string $block_content  The block content about to be appended.
 * @param  array  $block          The full block, including name and attributes.
 */
function wsubusiness_wrap_alignment( $block_content, $block ) {
    if ( isset( $block['attrs']['align'] ) && in_array( $block['attrs']['align'], array( 'wide', 'full' ) ) ) {
        $block_content = sprintf(
            '<div class="%1$s">%2$s</div>',
            'align-wrap align-wrap-' . esc_attr( $block['attrs']['align'] ),
            $block_content
        );
    }
    return $block_content;
}
add_filter( 'render_block', 'wsubusiness_wrap_alignment', 10, 2 );