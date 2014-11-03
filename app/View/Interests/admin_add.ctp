<div class="interests form">
<?php echo $this->Form->create('Interest'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Interest'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('activity_id');
		echo $this->Form->input('giving');
		echo $this->Form->input('receiving');
		echo $this->Form->input('importance');
		echo $this->Form->input('experience');
		echo $this->Form->input('Activity');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Interests'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Activities'), array('controller' => 'activities', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity'), array('controller' => 'activities', 'action' => 'add')); ?> </li>
	</ul>
</div>
