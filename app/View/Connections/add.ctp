<div class="connections form">
<?php echo $this->Form->create('Connection'); ?>
	<fieldset>
		<legend><?php echo __('Add Connection'); ?></legend>
	<?php
        pr($this->data);
        if ( $this->data['Connections']['connection_id'] ) {
		    echo $this->Form->hidden('connection_id');
        } else {
		    echo $this->Form->select('connection_id', $connections);
        }
		echo $this->Form->input('message');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Connections'), array('action' => 'index')); ?></li>
	</ul>
</div>
