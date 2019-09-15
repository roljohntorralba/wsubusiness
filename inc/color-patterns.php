<?php
/**
 * WebsiteSetup Business Color Patterns
 *
 * @package WordPress
 * @subpackage TwentyNineteen
 * @since 1.0
 */

/**
 * Generate the CSS for the current primary color.
 */
function wsubusiness_custom_colors_css() {

	$primary_color = '#003acf';
	if ( '#003acf' !== get_theme_mod( 'primary_color', '#003acf' ) ) {
		$primary_color = get_theme_mod( 'primary_color', '#003acf' );
	}

	$theme_css = '
		.main-navigation .sub-menu,
		.sticky-post,
		.entry-content .wp-block-button .wp-block-button__link:not(.has-background),
		.button, button, input[type="button"], input[type="reset"], input[type="submit"],
		.entry-content > .has-primary-background-color,
		.entry-content > *[class^="wp-block-"].has-primary-background-color,
		.entry-content > *[class^="wp-block-"] .has-primary-background-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color.has-primary-background-color,
		.entry-content .wp-block-file .wp-block-file__button,
		.main-navigation .sub-menu > li > a:hover,
		.main-navigation .sub-menu > li > a:focus,
		.main-navigation .sub-menu > li > a:hover:after,
		.main-navigation .sub-menu > li > a:focus:after,
		.main-navigation .sub-menu > li > .menu-item-link-return:hover,
		.main-navigation .sub-menu > li > .menu-item-link-return:focus,
		.main-navigation .sub-menu > li > a:not(.submenu-expand):hover,
		.main-navigation .sub-menu > li > a:not(.submenu-expand):focus,
		.entry-content > .has-secondary-background-color,
		.entry-content > *[class^="wp-block-"].has-secondary-background-color,
		.entry-content > *[class^="wp-block-"] .has-secondary-background-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color.has-secondary-background-color,
		ul.page-numbers li .page-numbers.current, ol.page-numbers li .page-numbers.current,
		.widget_price_filter .ui-slider .ui-slider-handle {
			background-color: ' . $primary_color . ';
		}

		a,
		.main-navigation .main-menu > li,
		.main-navigation ul.main-menu > li > a,
		.post-navigation .post-title,
		.entry-meta a:hover,
		.entry-footer a:hover,
		.entry-content .more-link:hover,
		.main-navigation .main-menu > li > a + svg,
		.comment .comment-metadata > a:hover,
		.comment .comment-metadata .comment-edit-link:hover,
		#colophon .site-info a:hover,
		.widget a:not(.button),
		.entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.entry-content > .has-primary-color,
		.entry-content > *[class^="wp-block-"] .has-primary-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-primary-color p,
		a:hover, a:active,
		.main-navigation .main-menu > li > a:hover,
		.main-navigation .main-menu > li > a:hover + svg,
		.post-navigation .nav-links a:hover,
		.post-navigation .nav-links a:hover .post-title,
		.author-bio .author-description .author-link:hover,
		.entry-content > .has-secondary-color,
		.entry-content > *[class^="wp-block-"] .has-secondary-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color,
		.entry-content > *[class^="wp-block-"].is-style-solid-color blockquote.has-secondary-color p,
		.comment .comment-author .fn a:hover,
		.comment-reply-link:hover,
		.comment-navigation .nav-previous a:hover,
		.comment-navigation .nav-next a:hover,
		#cancel-comment-reply-link:hover,
		.widget a:hover:not(.button),
		ul.page-numbers li .page-numbers, ol.page-numbers li .page-numbers,
		.entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
			color: ' . $primary_color . ';
		}

		blockquote,
		.entry-content blockquote,
		.entry-content .wp-block-quote:not(.is-large),
		.entry-content .wp-block-quote:not(.is-style-large),
		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		input[type="number"]:focus,
		input[type="tel"]:focus,
		input[type="range"]:focus,
		input[type="date"]:focus,
		input[type="month"]:focus,
		input[type="week"]:focus,
		input[type="time"]:focus,
		input[type="datetime"]:focus,
		input[type="datetime-local"]:focus,
		input[type="color"]:focus,
		textarea:focus,
		.entry-content .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color) {
			border-color: ' . $primary_color . ';
		}
		
		.gallery-item > div > a:focus {
			box-shadow: 0 0 0 2px ' . $primary_color . ';
		}

		/* Text selection colors */
		::selection {
			background-color: ' . wsubusiness_adjust_brightness( $primary_color, 90 ) . ';
		}
		::-moz-selection {
			background-color: ' . wsubusiness_adjust_brightness( $primary_color, 90 ) . ';
		}

		.bypostauthor .comment-content {
			background-color: ' . wsubusiness_adjust_brightness( $primary_color, 50 )  . ';
		}

		ul.page-numbers li .page-numbers, ol.page-numbers li .page-numbers {
			border-color: ' . wsubusiness_adjust_brightness( $primary_color, 50 ) . ';
		}
		ul.page-numbers li:last-child .page-numbers, ol.page-numbers li:last-child .page-numbers {
			border-color: ' . wsubusiness_adjust_brightness( $primary_color, 50 ) . ';	
		}
		.widget_price_filter .ui-slider .ui-slider-range {
			background-color: ' . wsubusiness_adjust_brightness( $primary_color, 30 ) . ';	
		}

		';

	$editor_css = '
		/*
		 * Set colors for:
		 * - links
		 * - blockquote
		 * - pullquote (solid color)
		 * - buttons
		 */
		.editor-block-list__layout .editor-block-list__block a,
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:hover .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:focus .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-button.is-style-outline:active .wp-block-button__link:not(.has-text-color),
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink {
			color: ' . $primary_color . ';
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-quote:not(.is-large):not(.is-style-large),
		.editor-styles-wrapper .editor-block-list__layout .wp-block-freeform blockquote {
			border-color: ' . $primary_color . ';
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color:not(.has-background-color) {
			background-color: ' . $primary_color . ';
		}

		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__button,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:focus,
		.editor-block-list__layout .editor-block-list__block .wp-block-button:not(.is-style-outline) .wp-block-button__link:hover {
			background-color: ' . $primary_color . ';
		}

		/* Hover colors */
		.editor-block-list__layout .editor-block-list__block a:hover,
		.editor-block-list__layout .editor-block-list__block a:active,
		.editor-block-list__layout .editor-block-list__block .wp-block-file .wp-block-file__textlink:hover {
			color: ' . $primary_color . ';
		}

		/* Do not overwrite solid color pullquote or cover links */
		.editor-block-list__layout .editor-block-list__block .wp-block-pullquote.is-style-solid-color a,
		.editor-block-list__layout .editor-block-list__block .wp-block-cover a {
			color: inherit;
		}
		';

	if ( function_exists( 'register_block_type' ) && is_admin() ) {
		$theme_css = $editor_css;
	}

	/**
	 * Filters Twenty Nineteen custom colors CSS.
	 *
	 * @since Twenty Nineteen 1.0
	 *
	 * @param string $css           Base theme colors CSS.
	 * @param int    $primary_color The user's selected color hue.
	 * @param string $saturation    Filtered theme color saturation level.
	 */
	return apply_filters( 'wsubusiness_custom_colors_css', $theme_css, $primary_color );
}
