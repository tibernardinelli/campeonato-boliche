<div class="teamsParticipants form">
<?php echo $this->Form->create('TeamsParticipant'); ?>
	<fieldset>
		<legend><?php echo __('Edit Teams Participant'); ?></legend>
	<?php
		echo $this->Form->input('participant_id');
		echo $this->Form->input('team_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('TeamsParticipant.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('TeamsParticipant.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Teams Participants'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
