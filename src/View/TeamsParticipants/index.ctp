<div class="teamsParticipants index">
	<h2><?php echo __('Teams Participants'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('participant_id'); ?></th>
			<th><?php echo $this->Paginator->sort('team_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($teamsParticipants as $teamsParticipant): ?>
	<tr>
		<td>
			<?php echo $this->Html->link($teamsParticipant['Participant']['name'], array('controller' => 'participants', 'action' => 'view', $teamsParticipant['Participant']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($teamsParticipant['Team']['name'], array('controller' => 'teams', 'action' => 'view', $teamsParticipant['Team']['id'])); ?>
		</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $teamsParticipant['TeamsParticipant']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $teamsParticipant['TeamsParticipant']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $teamsParticipant['TeamsParticipant']['id']), array(), __('Are you sure you want to delete # %s?', $teamsParticipant['TeamsParticipant']['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Teams Participant'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('controller' => 'teams', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('controller' => 'teams', 'action' => 'add')); ?> </li>
	</ul>
</div>
