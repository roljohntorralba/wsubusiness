<?php
/**
 * WebsiteSetup Business Theme Customizer
 *
 * @package WebsiteSetup_Business
 */

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

	/**
	 * Primary color.
	 
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => 'default',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'wsubusiness_sanitize_color_option',
		)
	);

	$wp_customize->add_control(
		'primary_color',
		array(
			'type'     => 'radio',
			'label'    => __( 'Primary Color', 'wsubusiness' ),
			'choices'  => array(
				'default' => _x( 'Default', 'primary color', 'wsubusiness' ),
				'custom'  => _x( 'Custom', 'primary color', 'wsubusiness' ),
			),
			'section'  => 'colors',
			'priority' => 5,
		)
	);
	*/

	/*--------------------------------------------------------------
	 * Header Image Section: Controls and Settings
	 *-------------------------------------------------------------*/
	// Add Header Color Filter setting and control.
	$wp_customize->add_setting(
		'header_filter_color',
		array(
			'default'           => '#003acf',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);
	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'header_filter_color',
			array(
				'label'				=> __( 'Header Filter Color', 'wsubusiness' ),
				'section'     => 'colors',
				'priority'		=> 5,
			)
		)
	);

	/*--------------------------------------------------------------
	 * Global Colors: Controls and Settings
	 *-------------------------------------------------------------*/

	// Add Text Color setting and control.
	$wp_customize->add_setting(
		'text_color',
		array(
			'default'           => '#000000',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'text_color',
			array(
				'label'				=> __( 'Text Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Primary Color setting and control.
	$wp_customize->add_setting(
		'primary_color',
		array(
			'default'           => '#003acf',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'primary_color',
			array(
				'label'				=> __( 'Primary Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	/*--------------------------------------------------------------
	 * Footer Colors: Controls and Settings
	 *-------------------------------------------------------------*/

	// Add Footer Background Color setting and control.
	$wp_customize->add_setting(
		'footer_bg_color',
		array(
			'default'           => '#222222',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_bg_color',
			array(
				'label'				=> __( 'Footer Background Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Footer Text Color setting and control.
	$wp_customize->add_setting(
		'footer_text_color',
		array(
			'default'           => '#c9c9c9',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_text_color',
			array(
				'label'				=> __( 'Footer Text Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Footer Widget Background Color setting and control.
	$wp_customize->add_setting(
		'footer_widget_background_color',
		array(
			'default'           => '#0d1834',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_background_color',
			array(
				'label'				=> __( 'Footer Widget Background Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Footer Widget Heading Color setting and control.
	$wp_customize->add_setting(
		'footer_widget_heading_color',
		array(
			'default'           => '#6e7a9b',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_heading_color',
			array(
				'label'				=> __( 'Footer Widget Heading Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Footer Widget Heading Color setting and control.
	$wp_customize->add_setting(
		'footer_widget_text_color',
		array(
			'default'           => '#ffffff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_text_color',
			array(
				'label'				=> __( 'Footer Widget Text Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);

	// Add Footer Widget Link Color setting and control.
	$wp_customize->add_setting(
		'footer_widget_link_color',
		array(
			'default'           => '#8cacff',
			'transport'         => 'postMessage',
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'footer_widget_link_color',
			array(
				'label'				=> __( 'Footer Widget Link Color', 'wsubusiness' ),
				'section'     => 'colors',
			)
		)
	);



	/*
	// Add image filter setting and control.
	$wp_customize->add_setting(
		'image_filter',
		array(
			'default'           => 1,
			'sanitize_callback' => 'absint',
			'transport'         => 'postMessage',
		)
	);

	$wp_customize->add_control(
		'image_filter',
		array(
			'label'   => __( 'Apply a filter to featured images using the primary color', 'wsubusiness' ),
			'section' => 'colors',
			'type'    => 'checkbox',
		)
	);
	*/
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
