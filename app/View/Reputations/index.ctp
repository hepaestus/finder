<div class="reputations index">
	<h2><?php echo __('Reputations'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('user_id'); ?></th>
			<th><?php echo $this->Paginator->sort('reviewer_id'); ?></th>
			<th><?php echo $this->Paginator->sort('comment'); ?></th>
			<th><?php echo $this->Paginator->sort('rating'); ?></th>
			<!-- th><?php //echo $this->Paginator->sort('endoresments_id'); ?></th -->
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($reputations as $reputation): ?>
	<tr>
		<td><?php echo h($reputation['Reputation']['id']); ?>&nbsp;</td>
		<td>
			<?php echo $this->Html->link($reputation['User']['username'], array('controller' => 'users', 'action' => 'view', $reputation['User']['id'])); ?>
		</td>
		<td>
			<?php echo $this->Html->link($reputation['Reviewer']['username'], array('controller' => 'users', 'action' => 'view', $reputation['Reviewer']['id'])); ?>
		</td>
		<td><?php echo h($reputation['Reputation']['comment']); ?>&nbsp;</td>
		<td><?php echo h($reputation['Reputation']['rating']); ?>&nbsp;</td>
		<!-- td><?php //echo h($reputation['Reputation']['endoresments_id']); ?>&nbsp;</td -->
		<td><?php echo h($reputation['Reputation']['created']); ?>&nbsp;</td>
		<td><?php echo h($reputation['Reputation']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $reputation['Reputation']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $reputation['Reputation']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $reputation['Reputation']['id']), array(), __('Are you sure you want to delete # %s?', $reputation['Reputation']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Reputation'), array('action' => 'add')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
