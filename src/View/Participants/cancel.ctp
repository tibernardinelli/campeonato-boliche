<!-- Tela de Cancelamento -->
<div class="display" id="cancelar">
    <header>
        <h1><a href="/inicio">GTE - Campeonato de Boliche</a></h1>
    </header>
    <main>
        <div class="wrapper">
            <div class="action">
                <?php echo $this->Form->create('Participant'); ?>
                <p>Você tem certeza?</p>
                <?php
                echo $this->Form->hidden('subscribeMe');
                echo $this->Form->submit('Cancelar Inscrição', ['class' => 'button grd next text-shadow']);
                echo $this->Html->link('NÃO CANCELAR', '/', ['class' => 'button peq return text-shadow']);
                ?>
                <?php echo $this->Form->end(); ?>
            </div>
            <footer></footer>
        </div>
    </main>
</div>