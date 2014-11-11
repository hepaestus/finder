<div class="connections form">
<?php echo $this->Form->create('Connection'); ?>
	<fieldset>
		<legend><?php echo __('Edit Connection'); ?></legend>
	<?php
		echo $this->Form->input('connection_type', array('options' => array('blocked' => 'Blocked', 'acquaintance' => 'Acquaintance', 'friend' => 'Friend', 'relationship' => 'Relationship' )));
		//echo $this->Form->input('verified');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('Connection.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Connection.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Connections'), array('action' => 'index')); ?></li>
	</ul>
</div>
