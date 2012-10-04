<div id='divdos'>

		
</div> 

<?php if(isset($proyecto)) { ?>
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
				                
				             },
				             creacion: {
				             	type: "date"
				             }
				             
				         }
				     }
				   }
				},
                columns: [
                            { field: "idfuentefinanciamiento", title: "Fuente" },
                            { field: "montoparcial", title: "Monto", format: "{0:c}", footerTemplate: "<strong>$#=sum#</strong>" },
                            { field: "userc", title: "Usuario"},
                            { field: "creacion", title: "Fecha Asignación", format: "{0:dd/MM/yyyy}"}
                                
                 ]
        	});
     
</script>