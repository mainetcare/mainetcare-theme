<?php
// Alternative
// Fully Disable Gutenberg editor.
add_filter('use_block_editor_for_post_type', '__return_false', 10);
// Don't load Gutenberg-related stylesheets.
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library'); // WordPress core
    wp_dequeue_style('wp-block-library-theme'); // WordPress core
    wp_dequeue_style('wc-block-style'); // WooCommerce
    wp_dequeue_style('storefront-gutenberg-blocks'); // Storefront theme
}, 100);


add_filter('wp_default_scripts', function(&$scripts) {
    if (!is_admin()) {
        $scripts->remove('jquery');
        $scripts->add('jquery', false, array('jquery-core'), '1.12.4');
    }
});

add_action( 'wp_enqueue_scripts', function() {
    wp_scripts()->add_data( 'jquery', 'group', 1 );
    wp_scripts()->add_data( 'jquery-core', 'group', 1 );
    wp_scripts()->add_data( 'jquery-migrate', 'group', 1 );
} );

add_filter( 'body_class',function ( $classes ) {
	$classes[] = 'mnc-site';
	return $classes;
} );

// Use own SVG Favicon in Admin Panel
add_action( 'admin_head', function () {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="' . get_bloginfo( 'wpurl' ) . '/wp-content/uploads/2019/06/favicon.svg" />';
} );

// Allow Shortcodes in Widgets:
add_filter( 'widget_text', 'do_shortcode' );

// Allow SVG MIME TYPE (seems not to work, test please)
add_filter( 'upload_mimes', function ( $mime_types ) {
	$mime_types['svg'] = 'image/svg+xml'; //.svg hinzufügen
	return $mime_types;
}, 1, 1 );



//function mnc_icon_check( $content = '' ) {
//	if ( $content == '' ) {
//		return '<span>' . mnc_get_icon( 'check' ) . '</span>';
//	}
//
//	return '<span>' . mnc_get_icon( 'check' ) . '</span><span class="ml-2">' . $content . '</span>';
//}
//
//if(! function_exists( 'mnc_get_icon' )) {
//	function mnc_get_icon( $icon_key ) {
//		$prefix = wp_upload_dir()['basedir'] . '/svg/';
//		// $prefix  = '/wp-content/uploads/svg/';
//		$map  = [
//			'email'    => 'email-24px.svg',
//			'location' => 'room-24px.svg',
//			'phone'    => 'call-24px.svg',
//			'check'    => 'check-circle.svg',
//			'clear'    => 'clear-24px.svg'
//		];
//		$path = $prefix . $map[ $icon_key ];
//		if ( ! file_exists( $path ) ) {
//			return 'Icon not found: ' . $path;
//		}
//		$icon = file_get_contents( $path );
//
//		return str_replace( 'class=""', 'class="mnc-icon mnc-icon-' . $icon_key . '"', $icon );
//	}
//}
