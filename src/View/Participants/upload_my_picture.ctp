<!-- Tela de Aviso -->
<div class="aviso no-modal" id="avatar">
    <h2>AVATAR</h2>
    <p class="texto-corrido"> Recorte e(ou) redimensione seu avatar. Utilize somente imagens em jpg ou png menores que <stron class="flag">1 MB</stron>.</p>
        <?php echo $this->Form->create('Participant', ['type' => 'file']); ?>
<fieldset>
    <?php
    echo $this->Form->input('id');
    /*
      echo $this->Form->input('MyFile', array(
      'type' => 'file',
      'options' => array('accept' => '.jpg, .png, .jpeg')
      ));
     */
    echo $this->Form->input('picture_file', array(
        'type' => 'file',
        'class' => 'upload',
        'label' => false,
        'accept' => '.jpg, .png, .jpeg',
        'required' => true
    ));
    ?>
</fieldset>
<?php
echo $this->Form->submit('ENVIAR FOTO', array(
    'class' => 'button ok peq text-shadow',
    'label' => false,
    'id' => 'avatar-button',
    'required' => true,
    'div' => false
));

echo $this->Html->link('Voltar', '/Participants/edit/' . $this->request->data['Participant']['id'], ['class' => 'return peq button text-shadow']);
echo $this->Form->end();
?>


</div>
<script type="text/javascript">
    $("document").ready(function(){

    $("#ParticipantPictureFile").change(function() {
    alert('changed!');
    });
            //'accept' => '.jpg, .png, .jpeg',
    });
            /* $(function () {
             /*$('#ParticipantPictureFile').change(function () {
             alert($('#ParticipantPictureFile').val());
             });*/

            /*$('#ParticipantPictureFile').live('change', function(){ 
             alert($('#ParticipantPictureFile').val());
             });*/


    } * /
</script>
