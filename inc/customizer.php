<?php
/**
 * WebsiteSetup Business Theme Customizer
 *
 * @package 		WebsiteSetup_Business
 * @category    Core
 * @license     https://opensource.org/licenses/MIT
 * @since       3.0.12
 */

use Kirki\Util\Helper;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Do not proceed if Kirki does not exist.
if ( ! class_exists( 'Kirki' ) ) {
	return;
}

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function wsubusiness_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial(
			'blogname',
			array(
				'selector'        => '.site-title a',
				'render_callback' => 'wsubusiness_customize_partial_blogname',
			)
		);
		$wp_customize->selective_refresh->add_partial(
			'blogdescription',
			array(
				'selector'        => '.site-description',
				'render_callback' => 'wsubusiness_customize_partial_blogdescription',
			)
		);
	}
}
add_action( 'customize_register', 'wsubusiness_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function wsubusiness_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function wsubusiness_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Bind JS handlers to instantly live-preview changes.
 */
function wsubusiness_customize_preview_js() {
	wp_enqueue_script( 'wsubusiness-customize-preview', get_theme_file_uri( '/js/customize-preview.js' ), array( 'customize-preview' ), '20181231', true );
}
add_action( 'customize_preview_init', 'wsubusiness_customize_preview_js' );

/**
 * Load dynamic logic for the customizer controls area.
 */
function wsubusiness_panels_js() {
	wp_enqueue_script( 'wsubusiness-customize-controls', get_theme_file_uri( '/js/customize-controls.js' ), array(), '20181231', true );
}
add_action( 'customize_controls_enqueue_scripts', 'wsubusiness_panels_js' );

/**
 * Is active callback function for CTA Top Widget
 */
function wsubusiness_widget_cta_top_active() {
	if( is_active_sidebar( 'cta-top-1' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Is active callback function for After Content Widget
 */
function wsubusiness_widget_after_content_active() {
	if( is_active_sidebar( 'after-content-1' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Is active callback function for CTA Bottom Widget
 */
function wsubusiness_widget_cta_bottom_active() {
	if( is_active_sidebar( 'cta-bot-1' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Is active callback function for Footer Widget
 */
function wsubusiness_widget_footer_active() {
	if( is_active_sidebar( 'footer-1' ) ) {
		return true;
	} else {
		return false;
	}
}

/**
 * Is active callback function for all extra Widgets
 */
function wsubusiness_widgets_active() {
	if( is_active_sidebar( 'cta-top-1' ) && is_active_sidebar( 'after-content-1' ) && is_active_sidebar( 'cta-bot-1' ) && is_active_sidebar( 'footer-1' ) ) {
		return true;
	} else {
		return false;
	}
}

// Kirki configuration to make the theme unique
Kirki::add_config( 'wsubusiness_kirki', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

/**
 * Create sections
 */

// Add Typography section
Kirki::add_section( 'typography_options', array(
	'title'			=> esc_html__( 'Typography', 'wsubusiness' ),
	'priority'	=> 160,
) );

// Add Layout section
Kirki::add_section( 'layout_options', array(
	'title'			=> esc_html__( 'Site Layout', 'wsubusiness' ),
	'priority'	=> 160,
) );

// Add Footer section
Kirki::add_section( 'footer_options', array(
	'title'			=> esc_html__( 'Footer', 'wsubusiness' ),
	'priority'	=> 160,
) );

/**
 * Create controls and settings
 */

// Informative control----------------------------------------
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'divider_color_header',
	'label'       => '',
	'section'     => 'colors',
	'default'     => '<hr><div style="padding: 0.5rem;background-color: #333; color: #fff;">' . esc_html__( 'Header and Background controls', 'wsubusiness' ) . '</div>',
	'priority'    => 4,
) );

// Header Filter Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'header_filter_color',
	'label'			=> __( 'Header Filter Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#003acf',
	'priority'	=> 5,
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'.image-filters-enabled .site-header.featured-image .site-featured-image:before',
				'.image-filters-enabled .site-header.featured-image .site-featured-image:after',
				'.image-filters-enabled .entry .post-thumbnail:before',
				'.image-filters-enabled .entry .post-thumbnail:after'
			),
			'property' => 'background-color',
		)
	),
	'active_callback'	=> 'get_header_image'
) );

// Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'header_banner_text_color',
	'label'			=> __( 'Header Menu and Banner Text', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#000000',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'.main-navigation a:after',
				'.main-navigation .main-menu > li.menu-item-has-children:after',
				'.main-navigation li',
				'.site-header .entry-meta',
				'.site-header .entry-title',
				'.main-navigation a',
				'.site-featured-image a',
				'.main-navigation a:hover',
				'.site-featured-image a:hover',
				'.main-navigation a:active',
				'.site-featured-image a:active',
				'.main-navigation a:focus',
				'.site-featured-image a:focus',
				'.menu-toggle',
			),
			'property' => 'color',
		),
		array(
			'element' => array(
				'.hamburger-inner',
				'.hamburger-inner:after',
				'.hamburger-inner:before',
				'.hamburger.is-active .hamburger-inner',
				'.hamburger.is-active .hamburger-inner:after',
				'.hamburger.is-active .hamburger-inner:before',
			),
			'property' => 'background-color',
		)
	),
) );

// Informative control----------------------------------------
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'divider_color_content',
	'label'       => '',
	'section'     => 'colors',
	'default'     => '<hr><div style="padding: 0.5rem;background-color: #333; color: #fff;">' . esc_html__( 'Content controls', 'wsubusiness' ) . '</div>',
) );

// Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'text_color',
	'label'			=> __( 'Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#000000',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'body',
				'.nav-links a',
				'.entry-title a',
			),
			'property' => 'color',
		),
		array(
			'element' => array(
				'.woocommerce-EditAccountForm fieldset',
				'.shop_table',
				'.shop_table th',
				'.shop_table td',
				'.woocommerce-tabs ul.tabs li a',
				'.woocommerce-tabs .panel',
				'.widget_shopping_cart',
				
			),
			'property' => 'border-color',
		),
	),
) );

// Primary Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'primary_color',
	'label'			=> __( 'Primary Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#003acf',
	'transport'	=> 'postMessage',
) );

// Primary Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'primary_text_color',
	'label'			=> __( 'Primary Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#ffffff',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'button',
				'input[type="button"]',
				'input[type="reset"]',
				'input[type="submit"]',
				'.entry-content .wp-block-button .wp-block-button__link:not(.has-background)',
				'.bypostauthor .comment-content',
				'.button.primary',
				'.primary',
				'ul.page-numbers li .page-numbers.current',
				'ol.page-numbers li .page-numbers.current',
			),
			'property' => 'color',
		),
	),
) );

// Informative control short -----------
Kirki::add_field( 'theme_config_id', array( 'type' => 'custom', 'settings' => 'divider_short_accent', 'label' => '', 'section' => 'colors', 'default' => '<hr>',
) );

// Accent Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'accent_color',
	'label'			=> __( 'Accent Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#d01212',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'.button.secondary',
				'.secondary',
				'.woocommerce-mini-cart__buttons .button.checkout',
				'.onsale',
				'.shop_table button[name="update_cart"]',
			),
			'property' => 'background-color',
		),
	),
) );

// Accent Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'accent_text_color',
	'label'			=> __( 'Accent Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#ffffff',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array(
				'.button.secondary',
				'.secondary',
				'.woocommerce-mini-cart__buttons .button.checkout',
				'.onsale',
				'.shop_table button[name="update_cart"]',
			),
			'property' => 'color',
		),
	),
) );

// Informative control----------------------------------------
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'divider_color_widget',
	'label'       => '',
	'section'     => 'colors',
	'default'     => '<hr><div style="padding: 0.5rem;background-color: #333; color: #fff;">' . esc_html__( 'Widget controls', 'wsubusiness' ) . '</div>',
	'active_callback' => 'wsubusiness_widgets_active',
) );

// CTA Top Widget Background Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'cta_top_bg_color',
	'label'			=> __( 'CTA Top Widget Background', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#D4D9E6',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.cta-top-widget-area'),
			'property' => 'background-color',
		),
	),
	'active_callback' => 'wsubusiness_widget_cta_top_active',
) );

// CTA Top Widget Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'cta_top_text_color',
	'label'			=> __( 'CTA Top Widget Text', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#000000',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.cta-top-widget-area', '.cta-top-widget-area a'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_cta_top_active',
) );

// Informative control short -----------
Kirki::add_field( 'theme_config_id', array( 'type' => 'custom', 'settings' => 'divider_short_aftercontent', 'label' => '', 'section' => 'colors', 'default' => '<hr>', 'active_callback' => 'wsubusiness_widget_cta_top_active',
) );

// After Content Widget Background Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'after_content_bg_color',
	'label'			=> __( 'After Content Widget Background', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#D4D9E6',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.after-content-widget-area .widget'),
			'property' => 'background-color',
		),
	),
	'active_callback' => 'wsubusiness_widget_after_content_active',
) );

// After Content Widget Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'after_content_text_color',
	'label'			=> __( 'After Content Widget Text', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#000000',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.after-content-widget-area', '.after-content-widget-area a'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_after_content_active',
) );

// Informative control short -----------
Kirki::add_field( 'theme_config_id', array( 'type' => 'custom', 'settings' => 'divider_short_ctabot', 'label' => '', 'section' => 'colors', 'default' => '<hr>', 'active_callback' => 'wsubusiness_widget_after_content_active',
) );

// CTA Bottom Widget Background Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'cta_bot_bg_color',
	'label'			=> __( 'CTA Bottom Widget Background', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#002480',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.cta-bot-widget-area'),
			'property' => 'background-color',
		),
	),
	'active_callback' => 'wsubusiness_widget_cta_bottom_active',
) );

// CTA Bottom Widget Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'cta_bot_text_color',
	'label'			=> __( 'CTA Bottom Widget Text', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#ffffff',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.cta-bot-widget-area', '.cta-bot-widget-area a'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_cta_bottom_active',
) );

// Informative control short -----------
Kirki::add_field( 'theme_config_id', array( 'type' => 'custom', 'settings' => 'divider_short_footercolors', 'label' => '', 'section' => 'colors', 'default' => '<hr>', 'active_callback' => 'wsubusiness_widget_cta_bottom_active',
) );

// Footer Widget Background Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_widget_bg_color',
	'label'			=> __( 'Footer Widget Background Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#102251',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.footer-widgets'),
			'property' => 'background-color',
		),
	),
	'active_callback' => 'wsubusiness_widget_footer_active',
) );

// Footer Widget Heading Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_widget_heading_color',
	'label'			=> __( 'Footer Widget Heading Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#ffffff',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.footer-widgets .footer-widgets-inner .widget .widget-title'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_footer_active',
) );

// Footer Widget Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_widget_text_color',
	'label'			=> __( 'Footer Widget Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#BBCAF3',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.footer-widgets'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_footer_active',
) );

// Footer Widget Link Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_widget_link_color',
	'label'			=> __( 'Footer Widget Link Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#8cacff',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.footer-widgets .widget a:not(.button)'),
			'property' => 'color',
		),
	),
	'active_callback' => 'wsubusiness_widget_footer_active',
) );

// Informative control----------------------------------------
Kirki::add_field( 'theme_config_id', array(
	'type'        => 'custom',
	'settings'    => 'divider_color_footer',
	'label'       => '',
	'section'     => 'colors',
	'default'     => '<hr><div style="padding: 0.5rem;background-color: #333; color: #fff;">' . esc_html__( 'Footer controls', 'wsubusiness' ) . '</div>',
) );

// Footer Background Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_bg_color',
	'label'			=> __( 'Footer Background Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#222222',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => '.site-footer',
			'property' => 'background-color',
		),
	),
) );

// Footer Text Color
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'			=> 'color',
	'settings'	=> 'footer_text_color',
	'label'			=> __( 'Footer Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#c9c9c9',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( '.site-footer', '.site-footer a'),
			'property' => 'color',
		),
	),
) );

/* ----------------------------
 * End colors
 * ---------------------------*/

// Logo sizing
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'slider',
	'settings'    => 'custom_logo_size',
	'label'       => esc_html__( 'Logo size', 'wsubusiness' ),
	'section'     => 'title_tagline',
	'priority'		=> 9,
	'default'     => 200,
	'choices'     => array(
		'min'  => 100,
		'max'  => 600,
		'step' => 1,
	),
	'transport' 	=> 'postMessage',
	'js_vars'			=> array(
		array(
			'element' => '.custom-logo',
			'function' => 'css',
			'property' => 'max-width',
			'units' => 'px',
		),
	),
	'active_callback' => 'has_custom_logo',
) );

// Site container size
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'slider',
	'settings'    => 'custom_container_size',
	'label'       => esc_html__( 'Site container size', 'wsubusiness' ),
	'section'     => 'layout_options',
	'default'     => 1200,
	'choices'     => array(
		'min'  => 600,
		'max'  => 2000,
		'step' => 10,
	),
	'transport' 	=> 'postMessage',
	'js_vars'			=> array(
		array(
			'element' => '.container',
			'function' => 'css',
			'property' => 'max-width',
			'units' => 'px',
		),
		array(
			'element' => '.wp-block-cover__inner-container',
			'function' => 'css',
			'property' => 'max-width',
			'units' => 'px',
		)
	),
	'active_callback' => 'has_custom_logo',
) );

// Sidebar position select
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'radio-image',
	'settings'    => 'layout_sidebar_position',
	'label'       => esc_html__( 'Sidebar position', 'wsubusiness' ),
	'section'     => 'layout_options',
	'default'     => 'right',
	'choices'     => array(
		'right'   => get_template_directory_uri() . '/images/layout-sidebar-right.png',
		'left' => get_template_directory_uri() . '/images/layout-sidebar-left.png',
	),
) );

// Footer Copyright Text
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'     => 'text',
	'settings' => 'footer_copyright_text',
	'label'    => esc_html__( 'Copyright Text', 'wsubusiness' ),
	'section'  => 'footer_options',
	'default'  => '',
	'transport'=> 'postMessage',
) );

// Switch to hide or show the footer menu
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'switch',
	'settings'    => 'footer_menu_switch',
	'label'       => esc_html__( 'Footer Menu', 'kirki' ),
	'section'     => 'footer_options',
	'default'     => '0',
	'choices'     => array(
		'on'  => esc_html__( 'Show', 'kirki' ),
		'off' => esc_html__( 'Hide', 'kirki' ),
	),
) );

// Switch to hide or show the Back to Top button
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'switch',
	'settings'    => 'footer_backtotop',
	'label'       => esc_html__( 'Back to Top', 'kirki' ),
	'section'     => 'footer_options',
	'default'     => '1',
	'choices'     => array(
		'on'  => esc_html__( 'Show', 'kirki' ),
		'off' => esc_html__( 'Hide', 'kirki' ),
	),
) );

// Body Font
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_body',
	'label'       => esc_html__( 'Body Font', 'kirki' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif',
		'variant'        => 'regular',
		'line-height'    => '1.685',
		'text-transform' => 'none',
	),
	'priority'    => 10,
	'choices' => array(
		'fonts' => array(
			'google'   => array( 'popularity', 50 ),
			'standard' => array(
				'Georgia,Times,"Times New Roman",serif',
				'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif',
			),
		),
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => 'body',
		),
	),
) );

// Body Font
Kirki::add_field( 'wsubusiness_kirki', array(
	'type'        => 'typography',
	'settings'    => 'typography_headings',
	'label'       => esc_html__( 'Headings Font', 'kirki' ),
	'section'     => 'typography_options',
	'default'     => array(
		'font-family'    => '-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif',
		'variant'        => '700',
		'line-height'    => '1.2',
		'text-transform' => 'none',
	),
	'priority'    => 10,
	'choices' => array(
		'fonts' => array(
			'google'   => array( 'popularity', 50 ),
			'standard' => array(
				'Georgia,Times,"Times New Roman",serif',
				'-apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", sans-serif',
			),
		),
	),
	'transport'   => 'auto',
	'output'      => array(
		array(
			'element' => array(
				'h1',
				'h2',
				'h3',
				'h4',
				'h5',
				'h6',
			),
		),
	),
) );