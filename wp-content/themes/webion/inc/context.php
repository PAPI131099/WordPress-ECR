<?php
/**
 * Contextual functions for the header, footer, content and sidebar classes.
 *
 * @package Webion
 */

/**
 * Retrieve a CSS class attribute for container based on `Page Layout Type` option.
 *
 * @since  1.0.0
 * @param  string  $classes Additional classes.
 * @return string
 */
function webion_get_container_classes( $classes = null, $fullwidth = false ) {
	if ( $classes ) {
		$classes .= ' ';
	}

	if ( ! apply_filters( 'webion-theme/site/fullwidth', $fullwidth ) ) {
		$layout_type = webion_theme()->customizer->get_value( 'container_type' );

		if ( 'boxed' == $layout_type ) {
			$classes .= 'container';
		}
	}

	return 'class="' . $classes . '"';
}

/**
 * Prints site header container CSS classes
 *
 * @since   1.0.0
 * @param   string  $classes Additional classes.
 * @return  void
 */
function webion_header_class( $classes = null ) {
	if ( $classes ) {
		$classes .= ' ';
	}

	$layout = webion_theme()->customizer->get_value( 'header_layout_type' );

	$classes .= ' site-header__' . esc_attr( $layout );

	$classes .= ' site-header__wrap';

	$header_container_type = webion_theme()->customizer->get_value( 'header_container_type' );

	$classes .= 'fullwidth' != $header_container_type ? ' container' : ' container-fullwidth';

	$sticky = webion_theme()->customizer->get_value( 'is_sticky_mode' );

	if ( $sticky ) {
		$classes .= ' header-sticky';
	}

	echo 'class="' . apply_filters( 'webion-theme/site-header/content-classes', $classes ) . '"';
}

/**
 * Prints site content container CSS classes
 *
 * @since  1.0.0
 * @return string
 */
function webion_content_class( $classes = null ) {
	if ( $classes ) {
		$classes .= ' ';
	}
	
	$classes .= 'site-content__wrap';

	echo 'class="' . apply_filters( 'webion-theme/site-content/content-classes', $classes ) . '"';
}

/**
 * Prints site footer container CSS classes
 *
 * @since  1.0.0
 * @return string
 */
function webion_footer_class( $classes = null ) {
	if ( $classes ) {
		$classes .= ' ';
	}
	
	$classes .= 'site-footer__wrap';

	$site_content_container = apply_filters( 'webion-theme/site-footer/container-enabled', true );

	if ( $site_content_container ) {
		$classes .= ' container';
	}

	echo 'class="' . apply_filters( 'webion-theme/site-footer/content-classes', $classes ) . '"';
}

/**
 * Prints primary content wrapper CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function webion_primary_content_class( $classes = array() ) {
	echo webion_get_layout_classes( 'content', $classes );
}

/**
 * Prints secondary content wrapper CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function webion_secondary_content_class( $classes = array() ) {
	echo webion_get_layout_classes( 'sidebar', $classes );
}

/**
 * Get CSS class attribute for passed layout context.
 *
 * @since  1.0.0
 * @param  string $layout  Layout context.
 * @param  array  $classes Additional classes.
 * @return string
 */
function webion_get_layout_classes( $layout = 'content', $classes = array() ) {
	$sidebar_position = webion_theme()->sidebar_position;
	$sidebar_width    = webion_theme()->customizer->get_value( 'sidebar_width' );

	if ( 'none' === $sidebar_position || !is_active_sidebar( 'sidebar' ) ) {
		$sidebar_position = is_singular( 'post' ) ? 'single-post-fullwidth' : 'fullwidth';
		$sidebar_width = 0;

		$blog_layout_type = webion_theme()->customizer->get_value( 'blog_layout_type' );
		if( ( is_home() && ! is_front_page() || is_archive()  ) && $blog_layout_type == 'default' ) {
			$sidebar_position = 'fullwidth-blog-listing';
		}
	}

	if( class_exists( 'WooCommerce' ) && ( is_shop() && is_active_sidebar( 'sidebar-shop' ) ) ) {
		$sidebar_position = 'shop-layout';
	}

	$layout_classes = ! empty( webion_theme()->layout[ $sidebar_position ][ $sidebar_width ][ $layout ] ) ? webion_theme()->layout[ $sidebar_position ][ $sidebar_width ][ $layout ] : array();

	if ( ! empty( $classes ) ) {
		$layout_classes = array_merge( $layout_classes, $classes );
	}

	if ( empty( $layout_classes ) ) {
		return '';
	}

	$layout_classes = apply_filters( "webion-theme/wrapper/{$layout}_classes", $layout_classes );

	return 'class="' . join( ' ', $layout_classes ) . '"';
}

/**
 * Retrieve or print `class` attribute for Post List wrapper.
 *
 * @since  1.0.0
 * @param  string       $classes Additional classes.
 * @return string|void
 */
function webion_posts_list_class( $classes = null ) {
	if ( $classes ) {
		$classes .= ' ';
	}

	$classes .= 'posts-list';

	echo 'class="' . apply_filters( 'webion-theme/posts/list-class', $classes ) . '"';
}


/**
 * Prints site header CSS classes.
 *
 * @since  1.0.0
 * @param  array $classes Additional classes.
 * @return void
 */
function webion_site_branding_class( $classes = array() ) {
	$classes[] = 'site-branding';

	echo 'class="' . join( ' ', $classes ) . '"';
}
