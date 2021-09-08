<?php

// Dont show Posts in Archive with meta_cat taxonomy
// Since they are listed manually

add_action( 'pre_get_posts', function ( $query ) {

	if ( is_home() && $query->is_main_query() ) {
		$stickies = get_option( "sticky_posts" );
		$query->set( 'post__not_in', $stickies );
	}
} );
