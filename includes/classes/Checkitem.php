<?php
namespace Mnc;

use Carbon\Carbon;

class Checkitem {

	public $id = '';
	public $name = '';
	public $label = '';

	public function __construct($value) {
		$this->label = $value;
		$this->name  = str_replace('-', '_', sanitize_title($value));
		$id = str_replace('_', ' ', $this->name);
		$id = ucwords($id);
		$id = str_replace(' ', '', $id);
		$this->id = 'C' . $id;
	}

	public function checked($request) {
		return (isset($request[$this->name]) && (int) $request[$this->name] == 1);
	}

}