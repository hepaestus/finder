<div class="activityCategories form">
<?php echo $this->Form->create('ActivityCategory'); ?>
	<fieldset>
		<legend><?php echo __('Add Activity Category'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('parent_id');
		echo $this->Form->input('lft');
		echo $this->Form->input('rght');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Activity Categories'), array('action' => 'index')); ?></li>
	</ul>
</div>
