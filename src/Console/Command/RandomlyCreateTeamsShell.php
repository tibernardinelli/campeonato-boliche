<?php

class RandomlyCreateTeamsShell extends AppShell {

    public $uses = ['TeamsParticipant', 'Participant', 'Team'];

    public function main() {
        
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
