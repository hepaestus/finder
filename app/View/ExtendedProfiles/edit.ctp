<div class="extendedProfiles form">
<?php echo $this->Form->create('ExtendedProfile', array('enctype' => 'multipart/form-data')); ?>
	<fieldset>
		<legend><?php echo __('Edit Extended Profile'); ?></legend>
	<?php
	    echo $this->Form->input('id');
		// echo $this->Form->input('user_id');
		echo $this->Form->input('first_name');
		echo $this->Form->input('last_name');
		echo $this->Form->input('postal_code');
		echo $this->Form->input('gender_identity');
		echo $this->Form->input('relationship_status');
        if ( $this->Form->value('image') ) {
		    echo "<img src=\"/" . $this->Form->value('image') . "\" alt=\"profile image\">";
		    echo $this->Form->input('image_new', array('type' => 'file'));
        } else {
		    echo $this->Form->input('image', array('type' => 'file'));
        }
		echo $this->Form->input('external_links');
		echo $this->Form->input('latitude');
		echo $this->Form->input('longitude');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $this->Form->value('ExtendedProfile.id')), array(), __('Are you sure you want to delete # %s?', $this->Form->value('ExtendedProfile.id'))); ?></li>
		<li><?php echo $this->Html->link(__('List Extended Profiles'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?> </li>
	</ul>
</div>
