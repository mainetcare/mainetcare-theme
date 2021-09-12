<?php

namespace Mnc;

use Carbon\Carbon;

class Anfrage {

	public $map = [];
	public $request = [];
	public $errortext = null;

	protected $errors = [];

	/**
	 * @var \string[][]
	 */
	protected array $validate;

	public function __construct() {
		$this->initMap();
		$this->initRequest();
	}

	protected function initMap() {
		$labels    = [
			'Eine neue Website',
			'Website für ein Digitalisierungsprojekt',
			'Auffrischen einer alten Website',
			'Newsletter einrichten',
			'Einfachere Bearbeitung',
//			'Landingpages',
//			'Kontaktformular / Assistent',
//			'Online-Shop',
//			'Schnellere Ladezeit',
//			'Intelligente Suche',
//			'Animationen und Filme',
//			'Event-Planer / Kalender für Termine und Anmeldungen',
//			'Inhaltspflege und Betreuung',
//			'Mehr Content auf meiner Seite',
//			'Erhöhung der Sicherheit',
//			'Was tut sich auf meiner Website? Besucheranalysen und Statistiken',
//			'Ein Buchungssystem',
//			'Fotogalerien und Bilderverwaltung',
//			'Eine ganz spezielle Programmierung',
//			'Anbindung einer Datenbank',
//			'Technische Updates',
//			'Gartenzwerge'
		];
		$this->map = [];
		foreach ( $labels as $label ) {
			$this->map[] = new Checkitem( $label );
		}
		$this->validate = [
			'name'        => [ 'isNotEmpty' => 'Bitte geben Sie Ihren Namen oder alternativ den Namen Ihres Unternehmens an.' ],
			'email'       => [ 'isNotEmpty' => 'Bitte geben Sie eine E-Mail Adresse an, mit der wir Sie kontaktieren können.' ],
			'datenschutz' => [
				'isChecked' => 'Um die Anfrage absenden zu können ist es notwendig, dass Sie unsere Datenschutzbestimmungen akzeptieren. Wir verwenden die Daten Ihrer Anfrage ausschließlich zur Kontaktaufnahmen und geben diese keinesfalls an Dritte weiter.'
			]
		];
	}

	protected function initRequest() {

		if ( $this->isSubmitted() ) {
			$this->request   = $_POST;
			$this->errortext = null;
			$this->errors    = [];
			$bError          = false;
			foreach ( $this->validate as $fieldname => $validation ) {
				foreach ( $validation as $method => $errormessage ) {
					if ( ! $this->{$method}( $fieldname ) ) {
						$this->errors[ $fieldname ] = $errormessage;
						$bError                     = true;
						break;
					}
				}
			}
			if ( $bError ) {
				$this->errortext = '<p>Bevor wir Ihre Anfrage versenden können, sind noch folgende Korrekturen notwendig:</p>';
			}
		}
	}

	public function isSubmitted() {
		return isset( $_POST['anfrage_submitted'] ) && $_POST['anfrage_submitted'] == 1;
	}

	public function getErrorClass( $name ) {
		if ( ! $this->getErrorMsg( $name ) ) {
			return '';
		}

		return 'mnc-has-error';
	}

	public function getErrorMsg( $name ) {
		if ( ! isset( $this->errors[ $name ] ) ) {
			return null;
		}

		return $this->errors[ $name ];
	}

	public function sendAsMail() {
		dump( $this->request );
	}

	public function redirect() {
		dump( 'redirect to thank you page' );
	}

	/**
	 * @param $fieldname
	 *
	 * @return bool
	 */
	protected function isNotEmpty( $fieldname ) {
		if ( ! isset( $this->request[ $fieldname ] ) ) {
			return false;
		}
		if ( ! strlen( $this->request[ $fieldname ] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param $fieldname
	 *
	 * @return bool
	 */
	protected function isEmail( $fieldname ) {
		if ( ! is_email( $this->request[ $fieldname ] ) ) {
			return false;
		}

		return true;
	}

	/**
	 * @param $fieldname
	 *
	 * @return bool
	 */
	protected function isChecked( $fieldname ) {
		if ( ! isset( $this->request[ $fieldname ] ) ) {
			return false;
		}
		if ( (int) $this->request[ $fieldname ] !== 1  ) {
			return false;
		}
		return true;
	}

	public function hasNoErrors() {
		return count($this->errors) == 0;
	}


}