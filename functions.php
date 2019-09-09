<?php

/**
 * Define Constants
 */
define( 'CHILD_THEME_MAINETCARE_THEME_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */
function child_enqueue_styles() {
	wp_enqueue_style( 'astra-child-theme-css', get_stylesheet_directory_uri() . '/style.css', array( 'astra-theme-css' ), CHILD_THEME_MAINETCARE_THEME_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 15 );

// Load Google Fonts:
//function custom_add_google_fonts() {
//	wp_enqueue_style( 'custom-google-fonts', 'https://fonts.googleapis.com/css?family=Roboto:300,900|Slabo+27px&display=swap', false );
//}
//add_action( 'wp_enqueue_scripts', 'custom_add_google_fonts' );


add_filter( 'widget_text', 'do_shortcode' );

add_filter( 'upload_mimes', function ( $mime_types ) {
	$mime_types['svg'] = 'image/svg+xml'; //.svg hinzufügen

	return $mime_types;
}, 1, 1 );

// add Groteske Font from adobe in header:
//add_action( 'wp_head', function () {
//
//} );


//function mi_script() {
//	wp_register_script( 'mi', FL_CHILD_THEME_URL . '/js/mi.js', array( 'jquery' ), false, true );
//	wp_enqueue_script( 'mi' );
//}
//
//add_action( 'wp_enqueue_scripts', 'mi_script' );

add_action( 'admin_head', function () {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo( 'wpurl' ) . '/wp-content/uploads/2019/06/favicon.svg" />';
} );


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
	$a[] = 'Tile-Wardenberg-Str. 13';
	$a[] = 'D-10555 Berlin';
	$a[] = '<a href="tel:+491795026607">Tel:&nbsp;+49&nbsp;(179)&nbsp;502.6607</a>';
	$a[] = '<a href="mailto:info@mainetcare.com">E-Mail:&nbsp;info@mainetcare.com</a>';
	if ( $format == 'inline' ) {
		return implode( ', ', $a );
	} elseif ( $format == 'block' ) {
		return implode( '<br>', $a );
	} else {
		return implode( ' ', $a );
	}
} );

add_shortcode( 'mi_year', function () {
	return date( 'Y' );
} );

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

add_shortcode( 'skiptomain', function ( $atts ) {
	return '<a class="skip-main" href="#main">Zum Hauptinhalt</a>';
} );

add_shortcode( 'mi_year', function ( $atts ) {
	return date( 'Y' );
} );

add_shortcode( 'mi_email', function ( $atts ) {
	return '<a href="mailto:info@mainetcare.com">E-Mail:&nbsp;info@mainetcare.com</a>';
} );

add_shortcode( 'copyright', function ( $atts ) {
	return sprintf( '<span>© %s MaiNetCare GmbH</span>', date( 'Y' ) );
} );













