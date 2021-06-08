<?php

add_shortcode( 'mnc_matomo_opt_out', function () {
	$template = CHILD_THEME_DIR . '/templates/matomo_opt_out.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
} );

// Use Yoast Breadcrumbs as Shortcode:
add_shortcode('yoastbc', function() {
	return yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
});

add_shortcode( 'mi_year', function () {
	return date( 'Y' );
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

// @todo is this used?
add_shortcode( 'check', function ( $atts ) {
	return mnc_icon_check();
} );


function mnc_icon_check( $content = '' ) {
	if ( $content == '' ) {
		return '<span>' . mnc_get_icon( 'check' ) . '</span>';
	}

	return '<span>' . mnc_get_icon( 'check' ) . '</span><span class="ml-2">' . $content . '</span>';
}

if(! function_exists( 'mnc_get_icon' )) {
	function mnc_get_icon( $icon_key ) {
		$prefix = wp_upload_dir()['basedir'] . '/svg/';
		// $prefix  = '/wp-content/uploads/svg/';
		$map  = [
			'email'    => 'email-24px.svg',
			'location' => 'room-24px.svg',
			'phone'    => 'call-24px.svg',
			'check'    => 'check-circle.svg',
			'clear'    => 'clear-24px.svg'
		];
		$path = $prefix . $map[ $icon_key ];
		if ( ! file_exists( $path ) ) {
			return 'Icon not found: ' . $path;
		}
		$icon = file_get_contents( $path );

		return str_replace( 'class=""', 'class="mnc-icon mnc-icon-' . $icon_key . '"', $icon );
	}
}
