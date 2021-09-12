<?php
namespace Mnc;

use Carbon\Carbon;

class Season {

	protected Carbon $spring;
	protected Carbon $summer;
	protected Carbon $fall;
	protected Carbon $winter;
	protected Carbon $today;

	protected function __construct() {
		$this->spring = new Carbon('March 20');
		$this->summer = new Carbon('June 20');
		$this->fall = new Carbon('September 22');
		$this->winter = new Carbon('December 21');
		$this->today = new Carbon();
	}

	public static function instance() {
		return new Season();
	}

	public function met() {
		$m = $this->today->month;
		if(in_array($m, [3,4,5])) {
			return 'Frühling';
		}
		if(in_array($m, [6,7,8])) {
			return 'Sommer';
		}
		if(in_array($m, [9,10,11])) {
			return 'Herbst';
		}
		return 'Winter';
	}

	public function ast() {
		return 'Sommer';
	}

}