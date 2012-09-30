<!-- File: /app/View/Proyectos/proyecto_listado.ctp -->

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
			?> Proyecto » Editar proyecto
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Proyectos</h2>
		
		<table id="grid">
		    <tr>
		        <th data-field="nombreproyecto">Nombre proyecto</th>
		        <th data-field="montoplaneado">Monto planeado</th>
		        <th data-field="iddivision">División</th>
		        <th data-field="accion" width="225px">Acción</th>
		    </tr>
			<?php foreach ($proyectos as $proy): ?>
		    <tr>
		        <td><?php echo $proy['Proyecto']['nombreproyecto']; ?></td>
		        <td>$<?php echo $proy['Proyecto']['montoplaneado']; ?></td>
		        <td><?php echo $proy['Proyecto']['iddivision']; ?></td>
		      	<td align="center">
		            <?php echo $this->Html->link(
		            	'Editar', 
		            	array('action' => 'proyecto_modificar', $proy['Proyecto']['idproyecto']),
		            	array('class'=>'k-button'));
		            	?>
			    </td> 
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($proyectos); ?>
	</table>
		
	</div>
</div>

<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Proyectos",
            			empty: "No plazas a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Proyectos por página",
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
