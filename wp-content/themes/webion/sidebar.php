<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Webion
 */

?>

<?php 

do_action( 'webion-theme/sidebar/before' );

if ( is_active_sidebar( 'sidebar' ) && 'none' !== webion_theme()->sidebar_position ) : ?>
	<aside id="secondary" <?php webion_secondary_content_class( array( 'widget-area' ) ); ?>>
		<?php dynamic_sidebar( 'sidebar' ); ?>
	</aside><!-- #secondary -->
<?php endif; 

do_action( 'webion-theme/sidebar/after' );
