<?php
App::uses('Room', 'ReservationManager.Model');

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
		'plugin.reservation_manager.room',
		'plugin.reservation_manager.room_state',
		'plugin.reservation_manager.reservation'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Room = ClassRegistry::init('ReservationManager.Room');
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
