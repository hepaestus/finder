<div class="interests view">
<h2><?php echo __('Interest'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($interest['User']['id'], array('controller' => 'users', 'action' => 'view', $interest['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Activity'); ?></dt>
		<dd>
			<?php echo $this->Html->link($interest['Activity']['name'], array('controller' => 'activities', 'action' => 'view', $interest['Activity']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Giving'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['giving']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Receiving'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['receiving']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Importance'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['importance']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Experience'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['experience']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($interest['Interest']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Interest'), array('action' => 'edit', $interest['Interest']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Interest'), array('action' => 'delete', $interest['Interest']['id']), array(), __('Are you sure you want to delete # %s?', $interest['Interest']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
<div class="related">
	<h3><?php echo __('Related Activities'); ?></h3>
	<?php if (!empty($interest['Activity'])): ?>
	<table cellpadding = "0" cellspacing = "0">
	<tr>
		<th><?php echo __('Id'); ?></th>
		<th><?php echo __('Name'); ?></th>
		<th><?php echo __('Category'); ?></th>
		<th><?php echo __('Sub Category Of'); ?></th>
		<th><?php echo __('Description Url'); ?></th>
		<th><?php echo __('Created'); ?></th>
		<th><?php echo __('Modified'); ?></th>
		<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($interest['Activity'] as $activity): ?>
		<tr>
			<td><?php echo $activity['id']; ?></td>
			<td><?php echo $activity['name']; ?></td>
			<td><?php echo $activity['category']; ?></td>
			<td><?php echo $activity['sub_category_of']; ?></td>
			<td><?php echo $activity['description_url']; ?></td>
			<td><?php echo $activity['created']; ?></td>
			<td><?php echo $activity['modified']; ?></td>
			<td class="actions">
				<?php echo $this->Html->link(__('View'), array('controller' => 'activities', 'action' => 'view', $activity['id'])); ?>
				<?php echo $this->Html->link(__('Edit'), array('controller' => 'activities', 'action' => 'edit', $activity['id'])); ?>
				<?php echo $this->Form->postLink(__('Delete'), array('controller' => 'activities', 'action' => 'delete', $activity['id']), array(), __('Are you sure you want to delete # %s?', $activity['id'])); ?>
			</td>
		</tr>
	<?php endforeach; ?>
	</table>
<?php endif; ?>

	<div class="actions">
		<ul>
			<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
		</ul>
	</div>
</div>
