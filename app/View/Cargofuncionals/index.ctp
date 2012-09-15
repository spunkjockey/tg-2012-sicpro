<!-- File: /app/View/Cargofuncionals/index.ctp -->

<h2>Plazas</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar cargo funcional', 
		array('controller' => 'cargofuncionals', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="idcargofuncional">Identificador</th>
        <th data-field="cargofuncional">Cargo funcional</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <?php foreach ($cargofuncional as $cargo): ?>
    <tr>
        <td><?php echo $cargo['Cargofuncional']['idcargofuncional']; ?></td>
        <td><?php echo $cargo['Cargofuncional']['cargofuncional']; ?></td>
      <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $cargo['Cargofuncional']['idcargofuncional']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $cargo['Cargofuncional']['idcargofuncional']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
       </td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($cargo); ?>
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
            			display: "{0} - {1} de {2} Cargos",
            			empty: "No hay cargos para mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Plazas por página",
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