<?php
/*
 * Processing of Anfrage Formular
 *
 * */

/**
 * In WP Action Hook the wp query is just executed so we have the post object
 * @see https://codex.wordpress.org/Plugin_API/Action_Reference#Actions_Run_During_a_Typical_Request
 */

use Mnc\AnfrageException;

add_action( 'wp', function () {
	global $post;
	if ( ! $post ) {
		return;
	}

	$correct_page_id = 586; // Ihr Website Anliegen
	if ( ! is_admin() && $post->ID == $correct_page_id ) {
		$anfrage = new \Mnc\Anfrage();
		if ( $anfrage->isSubmitted() && ! $anfrage->hasErrors() ) {
			try {
				$anfrage->sendAsMail();
				$anfrage->redirect();
			} catch ( AnfrageException $e ) {
				$anfrage->setErrors( 'Bei der Verarbeitung ist ein Fehler aufgetreten', [
					'mailsent' => 'Es gab einen Fehler beim Versuch, Ihre Anfrage per E-Mail zu versenden. Dies kann mit Störungen im E-Mail Server oder im Netzwerk zu tun haben. Sie können es erneut versuchen. Falls der Fehler wiederholt auftritt, wäre es nett, wenn Sie uns unter der Rufnummer 030 966 066 79 darüber informieren könnten.'
				] );
			}
		}
	}
} );
