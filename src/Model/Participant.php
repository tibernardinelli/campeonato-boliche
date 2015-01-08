<?php
App::uses('AppModel', 'Model');

/**
 * Participant Model
 *
 * @property Team $Team
 */
class Participant extends AppModel
{

    /**
     * Validation rules
     *
     * @var array
     */
    public $validate = array(
        'cpf' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'name' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'email' => array(
            'email' => array(
                'rule' => array('email'),
                'message' => 'Email inválido ou não esta preenchido',
                'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'contest' => array(
            'boolean' => array(
                'rule' => array('boolean'),
                //'message' => 'Your custom message here',
                //'allowEmpty' => false,
                //'required' => false,
                //'last' => false, // Stop validation after this rule
                //'on' => 'create', // Limit validation to 'create' or 'update' operations
            ),
        ),
        'telephone' => array(
            'minLength' => [
                'rule' => ['minLength', 14],
                'message' => 'Telefone deve possuir no minimo 14 caracteres: (00) 0000-0000'
            ]
        ),
    );


    //The Associations below have been created with all possible keys, those that are not needed can be removed

    /**
     * hasAndBelongsToMany associations
     *
     * @var array
     */
    public $hasAndBelongsToMany = array(
        'Team' => array(
            'className' => 'Team',
            'joinTable' => 'teams_participants',
            'foreignKey' => 'participant_id',
            'associationForeignKey' => 'team_id',
            'unique' => 'keepExisting',
            'conditions' => '',
            'fields' => '',
            'order' => '',
            'limit' => '',
            'offset' => '',
            'finderQuery' => '',
        )
    );

    public function beforeSave($options = array())
    {
        $this->participantSubscription();
        return true;
    }

    private function participantSubscription()
    {
        if (!isset($this->data['Participant']['subscribeMe'])) return false;

        if ((int)$this->data['Participant']['subscribeMe'] === 1) {
            $this->data['Team'] = ['Team' => [0 => $this->Team->getGenericTeam()['Team']['id']]];
        } else if ($this->data['Participant']['subscribeMe'] === '') {
            $myActualTeams = $this->findById($this->data['Participant']['id'])['Team'];
            if (!empty($myActualTeams)) {
                $this->data['Team']['Team'] = [0 => $myActualTeams[0]['id']];
            }
        } else if ((int)$this->data['Participant']['subscribeMe'] === 0) {
            $this->data['Team'] = null;
        }

        return true;
    }

    public function isCPFValid($cpf = false)
    {
        // Exemplo de CPF: 025.462.884-23

        /**
         * Multiplica dígitos vezes posições
         *
         * @param string $digitos Os digitos desejados
         * @param int $posicoes A posição que vai iniciar a regressão
         * @param int $soma_digitos A soma das multiplicações entre posições e digitos
         * @return int Os digitos enviados concatenados com o último dígito
         *
         */
        function calc_digitos_posicoes($digitos, $posicoes = 10, $soma_digitos = 0)
        {
            // Faz a soma dos digitos com a posição
            // Ex. para 10 posições:
            //   0    2    5    4    6    2    8    8   4
            // x10   x9   x8   x7   x6   x5   x4   x3  x2
            // 	 0 + 18 + 40 + 28 + 36 + 10 + 32 + 24 + 8 = 196
            for ($i = 0; $i < strlen($digitos); $i++) {
                $soma_digitos = $soma_digitos + ($digitos[$i] * $posicoes);
                $posicoes--;
            }

            // Captura o resto da divisão entre $soma_digitos dividido por 11
            // Ex.: 196 % 11 = 9
            $soma_digitos = $soma_digitos % 11;

            // Verifica se $soma_digitos é menor que 2
            if ($soma_digitos < 2) {
                // $soma_digitos agora será zero
                $soma_digitos = 0;
            } else {
                // Se for maior que 2, o resultado é 11 menos $soma_digitos
                // Ex.: 11 - 9 = 2
                // Nosso dígito procurado é 2
                $soma_digitos = 11 - $soma_digitos;
            }

            // Concatena mais um digito aos primeiro nove digitos
            // Ex.: 025462884 + 2 = 0254628842
            $cpf = $digitos . $soma_digitos;

            // Retorna
            return $cpf;
        }

        // Verifica se o CPF foi enviado
        if (!$cpf) {
            return false;
        }

        // Remove tudo que não é número do CPF
        // Ex.: 025.462.884-23 = 02546288423
        $cpf = preg_replace('/[^0-9]/is', '', $cpf);

        // Verifica se o CPF tem 11 caracteres
        // Ex.: 02546288423 = 11 números
        if (strlen($cpf) != 11) {
            return false;
        }

        // Captura os 9 primeiros dígitos do CPF
        // Ex.: 02546288423 = 025462884
        $digitos = substr($cpf, 0, 9);

        // Faz o cálculo dos 9 primeiros dígitos do CPF para obter o primeiro dígito
        $novo_cpf = calc_digitos_posicoes($digitos);

        // Faz o cálculo dos 10 digitos do CPF para obter o último dígito
        $novo_cpf = calc_digitos_posicoes($novo_cpf, 11);

        // Verifica se o novo CPF gerado é identico ao CPF enviado
        if ($novo_cpf === $cpf) {
            // CPF válido
            return true;
        } else {
            // CPF inválido
            return false;
        }

    }

    public function cancelParticipantSubscription($ParticipantId)
    {
        $this->read(null, $ParticipantId);
        $this->data['Team'] = [];
        return $this->saveAssociated();
    }

}
