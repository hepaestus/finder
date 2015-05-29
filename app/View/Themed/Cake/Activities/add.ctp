<div class="activities form">
<?php echo $this->Form->create('Activity'); ?>
	<fieldset>
		<legend><?php echo __('Add Activity'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('activity_category_id', array ( 'options' => $activity_category_id ));
		echo $this->Form->input('description_url');
		echo $this->Form->input('reciprocal');
		// echo $this->Form->input('Interest');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activities'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Activity Categories'), array('controller' => 'activity_categories', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Activity Category'), array('controller' => 'activity_categories', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
	</ul>
</div>
