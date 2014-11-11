<div class="connections view">
<h2><?php echo __('Connection'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('User Id'); ?></dt>
		<dd>
			<?php //echo h($connection['Connection']['user_id']); ?>
			<?php echo h($connection['MyUser']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Connection Id'); ?></dt>
		<dd>
			<?php //echo h($connection['Connection']['connection_id']); ?>
			<?php echo h($connection['MyConnection']['username']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Connection Type'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['connection_type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Verified'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['verified']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Message'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['message']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Created'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['created']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Modified'); ?></dt>
		<dd>
			<?php echo h($connection['Connection']['modified']); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<!-- li><?php //echo $this->Html->link(__('Edit Connection'), array('action' => 'edit', $connection['Connection']['id'])); ?> </li -->
		<li><?php echo $this->Form->postLink(__('Delete Connection'), array('action' => 'delete', $connection['Connection']['id']), array(), __('Are you sure you want to delete # %s?', $connection['Connection']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Connections'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Connection'), array('action' => 'add')); ?> </li>
	</ul>
</div>
