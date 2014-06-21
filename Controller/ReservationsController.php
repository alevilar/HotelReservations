<?php
App::uses('ReservationManagerAppController', 'ReservationManager.Controller');
/**
 * Reservations Controller
 *
 * @property Reservation $Reservation
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ReservationsController extends ReservationManagerAppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator', 'Session');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$col_width = $this->Reservation->getColWidth();
		$this->layout = 'ReservationManager.default';

		// Getting the current date or selected one
		$date = date('Y-m-d');
		if (isset($this->request->named['date'])) {
			$date = $this->request->named['date'];
		}

		// Get the left date and right date from selected one
		list($left, $right)  = $this->Reservation->getLeftAndRightRangeDates($date);

		// Get the prev date and next date from selected one
		list($prev, $next) = $this->Reservation->getPrevAndNextDates($date);

		// Get all dates bewteen range given
		$dates = $this->Reservation->getRangeDates($left, $right);
		// print_r($dates);

		// Getting all rooms
		$this->Reservation->Room->recursive = 0;
		$rooms = $this->Reservation->Room->find('all');
		// print_r($rooms);die;
		foreach ($rooms as &$room) {
			$room_reservation_dates = array();
			$room['Reservation'] = $this->Reservation->getReservationsForRoom($room['Room']['id'], $left, $right);
		
			foreach ($room['Reservation'] as &$reservation) {
				foreach ($dates as $date) {
					$room_reservation_dates[$date] = ($this->Reservation->hasRoomReservationInDate($room, $date)) ? $reservation['Reservation']['id'] : false;
				}
				$room['ReservationDates'] = $room_reservation_dates;
				$this->Reservation->setReservationShowedDays($reservation, $left, $right);
			}
		}
		// print_r($rooms);

		$this->set(compact('rooms', 'dates', 'prev', 'next', 'col_width'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$options = array('conditions' => array('Reservation.' . $this->Reservation->primaryKey => $id));
		$this->set('reservation', $this->Reservation->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($cliente_id = null, $checkin = null, $room_id = null) {
		if ($this->request->is('post')) {
			$this->Reservation->create();
			if ($this->Reservation->save($this->request->data)) {
				$this->Reservation->changeRoomStateIfTodayInPeriod(
					$this->request->data['Reservation']['room_id'],
					$this->request->data['Reservation']['checkin'],
					$this->request->data['Reservation']['checkout']);
				$this->Session->setFlash(__('The reservation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			}
		}
		if ($cliente_id) {
			$cliente = $this->Reservation->Cliente->findById($cliente_id);
		}
		if ($room_id) {
			$room = $this->Reservation->Room->findById($room_id);
		}
		$rooms = $this->Reservation->Room->find('list');
		$clientes = $this->Reservation->Cliente->find('list');
		$this->set(compact('cliente_id', 'room_id', 'checkin', 'rooms', 'clientes', 'cliente', 'room'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reservation->save($this->request->data)) {
				$this->Reservation->changeRoomStateIfTodayInPeriod(
					$this->request->data['Reservation']['room_id'],
					$this->request->data['Reservation']['checkin'],
					$this->request->data['Reservation']['checkout']);
				$this->Session->setFlash(__('The reservation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reservation.' . $this->Reservation->primaryKey => $id));
			$this->request->data = $this->Reservation->find('first', $options);
		}
		$clientes = $this->Reservation->Cliente->find('list');
		$rooms = $this->Reservation->Room->find('list');
		$this->set(compact('rooms', 'clientes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function select_client() {
		$clientes = $this->Reservation->Cliente->find('all');
		$this->set(compact('clientes'));
	}




/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function checkout($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$reservation = $this->Reservation->findById($id);
			$reservation['Reservation']['checkout'] = date('Y-m-d H:i:s');
			if ($this->Reservation->save($reservation)) {
				$reservation['Room']['room_state_id'] = 3; // En limpieza
				$this->Reservation->Room->save($reservation['Room']);
				$this->Session->setFlash(__('The reservation has been checked out.'));
			} else {
				$this->Session->setFlash(__('The reservation could not be checked out. Please, try again.'));
			}
			return $this->redirect(array('action' => 'index'));
		}
		$this->redirect(array('action' => 'edit', $id));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Reservation->id = $id;
		if (!$this->Reservation->exists()) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Reservation->delete()) {
			$this->Session->setFlash(__('The reservation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reservation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
