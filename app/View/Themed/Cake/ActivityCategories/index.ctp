<div class="activityCategories index">
	<h2><?php echo __('Activity Categories'); ?></h2>
	<table cellpadding="0" cellspacing="0">
	<thead>
	<tr>
			<th><?php echo $this->Paginator->sort('id'); ?></th>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('parent_id'); ?></th>
			<th><?php echo $this->Paginator->sort('lft'); ?></th>
			<th><?php echo $this->Paginator->sort('rght'); ?></th>
			<th><?php echo $this->Paginator->sort('created'); ?></th>
			<th><?php echo $this->Paginator->sort('modified'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	</thead>
	<tbody>
	<?php foreach ($activityCategories as $activityCategory): ?>
	<tr>
		<td><?php echo h($activityCategory['ActivityCategory']['id']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['name']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['parent_id']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['lft']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['rght']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['created']); ?>&nbsp;</td>
		<td><?php echo h($activityCategory['ActivityCategory']['modified']); ?>&nbsp;</td>
		<td class="actions">
			<?php echo $this->Html->link(__('View'), array('action' => 'view', $activityCategory['ActivityCategory']['id'])); ?>
			<?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $activityCategory['ActivityCategory']['id'])); ?>
			<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $activityCategory['ActivityCategory']['id']), array(), __('Are you sure you want to delete # %s?', $activityCategory['ActivityCategory']['id'])); ?>
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
		<li><?php echo $this->Html->link(__('New Activity Category'), array('action' => 'add')); ?></li>
	</ul>
</div>

<div>
  <?php echo $this->Html->nestedList($tree); ?>
</div>
