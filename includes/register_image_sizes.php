<?php
add_filter( 'sanitize_file_name', function ( $filename ) {
	$sanitized_filename = remove_accents( $filename ); // Convert to ASCII
	// Standard replacements
	$invalid            = array(
		' '   => '-',
		'%20' => '-',
		'_'   => '-',
	);
	$sanitized_filename = str_replace( array_keys( $invalid ), array_values( $invalid ), $sanitized_filename );
	$sanitized_filename = preg_replace( '/[^A-Za-z0-9-\. ]/', '', $sanitized_filename ); // Remove all non-alphanumeric except .
	$sanitized_filename = preg_replace( '/\.(?=.*\.)/', '', $sanitized_filename ); // Remove all but last .
	$sanitized_filename = preg_replace( '/-+/', '-', $sanitized_filename ); // Replace any more than one - in a row
	$sanitized_filename = str_replace( '-.', '.', $sanitized_filename ); // Remove last - if at the end

	return strtolower( $sanitized_filename );
}, 10, 1 );

add_action( 'after_setup_theme', function () {
	add_theme_support( 'post-thumbnails' );
	if ( function_exists( 'add_image_size' ) ) {
		add_image_size( 'hd-size', 1200, 0, false ); //(not cropped)
		add_image_size( 'medium-crop', 512, 512, true ); //( cropped)
	}
} );

add_filter( 'image_size_names_choose', function ( $sizes ) {
	return array_merge( $sizes, [
		"hd-size"     => __( "hd-size" ),
		"medium-crop" => __( "medium-crop" )
	] );
} );
