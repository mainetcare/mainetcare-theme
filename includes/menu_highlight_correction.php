<?php


/**
 * If Sub-Page of Archive Page ist loaded, set highlight class to the Menu Item of the Archive:
 * (Highlight Parent)
 * mmai
 */
add_filter( 'nav_menu_css_class', function ($classes = array(), $menu_item = false ){

	// global $wp_query;

	if(! is_object($menu_item)) {
		return $classes;
	}

	if(in_array('current-menu-item', $menu_item->classes)){
		return $classes;
	}

	foreach([
		'post' => 'Blog'
	] as $post_type => $menu_title) {

		if ( $menu_item->title === $menu_title && (is_post_type_archive($post_type) || is_singular($post_type)) ) {
			$classes[] = 'current-menu-item';
		}

	}

	return $classes;
}, 10, 2 );