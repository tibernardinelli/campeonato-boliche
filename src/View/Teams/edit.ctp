<!-- Tela de Display Equipe -->
<div class="display" id="equipe">
    <header>
        <h1><a href="/inicio">GTE - Campeonato de Boliche</a></h1>
    </header>
    <main>
        <div class="action">
            <?php
            echo $this->Form->create('Team');
            echo $this->Form->input('id');
            ?>
            <div class="botoes continue">
                <div>
                    <?php
                    if ($this->request->data['Team']['name'] == 'generic') {
                        echo $this->Form->link('name', array('div' => false, 'id' => 'nome-equipe', 'label' => false, 'value' => 'Aguardando Sorteio', 'readonly' => true, 'class' => 'text-shadow generic-team'));
                    } else {
                        echo $this->Form->link('name', array('div' => false, 'id' => 'nome-equipe', 'label' => false, 'class' => 'text-shadow', 'maxlength' => 8));
                        echo $this->Form->submit('Editar', array('div' => false, 'id' => 'editar-equipe', 'label' => false, 'class' => 'text-shadow'));
                    }
                    ?>
                </div>
            </div>

            <?php foreach ($participants as $participant): ?>
                <article class="persona">
                    <div class="wrapper">
                        <?php
                        $info = new SplFileInfo(Configure::read('PARTICIPANTS_PICTURES_DIR') . $participant['id'] . '.jpg');
                        if ($info->isFile()) {
                            echo $this->Html->image("/img/participants_pictures/{$participant['id']}.jpg?" . String::uuid(), ['class' => 'thumb']);
                        } else {
                            echo '<img class="thumb thumb-img-mini" alt="">';
                        }
                        ?>
                        <p class="nome"><?php echo $participant['name']; ?></p>
                        <p class="email"><?php echo $participant['email']; ?></p>
                        <p class="telefone"><?php echo $participant['telephone']; ?></p>

                    </div>
                </article>
<?php endforeach; ?>
            <?php echo $this->Html->link('Voltar', '/', ['class' => 'button peq return']); ?>
        </div>
    </main>
<?php echo $this->Form->end(); ?>

</div>
