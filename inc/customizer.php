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
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

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

// Kirki configuration to make the theme unique
Kirki::add_config( 'wsubusiness_kirki', array(
	'capability'    => 'edit_theme_options',
	'option_type'   => 'theme_mod',
) );

// Add Typography section
Kirki::add_section( 'typography_options', array(
	'title'			=> esc_html__( 'Typography', 'wsubusiness' ),
	'priority'	=> 90,
) );

// Add Footer section
Kirki::add_section( 'footer_options', array(
	'title'			=> esc_html__( 'Footer', 'wsubusiness' ),
	'priority'	=> 160,
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
	'settings'	=> 'text_color',
	'label'			=> __( 'Text Color', 'wsubusiness' ),
	'section'		=> 'colors',
	'default'		=> '#000000',
	'transport'	=> 'auto',
	'output'		=> array(
		array(
			'element' => array( 'body', '.nav-links a' ),
			'property' => 'color',
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
			'element' => array( '.footer-widgets a'),
			'property' => 'color',
		),
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
		'variant'        => 'regular',
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