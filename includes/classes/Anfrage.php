<?php

namespace Mnc;

use Carbon\Carbon;
use Exception;

class Anfrage {

	public $map = [];
	public $request = [];
	public $errortext = null;

	public $errors = [];

	/**
	 * @var null | Exception | AnfrageException | RequestException
	 */
	public $exception = null;

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
			'Ich will meine alte Website aufpeppen',
			'Jemand, der meine Website pflegt',
			'Anleitung wie ich meine Seite selber pflege',
			'Regelmäßig neue Blogbeiträge oder Meldungen',
			'Jemand, der mir den technischen Kram abnimmt',
			'Eigentlich will ich mich um gar nichts kümmern müssen 😇',
			'Meine Website wird bei Google nicht gefunden',
			'Die Website soll besser gegen Angriffe geschützt werden',
			'Die Website soll schneller laden',
			'Mehr Infos über meine Besucher',
			'Google Anzeigen mit Landing Pages wären toll',
			'Ein Online-Shop',
			'Ein Buchungssystem',
			'Ein Blog',
			'Event-Planer / Kalender für Termine und Anmeldungen',
			'Fotogalerien und Bilderverwaltung',
			'Ich habe eine Datenbank und will diese online stellen',
			'Ein Kontaktformular / Assistent',
			'Einen Newsletter',
			'Intelligente Suche',
			'Animationen, Visualisierungen, Filme',
			'Technische Betreuung',
			'Wir wollen ein Digitalisierungsprojekt umsetzen und benötigen Beratung',
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
			$nonce = $_REQUEST['_wpnonce'] ?? '';
			if ( ! wp_verify_nonce( $nonce, 'submit_anfrage' ) ) {
				throw new RequestException('Die Sitzung ist abgelaufen.');
			}
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

	public function setErrors($errortext, $arrErrors) {
		$this->errortext = $errortext;
		$this->errors = $arrErrors;
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

	/**
	 * @throws AnfrageException
	 */
	public function sendAsMail() {
		$message = $this->buildMessage();
		// throw new AnfrageException('Beim Versand der E-Mail ist ein Fehler aufgetreten.');
		$return = wp_mail( 'info@mainetcare.com', 'Anfrage von der Website. Interessent schickt Anliegen', $message );
		if (! $return ) {
			throw new AnfrageException('Beim Versand der E-Mail ist ein Fehler aufgetreten.');
		}
	}

	protected function buildMessage() {
		$message = [];
		foreach ( $this->request as $field => $value ) {
			$checkfield = $this->getCheckfield( $field );
			if ( $checkfield && $checkfield->checked( $this->request ) ) {
				$message[] = 'Interessent will: ' . $checkfield->label;
			}
		}
		$message[] = 'Interessent will Sonstiges: ' . $this->request['sonstiges'];
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
		$permalink = get_permalink( get_page_by_path( 'ihr-website-anliegen/vielen-dank-fuer-ihre-anfrage' ));
		wp_redirect($permalink, 303);
		exit;
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

	/**
	 * @return bool
	 */
	public function hasAnfrageException() {
		if(!$this->exception) {
			return false;
		}
		return $this->exception instanceof AnfrageException;
	}

	/**
	 * @return bool
	 */
	public function hasRequestException() {
		if(!$this->exception) {
			return false;
		}
		return $this->exception instanceof RequestException;
	}


}