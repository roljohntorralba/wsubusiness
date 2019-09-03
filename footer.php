<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WebsiteSetup_Business
 */

?>
		</div><!-- .site-content-inner -->
	</div><!-- #content -->

	<?php get_sidebar('ctabot'); ?>

	<footer class="site-footer">

		<?php get_sidebar('footer'); ?>

		<div class="site-footer-inner container">
			<div id="colophon" class="site-info">
				<?php if( get_theme_mod( 'footer_copyright_text' ) ) : ?>
					<?php printf( '%1$s', get_theme_mod('footer_copyright_text') ); ?>
				<?php else: ?>
					<a href="<?php echo esc_url( __( 'https://wordpress.org/', 'wsubusiness' ) ); ?>">
						<?php
						/* translators: %s: CMS name, i.e. WordPress. */
						printf( esc_html__( 'Proudly powered by %s', 'wsubusiness' ), 'WordPress' );
						?>
					</a>
					<span class="sep"> | </span>
						<?php
						/* translators: 1: Theme name, 2: Theme author. */
						printf( esc_html__( 'Theme: %1$s by %2$s.', 'wsubusiness' ), 'wsubusiness', '<a href="https://websitesetup.org">Website Setup</a>' );
						?>
				<?php endif; ?>
			</div><!-- .site-info -->
			<?php if( false != get_theme_mod( 'footer_menu_switch', false ) ) : ?>
				<div id="footer-menu-1" class="footer-menu">
					<?php
					wp_nav_menu( array(
						'theme_location' => 'footer-menu-1',
						'menu_id'        => 'footer-menu',
					) );
					?>
				</div>
			<?php endif; ?>
		</div><!-- .site-footer-inner -->
	</footer><!-- #colophon -->

	<?php if( true == get_theme_mod( 'footer_backtotop', true ) ) : ?>
		<a href="#" id="footer-back-to-top" class="back-to-top"><span class="screen-reader-text">Back to top</span></a>
	<?php endif; ?>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
