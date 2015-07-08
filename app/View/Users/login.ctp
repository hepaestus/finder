<div data-role="page" data-url="/finder/users/login" class="ui-page ui-body-c ui-page-active" id="login"> 
  
  <script>
    console.log("Load Login Page!");
  </script>
    <div class="users form">
      <h1>Welcome to the Finder App</h1>
      <?php echo $this->Session->flash('auth'); ?>
      <?php echo $this->Form->create('User', array('action' => 'login', 'data-ajax' => 'false')); ?>
      <fieldset>
          <legend>
              <?php echo '<h2>Please enter your username and password.</h2>'; ?>
          </legend>
          <?php 
            echo $this->Form->input('username');
            echo $this->Form->input('password');
          ?>
      </fieldset>
      <?php echo $this->Form->end(__('Login')); ?>
    </div>
  <div>
    <?php echo '<h2>Create a new Account</h2>'; ?>
    <?php echo $this->Html->link('Register for an Account', '/users/register'); ?>
  </div>
</div>
