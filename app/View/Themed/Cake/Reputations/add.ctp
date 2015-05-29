<div class="reputations form">
<?php echo $this->Form->create('Reputation'); ?>
	<fieldset>
		<legend><?php echo __('Add Reputation'); ?></legend>
	<?php
		echo $this->Form->input('username');
		echo $this->Form->input('comment');
        echo $this->Form->label('Reputation.rating','Rating');
		echo $this->Form->select('rating', array('3' => 'Awesome', '2' => 'Great', '1' => 'Good', '0' => '', '-1' => 'Needs Improvment', '-2' => 'Poor', '-3' => 'Very Poor'), array('value' => 0, 'empty' => false, 'label' => 'Rating' ));
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
