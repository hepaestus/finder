<div class="note form">
<?php echo $this->Form->create('Note', array('action' => 'reply')); ?>
	<fieldset>
		<legend><?php echo __('Reply'); ?></legend>
	<?php
        echo $this->Form->hidden('user_id');
        echo $this->Form->hidden('to_user_id');
		echo $this->Form->input('subject', array('value' => $subject));
		echo $this->Form->label('Message');
		echo $this->Form->textarea('message');
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
