<div class="teamsParticipants view">
<h2><?php echo __('Teams Participant'); ?></h2>
	<dl>
		<dt><?php echo __('Participant'); ?></dt>
		<dd>
			<?php echo $this->Html->link($teamsParticipant['Participant']['name'], array('controller' => 'participants', 'action' => 'view', $teamsParticipant['Participant']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Team'); ?></dt>
		<dd>
			<?php echo $this->Html->link($teamsParticipant['Team']['name'], array('controller' => 'teams', 'action' => 'view', $teamsParticipant['Team']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Teams Participant'), array('action' => 'edit', $teamsParticipant['TeamsParticipant']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Teams Participant'), array('action' => 'delete', $teamsParticipant['TeamsParticipant']['id']), array(), __('Are you sure you want to delete # %s?', $teamsParticipant['TeamsParticipant']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams Participants'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Teams Participant'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
