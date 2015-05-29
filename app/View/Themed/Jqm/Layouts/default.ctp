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
        <?php echo $this->fetch('content'); ?>
</body>
</html>
