<?php
/**
 * The template for full width page or posts
 *
 * @package WebsiteSetup_Business
 * 
 * Template Name: Full Width
 * Template Post Type: post, page 
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">
		<?php do_action( 'in_site_main_top' ); ?>

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', get_post_type() );

			if( 'post' == get_post_type() ) {
				the_post_navigation();
			}

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>

		<?php do_action( 'in_site_main_above_aftercontent' ); ?>
		<?php get_sidebar('aftercontent'); ?>
		<?php do_action( 'in_site_main_bot' ); ?>
		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
