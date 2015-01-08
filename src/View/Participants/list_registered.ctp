<style type="text/css">a {
        color: #cccccc;
    }</style>
<div class="participants index">
    <h2>Participantes Inscritos</h2>
    <table cellpadding="0" cellspacing="0" class="table table-striped">
        <thead>
        <tr>
            <th>Foto</th>
            <th>Nome</th>
            <th>CPF</th>
            <th>DDD</th>
            <th>Telefone</th>
            <th>Ramal</th>
            <th>Email</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($teamsParticipants as $teamsParticipant): ?>
            <tr>
                <td><?php echo $this->Html->image("/img/participants_pictures/{$teamsParticipant['Participant']['id']}.jpg?" . String::uuid(), ['class' => 'img-rounded', 'style' => 'width:45px']); ?></td>
                <td><?php echo h($teamsParticipant['Participant']['name']); ?>&nbsp;</td>
                <td><?php echo h($teamsParticipant['Participant']['cpf']); ?>&nbsp;</td>
                <td><?php echo h($teamsParticipant['Participant']['ddd']); ?>&nbsp;</td>
                <td><?php echo h($teamsParticipant['Participant']['telephone']); ?>&nbsp;</td>
                <td><?php echo h($teamsParticipant['Participant']['extension']); ?>&nbsp;</td>
                <td><?php echo h($teamsParticipant['Participant']['email']); ?>&nbsp;</td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <p>
        <?php
        echo $this->Paginator->counter(array(
            'format' => __('Total de participantes no boliche {:count}')
        ));
        ?>    </p>

    <div class="paging">
        <?php
        echo $this->Paginator->prev('< ' . __('anterior'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('proxima') . ' >', array(), null, array('class' => 'next disabled'));
        ?>
    </div>
    <?php echo $this->Html->link('Voltar', '/', ['class' => 'btn btn-warning']) ?>
</div>
