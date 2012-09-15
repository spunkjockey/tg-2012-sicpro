<!-- File: /app/View/Plazas/index.ctp -->

<h2>Plazas</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar Plaza', 
		array('controller' => 'plazas', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="idDivision">Identificador</th>
        <th data-field="division">Plaza</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <?php foreach ($plaza as $pla): ?>
    <tr>
        <td><?php echo $pla['Plaza']['idplaza']; ?></td>
        <td><?php echo $pla['Plaza']['plaza']; ?></td>
      <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $pla['Plaza']['idplaza']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $pla['Plaza']['idplaza']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
       </td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($plaza); ?>
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
            			display: "{0} - {1} de {2} Plazas",
            			empty: "No plazas a mostrar",
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