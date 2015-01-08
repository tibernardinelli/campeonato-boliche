<?php
App::uses('AppModel', 'Model');

/**
 * Team Model
 *
 * @property Participant $Participant
 */
class Team extends AppModel
{

    public $actsAs = array('Containable');

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                'message' => 'Não pode ser nulo'
            ),
            'unique' => array(
                'rule' => 'isUnique',
                'message' => 'Este nome já foi escolhido por outro time'
            ),
        ),
    );

    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Participant' => array(
            'className' => 'Participant',
            'joinTable' => 'teams_participants',
            'foreignKey' => 'team_id',
            'associationForeignKey' => 'participant_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    private function createGenericTeam()
    {
        $this->clear();
        $this->create();
        return $this->save(['name' => 'generic']);
    }

    public function getGenericTeam()
    {
        $team_generic = $this->findByName('generic');
        if (empty($team_generic)) {
            return $this->createGenericTeam();
        } else {
            return $team_generic;
        }
    }

}
