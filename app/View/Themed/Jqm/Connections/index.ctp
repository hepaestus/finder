<div class="connections index">
	<h2><?php echo __('Connections'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo __('id'); ?></th>
			<th><?php echo __('user_id'); ?></th>
			<th><?php echo __('connection_id'); ?></th>
			<th><?php echo __('connection_type'); ?></th>
			<th><?php echo __('verified'); ?></th>
			<th><?php echo __('message'); ?></th>
			<th><?php echo __('created'); ?></th>
			<th><?php echo __('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($connections as $connection): ?>
	<tr>
		<td><?php echo h($connection['id']); ?>&nbsp;</td>
		<td><?php echo h($connection['user_id']); ?>&nbsp;</td>
		<td><?php echo h($connection['connection_id']); ?>&nbsp;</td>
		<td><?php echo h($connection['connection_type']); ?>&nbsp;</td>
		<td><?php echo h($connection['verified']); ?>&nbsp;</td>
		<td><?php echo h($connection['message']); ?>&nbsp;</td>
		<td><?php echo h($connection['created']); ?>&nbsp;</td>
		<td><?php echo h($connection['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $connection['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $connection['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $connection['id']), array(), __('Are you sure you want to delete # %s?', $connection['id'])); ?>
		</td>
	</tr>
<?php endforeach; ?>
	</tbody>
	</table>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('New Connection'), array('action' => 'add')); ?></li>
	</ul>
</div>
