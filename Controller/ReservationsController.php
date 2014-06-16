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

		// Getting reservation in range TODO: filter by range
		$this->Reservation->recursive = 0;
		$options = array('conditions' => array(
			'or' => array(
				array(
					'Reservation.checkin >=' => $left,
					'Reservation.checkin <=' => $right
				),
				array(
					'Reservation.checkout >=' => $left,
					'Reservation.checkout <=' => $right
				)
			)
		));
		$this->Paginator->settings = $options;
		$reservations =  $this->Paginator->paginate();
		foreach ($reservations as &$reservation) {
			$this->Reservation->setReservationShowedDays($reservation, $left, $right);
		}
		$this->set(compact('reservations', 'dates', 'prev', 'next'));
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
	public function add() {
		if ($this->request->is('post')) {
			$this->Reservation->create();
			if ($this->Reservation->save($this->request->data)) {
				$this->Session->setFlash(__('The reservation has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The reservation could not be saved. Please, try again.'));
			}
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
	public function edit($id = null) {
		if (!$this->Reservation->exists($id)) {
			throw new NotFoundException(__('Invalid reservation'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Reservation->save($this->request->data)) {
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
