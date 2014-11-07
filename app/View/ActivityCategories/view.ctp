<div class="activityCategories view">
<h2><?php echo __('Activity Category'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Parent Id'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['parent_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Lft'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['lft']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rght'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['rght']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($activityCategory['ActivityCategory']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Activity Category'), array('action' => 'edit', $activityCategory['ActivityCategory']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Activity Category'), array('action' => 'delete', $activityCategory['ActivityCategory']['id']), array(), __('Are you sure you want to delete # %s?', $activityCategory['ActivityCategory']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Activity Categories'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity Category'), array('action' => 'add')); ?> </li>
	</ul>
</div>
