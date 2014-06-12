<?php
App::uses('Room', 'HotelReservation.Model');

/**
 * Room Test Case
 *
 */
class RoomTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.hotel_reservation.room',
		'plugin.hotel_reservation.room_state',
		'plugin.hotel_reservation.reservation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Room = ClassRegistry::init('HotelReservation.Room');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->Room);

		parent::tearDown();
	}

}
