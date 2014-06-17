<?php

App::uses( 'AppModel', 'Model' );

class ReservationManagerAppModel extends AppModel {
	public $tablePrefix = 'hotel_';

	public function setReservationShowedDays(&$reservation, $left, $right) {
		$checkin = strtotime($reservation['Reservation']['checkin']);
		$checkout = strtotime($reservation['Reservation']['checkout']);
		$left = strtotime($left);
		$right = strtotime($right);

		$datediff = $checkin - $left;
		$showed_days = floor($datediff/(60*60*24)) + 1;
		if ($showed_days < 1) {
			$showed_days = 1;
		}

		$start_date = $checkin;
		if ($left > $checkin) {
			$start_date = $left;
		}

		$end_date = $checkout;
		if ($right < $checkout) {
			$end_date = $right;
		}

		// echo date('Y-m-d', $start_date);
		// echo " ";
		// echo date('Y-m-d', $end_date);
		$showed_width = floor( ($end_date - $start_date) /(60*60*24)) + 1;
		$reservation['Reservation']['showed_days'] = $showed_days;
		$reservation['Reservation']['showed_width'] = $showed_width;
		// $reservation['Reservation']['showed_start'] = $datediff;
		// $reservation['Reservation']['showed_end'] = $datediff;
	}
/**
 * Get the prev and next date
 * @param type $date 
 * @return type
 */
	public function getPrevAndNextDates($date) {
		$config = Configure::read('Calendar.ranges');
		$interval = 60 * 60 * 24;
		return array(date('Y-m-d', strtotime($date) - $interval), date('Y-m-d', strtotime($date) + $interval));
	}

	/**
	 * Get a list of dates from a particular date given with a specific numbers of days after and before
	 *
	 * @param date $date start day
	 * @return array $dates left date and right date
	 */
	public function getLeftAndRightRangeDates( $from ) {
		$config = Configure::read('Calendar.ranges');
		$from = strtotime($from);
		$interval = 60 * 60 * 24;

		$days_left  = $from - ($config['left']  * $interval);
		$days_right = $from + ($config['right'] * $interval);

		$from = date('Y-m-d', $days_left);
		$to = date('Y-m-d', $days_right);

		return array( $from, $to);
	}

/**
 * Get a range of dates between $from date and $to date
 * @param string $from 
 * @param string $to 
 * @return array list of date in range
 */
	public function getRangeDates($from = null, $to = null) {
		$config = Configure::read('Calendar.ranges');
		$dates = array();
		$interval = 60 * 60 * 24; // one day

		if ($from && $to) {
			$from = strtotime($from);
			$to = strtotime($to);
		} else {
			if (!$from && $to) {
				$from = strtotime($to) - (($config['left'] + $config['right']) * $interval);
				$to = strtotime($to);
			} else {
				$to = strtotime($from) + (($config['left'] + $config['right']) * $interval);
				$from = strtotime($from);
			}
		}

		for ($i = $from; $i < $to; $i = $i + $interval) {
			$dates[] = date('Y-m-d', $i);
		}
		return $dates;
	}
}
