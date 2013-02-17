

<?php
	if(isset($info)){ 
?>
<h3>Componente: <?php echo $nombre; ?></h3><br>
<br>
<table id="grid">
	<tr>
	    <th data-field="descmeta" width="375px">Meta</th>
	    <th data-field="porcentaje">Porcentaje avance</th>
	    <th data-field="accion" width="50px">Acción</th>
	</tr>
	<?php foreach ($info as $inf): ?>
	<tr>
	    <td><?php echo $inf['Meta']['descripcionmeta']; ?></td>
	    <td><?php echo $inf['Meta']['porcestimado']." %"; ?></td>
	  	<td align="center">
	        <?php 
	        	echo $this->Html->link('<span class="k-icon k-i-pencil"></span>', 
	            	array('action' => 'meta_actualizarpje', $inf['Meta']['idmeta'],$idc),
	            	array('class'=>'k-button','escape'=>false,'title'=>'Modificar Meta'));
			?>
	       </td>
	</tr>
	<?php endforeach; }
	else {
		echo "No existe metas para este componente";
		}  
	unset($info)?>
</table>
<div style="margin: 10px 0px 10px 563px;"> 
		<?php echo $this->Html->link('Regresar', 
						array('controller' => 'Metas','action' => 'meta_actualizarporcentaje'),
						array('class'=>'k-button')); ?>
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
            			display: "{0} - {1} de {2} Metas",
            			empty: "No hay metas para este componente",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Metas por página",
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