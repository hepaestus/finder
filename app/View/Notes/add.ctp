<div class="notes form">
<?php echo $this->Form->create('Note'); ?>
	<fieldset>
		<legend><?php echo __('Add Note'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('to_user_id');
		echo $this->Form->input('message');
		echo $this->Form->input('read');
		echo $this->Form->input('subject');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Notes'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
