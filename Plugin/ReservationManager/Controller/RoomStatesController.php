<?php
App::uses('ReservationManagerAppController', 'ReservationManager.Controller');
/**
 * RoomStates Controller
 *
 * @property RoomState $RoomState
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class RoomStatesController extends ReservationManagerAppController {

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
		$this->RoomState->recursive = 0;
		$this->set('roomStates', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->RoomState->exists($id)) {
			throw new NotFoundException(__('Invalid room state'));
		}
		$options = array('conditions' => array('RoomState.' . $this->RoomState->primaryKey => $id));
		$this->set('roomState', $this->RoomState->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->RoomState->create();
			if ($this->RoomState->save($this->request->data)) {
				$this->Session->setFlash(__('The room state has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room state could not be saved. Please, try again.'));
			}
		}
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->RoomState->exists($id)) {
			throw new NotFoundException(__('Invalid room state'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->RoomState->save($this->request->data)) {
				$this->Session->setFlash(__('The room state has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The room state could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('RoomState.' . $this->RoomState->primaryKey => $id));
			$this->request->data = $this->RoomState->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->RoomState->id = $id;
		if (!$this->RoomState->exists()) {
			throw new NotFoundException(__('Invalid room state'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->RoomState->delete()) {
			$this->Session->setFlash(__('The room state has been deleted.'));
		} else {
			$this->Session->setFlash(__('The room state could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
