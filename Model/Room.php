<?php
App::uses('ReservationManagerAppModel', 'ReservationManager.Model');
/**
 * Room Model
 *
 * @property RoomState $RoomState
 * @property Reservation $Reservation
 */
class Room extends ReservationManagerAppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

/**
 * Validation rules
 *
 * @var array
 */
	public $validate = array(
		'room_state_id' => array(
			'numeric' => array(
				'rule' => array('numeric'),
				//'message' => 'Your custom message here',
				//'allowEmpty' => false,
				//'required' => false,
				//'last' => false, // Stop validation after this rule
				//'on' => 'create', // Limit validation to 'create' or 'update' operations
			),
		),
	);

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'RoomState' => array(
			'className' => 'ReservationManager.RoomState',
			'foreignKey' => 'room_state_id',
			'conditions' => '',
			'fields' => '',
			'order' => ''
		)
	);

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Reservation' => array(
			'className' => 'ReservationManager.Reservation',
			'foreignKey' => 'room_id',
			'dependent' => false,
			'conditions' => '',
			'fields' => '',
			'order' => '',
			'limit' => '',
			'offset' => '',
			'exclusive' => '',
			'finderQuery' => '',
			'counterQuery' => ''
		)
	);

	public function getTodayState($room_id) {
		$today = date('Y-m-d H:i:s');
		$this->recursive = 1;
		$options = array('conditions' => array(
			'Reservation.checkin >=' => $today,
			'Reservation.checkin <=' => $today,
			'Reservation.room_id' => $room_id
		));
		$room = $this->findById($room_id);
		// TODO: Aqui voy determinando si la habitacion esta ocupada hoy
		print_r($room);die;
		// return (isset($reservation['Room']['room_state_id'])) ? $reservation['Room']['room_state_id'] : 1;
	}
}
