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
