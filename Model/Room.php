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

/**
 * Change room state of a given room object or a given room id
 * @param integer|array $room 
 * @param integer $new_room_state_id 
 * @return boolean
 */
	function changeRoomState($room, $new_room_state_id) {
		if (!is_array($room) && (is_string($room) || is_int($room))) {
			$room = $this->findById($room);
		}
		$room['Room']['room_state_id'] = $new_room_state_id;
		return $this->save($room);
	}
}
