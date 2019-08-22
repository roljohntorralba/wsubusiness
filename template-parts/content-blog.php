<?php
/**
 * Template part for displaying posts in the blog
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WebsiteSetup_Business
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php wsubusiness_post_thumbnail(); ?>
		<?php
		the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		if ( 'post' === get_post_type() ) :
			?>
			<div class="entry-meta">
				<?php
				wsubusiness_posted_by();
				wsubusiness_posted_on();
				wsubusiness_posted_in();
				?>
			</div><!-- .entry-meta -->
		<?php endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_excerpt(); ?>
	</div><!-- .entry-content -->

</article><!-- #post-<?php the_ID(); ?> -->
