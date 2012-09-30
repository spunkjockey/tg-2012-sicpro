
   <!-- File: /app/View/Estimacion/index.ctp -->
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
			?> » Bienvenido a SICPRO
			
		</div>
	</div>
	
<?php $this->end(); ?>
<h2>Registrar Estimación de Avance</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Estimación de Avance', 
		array('controller' => 'Estimacions', 'action' => 'registrarestimacion'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="tituloestimacion">Titulo Estimación</th>
        <th data-field="fechainicioestimacion">Inicio Estimación</th>
        <th data-field="fechafinestimacion">Fin Estimación</th>
        <th data-field="fechaestimacion" width="225px">Fecha Estimación</th>
        <th data-field="montoestimado" width="225px">Monto Estimado</th>
        <th data-field="accion" width="225px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $fuente array, printing out post info -->

    <?php foreach ($estimacions as $esti): ?>
    <tr>
        <td><?php echo $esti['Estimacion'] ['tituloestimacion']; ?></td>
        <td><?php echo $esti['Estimacion']['fechainicioestimacion']; ?></td>
        <td><?php echo $esti['Estimacion']['fechafinestimacion']; ?></td>  
        <td><?php echo $esti['Estimacion']['fechaestimacion']; ?></td>      
        <td><?php echo $esti['Estimacion']['montoestimado']; ?></td>    
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'modificarestimacion', $esti['Estimacion']['idestimacion']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $esti['Estimacion']['idestimacion']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
           <?php echo $this->Html->link(
            	'Cargar Archivo', 
            	array('controller' => 'Estimacions','action' => 'agregar_archivo',$esti['Estimacion']['idestimacion']),
            	array('class'=>'k-button')
			);?>

        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($estimacions); ?>
</table>

<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Estimaciones",
            			empty: "No hay Estimaciones de Avances a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Estimaciones por página",
            			first: "Ir a la primera página",
            			previous: "Ir a la página anterior",
            			next: "Ir a la siguiente página",
            			last: "Ir a la última página",
            			refresh: "Actualizar"
            		}
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
        });
</script>