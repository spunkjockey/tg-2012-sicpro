<div id='divdos'>
<?php if(isset($disponible)) { ?>
	<h3>Detalles Fuente financiamiento</h3>
	<p><strong class:'etiqueta'>Título Estimación: </strong><?php echo $titulo;?>
	<p><strong class:'etiqueta'>Monto Disponible: </strong><?php echo '$'.number_format($disponible, 2, '.', ',')?> 
<?php } ?>
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
	        <th>Acción</th>
	    </tr>
	    <?php foreach ($proyectos as $pro): ?>
		    <tr>
		        <td><?php echo $pro['Fuentefinanciamiento']['nombrefuente']; ?></td>
		        <td><?php echo $pro['Financia']['montoparcial']; ?></td>        
		        <td><?php echo $pro['Financia']['userc']; ?></td>
		        <td><?php echo $pro['Financia']['creacion']; ?></td>
		        <td>  
		        	<?php echo $this->Html->link(
            			'<span class="k-icon k-i-pencil"></span>', 
            			array('action' => 'financia_modificar', $pro['Financia']['fuente_proyecto']),
            			array('class'=>'k-button', 'escape' => false, 'title'=>'Editar Fuente')
					);?>
            		<!--<?php echo $this->Form->postLink(
                		'<span class="k-icon k-i-close"></span>',
                		array('action' => 'financia_eliminar', $pro['Financia']['fuente_proyecto']),
                		array('confirm' => '¿Está seguro que desea eliminar el financiamiento ' . $pro['Fuentefinanciamiento']['nombrefuente'] . '?',
                			'class'=>'k-button', 'escape' => false,'title' => 'Eliminar Fuente de Financiamiento')
            		)?>-->
            		
            		<?php echo $this->Html->link(
                		'<span class="k-icon k-i-close"></span>',
                		array('action' => 'financia_eliminar', $pro['Financia']['fuente_proyecto']),
                		array('confirm' => '¿Está seguro que desea eliminar el financiamiento ' . $pro['Fuentefinanciamiento']['nombrefuente'] . '?',
                			'class'=>'k-button', 'escape' => false,'title' => 'Eliminar Fuente de Financiamiento')
            		)?>
             	</td>
		    </tr>
	    <?php endforeach; ?>
	    <?php unset($proyectos); ?>
	</table>
<?php } ?>

<style scoped>
        #grid .k-button
        {
            vertical-align: middle;
            width: 28px;
            margin: 0 3px;
            padding: .1em .4em .3em;
            display: inline;
            
        }
    </style>


<script>
	
	
	
	var grid =  $("#grid").kendoGrid({
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
        	{ field: "idfuentefinanciamiento", title: "Fuente", width: 200 },
            { field: "montoparcial", title: "Monto", format: "{0:c}", footerTemplate: "#= kendo.toString(sum,'c2') #"},
            { field: "userc", title: "Usuario"},
            { field: "creacion", title: "Fecha Asignación", format: "{0:dd/MM/yyyy}"},
            { field: "accion", width: 90} 
		]
          
	}).data("kendoGrid");

//grid.hideColumn("userc");
</script>