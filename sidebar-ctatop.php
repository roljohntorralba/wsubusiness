<?php
/**
 * The sidebar containing the CTA Top widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WebsiteSetup_Business
 */

if ( ! is_active_sidebar( 'cta-top-1' ) ) {
	return;
}
?>

<?php do_action( 'above_cta_top' ); ?>
<aside class="cta-top-widget-area">
	<div class="container">
		<?php dynamic_sidebar( 'cta-top-1' ); ?>
	</div>
</aside><!-- .cta-top-widget-area -->
<?php do_action( 'below_cta_top' ); ?>