<?php
App::uses('RoomState', 'HotelReservation.Model');

/**
 * RoomState Test Case
 *
 */
class RoomStateTest extends CakeTestCase {

/**
 * Fixtures
 *
 * @var array
 */
	public $fixtures = array(
		'plugin.hotel_reservation.room_state',
		'plugin.hotel_reservation.room'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RoomState = ClassRegistry::init('HotelReservation.RoomState');
	}

/**
 * tearDown method
 *
 * @return void
 */
	public function tearDown() {
		unset($this->RoomState);

		parent::tearDown();
	}

}
