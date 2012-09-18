<div id='divdos'>
	
		<?php if(!empty($disponible)) { ?>
			<h3>Detalle Fuente financiamiento</h3>
			<p><strong class:'etiqueta'>Monto Disponible: </strong><?php echo '$'.number_format($disponible, 2, '.', ',')?> 
		<?php } ?>	
		<?php //Debugger::dump($disponible);?> 
		
</div> 

<?php if(!empty($disponible)) { ?>
	<h3 style="font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;">Detalles del Proyecto</h3>
	<?php foreach ($proyecto as $pro): ?>
		<p><strong class:'etiqueta'>Proyecto: </strong> <?php echo $pro['0']['nombreproyecto']; ?></p>
		<p><strong class:'etiqueta'>Estado Proyecto: </strong><?php echo $pro['0']['estadoproyecto']; ?></p>
		<p><strong class:'etiqueta'>Monto Planeado: </strong>:<?php echo "\$".number_format( $pro['0']['montoplaneado'], 2, '.', ','); ?></p>
	<?php endforeach; ?>
	<?php unset($proyecto); ?>
	<table id="grid">
	    <tr>
	        
	        <th data-field="idfuentefinanciamiento">Fuente</th>
	        <th data-field="montoparcial">Monto</th>
	        <th data-field="userc">Usuario</th>
	        <th data-field="creacion">Fecha Asignación</th>
	    </tr>
	
	    <!-- Here is where we loop through our $empresas array, printing out post info -->
	
	    <?php foreach ($proyectos as $pro): ?>
	    <tr>
	        
	        <td><?php echo $pro['Fuentefinanciamiento']['nombrefuente']; ?></td>
	        <td><?php echo $pro['Financia']['montoparcial']; ?></td>        
	        <td><?php echo $pro['Financia']['userc']; ?></td>
	        <td><?php echo $pro['Financia']['creacion']; ?></td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($proyectos); ?>
	</table>
<?php } ?>


<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	sortable: false,
            	scrollable: false,
				dataSource: {
                	aggregate: [{ field: "montoparcial", aggregate: "sum" }],
                	schema: {
				      model: {
				         fields: {
				             montoparcial: {
				                editable: false,
				                type: "number"
				             }
				         }
				     }
				   }
				},
                columns: [
                            { field: "idfuentefinanciamiento", title: "Fuente" },
                            { field: "montoparcial", title: "Monto", footerTemplate: "$ #=sum#" },
                            { field: "userc", title: "Usuario"},
                            { field: "creacion", title: "Fecha Asignación"}
                                
                 ]
        	});
        });
</script>