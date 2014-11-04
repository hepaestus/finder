<div class="users form">
<?php echo $this->Form->create('User'); ?>
<fieldset>
    <legend><?php echo __('Register a New User'); ?></legend>
<?php
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('email', array('label' => "Email Address"));
?>
</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
