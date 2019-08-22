<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WebsiteSetup_Business
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

	<?php if ( get_header_image() ) : ?>
		<style type="text/css">
			
		</style>
	<?php endif; ?>
</head>

<body <?php body_class('image-filters-enabled'); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wsubusiness' ); ?></a>

	<header id="masthead" class="site-header <?php $header_class = get_header_image() ? 'featured-image' : ''; echo $header_class; ?>">
		<div class="site-header-inner container">
			<div class="site-branding">
				<?php
				the_custom_logo();
				if ( is_front_page() && is_home() ) :
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				else :
					?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
				endif;
				$wsubusiness_description = get_bloginfo( 'description', 'display' );
				if ( $wsubusiness_description || is_customize_preview() ) :
					?>
					<p class="site-description"><?php echo $wsubusiness_description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">  
				<button class="menu-toggle hamburger hamburger--spin" aria-controls="primary-menu" aria-expanded="false">
					<?php esc_html_e( 'Menu', 'wsubusiness' ); ?>
					<span class="hamburger-box">
				    <span class="hamburger-inner"></span>
				  </span>
				</button>
				<?php
				wp_nav_menu( array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				) );
				?>
			</nav><!-- #site-navigation -->
		</div><!-- .site-header-inner -->

		<?php if( get_header_image() ) : ?>
			<div class="site-featured-image">

				<div class="post-thumbnail">
					<img src="<?php echo get_header_image(); ?>" alt="">
				</div>
				
				<?php if( is_singular() ) : ?>
					<div class="entry-header container">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
						<?php if ( 'post' === get_post_type() ) : ?>
							<div class="entry-meta">
								<?php
								wsubusiness_posted_by();
								wsubusiness_posted_on();
								wsubusiness_posted_in();
								?>
							</div><!-- .entry-meta -->
						<?php endif; ?>
					</div><!-- .entry-header -->
				<?php endif; ?>
			</div><!-- .site-featured-image -->
		<?php endif; ?>
		
	</header><!-- #masthead -->

	<div id="content" class="site-content">
		<div class="site-content-inner container clearfix">
