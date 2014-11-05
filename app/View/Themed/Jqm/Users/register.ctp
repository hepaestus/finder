<div class="users form">
<?php echo $this->Form->create('User'); ?>
<?php
echo $this->Form->input('username');
echo $this->Form->input('password');
echo $this->Form->input('email', array('label' => "Email Address"));
?>
</fieldset>
<?php echo $this->Form->end(array('label' => 'Submit', 'data-inline' => 'true', 'type' => 'button' )); ?>
</div>
