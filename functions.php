<?php

// Defines
define( 'FL_CHILD_THEME_DIR', get_stylesheet_directory() );
define( 'FL_CHILD_THEME_URL', get_stylesheet_directory_uri() );

// Classes
require_once 'classes/class-fl-child-theme.php';

// Actions
add_action( 'fl_head', 'FLChildTheme::stylesheet' );
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}


//function mi_script() {
//	wp_register_script( 'mi', FL_CHILD_THEME_URL . '/js/mi.js', array( 'jquery' ), false, true );
//	wp_enqueue_script( 'mi' );
//}
//
//add_action( 'wp_enqueue_scripts', 'mi_script' );
function favicon4admin() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo('wpurl') . '/wp-content/uploads/2019/06/favicon.svg" />';
}
add_action( 'admin_head', 'favicon4admin' );


function load_template_part( $template_name, $part_name = null ) {
	ob_start();
	get_template_part( $template_name, $part_name );
	$var = ob_get_contents();
	ob_end_clean();

	return $var;
}


add_shortcode( 'mi_akz', function ( $atts ) {
	$atts   = shortcode_atts( array(
		'format' => 'inline',
	), $atts );
	$format = $atts['format'];
	$a[]    = 'MaiNetCare GmbH';
	// $a[]    = '';
	$a[]    = 'Tile-Wardenberg-Str. 13';
	$a[]    = 'D-10555 Berlin';
	$a[]    = '<a href="tel:+491795026607">Tel:&nbsp;+49&nbsp;(179)&nbsp;502.6607</a>';
	$a[]    = '<a href="mailto:info@mainetcare.com">E-Mail:&nbsp;info@mainetcare.com</a>';
	if ( $format == 'inline' ) {
		return implode( ', ', $a );
	} elseif ( $format == 'block' ) {
		return implode( '<br>', $a );
	} else {
		return implode( ' ', $a );
	}
} );

add_shortcode('mi_year', function () {
	return date('Y');
});

add_shortcode( 'mi_bank', function ( $atts ) {
	$atts   = shortcode_atts( array(
		'format' => 'block',
	), $atts );
	$format = $atts['format'];
	$a[]    = 'MaiNetCare';
	$a[]    = 'Volks- und Raiffeisenbank Rendsburg';
	$a[]    = 'IBAN ';
	$a[]    = 'BIC ';
	if ( $format == 'inline' ) {
		return implode( ', ', $a );
	} elseif ( $format == 'block' ) {
		return implode( '<br>', $a );
	} else {
		return implode( ' ', $a );
	}
} );














