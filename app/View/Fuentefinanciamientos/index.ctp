
   <!-- File: /app/View/Fuentefinanciamiento/index.ctp -->


<h2>Fuente de Financiamiento</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Fuente de Financiamiento', 
		array('controller' => 'Fuentefinanciamientos', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="nombrefuente">Nombre Fuente</th>
        <th data-field="montoinicial">Monto Inicial</th>
        <th data-field="fechadisponible">Fecha de Disponibilidad</th>
        <th data-field="tipofuente" width="225px">Tipo de Fuente</th>
        <th data-field="accion" width="225px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $fuente array, printing out post info -->

    <?php foreach ($fuentefinanciamientos as $fuente): ?>
    <tr>
        <td><?php echo $fuente['Fuentefinanciamiento']['nombrefuente']; ?></td>
        <td><?php echo $fuente['Fuentefinanciamiento']['montoinicial']; ?></td>
        <td><?php echo $fuente['Fuentefinanciamiento']['fechadisponible']; ?></td>  
        <td><?php echo $fuente['Fuentefinanciamiento']['tipofuente']; ?></td>      
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $fuente['Fuentefinanciamiento']['idfuentefinanciamiento']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $fuente['Fuentefinanciamiento']['idfuentefinanciamiento']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($fuentefinanciamientos); ?>
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
            			display: "{0} - {1} de {2} Fuentes",
            			empty: "No hay fuentes de financiamiento a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "fuentes de financiamiento por página",
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