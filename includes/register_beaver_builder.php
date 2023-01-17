<?php


add_filter( 'fl_builder_color_presets', function ( $colors ) {
	$arrPalette = [
		'color-mnc-gruen'        => '#87a133',
		'color-mnc-text'         => '#3a3a3a',
		'color-mnc-blau'         => '#0e2c40',
		'color-mnc-hellblau'     => '#D1E7E5',
		'color-mnc-bg_blassblau' => '#F6FAFA',
		'color-mnc-infoblau'     => '#427adc',
		'color-mnc-bg_orange'    => '#FEFBF7',
		'color-mnc-error-border' => '#bf4d4d',
		'color-mnc-error-bg'     => '#fccfcc',
	];

	return array_values( $arrPalette );

} );

add_filter( 'fl_builder_loop_query_args', function ( $args ) {
	if ( isset( $args['s'] ) ) {
		$args['post_type'] = array( 'post' );
	}

	return $args;
} );

add_filter( 'fl_module_upload_regex', function ( $regex, $type, $ext, $file ) {
	$regex['photo'] = '#(jpe?g|png|gif|bmp|tiff?|webp|svg)#i';

	return $regex;
}, 10, 4 );




