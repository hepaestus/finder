<div class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User'); ?>
    <fieldset>
        <legend>
            <?php echo '<h2>Please enter your username and password.</h2>'; ?>
        </legend>
        <?php echo $this->Form->input('username');
        echo $this->Form->input('password');
        ?>
    </fieldset>
<?php echo $this->Form->end(__('Login')); ?>
</div>
<div>
  <?php echo '<h2>Create a new Account</h2>'; ?>
  <?php echo $this->Html->link('Register for an Account', '/users/register'); ?>
</div>
