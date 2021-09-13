<?php

namespace Mnc;

use Carbon\Carbon;

class Anfrage {

	public $map = [];
	public $request = [];
	public $errortext = null;

	public $errors = [];

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
			'Ich will meine alte Website ein wenig aufpeppen',
			'Jemand, der meine Website pflegt',
			'Anleitung wie ich meine Seite selber pflege',
			'Regelmäßig neue Blogbeiträge oder Meldungen',
			'Jemand, der mir den technischen Kram abnimmt',
			'Eigentlich will ich mich um gar nichts kümmern müssen 😇',
			'Die Website muss schneller laden',
			'Mehr Infos über meine Besucher',
			'Google Anzeigen mit Landing Pages wären toll',
			'Meine Website wird bei Google nicht gefunden',
			'Ein Online-Shop',
			'Ein Buchungssystem',
			'Ein Blog',
			'Event-Planer / Kalender für Termine und Anmeldungen',
			'Fotogalerien und Bilderverwaltung',
			'Ich habe eine Datenbank randvoll mit "XYZ" und will diese online verfügbar machen',
			'Ein Kontaktformular / Assistent',
			'Einen Newsletter',
			'Intelligente Suche',
			'Animationen, Visualisierungen, Filme',
			'Erhöhung der Sicherheit',
			'Technische Betreuung',
			'Ein Digitalisierungsprojekt',
			'Gartenzwerge'
		];
		$this->map = [];
		foreach ( $labels as $label ) {
			$this->map[] = new Checkitem( $label );
		}
		$this->validate = [
			'contact_name'  => [ 'isNotEmpty' => 'Bitte geben Sie Ihren Namen oder alternativ den Namen Ihres Unternehmens an.' ],
			'contact_email' => [ 'isNotEmpty' => 'Bitte geben Sie eine E-Mail Adresse an, mit der wir Sie kontaktieren können.' ],
			'datenschutz'   => [
				'isChecked' => 'Um die Anfrage absenden zu können ist es notwendig, dass Sie unsere Datenschutzbestimmungen akzeptieren. Wir verwenden Ihre Angaben ausschließlich zur Kontaktaufnahme und geben diese keinesfalls an Dritte weiter.'
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

	/**
	 * @param $fieldname
	 *
	 * @return mixed|null
	 */
	public function getRequest( $fieldname ) {
		if ( ! isset( $this->request[ $fieldname ] ) ) {
			return null;
		}

		return $this->request[ $fieldname ];
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
		$message = $this->buildMessage();
		wp_mail( 'info@mainetcare.com', 'Anfrage von der Website. Interessent schickt Anliegen', $message );
	}

	protected function buildMessage() {
		$message = [];
		foreach ( $this->request as $field => $value ) {
			$checkfield = $this->getCheckfield( $field );
			if ( $checkfield && $checkfield->checked( $this->request ) ) {
				$message[] = 'Kunde will: ' . $checkfield->label;
			}
		}
		$message[] = 'Kunde will Sonstiges: ' . $this->request['sonstiges'];
		$message[] = 'Name: ' . $this->request['contact_name'];
		$message[] = 'Email: ' . $this->request['contact_email'];
		$message[] = 'Telefon: ' . $this->request['contact_tel'];
		$message[] = 'Website: ' . $this->request['contact_web'];
		return implode( "\n", $message );
	}

	protected function getCheckfield( $fielname ) {
		foreach ( $this->map as $checkfield ) {
			/**
			 * @var $checkfield Checkitem
			 */
			if ( $checkfield->name == $fielname ) {
				return $checkfield;
			}
		}

		return null;
	}

	public function redirect() {
		wp_redirect(get_permalink( get_page_by_path( 'vielen-dank-fuer-ihre-anfrage' ) ), 303);
	}

	/**
	 * @return bool
	 */
	public function hasErrors() {
		return count( $this->errors ) > 0;
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
		if ( (int) $this->request[ $fieldname ] !== 1 ) {
			return false;
		}

		return true;
	}


}