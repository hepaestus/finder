<div class="reputations form">
<?php echo $this->Form->create('Reputation'); ?>
	<fieldset>
		<legend><?php echo __('Admin Add Reputation'); ?></legend>
	<?php
		echo $this->Form->input('user_id');
		echo $this->Form->input('reviewer_id');
		echo $this->Form->input('comment');
		echo $this->Form->input('rating');
		echo $this->Form->input('endoresments_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Reputations'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
