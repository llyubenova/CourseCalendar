<?php

class Calendar {

	private $now;

	function __construct( $date_string = null ) {
		$this->setDate($date_string);
	}

	private function setDate( $date_string = null ) {
		if( $date_string ) {
			$this->now = getdate(strtotime($date_string));
		} else {
			$this->now = getdate();
		}
	}

	public function showCalendar($year = '',$month = '')
	{
		include 'app/getCalendar.php';
	}
}
?>
