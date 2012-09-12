<!-- File: /app/View/Divisions/index.ctp -->

<h2>Divisiones</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar División', 
		array('controller' => 'divisions', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="idDivision">Identificador</th>
        <th data-field="division">División</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <?php foreach ($division as $divi): ?>
    <tr>
        <td><?php echo $divi['Division']['iddivision']; ?></td>
        <td><?php echo $divi['Division']['divison']; ?></td>
      <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $divi['Division']['iddivision']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $divi['Division']['iddivision']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
       </td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($division); ?>
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
            			display: "{0} - {1} de {2} Divisiones",
            			empty: "No divisiones a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Divisiones por página",
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