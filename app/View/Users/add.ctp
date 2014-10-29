<div class="users form">
<?php echo $this->Form->create('User'); ?>
	<fieldset>
		<legend><?php echo __('Add User'); ?></legend>
	<?php
		echo $this->Form->input('profile_id');
		echo $this->Form->input('extended_profile_id');
		echo $this->Form->input('username');
		echo $this->Form->input('password');
		echo $this->Form->input('recovery_hash');
		echo $this->Form->input('role');
		echo $this->Form->input('email');
		echo $this->Form->input('loggedin');
		echo $this->Form->input('lastlogin');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Users'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Profiles'), array('controller' => 'profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Profile'), array('controller' => 'profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Extended Profiles'), array('controller' => 'extended_profiles', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Extended Profile'), array('controller' => 'extended_profiles', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Interests'), array('controller' => 'interests', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Interest'), array('controller' => 'interests', 'action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Reputations'), array('controller' => 'reputations', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Reputation'), array('controller' => 'reputations', 'action' => 'add')); ?> </li>
	</ul>
</div>
