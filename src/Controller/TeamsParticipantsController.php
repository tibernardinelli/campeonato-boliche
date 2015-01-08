<?php
App::uses('AppController', 'Controller');
/**
 * TeamsParticipants Controller
 *
 * @property TeamsParticipant $TeamsParticipant
 * @property PaginatorComponent $Paginator
 */
class TeamsParticipantsController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index() {
		$this->TeamsParticipant->recursive = 0;
		$this->set('teamsParticipants', $this->Paginator->paginate());
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->TeamsParticipant->exists($id)) {
			throw new NotFoundException(__('Invalid teams participant'));
		}
		$options = array('conditions' => array('TeamsParticipant.' . $this->TeamsParticipant->primaryKey => $id));
		$this->set('teamsParticipant', $this->TeamsParticipant->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {
			$this->TeamsParticipant->create();
			if ($this->TeamsParticipant->save($this->request->data)) {
				$this->Session->setFlash(__('The teams participant has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teams participant could not be saved. Please, try again.'));
			}
		}
		$participants = $this->TeamsParticipant->Participant->find('list');
		$teams = $this->TeamsParticipant->Team->find('list');
		$this->set(compact('participants', 'teams'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->TeamsParticipant->exists($id)) {
			throw new NotFoundException(__('Invalid teams participant'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->TeamsParticipant->save($this->request->data)) {
				$this->Session->setFlash(__('The teams participant has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The teams participant could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('TeamsParticipant.' . $this->TeamsParticipant->primaryKey => $id));
			$this->request->data = $this->TeamsParticipant->find('first', $options);
		}
		$participants = $this->TeamsParticipant->Participant->find('list');
		$teams = $this->TeamsParticipant->Team->find('list');
		$this->set(compact('participants', 'teams'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->TeamsParticipant->id = $id;
		if (!$this->TeamsParticipant->exists()) {
			throw new NotFoundException(__('Invalid teams participant'));
		}
		$this->request->allowMethod('post', 'delete');
		if ($this->TeamsParticipant->delete()) {
			$this->Session->setFlash(__('The teams participant has been deleted.'));
		} else {
			$this->Session->setFlash(__('The teams participant could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index'));
	}
}
