<?php
/**
 * WebsiteSetup Business functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WebsiteSetup_Business
 */

/**
 * Load Kirki
 */
require get_template_directory() . '/kirki/kirki.php';

if ( ! function_exists( 'wsubusiness_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function wsubusiness_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on WebsiteSetup Business, use a find and replace
		 * to change 'wsubusiness' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'wsubusiness', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// Add support for Block Styles.
		add_theme_support( 'wp-block-styles' );

		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for editor styles.
		add_theme_support( 'editor-styles' );

		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1' => esc_html__( 'Primary', 'wsubusiness' ),
			'footer-menu-1' => esc_html__( 'Footer Menu', 'wsubusiness' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'wsubusiness_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 76,
			'width'       => 390,
			'flex-width'  => true,
			'flex-height' => true,
		) );

	}
endif;
add_action( 'after_setup_theme', 'wsubusiness_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function wsubusiness_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	// phpcs:ignore WPThemeReview.CoreFunctionality.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'wsubusiness_content_width', 764 );
}
add_action( 'after_setup_theme', 'wsubusiness_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function wsubusiness_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'CTA Top', 'wsubusiness' ),
		'id'            => 'cta-top-1',
		'description'   => esc_html__( 'Widgets will appear below the header.', 'wsubusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wsubusiness' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wsubusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'After Content', 'wsubusiness' ),
		'id'            => 'after-content-1',
		'description'   => esc_html__( 'Widgets will appear below the page and post\'s content', 'wsubusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'CTA Bottom', 'wsubusiness' ),
		'id'            => 'cta-bot-1',
		'description'   => esc_html__( 'Widgets will appear above the footer', 'wsubusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'wsubusiness' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Footer widgets.', 'wsubusiness' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'wsubusiness_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function wsubusiness_scripts() {

	wp_enqueue_style( 'wsubusiness-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wsubusiness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wsubusiness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'wsubusiness-scripts-js', get_template_directory_uri() . '/js/scripts.min.js', array(), '20190830', true);

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	//* Display custom color CSS in customizer and on frontend.
	// Proceeds if primary_color is changed
	if ( '#003acf' !== get_theme_mod( 'primary_color', '#003acf' ) ) {
		require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
		wp_add_inline_style( 'wsubusiness-style', wsubusiness_custom_colors_css() );	
	}

	//* Custom logo sizer
	$logo_size = get_theme_mod( 'custom_logo_size', 200);
	$container_size = get_theme_mod( 'custom_container_size', 1200);
	$logo_inline_style = '
		.custom-logo {
			max-width: ' . esc_html($logo_size) . 'px;
		}
		.container,
		.wp-block-cover__inner-container {
			max-width: ' . esc_html($container_size) . 'px;
		}
	';
	// Adds widget-title inline styles if title_widget_transform is changed
	if( 'uppercase' !== get_theme_mod( 'title_widget_transform', 'uppercase' ) ) {
		$logo_inline_style .= '
			.widget .widget-title {
				text-transform: ' . esc_html( get_theme_mod( 'title_widget_transform', 'uppercase' ) ) . '; 
				letter-spacing: 0;
			}
		';
	}
	wp_add_inline_style( 'wsubusiness-style', $logo_inline_style );

}
add_action( 'wp_enqueue_scripts', 'wsubusiness_scripts' );

/**
 * Enqueue the customizer stylesheet.
 */
function wsubusiness_enqueue_customizer_stylesheet() {
	wp_enqueue_style( 'wsubusiness-customizer-css', get_template_directory_uri() . '/css/customizer.css', NULL, NULL, 'all' );
}
add_action( 'customize_controls_print_styles', 'wsubusiness_enqueue_customizer_stylesheet' );


/**
 * Enqueue supplemental block editor styles.
 */
function wsubusiness_editor_customizer_styles() {

	wp_enqueue_style( 'wsubusiness-editor-customizer-styles', get_theme_file_uri( '/style-editor-customizer.css' ), false, '1.1', 'all' );

	// Include color patterns.
	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );
	wp_add_inline_style( 'wsubusiness-editor-customizer-styles', wsubusiness_custom_colors_css() );
}
add_action( 'enqueue_block_editor_assets', 'wsubusiness_editor_customizer_styles' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

/**
 * Theme Update Checker
 */
require 'plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/rolzan/wsubusiness',
	__FILE__,
	'wsubusiness'
);
//Optional: Set the branch that contains the stable release.
$myUpdateChecker->setBranch('stable');