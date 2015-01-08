<!-- Tela de Display Início -->
<div class="display" id="inicio">
    <!--<button class="cta hint" data-toggle="modal" data-target="#hint"></button>-->
    <header>
        <h1><a href="/inicio">GTE - Campeonato de Boliche</a></h1>
    </header>
    <main>
        <div class="wrapper">
            <div class="action">
                <?php
                // Data fim
                if (new DateTime() <= new DateTime($config['Config']['subscripiton_end_date'])) {
                    echo '<div class="botoes continue">';
                    echo $this->Html->link('Realizar Inscrição', ['controller' => 'Participants', 'action' => 'find_me'], ['class' => 'text-shadow']);
                    echo '</div>';
                }
                // Teve sorteio
                if ($otherTeamsExists) {
                    echo '<div class="botoes continue">';
                    echo $this->Html->link('Minha Equipe', ['controller' => 'Participants', 'action' => 'find_me', 2], ['class' => 'text-shadow']);
                    echo '</div>';
                }
                //Pode Cancelar
                if ($config['Config']['can_cancel']) {
                    echo '<div class="botoes warning">';
                    echo $this->Html->link('Cancelar Inscrição', ['controller' => 'Participants', 'action' => 'find_me', 0], ['class' => 'text-shadow']);
                    echo '</div>';
                }    
                // Pode ver inscritos
                if ($config['Config']['see_teams']) {
                    echo '<div class="botoes continue">';
                    echo $this->Html->link( $otherTeamsExists ? 'Veja as Equipes' : 'Veja os inscritos',     ['controller' => 'Teams', 'action' => 'index', $teamGenericExists], ['class' => 'text-shadow']);
                    //echo $this->Html->link('Veja todas as equipes', ['controller' => 'Teams', 'action' => 'index', $teamGenericExists], ['class' => 'text-shadow']);
                    echo '</div>';
                }
                ?>
                
                
            </div>
        </div>
    </main>
</div>

<!-- Modal -->
<div class="modal fade" id="hint" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content aviso">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <h2>Informações</h2>
      </div>
      <div class="modal-body">
          <p class=texto-corrido>Você pode fazer sua inscrição de  <strong>03/11</strong> até <strong>15/11/2014</strong>.<br>
              O evento acontecerá no dia  <strong>17/12/2014</strong>, das <strong>12h às 19h</strong>.</p>
          <p class="texto-corrido"><strong class="flag">Não deixe de participar!</strong></p>
      </div>
      <div class="modal-footer">
          <a href="https://www.google.com/maps?ll=-23.526548,-46.674663&z=15&t=m&hl=pt-BR&gl=BR&mapclient=embed&cid=3157722952542793374" target="_blank">
         <?php echo $this->Html->image('conteudo/comochegar.jpg', array('alt' => 'Dica','class' => 'hint'));?>
        </a>
      </div>
        <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/googlemaps.png', array('alt' => 'Dica', 'id' => 'googlemaps'));?>
    </div>
  </div>
</div>