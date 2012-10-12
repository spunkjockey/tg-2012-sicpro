<!DOCTYPE html>
<!--[if lt IE 7]> <html class="lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]> <html class="lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]> <html class="lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>
		<?php echo $this -> Html -> charset(); ?>
		<title> <?php echo $title_for_layout; ?> </title>
		<?php
		//echo $this -> Html -> meta('icon');
		echo $this->Html->meta('icono.ico','icono.ico',array('type' => 'icon'));

		echo $this -> Html -> css('style.8loginform');
		echo $this -> Html -> script('livevalidation_standalone');
		echo $this -> Html -> script('kendojs/jquery.min');
		
		echo $this -> fetch('meta');
		echo $this -> fetch('css');
		echo $this -> fetch('script');
		?>
		<!--[if lt IE 9]><script src="//html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->	
</head>
	<body>
		<?php echo $this->Session->flash(); ?>
		<?php echo $this->fetch('content'); ?>
	</body>
</html>