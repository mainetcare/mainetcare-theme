<?php

add_shortcode( 'mnc_matomo_opt_out', function () {
	$template = CHILD_THEME_DIR . '/templates/matomo_opt_out.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_jahreszeit', function () {
	$s = \Mnc\Season::instance()->getMeteorologicalSeason();
	if($s == 'Frühling') {
		return 'Passend zur Jahreszeit';
	}
	return 'Auch im '.$s. ' sehr sinnvoll';
} );

add_shortcode( 'mnc_phone_symbol', function () {
	return '<svg aria-hidden="true" focusable="false" data-prefix="fas" data-icon="phone-square" class="mnc-menu-icon" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path fill="currentColor" d="M400 32H48C21.49 32 0 53.49 0 80v352c0 26.51 21.49 48 48 48h352c26.51 0 48-21.49 48-48V80c0-26.51-21.49-48-48-48zM94 416c-7.033 0-13.057-4.873-14.616-11.627l-14.998-65a15 15 0 0 1 8.707-17.16l69.998-29.999a15 15 0 0 1 17.518 4.289l30.997 37.885c48.944-22.963 88.297-62.858 110.781-110.78l-37.886-30.997a15.001 15.001 0 0 1-4.289-17.518l30-69.998a15 15 0 0 1 17.16-8.707l65 14.998A14.997 14.997 0 0 1 384 126c0 160.292-129.945 290-290 290z"></path></svg>';
} );

// Use Yoast Breadcrumbs as Shortcode:
add_shortcode( 'yoastbc', function () {
	return yoast_breadcrumb( '<p id="breadcrumbs">', '</p>' );
} );

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

add_shortcode( 'mnc_item_weitere_stories', function () {
	$template = CHILD_THEME_DIR . '/templates/item_weitere_stories.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_browse_categories', function () {
	$template = CHILD_THEME_DIR . '/templates/browse_categories.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_anfrage', function () {
	$template = CHILD_THEME_DIR . '/templates/anfrage.php';
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

add_shortcode( 'mnc_custom_post_referenz', function () {
	$template = CHILD_THEME_DIR . '/templates/custom_post_referenz.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_list_categories', function ($atts = [], $tag = '') {

	$list_category_atts = shortcode_atts(
		[
			'cat' => 'category',
		], $atts, $tag
	);

	$template = CHILD_THEME_DIR . '/templates/list_categories.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_list_archives', function ($atts = [], $tag = '') {

	$list_archive_atts = shortcode_atts(
		[
			'cpt' => 'post',
		], $atts, $tag
	);

	$template = CHILD_THEME_DIR . '/templates/list_archives.php';
	ob_start();
	require $template;
	$html = ob_get_contents();
	ob_end_clean();

	return $html;
} );

add_shortcode( 'mnc_archive_intro', function () {
	if(is_home()) {
		return '';
	}
	$arrMap = [
		'aus Kategorie' => 'aus der Kategorie',
		'aus Jahr:'     => 'aus dem Jahr'
	];
	$mnc_title = 'Beiträge aus ' . get_the_archive_title();
	$mnc_title = str_replace(array_keys($arrMap), array_values($arrMap), $mnc_title);
	return $mnc_title;
} );
