<?php $this->start('menu');
	switch ($this->Session->read('User.idrol')) {
		case 9:
	        echo $this->element('menu/menu_all');
	        break;
	    case 8:
	        echo $this->element('menu/menu_observer');
	        break;
	    case 7:
	        echo $this->element('menu/menu_jefeplan');
	        break;
		case 6:
	        echo $this->element('menu/menu_tecproy');
	        break;
	    case 5:
	        echo $this->element('menu/menu_tecplan');
	        break;
	    case 4:
	        echo $this->element('menu/menu_adminsys');
	        break;
		case 3:
	        echo $this->element('menu/menu_admincon');
	        break;
	    case 2:
	        echo $this->element('menu/menu_adminproy');
	        break;
	    case 1:
	        echo $this->element('menu/menu_director');
	        break;			
	}
$this->end(); ?>

<?php $this->start('breadcrumb'); ?>
	
	<div id="menuderastros">
		<div id="rastros">
			
			<?php
			echo $this->Html->image("home.png", array(
	    		"alt" => "Inicio",
	    		'url' => array('controller' => 'mains'),
				'width' => '30px',
				'class' => 'homeimg'
			));
			?> » Como Navegar
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div style="text-align: justify; width: 450px; height: 200px; margin: 50px 0; padding-left: 50px">
	
	<h2>Como Navegar</h2>
	<p>SICPRO es un Sistema Informático para control y seguimiento de proyectos desarrollado por estudiantes de a Universidad de El Salvador</p>
	
	<p>Y tiene un estructura de navegación que le permitirá, dependiendo del rol asignado a cada usuario, participar en cada una de las etapas en las que se desarrolla un proyecto desde su formulación hasta su finalización</p>
	<!--<?php
			echo $this->Html->image("undercon.jpg", array(
	    		"alt" => "En Construccion",
	    		'style' => 'border:0'
	
	
	
			));
	?>-->
	
</div>