<!-- Modal -->
<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content aviso erro">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
        <?php
        //Se a mensagem for sucesso...
        if($message == 'sucesso'){?>
            <h2>PARABÉNS</h2>
          </div>
          <div class="modal-body">
            <p class="texto-corrido">Você concluiu com sucesso sua inscrição para o Campeonato de Boliche - GTE. </p>
            <p class="texto-corrido">Boa Festa, muitos Strikes  e se <strong class="flag">beber não dirija</strong>.
          </div>
          <div class="modal-footer">
            <!-- Imagem que flutua -->
            <?php echo $this->Html->image('conteudo/avisos/parabens.png', array('alt' => 'Parabéns!')); ?>   
          </div>

            <?php
            // Se a mensagem for cancelamento...
        } elseif ($message == 'cancelou') {?>
        <h2>QUE PENA...</h2>
      </div>
        <div class="modal-body">
            <p class="texto-corrido">Você cancelou sua inscrição para o Campeonato de Boliche - GTE. </p>
            <p class="texto-corrido">Mesmo assim nos vemos na festa, <strong class="flag">boa diversão!</strong>.
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
            <?php echo $this->Html->image('conteudo/avisos/quepena.png', array('alt' => 'Parabéns!')); ?>   
        </div>
        
        <?php
        // Se a mensagem for Ops...
        } elseif ($message == 'ops') { ?>
        <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Temos problemas, você não pode cancelar sua inscrição!</p>
            <p class="texto-corrido">Ou você já não estava cadastrado, ou ocorreu algum erro. <strong class="flag">Verifique seu cadastro</strong>.
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
            <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
            
        <?php
        } elseif ($message == 'naoInscreveu') {
            ?>
            <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Você ainda não se inscreveu no Campeonato de Boliche - GTE.</p>
            <p class="texto-corrido"> Verifique se você está <strong class="flag">no prazo</strong> para se cadastrar.</p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
        
        <?php
        } elseif ($message == 'CPFnaoInscrito') {
            ?>
            <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Este CPF não está inscrito no Campeonato de Boliche - GTE. </p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
        
        <?php
        } elseif ($message == 'NaoEcontramosCPF') {
            ?>
            <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Não encontramos seu CPF.</p>
            <p class="texto-corrido">Verifique entrando em contato com <strong class="flag">lalmeida@vanzolini-ead.org.br</strong></p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
        
        <?php
        } elseif ($message == 'CPFInvalido') {
            ?>
            <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">CPF inválido, tente novamente.</p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
        
        <?php
        } elseif ($message == 'TituloAlterado') {
            ?>
            <h2>Ai sim!</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Nome do time foi alterado com sucesso!</p>
            <p class="texto-corrido">Boa Festa, muitos Strikes e se <strong class="flag">beber não dirija</strong>.
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
                
        <?php
        } elseif ($message == 'FalhaSalvarEquipe') {
            ?>
            <h2>Ops...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Houve uma falha ao tentar salvar a equipe</p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
        <?php echo $this->Html->image('conteudo/avisos/ops.png', array('alt' => 'Parabéns!')); ?>   
        </div>
                   
         <?php } else {?>
        <h2>Algo não está certo...</h2>
        </div>
        <div class="modal-body">
            <p class="texto-corrido">Você digitou campos que estão inválidos. Por favor preencha corretamente todos os campos antes de continuar.</p>
        </div>
        <div class="modal-footer">
            <!-- Imagem que flutua -->
            <?php echo $this->Html->image('conteudo/avisos/quepena.png', array('alt' => 'Parabéns!')); ?>   
        </div>
         <?php }?>
    </div>
  </div>
</div>



<script type="text/javascript">
    $('.modal').modal();
</script>