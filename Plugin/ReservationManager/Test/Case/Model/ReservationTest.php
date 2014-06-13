<?php
App::uses('Reservation', 'ReservationManager.Model');

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
		'plugin.reservation_manager.reservation',
		'plugin.reservation_manager.room'
	);

/**
 * setUp method
 *
 * @return void
 */
	public function setUp() {
		parent::setUp();
		$this->Reservation = ClassRegistry::init('ReservationManager.Reservation');
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
