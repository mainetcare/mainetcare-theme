<?php


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
add_filter('wp_nav_menu_items', 'do_shortcode');

// Since WP 5.8 there is an annoying "load more" button after 40 Images. You can turn it off like so:
add_filter( 'media_library_infinite_scrolling', '__return_true' );

//estimated reading time
function mnc_reading_time() {
	global $post;
	if(! $post) {
		return null;
	}
	$content = get_post_field( 'post_content', $post->ID );
	$word_count = str_word_count( strip_tags( $content ) );
	return ceil( $word_count / 200);
}

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
