<?php


/*
 *
 * Using the Schema command line utility
 * 
 * copy this file into /app/Config/Schema and
 * run from console:
 * cake schema create reservations
 *
 */
class ReservationsSchema extends CakeSchema {

	public function before($event = array()) {
		return true;
	}

	public function after($event = array()) {
	}

/**
 * Reservations - Table for holding reservations
 */
	public $hotel_reservations = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'room_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'cliente_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'observation' => array('type' => 'text', 'null' => true, 'default' => null),
		'passengers' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'checkin' => array('type' => 'datetime', 'null' => false),
		'checkout' => array('type' => 'datetime', 'null' => false),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);



	/**
	 * Rooms - Table for each room in hotel
	 */
	public $hotel_rooms = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true),
		'description' => array('type' => 'text', 'null' => true, 'default' => null),
		'room_state_id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);


	/**
	 * Room States - The room shuld belong to one of this states- Ex: Occupied, 
	 */
	public $hotel_room_states = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => null, 'length' => 10, 'key' => 'primary'),
		'name' => array('type' => 'string', 'null' => true),
		'created' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'modified' => array('type' => 'datetime', 'null' => true, 'default' => null),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1))
	);



	public $clientes = array(
		'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 10, 'key' => 'primary'),
		'mail' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'telefono' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 30, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nombre' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'nrodocumento' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 11, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'domicilio' => array('type' => 'string', 'null' => true, 'default' => NULL, 'length' => 110, 'collate' => 'utf8_spanish_ci', 'charset' => 'utf8'),
		'created' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'modified' => array('type' => 'timestamp', 'null' => true, 'default' => NULL),
		'indexes' => array('PRIMARY' => array('column' => 'id', 'unique' => 1)),
		'tableParameters' => array('charset' => 'utf8')
	);

}