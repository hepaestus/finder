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
		<?php echo $cakeDescription ?>:
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<?php
		echo $this->Html->meta('icon');

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

		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <div data-role="page">

    <div data-role="header">
        <h1>Page Title</h1>
    </div><!-- /header -->

    <div role="main" class="ui-content">
	    <?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
    </div><!-- /content -->

    <div data-role="footer">
        <h4>Page Footer</h4>
    </div><!-- /footer -->
    </div><!-- /page -->
	<?php echo $this->element('sql_dump'); ?>
</body>
</html>
