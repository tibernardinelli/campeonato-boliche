<!-- Tela de Display CPF -->
<div class="display" id="cpf">
    <header>
        <a href="#"><h1>GTE - Campeonato de Boliche</h1></a>
    </header>
    <main>
        <div class="wrapper">
            <div class="action">
                <?php echo $this->Form->create('Participant'); ?>
                <fieldset>
                    <?php echo $this->Form->input('cpf', array('placeholder' => 'Digite aqui seu CPF', 'label' => 'CPF:', 'type' => 'number')); ?>
                    <!--<input class="button next grd" type="submit">-->
                </fieldset>
                <?php
                $options = array(
                    'label' => 'PROCURAR',
                    'class' => 'button next grd text-shadow'
                );
                echo $this->Form->end($options);
                echo $this->Html->link('Voltar', '/', ['class' => 'button peq return text-shadow']);
                ?>
                <footer></footer>
            </div>
    </main>
</div>