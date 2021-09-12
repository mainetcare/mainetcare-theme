<?php

/**
 * Define Constants
 */
define( 'CHILD_THEME_MAINETCARE_THEME_VERSION', '1.0.0' );
define( 'CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'CHILD_THEME_URL', get_stylesheet_directory_uri() );

add_action( 'wp_enqueue_scripts', function() {
	wp_enqueue_style( 'mnc-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-theme-css' ), CHILD_THEME_MAINETCARE_THEME_VERSION, 'all' );
	wp_scripts()->add_data( 'jquery', 'group', 1 );
	wp_scripts()->add_data( 'jquery-core', 'group', 1 );
	wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
}, 15 );

require_once CHILD_THEME_DIR . '/vendor/autoload.php';
include_once CHILD_THEME_DIR . '/includes/register_image_sizes.php';
include_once CHILD_THEME_DIR . '/includes/register_shortcodes.php';
include_once CHILD_THEME_DIR . '/includes/misc.php';






