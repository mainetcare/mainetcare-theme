<?php

add_filter( 'excerpt_length', function ( $length ) {
	return 40;
}, 999 );
