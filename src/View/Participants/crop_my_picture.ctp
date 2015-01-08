<?php if (!empty($cropSuccess) && $cropSuccess === true): ?>
    <script type="text/javascript">
        //Leandro isso está dando pau
        window.opener.document.getElementById("thumb").innerHTML = '<?php echo $this->Html->image("/img/participants_pictures/$participantId.jpg?" . String::uuid()) ?>';
        window.close();
    </script>

<?php
    die; endif; ?>
<script type="text/javascript">

    $(function () {

        $('#cropbox').Jcrop({
            aspectRatio: 1,
            onSelect: updateCoords
        });

    });

    function updateCoords(c) {
        $('#ParticipantX').val(c.x);
        $('#ParticipantY').val(c.y);
        $('#ParticipantW').val(c.w);
        $('#ParticipantH').val(c.h);
    }
    ;

    function checkCoords() {
        if (parseInt($('#ParticipantW').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
    }
    ;
</script>
<style type="text/css">
    #target {
        background-color: #ccc;
        width: 500px;
        height: 330px;
        font-size: 24px;
        display: block;
    }

    #cropbox {

    }
</style>



<div class="aviso" id="crop">
    <?php echo $this->Form->create('Participant', ['onsubmit' => 'return checkCoords();']); ?>
    <fieldset>
        <?php
        echo $this->Form->input('id');
        echo $this->Html->image("participants_pictures/{$this->request->data['Participant']['id']}.jpg?" . String::uuid(), ['id' => 'cropbox']);
        echo $this->Form->hidden('x');
        echo $this->Form->hidden('y');
        echo $this->Form->hidden('w');
        echo $this->Form->hidden('h');
        ?>
    </fieldset>
    <?php
    echo $this->Form->submit('Recortar Imagem',array('class'=>'button peq ok', 'id'=>'recortar'));
    echo $this->Form->end(); ?>
</div>