<div class="profiles form">
<?php echo $this->Form->create('Profile'); ?>
	<fieldset>
		<legend><?php echo __('Edit Profile'); ?></legend>
	<?php
		echo $this->Form->input('id');
		//echo $this->Form->input('user_id');
		echo $this->Form->input('scene_name');
        echo $this->Form->input('birth_date', array('label' => 'Date of Birth', 'dateFormat' => 'MDY', 'minYear' => date('Y') - 80, 'maxYear' => date('Y') - 16, ));
		echo $this->Form->textarea('about');

	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Form->postLink(__('Delete Profile'), array('action' => 'delete', $this->Form->value('Profile.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('Profile.id'))); ?></li>
	</ul>
</div>
