<div class="configs view">
<h2><?php echo __('Config'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($config['Config']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($config['Config']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Subscripiton End Date'); ?></dt>
		<dd>
			<?php echo h($config['Config']['subscripiton_end_date']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Participants Per Team'); ?></dt>
		<dd>
			<?php echo h($config['Config']['participants_per_team']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Can Cancel'); ?></dt>
		<dd>
			<?php echo h($config['Config']['can_cancel']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('See Teams'); ?></dt>
		<dd>
			<?php echo h($config['Config']['see_teams']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Config'), array('action' => 'edit', $config['Config']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Config'), array('action' => 'delete', $config['Config']['id']), array(), __('Are you sure you want to delete # %s?', $config['Config']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Configs'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Config'), array('action' => 'add')); ?> </li>
	</ul>
</div>
