<?php
/**
 *
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Layouts
 * @since         CakePHP(tm) v 0.10.0.1076
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

$cakeDescription = __d('cake_dev', 'CakePHP: the rapid development php framework');
$cakeVersion = __d('cake_dev', 'CakePHP %s', Configure::version())
?>
<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
		<script lang="javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->script('geolocation');
		echo $this->Html->css('cake.generic');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
	<div id="container">
		<div id="header">
			<h1><?php echo $this->Html->link($cakeDescription, 'http://cakephp.org'); ?></h1>
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
		<div id="content">

			<?php echo $this->Session->flash(); ?>

			<?php echo $this->fetch('content'); ?>
		</div>
		<div id="footer">
			<?php echo $this->Html->link(
					$this->Html->image('cake.power.gif', array('alt' => $cakeDescription, 'border' => '0')),
					'http://www.cakephp.org/',
					array('target' => '_blank', 'escape' => false, 'id' => 'cake-powered')
				);
			?>
			<p>
				<?php echo $cakeVersion; ?>
			</p>
		</div>
	</div>
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
