<div class="activities view">
<h2><?php echo __('Activity'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Category'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['category']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Sub Category Of'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['sub_category_of']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description Url'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['description_url']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($activity['Activity']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activity'), array('action' => 'edit', $activity['Activity']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activity'), array('action' => 'delete', $activity['Activity']['id']), array(), __('Are you sure you want to delete # %s?', $activity['Activity']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Interests'); ?></h3>
	<?php if (!empty($activity['Interest'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('User Id'); ?></th>
		<th><?php echo __('Activity Id'); ?></th>
		<th><?php echo __('Giving'); ?></th>
		<th><?php echo __('Receiving'); ?></th>
		<th><?php echo __('Importance'); ?></th>
		<th><?php echo __('Experience'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($activity['Interest'] as $interest): ?>
		<tr>
			<td><?php echo $interest['id']; ?></td>
			<td><?php echo $interest['user_id']; ?></td>
			<td><?php echo $interest['activity_id']; ?></td>
			<td><?php echo $interest['giving']; ?></td>
			<td><?php echo $interest['receiving']; ?></td>
			<td><?php echo $interest['importance']; ?></td>
			<td><?php echo $interest['experience']; ?></td>
			<td><?php echo $interest['created']; ?></td>
			<td><?php echo $interest['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'interests', 'action' => 'view', $interest['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'interests', 'action' => 'edit', $interest['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'interests', 'action' => 'delete', $interest['id']), array(), __('Are you sure you want to delete # %s?', $interest['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
