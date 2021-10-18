<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Hetas_Twenty_Seventeen
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function hetas_twenty_seventeen_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	return $classes;
}
add_filter( 'body_class', 'hetas_twenty_seventeen_body_classes' );

/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function hetas_twenty_seventeen_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
add_action( 'wp_head', 'hetas_twenty_seventeen_pingback_header' );


function check_rhi_manufacturer_callback($post, $global_get) {
	if(isset($global_get['filter']) && $global_get['filter'] == 'boiler-maintenance' ) {
		$manufacturers_array = get_post_meta($post->ID, 'rhi_manufacturers');
		$manufacturers_ids = wp_list_pluck( $manufacturers_array[0], 'van_rhimanufacturerid' );
		if(in_array($global_get["boiler_maintenance_manufacturers"], $manufacturers_ids)) {
			return $post;
		}
		if(empty($global_get["boiler_maintenance_manufacturers"]) && !empty($global_get["postcode"])) {
			return $post;
		}
	}
	return $post;
}
add_filter('check_rhi_manufacturer', 'check_rhi_manufacturer_callback', 10, 2);