<?php

App::uses('AppController', 'Controller');

class ParticipantsController extends AppController {

    public $uses = ['Participant', 'TeamsParticipant', 'Team', 'Config'];

    /**
     * Components
     *
     * @var array
     */
    public $components = array('Paginator');

    private function getConfig() {
        $config = $this->Config->findByName('Config');

        if (empty($config)) {
            $config['name'] = 'Config';
            $config['subscripiton_end_date'] = '20141115';
            $config['participants_per_team'] = 6;
            $config['can_cancel'] = true;
            $config['see_teams'] = true;

            $this->Config->create();
            $this->Config->save($config);

            $config = $this->Config->findByName('Config');
        }

        return $config;
    }

    public function home() {
        $config = $this->getConfig();
        $teamGeneric = $this->Team->findByName('generic');
        $otherTeams = $this->Team->find('first', array('conditions' => array('NOT' => array('name' => 'generic'))));
        $teamGenericExists = !empty($teamGeneric);
        $otherTeamsExists = !empty($otherTeams);
        $this->set(compact('teamGenericExists', 'otherTeamsExists', 'config'));
    }

    /**
     * index method
     *
     * @return void
     */
    public function list_registered() {
        $this->set('teamsParticipants', $this->Paginator->paginate('TeamsParticipant', null));
    }

    /**
     * view method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function view($id = null) {
        if (!$this->Participant->exists($id)) {
            throw new NotFoundException(__('Invalid participant'));
        }
        $options = array('conditions' => array('Participant.' . $this->Participant->primaryKey => $id));
        $this->set('participant', $this->Participant->find('first', $options));
    }

    /**
     * add method
     *
     * @return void
     */
    public function add() {
        if ($this->request->is('post')) {
            $this->Participant->create();
            if ($this->Participant->save($this->request->data)) {
                $this->Session->setFlash(__('The participant has been saved.'));
                return $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The participant could not be saved. Please, try again.'));
            }
        }
        $teams = $this->Participant->Team->find('list');
        $this->set(compact('teams'));
    }

    /**
     * edit method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function edit($id = null, $subscribeMe = null) {

        $config = $this->getConfig();

        if (new DateTime() > new DateTime($config['Config']['subscripiton_end_date'])) {
            throw new NotFoundException('As inscrições já estão encerradas');
        }
        if (!$this->Participant->exists($id)) {
            throw new NotFoundException(__('Invalid participant'));
        }
        if ($this->request->is(array('post', 'put'))) {

            $upload_my_picture = $this->request->data['Participant']['updImg'];
            $this->request->data['Participant']['updImg'] = 0;

            $saveOk = $this->Participant->save($this->request->data);

            if ($upload_my_picture) {
                return $this->redirect(['action' => 'upload_my_picture', $id, $subscribeMe]);
            } else {
                if ($saveOk) {
                    $this->Session->setFlash("sucesso", 'flash_modal');
                    return $this->redirect('/');
                } else {
                    $this->Session->setFlash("", 'flash_modal');
                }
            }
        } else {
            $options = array('conditions' => array('Participant.' . $this->Participant->primaryKey => $id));
            $this->request->data = $this->Participant->find('first', $options);
            if ($subscribeMe !== null) {
                $this->request->data['Participant']['subscribeMe'] = $subscribeMe;
            }
        }
        $myPicture = $this->ifParticipantHasAPictureReturnTheURI($id);

        $teams = $this->Participant->Team->find('list');
        $this->set(compact('teams', 'myPicture'));
    }

    private function ifParticipantHasAPictureReturnTheURI($ParticipantID) {
        $info = new SplFileInfo(Configure::read('PARTICIPANTS_PICTURES_DIR') . $ParticipantID . '.jpg');
        if ($info->isFile()) {
            return '/img/participants_pictures/' . $ParticipantID . '.jpg';
        } else {
            return false;
        }
    }

    public function cancel($id = null, $subscribeMe = null) {
        if (!$this->Participant->exists($id)) {
            throw new NotFoundException(__('inexistente'));
        }

        if (empty($this->Participant->read(null, $id)['Team'])) {
            $this->Session->setFlash('naoInscreveu', 'flash_modal');
            return $this->redirect('/');
        }

        if ($this->request->is(array('post', 'put'))) {

            $nomeCancelou = $this->Participant->data['Participant']['name'];
            $idEquipe = $this->Participant->data['Team'][0]['id'];

            if ($this->Participant->cancelParticipantSubscription($id)) {
                
                $this->notifyCancelParticipantSubscription($id, $idEquipe, $nomeCancelou);
                
                $this->Session->setFlash("cancelou", 'flash_modal');

                return $this->redirect('/');
            } else {
                $this->Session->setFlash('ops', 'flash_modal');
            }
        } else {
            $options = array('conditions' => array('Participant.' . $this->Participant->primaryKey => $id));
            $this->request->data = $this->Participant->find('first', $options);
            if ($subscribeMe !== null) {
                $this->request->data['Participant']['subscribeMe'] = $subscribeMe;
            }
        }
        $myPicture = $this->ifParticipantHasAPictureReturnTheURI($id);

        $teams = $this->Participant->Team->find('list');
        $this->set(compact('teams', 'myPicture'));
    }

    /**
     * delete method
     *
     * @throws NotFoundException
     * @param string $id
     * @return void
     */
    public function delete($id = null) {
        $this->Participant->id = $id;
        if (!$this->Participant->exists()) {
            throw new NotFoundException(__('Invalid participant'));
        }
        $this->request->allowMethod('post', 'delete');
        if ($this->Participant->delete()) {
            $this->Session->setFlash(__('The participant has been deleted.'));
        } else {
            $this->Session->setFlash(__('The participant could not be deleted. Please, try again.'));
        }
        return $this->redirect(array('action' => 'index'));
    }

    public function find_me($subscribeMe = 1) {
        if ($this->request->is('post')) {
            if ($this->Participant->isCPFValid($this->request->data['Participant']['cpf'])) {
                $me = $this->Participant->find('first', ['conditions' => ['cpf' => $this->request->data['Participant']['cpf']]]);
                if (($subscribeMe == 2 || $subscribeMe == 0) && empty($me['Team'])) {
                    $this->Session->setFlash('CPFnaoInscrito', 'flash_modal');
                    $this->redirect('/');
                }

                if (!empty($me)) {
                    if ($subscribeMe == 2) {
                        return $this->redirect(['controller' => 'Teams', 'action' => 'edit', $me['Team'][0]['id'], $me['Participant']['id']]);
                    } else if ($subscribeMe) {
                        return $this->redirect(array('action' => 'edit', $me['Participant']['id'], $subscribeMe));
                    } else {
                        return $this->redirect(array('action' => 'cancel', $me['Participant']['id'], $subscribeMe));
                    }
                } else {
                    $this->Session->setFlash('NaoEcontramosCPF', 'flash_modal');
                }
            } else {
                $this->Session->setFlash('CPFInvalido', 'flash_modal');
            }
        }

        $this->set(compact('subscribeMe'));
    }

    public function upload_my_picture($id = null, $subscribeMe = null) {
        //$this->layout = 'bootstrap_popup';

        App::uses('Resize', 'Vendor');

        $this->Participant->id = $id;
        if (!$this->Participant->exists()) {
            throw new NotFoundException(__('Invalid participant'));
        }

        $this->request->data['Participant']['id'] = $id;

        if (empty($this->request->data)) {
            $this->Participant->id = $id;
            $this->Participant->read();
            $this->request->data = $this->Participant->data;
        }

        if ($this->request->is(array('post', 'put'))) {
            $newPicture = Configure::read('PARTICIPANTS_PICTURES_DIR') . $id . '.jpg';
            move_uploaded_file($this->request->data['Participant']['picture_file']['tmp_name'], $newPicture);

            $this->Session->setFlash('');
            //return $this->redirect(['action' => 'crop_my_picture', $id]);
            return $this->redirect(['action' => 'edit', $id, $subscribeMe]);
        }
    }

    public function crop_my_picture($id = null) {
        $this->layout = 'bootstrap_popup';

        if (empty($this->request->data)) {
            $this->Participant->id = $id;
            $this->Participant->read();
            $this->request->data = $this->Participant->data;
        }

        if ($this->request->is(['put', 'post'])) {
            $x = $this->request->data['Participant']['x'];
            $y = $this->request->data['Participant']['y'];
            $h = $this->request->data['Participant']['h'];
            $w = $this->request->data['Participant']['w'];

            $targ_w = $targ_h = 150;
            $jpeg_quality = 90;

            $src = Configure::read('PARTICIPANTS_PICTURES_DIR') . "/$id.jpg";
            $img_r = imagecreatefromjpeg($src);
            $dst_r = ImageCreateTrueColor($targ_w, $targ_h);

            imagecopyresampled($dst_r, $img_r, 0, 0, $x, $y, $targ_w, $targ_h, $w, $h);

            $newPicture = Configure::read('PARTICIPANTS_PICTURES_DIR') . $id . '.jpg';
            if (imagejpeg($dst_r, $newPicture, $jpeg_quality)) {
                $this->Session->setFlash(__('Parabens'));

                $this->set(['cropSuccess' => true, 'participantId' => $id]);
            } else {
                $this->set(['cropSuccess' => false]);
            }
        }
        return true;
    }

    public function testmail() {
        $this->enviarEmail('Equipe X', 'Giovanni Carmona Prudencio', 'gprudencio@vanzolini-ead.org.br');
    }

    public function notifyCancelParticipantSubscription($participantCancelId, $equipeId, $participantCancelNome) {
        try {
            $equipe = $this->Team->findById($equipeId);

            $equipeNome = $equipe['Team']['name'];
            if ($equipeNome != 'generic') {
                
                foreach ($equipe['Participant'] as $participant) {
                    if ($participant['id'] != $participantCancelId) {
                        try {
                            //$nome = $participant['name'];
                            $email = $participant['email'];

                            //$this->enviarEmail($equipeNome, $nome, 'gprudencio@vanzolini-ead.org.br');
                            $this->enviarEmail($equipeNome, $participantCancelNome, $email);
                        } catch (Exception $ex) {
                            
                        }
                    }
                }
            }
        } catch (Exception $exp) {
            
        }
    }

    public function enviarEmail($equipe, $participante, $to) {
        App::uses('CakeEmail', 'Network/Email');

        $Email = new CakeEmail('smtp');
        $Email->template('cancelar', 'cancelar');

        $Email->viewVars(array('equipe' => $equipe,
            'participante' => $participante)
        );
        //$Email->subject('Campeonato de Boliche – GTE');
        $Email->subject('Cancelamento de inscrição');
        $Email->emailFormat('html');
        $Email->to($to);
        $Email->send();
    }

}
