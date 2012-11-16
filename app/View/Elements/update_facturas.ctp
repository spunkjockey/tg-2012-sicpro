<h2>Detalle Facturación</h2>

<?php if(isset($contrato)) { ?>
	<div>
		<ul style="list-style-type: none;
	                    margin: 10px;
	                    padding: 5px; color: black">
		<li><?php echo '<strong>Código:</strong> '. $contrato['Contrato']['codigocontrato']; ?></li> 
		<li><?php echo '<strong>Nombre de Contrato:</strong>'. $contrato['Contrato']['nombrecontrato']; ?></li>
		<li><?php echo '<strong>Monto:</strong> $'. number_format($contrato['Contrato']['montooriginal'],2); ?></li>
		<li><?php echo '<strong>Variación:</strong> $'. number_format($contrato['Contrato']['variacion'],2); ?></li>
		<li><?php echo '<strong>Orden de Inicio:</strong> '.  date('d/m/Y',strtotime($contrato['Contrato']['ordeninicio'])); ?></li>
		</ul>
	</div>
<?php } ?>


<?php if(isset($estimacion)) {?>
	<table id="grid">
	    <tr>
	        <th data-field="tituloestimacion">Título</th>
	        <th data-field="montoestimado">Monto</th>
	        <th data-field="porcentajeestimadoavance">Porcentaje</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($estimacion as $es): ?>
	    <tr>
	        <td><?php echo $es['Estimacion']['tituloestimacion']; ?></td>
	        <!--<td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>-->
	        <td><?php echo '$ ' . number_format($es['Estimacion']['montoestimado'],2); ?></td>
	        <td><?php echo number_format($es['Estimacion']['porcentajeestimadoavance'],2) . ' %'; ?></td>
	        
	        <td align="center">
	            <?php 
	            
	            	if(!empty($es['Facturaestimacion']['idfacturaestimacion'])) {
	            		?>
						<div style="display: inline; margin-right: 10px">
	            		<?php echo "Facturada el " . $es['Facturaestimacion']['facturacion']; ?>
						</div>
						
						<?php
		            	/*echo $this->Html->link(
			            	'<span class="k-icon k-i-pencil"></span>', 
			            	array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_modificar', $es['Facturaestimacion']['idfacturaestimacion']),
			            	array('class'=>'k-button', 'escape' => false)
						);*/
						
			            echo $this->Form->postLink(
			                '<span class="k-icon k-i-close"></span>',
			                array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_eliminar', $es['Facturaestimacion']['idfacturaestimacion']),
			                array('confirm' => '¿Está seguro que desea eliminar la factura seleccionada?','class'=>'k-button', 'escape' => false, 'title' => 'Eliminar Factura')
			            );

	            	} else {
	            		echo $this->Html->link(
	            			'<span class="k-icon k-i-plus"></span>Facturar', 
	            			array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_registrar', $es['Estimacion']['idestimacion']),
	            			array('class'=>'k-button', 'escape' => false, 'title' => 'Facturar la Estimación')
						);
	            	}
	            /*echo $this->Html->link(
	            	'Facturar', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado']),
	            	array('class'=>'k-button')
				);
				 * 
				 */?>
	            
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($estimacion); ?>
	</table>
<?php } ?>


<?php if(isset($supervisor)) {?>
	<table id="grid">
	    <tr>
	        <th data-field="tituloinformesup">Título</th>
	        <th data-field="valoravancefinanciero">Monto</th>
	        <th data-field="porcentajeavancefisico">Porcentaje</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($supervisor as $su): ?>
	    <tr>
	        <td><?php echo $su['Informesupervisor']['tituloinformesup']; ?></td>
	        <!--<td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>-->
	        <td><?php echo '$ ' . number_format($su['Informesupervisor']['valoravancefinanciero'],2); ?></td>
	        <td><?php echo number_format($su['Informesupervisor']['porcentajeavancefisico'],2) . ' %'; ?></td>
	        
	        <td align="center">
	            <?php 
	            
	            	if(!empty($su['Facturasupervision']['idinformesupervision'])) { ?>
	            		
	            		<div style="display: inline; margin-right: 10px">
	            		<?php echo "Facturada el " . $su['Facturasupervision']['facturacion']; ?>
						</div>
						
						<?php
		            	/*echo $this->Html->link(
			            	'<span class="k-icon k-i-pencil"></span>', 
			            	array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_modificar', $su['Facturasupervision']['idinformesupervision']),
			            	array('class'=>'k-button', 'escape' => false)
						);*/
						
			            echo $this->Form->postLink(
			                '<span class="k-icon k-i-close"></span>',
			                array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_eliminar', $su['Facturasupervision']['idfacturasupervision']),
			                array('confirm' => '¿Está seguro que desea eliminar la factura seleccionada?','class'=>'k-button', 'escape' => false, 'title' => 'Eliminar Factura')
			            );


	            	} else {
	            		echo $this->Html->link(
	            			'<span class="k-icon k-i-plus"></span>Facturar', 
	            			array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_registrar', $su['Informesupervisor']['idinformesupervision']),
	            			array('class'=>'k-button', 'escape' => false, 'title' => 'Facturar el Informe')
						);
	            	}
	            
	            
	            /*echo $this->Html->link(
	            	'Facturar', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado']),
	            	array('class'=>'k-button')
				);
				 * 
				 */?>
	            
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($supervisor); ?>
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
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false,
        	});
        	
        });
                
                
            </script>   