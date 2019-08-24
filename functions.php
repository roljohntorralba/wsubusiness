<?php
/**
 * WebsiteSetup Business functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WebsiteSetup_Business
 */

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
			'height'      => 250,
			'width'       => 250,
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
		'name'          => esc_html__( 'Sidebar', 'wsubusiness' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'wsubusiness' ),
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
	// Enables Dashicons on Blog and Single Posts
	if ( get_post_type() == 'post' || is_home() ) {
		wp_enqueue_style('dashicons');
	}
	wp_enqueue_style( 'hamburgers-style', get_template_directory_uri() . '/css/hamburgers.min.css' );
	wp_enqueue_style( 'wsubusiness-style', get_stylesheet_uri() );

	wp_enqueue_script( 'wsubusiness-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'wsubusiness-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'wsubusiness_scripts' );

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
 * Display custom color CSS in customizer and on frontend.
 */
function wsubusiness_colors_css_wrap() {

	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && '#003acf' === get_theme_mod( 'primary_color', '#003acf' ) ) || is_admin() ) {
		return;
	}

	require_once get_parent_theme_file_path( '/inc/color-patterns.php' );

	$primary_color = get_theme_mod( 'primary_color', '#003acf');
	?>

	<style type="text/css" id="custom-primary-css">
		<?php echo wsubusiness_custom_colors_css(); ?>
	</style>
	<?php
}
add_action( 'wp_head', 'wsubusiness_colors_css_wrap' );

/**
 * Display custom text color CSS in customizer and on frontend.
 */
function wsubusiness_text_colors_css_wrap() {

	$text_color = get_theme_mod( 'text_color', '#000000' );
	$footer_bg = get_theme_mod( 'footer_bg_color', '#222222' );
	$footer_text = get_theme_mod( 'footer_text_color', '#c9c9c9' );

	$is_customized = '#000000' === $text_color && '#222222' === $footer_bg;
	// Only include custom colors in customizer or frontend.
	if ( ( ! is_customize_preview() && ( $is_customized ) ) || is_admin() ) {
		return;
	}
	?>

	<style type="text/css" id="custom-colors-css">
		/* text_color */
		body, .nav-links a {
			color: <?php echo esc_attr( $text_color ); ?>;
		}
		/* footer custom colors */
		.site-footer {
			background-color: <?php echo esc_attr( $footer_bg ); ?>;
			color: <?php echo esc_attr( $footer_text ); ?>;
		}
		.site-footer a {
			color: <?php echo esc_attr( $footer_text ); ?>;
		}
	</style>
	<?php
}
add_action( 'wp_head', 'wsubusiness_text_colors_css_wrap' );

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
