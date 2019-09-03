<?php
/**
 * The sidebar containing the After Content widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WebsiteSetup_Business
 */

if ( ! is_active_sidebar( 'after-content-1' ) ) {
	return;
}
?>

<aside class="after-content-widget-area">
	<?php dynamic_sidebar( 'after-content-1' ); ?>
</aside><!-- .after-content-widget-area -->
