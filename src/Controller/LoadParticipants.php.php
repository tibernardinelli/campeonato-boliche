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

    public function index() {
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
}
