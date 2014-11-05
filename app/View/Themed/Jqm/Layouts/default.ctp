<?php
/**
 * @copyright     
 * @link          
 * @package       app.View.Layouts
 * @since         
 * @license       
 */
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');

        #echo $this->Html->script('http://code.jquery.com/jquery-1.4.4.min.js');
        echo $this->Html->script('jquery.js');
        echo $this->Html->script('index.js');
        echo $this->Html->script('jquery.mobile-1.4.4.js');
        #echo $this->Html->script('jquery.mobile-1.4.4.min.js');
        
        echo $this->Html->css('jquery.mobile-1.4.4.css');
        #echo $this->Html->css('jquery.mobile-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.external-png-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.external-png-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.icons-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.icons-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.inline-png-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.inline-png-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.inline-svg-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.inline-svg-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.structure-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.structure-1.4.4.min.css');
        echo $this->Html->css('jquery.mobile.theme-1.4.4.css');
        #echo $this->Html->css('jquery.mobile.theme-1.4.4.min.css');
        echo $this->Html->css('jqm-demos.css');

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div data-role="page" id="one">
        <div data-role="header">
            <?php echo $this->Session->flash(); ?>
            <h1><?php echo $title_for_layout; ?></h1>
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
        </div><!-- /header -->

        <div role="main" class="ui-content">
        <?php echo $this->fetch('content'); ?>
        </div> <!-- end role="main" class="ui-content" -->

        <div data-role="footer">
            <h4>Main Section ONE Footer</h4>
            <a href="#sqldebug">Sql Debug</a>
        </div><!-- /footer -->
    </div><!-- /page -->
    
    <div data-role="page" id="sqldebug">
        <div data-role="header">
          <h4>SQL Debugging</h4>
        </div><!-- /header -->
        <div role="main" class="ui-content">
    	<?php echo $this->element('sql_dump'); ?>
        </div> <!-- end role="main" class="ui-content" -->

        <div data-role="footer">
            <h4>SQL Debug Footer</h4>
            <a href="#one">Back To Top</a>
        </div><!-- /footer -->
    </div><!-- /page -->
</body>
</html>
