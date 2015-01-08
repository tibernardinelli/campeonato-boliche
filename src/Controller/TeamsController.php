<?php
App::uses('AppController', 'Controller');

/**
 * Teams Controller
 *
 * @property Team $Team
 * @property PaginatorComponent $Paginator
 */
class TeamsController extends AppController
{

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    private function ifParticipantHasAPictureReturnTheURI($ParticipantID) {
        $info = new SplFileInfo(Configure::read('PARTICIPANTS_PICTURES_DIR') . $ParticipantID . '.jpg');
        if ($info->isFile()) {
            return '/img/participants_pictures/' . $ParticipantID . '.jpg';
        } else {
            return false;
        }
    }
    
    /**
     * index method
     *
     * @return void
     */
    public function index($teamGenericExists = 0)
    {
        $teams = $this->Team->find('all', array(
                'order' => array(
                    'Team.name'),
                'contain' => array(
                    'Participant' => array(
                        'order' => 'Participant.name'
                    )
                )
            )
        );
        $this->set(compact('teams', 'teamGenericExists'));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null)
    {
        if (!$this->Team->exists($id)) {
            throw new NotFoundException(__('Invalid team'));
        }
        $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
        $this->set('team', $this->Team->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add()
    {
        if ($this->request->is('post')) {
            $this->Team->create();
            if ($this->Team->save($this->request->data)) {
                $this->Session->setFlash(__('The team has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The team could not be saved. Please, try again.'));
            }
        }
        $participants = $this->Team->Participant->find('list');
        $this->set(compact('participants'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $participant_id = null)
    {
        if (!$this->Team->exists($id)) {
            throw new NotFoundException(__('Invalid team'));
        }
        if (!$this->Team->TeamsParticipant->find('first', [
            'conditions' => [
                'participant_id' => $participant_id,
                'team_id' => $id
            ]])
        ) {
            throw new NotFoundException("Você não tem permissão para editar esta equipe");
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Team->save($this->request->data)) {
                $this->log("User: $participant_id, edited Team: $id");
                $this->Session->setFlash("TituloAlterado","flash_modal");
                return $this->redirect(['action' => 'edit', $id, $participant_id]);
            } else {
                $this->Session->setFlash("FalhaSalvarEquipe","flash_modal");
            }
        } else {
            $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
            $this->request->data = $this->Team->find('first', $options);
        }

        $options = array('conditions' => array('Team.' . $this->Team->primaryKey => $id));
        $participants = $this->Team->find('first', $options);
        $participants = $participants['Participant'];

        $this->set(compact('participants'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null)
    {
        $this->Team->id = $id;
        if (!$this->Team->exists()) {
            throw new NotFoundException(__('Invalid team'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Team->delete()) {
            $this->Session->setFlash(__('The team has been deleted.'));
        } else {
            $this->Session->setFlash(__('The team could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }
}
