<div class="teams view">
<h2><?php echo __('Team'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($team['Team']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($team['Team']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($team['Team']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($team['Team']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Team'), array('action' => 'edit', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Team'), array('action' => 'delete', $team['Team']['id']), array(), __('Are you sure you want to delete # %s?', $team['Team']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Teams'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Team'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Participants'), array('controller' => 'participants', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Participants'); ?></h3>
	<?php if (!empty($team['Participant'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Cpf'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Ddd'); ?></th>
		<th><?php echo __('Telephone'); ?></th>
		<th><?php echo __('Extension'); ?></th>
		<th><?php echo __('Email'); ?></th>
		<th><?php echo __('Picture'); ?></th>
		<th><?php echo __('Contest'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($team['Participant'] as $participant): ?>
		<tr>
			<td><?php echo $participant['id']; ?></td>
			<td><?php echo $participant['cpf']; ?></td>
			<td><?php echo $participant['name']; ?></td>
			<td><?php echo $participant['ddd']; ?></td>
			<td><?php echo $participant['telephone']; ?></td>
			<td><?php echo $participant['extension']; ?></td>
			<td><?php echo $participant['email']; ?></td>
			<td><?php echo $participant['picture']; ?></td>
			<td><?php echo $participant['contest']; ?></td>
			<td><?php echo $participant['created']; ?></td>
			<td><?php echo $participant['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'participants', 'action' => 'view', $participant['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'participants', 'action' => 'edit', $participant['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'participants', 'action' => 'delete', $participant['id']), array(), __('Are you sure you want to delete # %s?', $participant['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Participant'), array('controller' => 'participants', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
