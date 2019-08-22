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

	<footer id="colophon" class="site-footer">
		<div class="site-footer-inner container">
			<div class="site-info">
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
			</div><!-- .site-info -->
	</div><!-- .site-footer-inner -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
