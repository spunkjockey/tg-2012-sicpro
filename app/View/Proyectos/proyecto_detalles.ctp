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
			?> Proyectos » Detalles
			
		</div>
	</div>
<?php $this->end(); ?>
<div id="formulario">
<ul>
		<li>
			<h3>Nombre proyecto:</h3>
			<?php echo $proyectos['Proyecto']['nombreproyecto']; ?>
		</li>
		<li>
			<h3>Número proyecto: </h3>
			<?php echo $proyectos['Proyecto']['numeroproyecto']; ?>
		</li>
		<li>
			<h3>Monto planeado:</h3>
			$<?php echo ($proyectos['Proyecto']['montoplaneado']); ?>
		</li>
		<li>
			<h3>Estado proyecto: </h3>
			<?php echo ($proyectos['Proyecto']['estadoproyecto']); ?>
		</li>
		<li>
			<h3>División responsable:</h3>
			<?php echo ($proyectos['Division']['divison']); ?>
		</li>
		<li>
			<?php echo $this->Html->link('Regresar', 
									array('controller' => 'Proyectos','action' => 'proyecto_listado'),
									array('class'=>'k-button')); ?>
		</li>
</ul>
</div>
<style scoped>

                                
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
                }

                #formulario h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    color:#3A90CA;
                   
                }

                #formulario ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                #formulario li {
                    margin: 10px 0 0 0;
                }

               
              </style>

