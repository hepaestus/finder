<!DOCTYPE html>
<html>
<head>
	<?php echo $this->Html->charset(); ?>
	<title>
		<?php echo $title_for_layout; ?>
	</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script lang="javascript" src="http://code.jquery.com/jquery-1.10.2.js"></script>
	<?php
		echo $this->Html->meta('icon');
		echo $this->Html->script('geolocation');
		echo $this->Html->script('ajax');
        // echo $this->Html->script('jquery.js');
        echo $this->Html->script('index.js');
        echo $this->Html->script('jquery.mobile-1.4.4.js');
        echo $this->Html->css('jquery.mobile-1.4.4.css');
        echo $this->Html->css('jquery.mobile.external-png-1.4.4.css');
        echo $this->Html->css('jquery.mobile.icons-1.4.4.css');
        echo $this->Html->css('jquery.mobile.inline-png-1.4.4.css');
        echo $this->Html->css('jquery.mobile.inline-svg-1.4.4.css');
        echo $this->Html->css('jquery.mobile.structure-1.4.4.css');
        echo $this->Html->css('jquery.mobile.theme-1.4.4.css');
        echo $this->Html->css('jqm-demos.css');
		echo $this->Html->css('custom');
		echo $this->fetch('meta');
		echo $this->fetch('css');
		echo $this->fetch('script');
	?>
</head>
<body>
    <?php //echo $this->Session->flash(); ?>
    <?php echo $this->fetch('content'); ?>
	<?php //echo $this->element('sql_dump'); ?>
</body>
</html>
