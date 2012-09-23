
   <!-- File: /app/View/Estimacion/index.ctp -->


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