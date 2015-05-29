		<div id="login">
            <?php if( ! $this->Session->read('Auth.User')) { ?>
                <div class="login">
                <?php echo $this->Html->link(__('Login'), array('controller' => 'users', 'action' => 'login')); ?> /
                <?php echo $this->Html->link(__('Register'), array('controller' => 'users', 'action' => 'register')); ?>
                </div>
            <?php } else {
                $userFoo = $this->Session->read('Auth.User');
            ?>
                <div class="logout">
                <?php echo $this->Html->link(__("Hello " . $userFoo['username']), array('controller' => 'users', 'action' => 'view', $userFoo['id'] )); ?>
                <?php echo $this->Html->link(__('Logout'), array('controller' => 'users', 'action' => 'logout')); ?>
                </div>
           <?php } ?>
		</div>
