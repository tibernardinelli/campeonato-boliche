<?php

App::uses('AppController', 'Controller');

/**
 * Configs Controller
 *
 * @property Config $Config
 * @property PaginatorComponent $Paginator
 * @property SessionComponent $Session
 */
class ConfigController extends AppController {

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
        $this->Config->recursive = 0;
        $this->set('configs', $this->Paginator->paginate());
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
        $this->set('config', $this->Config->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Config->create();
            if ($this->Config->save($this->request->data)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
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
        if (!$this->Config->exists($id)) {
            throw new NotFoundException(__('Invalid config'));
        }
        if ($this->request->is(array('post', 'put'))) {
            if ($this->Config->save($this->request->data)) {
                $this->Session->setFlash(__('The config has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The config could not be saved. Please, try again.'));
            }
        } else {
            $options = array('conditions' => array('Config.' . $this->Config->primaryKey => $id));
            $this->request->data = $this->Config->find('first', $options);
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
        $this->Config->id = $id;
        if (!$this->Config->exists()) {
            throw new NotFoundException(__('Invalid config'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Config->delete()) {
            $this->Session->setFlash(__('The config has been deleted.'));
        } else {
            $this->Session->setFlash(__('The config could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    //

    public function LoadParticipants() {
        $this->getParticipants();
        if ($this->permissionToContinue()) {
            $this->Participant->deleteAll('where 1 = 1');
            $this->Team->deleteAll('where 1 = 1');

            $participants = $this->getParticipants();

            if ($this->Participant->saveAll($participants, ['validate' => false])) {
                $this->Team->getGenericTeam();
                $this->out("Participantes incluidos com sucesso");
            } else {
                var_dump($this->Participant->validationErrors);
                $this->out("Falha ao incluir participantes");
            }
        }
    }

    private function permissionToContinue() {
        $this->out("Carregarei participantes no Aplicativo do Boliche");
        $this->out("!!! ATENCAO !!! Este script ira remover todos os usuarios e times ja cadastrados na base de dados, antes de tentar incluir os novos participantes");
        $selection = $this->in('Tem certeza que deseja continuar?', ['s', 'n'], 'n');

        return $selection == 's' ? true : false;
    }

    private function getParticipants() {
        $participantsArray = $this->getArrayFromCSVFile();
        foreach ($participantsArray as $participant) {
            $participant = explode(';', $participant);
            if (!empty($participant) && $participant[0] != 'name' && !empty($participant[0])) {
                $return[] = [
                    'Participant' => [
                        'name' => trim($participant[0]),
                        'department' => trim($participant[1]),
                        'email' => trim($participant[2]),
                        'cpf' => trim($participant[3])
                    ]
                ];
            }
        }
        return $return;
    }

    private function getArrayFromCSVFile() {
        return file(Configure::read('PARTICIPANTS_CSV_FILE'));
    }

    //

    public function RandomlyCreateTeams() {

        $teamGeneric = $this->Team->findByName('generic');

        $this->TeamsParticipant->updateAll(
                array('team_id' => $teamGeneric['Team']['id'])
        );

        $teamsParticipant = $this->TeamsParticipant->find('all');
        if (count($teamsParticipant) < Configure::read('PARTICIPANTS_PER_TEAM')) {
            throw new Exception('Não existem participantes o suficiente para montar um time');
        }

        $howManyTeamsShouldBeCreated = ceil(count($teamsParticipant) / Configure::read('PARTICIPANTS_PER_TEAM'));
        $this->createTeams($howManyTeamsShouldBeCreated);
        $this->putUsersInRandomTeams($teamsParticipant, $howManyTeamsShouldBeCreated);
    }

    private function createTeams($howManyTeamsShouldBeCreated) {
        $this->Team->deleteAll('where Team.name != \'generic\'');
        for ($i = 0; $i < $howManyTeamsShouldBeCreated; $i++) {
            $this->Team->create();
            $this->Team->save(['name' => "Equipe $i"]);
        }
        return true;
    }

    private function putUsersInRandomTeams($teamsParticipants, $howManyTeamsShouldBeCreated) {
        $teamGeneric = $this->Team->find('first', ['conditions' => ['Team.name' => 'generic']]);
        if (empty($teamGeneric)) {
            throw new NotFoundException('Team Generic doesn`t exist in database');
        }

        $otherTeams = $this->Team->find('all', ['conditions' => ['Team.name !=' => 'generic']]);
        shuffle($teamGeneric['Participant']);

        foreach ($teamGeneric['Participant'] as $participant) {
            foreach ($otherTeams as &$otherTeam) {
                if (@count($otherTeam['Participant']['Participant']) < Configure::read('PARTICIPANTS_PER_TEAM')) {
                    $otherTeam['Participant']['Participant'][] = $participant['id'];
                    break;
                }
            }
        }

        $this->Team->deleteAll('where 1=1');
        $this->Team->create();
        $this->Team->saveAll($otherTeams);
    }

}
