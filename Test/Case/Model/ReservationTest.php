<?php
App::uses('Reservation', 'HotelReservation.Model');

/**
 * Reservation Test Case
 *
 */
class ReservationTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.hotel_reservation.reservation',
		'plugin.hotel_reservation.room',
		'plugin.hotel_reservation.cliente'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reservation = ClassRegistry::init('HotelReservation.Reservation');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Reservation);

		parent::tearDown();
	}

}
