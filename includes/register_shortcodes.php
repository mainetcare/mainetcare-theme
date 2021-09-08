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

add_shortcode( 'check', function ( $atts ) {
	return mnc_icon_check();
} );

add_shortcode( 'mnc_custom_post', function () {
	$template = CHILD_THEME_DIR . '/templates/custom_post.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
} );

add_shortcode( 'mnc_item_top_stories', function () {
	$template = CHILD_THEME_DIR . '/templates/item_top_stories.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
} );

add_shortcode( 'mnc_custom_post', function () {
	$template = CHILD_THEME_DIR . '/templates/custom_post.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();
	return $html;
} );
