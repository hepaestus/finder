<div class="reputations view">
<h2><?php echo __('Reputation'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reputation['User']['id'], array('controller' => 'users', 'action' => 'view', $reputation['User']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Reviewer'); ?></dt>
		<dd>
			<?php echo $this->Html->link($reputation['Reviewer']['id'], array('controller' => 'users', 'action' => 'view', $reputation['Reviewer']['id'])); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Comment'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['comment']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Rating'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['rating']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Endoresments Id'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['endoresments_id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($reputation['Reputation']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Reputation'), array('action' => 'edit', $reputation['Reputation']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Reputation'), array('action' => 'delete', $reputation['Reputation']['id']), array(), __('Are you sure you want to delete # %s?', $reputation['Reputation']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Reputations'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reputation'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
