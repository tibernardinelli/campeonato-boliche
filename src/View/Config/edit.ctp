<div class="configs form">
<?php echo $this->Form->create('Config'); ?>
	<fieldset>
		<legend><?php echo __('Edit Config'); ?></legend>
	<?php
		echo $this->Form->input('id');
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

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Config.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Config.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?></li>
	</ul>
</div>
