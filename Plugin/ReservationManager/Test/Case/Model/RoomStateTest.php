<?php
App::uses('RoomState', 'ReservationManager.Model');

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
		'plugin.reservation_manager.room_state',
		'plugin.reservation_manager.room'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->RoomState = ClassRegistry::init('ReservationManager.RoomState');
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
