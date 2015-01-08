<?php
$teamGenericTotal = $teamTotal = 0;
?>

<div class="container">
    <div class="row">
        <div id="inscritos" class="aviso">
            <div class="wrapper">

                <?php foreach ($teams as $team): ?>

                    <h2 class="panel-title">
                        <?php echo $team['Team']['name'] != 'generic' ? $team['Team']['name'] : 'Aguardando Sorteio'; ?>
                        </a>
                    </h2>

                    <?php
                    if ($team['Team']['name'] == 'generic') {
                        $teamGenericTotal += count($team['Participant']);
                    } else {
                        $teamTotal += count($team['Participant']);
                    }
                    ?>

                    <!--                 class="panel-collapse collapse">-->


                    <table class="table inscritos strip">
                        <thead>
                            <tr>
                                <th>Foto:</th>
                                <th class="nome">Nome:</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($team['Participant'] as $teamsParticipant): ?>
                                <tr class="data persona">
                                    <td>
                                        <?php
                                        $info = new SplFileInfo(Configure::read('PARTICIPANTS_PICTURES_DIR') . $teamsParticipant['id'] . '.jpg');
                                            if ($info->isFile()) {
                                                echo $this->Html->image("/img/participants_pictures/{$teamsParticipant['id']}.jpg?" . String::uuid(), ['class' => 'thumb']);
                                            } else {
                                                echo '<img class="thumb thumb-img-mini">';
                                            }
                                        ?>
                                    </td>
                                    <td class="nome"><?php echo $teamsParticipant['name']; ?></td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php endforeach; ?>

                <p class="label">Participantes aguardando sorteio: <strong class="flag"><?php echo " $teamGenericTotal" ?></strong></p>
                <p class="label">Participantes nas equipes: <strong class="flag"><?php echo " $teamTotal" ?></strong></p>
                <p class="label"><?php echo $date = (new DateTime())->format("d/m/Y H:i:s"); ?></p>

                <?php echo $this->Html->link('Voltar', '/', array('class' => 'button peq return text-shadow')); ?>
            </div>
        </div>
    </div>
</div>