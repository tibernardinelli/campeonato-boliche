<div class="participants form">
<?php echo $this->Form->create('Participant'); ?>
	<fieldset>
		<legend><?php echo __('Add Participant'); ?></legend>
	<?php
		echo $this->Form->input('cpf');
		echo $this->Form->input('name');
		echo $this->Form->input('ddd');
		echo $this->Form->input('telephone');
		echo $this->Form->input('extension');
		echo $this->Form->input('email');
		echo $this->Form->input('picture');
		echo $this->Form->input('contest');
		echo $this->Form->input('Team');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Participants'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
