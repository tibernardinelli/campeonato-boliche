<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Add Config'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('subscripiton_end_date');
		echo $this->Form->input('participants_per_team');
		echo $this->Form->input('can_cancel');
		echo $this->Form->input('see_teams');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?></li>
	</ul>
</div>
