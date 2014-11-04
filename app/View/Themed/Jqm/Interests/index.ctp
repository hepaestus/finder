<div class="interests index">
	<h2><?php echo __('Interests'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('activity_id'); ?></th>
			<th><?php echo $this->Paginator->sort('giving'); ?></th>
			<th><?php echo $this->Paginator->sort('receiving'); ?></th>
			<th><?php echo $this->Paginator->sort('importance'); ?></th>
			<th><?php echo $this->Paginator->sort('experience'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($interests as $interest): ?>
	<tr>
		<td><?php echo h($interest['Interest']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($interest['User']['id'], array('controller' => 'users', 'action' => 'view', $interest['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($interest['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $interest['Activity']['id'])); ?>
		</td>
		<td><?php echo h($interest['Interest']['giving']); ?>&nbsp;</td>
		<td><?php echo h($interest['Interest']['receiving']); ?>&nbsp;</td>
		<td><?php echo h($interest['Interest']['importance']); ?>&nbsp;</td>
		<td><?php echo h($interest['Interest']['experience']); ?>&nbsp;</td>
		<td><?php echo h($interest['Interest']['created']); ?>&nbsp;</td>
		<td><?php echo h($interest['Interest']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $interest['Interest']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $interest['Interest']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $interest['Interest']['id']), array(), __('Are you sure you want to delete # %s?', $interest['Interest']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Interest'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
