<?php
/**
 * The sidebar containing the Footer widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WebsiteSetup_Business
 */

if ( ! is_active_sidebar( 'footer-1' ) ) {
	return;
}
?>

<div class="footer-widgets">
	<div class="footer-widgets-inner container">
		<?php dynamic_sidebar( 'footer-1' ); ?>
	</div>
</div>
