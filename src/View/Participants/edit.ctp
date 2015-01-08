<!-- Tela de Formulario -->
<script type="text/javascript">
function go() {
    $('#ParticipantUpdImg').val(1);
    $('#ParticipantEditForm').submit();
}
</script>
<div class="formulario">
    <div class="wrapper">
        <header>
            <h1><a href="/inicio">GTE - Campeonato de Boliche</a></h1>
        </header>
        <main>
            <div class="action">
                <?php
                echo $this->Form->create('Participant', ['inputDefaults' =>
                    [
                        'type' => 'text',
                        'label' => false,
                        'div' => false
                    ]
                ]);
                ?>
                <a href="#"
                   style="color:#000;"
                   onclick="go();"
                   id="thumb">
                    <?php echo!$myPicture ? "ENVIAR IMAGEM" : $this->Html->image($myPicture . '?' . String::uuid()); ?>
                </a>

                <?php echo $this->Form->hidden('updImg'); ?>

                <?php echo $this->Form->hidden('id'); ?>
                <fieldset>
                    <label>CPF:</label>
                    <?php echo $this->Form->input('cpf', ['readonly' => true]) ?>
                </fieldset>


                <fieldset>
                    <label>Nome:</label>
                    <?php echo $this->Form->input('name', ['readonly' => true]) ?>
                </fieldset>

                <fieldset>
                    <label>Tel:</label>
                    <?php echo $this->Form->input('telephone') ?>
                </fieldset>

                <fieldset>
                    <label>Email:</label>
                    <?php echo $this->Form->input('email') ?>
                </fieldset>

                <footer>
                    <?php
                    echo $this->Form->submit('CONFIRMAR', array('class' => 'button ok grd text-shadow', 'id' => 'btnCONFIRMAR'));
                    echo $this->Html->link('Voltar', '/Participants/find_me', ['class' => 'return peq button text-shadow']);
                    ?>
                </footer>

                <?php
                echo $this->Form->hidden('subscribeMe');
                echo $this->Form->end();
                ?>
            </div>
        </main>
    </div>

