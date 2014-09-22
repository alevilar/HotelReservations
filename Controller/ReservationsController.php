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


	public $uses = array('Mesa.Mesa');

/**
 * index method
 *
 * @return void
 */
	public function index() {
	}

	public function build_grid() {
		$this->layout = 'ReservationManager.default';

		// Getting the current date or selected one
		$date = date('Y-m-d');
		if (isset($this->request->named['date'])) {
			$date = $this->request->named['date'];
		}

		// Get the left date and right date from selected one
		list($left, $right)  = $this->Mesa->getLeftAndRightRangeDates($date);

		// Get the prev date and next date from selected one
		list($prev, $next) = $this->Mesa->getPrevAndNextDates($date);

		// Get all dates bewteen range given
		$dates = $this->Mesa->getRangeDates($left, $right);
		// print_r($dates);

		// Getting all nombre_mesas
		$this->Mesa->NombreMesa->recursive = 0;
		$nombre_mesas = $this->Mesa->NombreMesa->find('all');
		// print_r($nombre_mesas);die;
		foreach ($nombre_mesas as &$room) {
			$room_reservation_dates = array();
			$room['Reservation'] = $this->Mesa->getReservationsForRoom($room['Room']['id'], $left, $right);
		
			foreach ($room['Reservation'] as &$reservation) {
				foreach ($dates as $date) {
					// $room_reservation_dates[$date][] = ($this->Mesa->hasRoomReservationInDate($room, $date)) ? $reservation['Reservation']['id'] : false;
					$room_reservation_dates[$date] = $this->Mesa->getReservationsForRoomInDate($room, $date);
				}
				$room['ReservationDates'] = $room_reservation_dates;
				$this->Mesa->setReservationShowedDays($reservation, $left, $right);
			}
			// print_r($room['ReservationDates']);
		}
		// print_r($nombre_mesas);
		$this->layout = false;

		$this->set(compact('nombre_mesas', 'dates', 'prev', 'next'));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Mesa->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$options = array('conditions' => array('Reservation.' . $this->Mesa->primaryKey => $id));
		$this->set('reservation', $this->Mesa->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($cliente_id = null, $checkin = null, $room_id = null) {
		if ($this->request->is('post')) {
			$this->Mesa->create();
			if ($this->Mesa->save($this->request->data)) {
				$this->Mesa->changenombre_mesastateIfTodayInPeriod(
					$this->request->data['Reservation']['room_id'],
					$this->request->data['Reservation']['checkin'],
					$this->request->data['Reservation']['checkout']);
				$this->Session->setFlash(__('The reservation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			}
		}
		$this->layout = 'ajax';
		if ($cliente_id) {
			$cliente = $this->Mesa->Cliente->findById($cliente_id);
		}
		if ($room_id) {
			$room = $this->Mesa->NombreMesa->findById($room_id);
		}
		$nombre_mesas = $this->Mesa->NombreMesa->find('list');
		$clientes = $this->Mesa->Cliente->find('list');
		$this->set(compact('cliente_id', 'room_id', 'checkin', 'nombre_mesas', 'clientes', 'cliente', 'room'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Mesa->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Mesa->save($this->request->data)) {
				$this->Mesa->changenombre_mesastateIfTodayInPeriod(
					$this->request->data['Reservation']['room_id'],
					$this->request->data['Reservation']['checkin'],
					$this->request->data['Reservation']['checkout']);
				$this->Session->setFlash(__('The reservation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Reservation.' . $this->Mesa->primaryKey => $id));
			$this->request->data = $this->Mesa->find('first', $options);
		}
		$this->layout = 'ajax';
		$clientes = $this->Mesa->Cliente->find('list');
		$nombre_mesas = $this->Mesa->NombreMesa->find('list');
		$this->set(compact('nombre_mesas', 'clientes'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function select_client() {
		$clientes = $this->Mesa->Cliente->find('all');
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
		if (!$this->Mesa->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			$reservation = $this->Mesa->findById($id);
			$reservation['Reservation']['checkout'] = date('Y-m-d H:i:s');
			if ($this->Mesa->save($reservation)) {
				$reservation['Room']['room_state_id'] = 3; // En limpieza
				$this->Mesa->NombreMesa->save($reservation['Room']);
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
		$this->Mesa->id = $id;
		if (!$this->Mesa->exists()) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->Mesa->delete()) {
			$this->Session->setFlash(__('The reservation has been deleted.'));
		} else {
			$this->Session->setFlash(__('The reservation could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
