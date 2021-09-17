<?php
/*
 * Processing of Anfrage Formular
 *
 * */

/**
 * In WP Action Hook the wp query is just executed so we have the post object
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference#Actions_Run_During_a_Typical_Request
 */

use Mnc\Anfrage;
use Mnc\AnfrageException;

global $post;
$anfrage = new Anfrage($post);

add_action( 'wp', function () {
	global $anfrage;
	global $post;
	if ( ! $post ) {
		return;
	}
	$anfrage = new Anfrage($post);
	$correct_page_id = 3864; // Ihr Website Anliegen
	if ( ! is_admin() && $post->ID == $correct_page_id ) {
		try {
			if ( $anfrage->isSubmitted() && ! $anfrage->hasErrors() ) {
				$anfrage->sendAsMail();
				$anfrage->redirect();
			}
		} catch ( Exception $e ) {
			$anfrage->exception = $e;
		}
	}
} );
