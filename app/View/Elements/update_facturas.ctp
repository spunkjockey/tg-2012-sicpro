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
	            		echo "Facturada el " . $es['Facturaestimacion']['facturacion'];
	            	} else {
	            		echo $this->Html->link(
	            			'Facturar', 
	            			array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_registrar', $es['Estimacion']['idestimacion']),
	            			array('class'=>'k-button')
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
	            
	            	if(!empty($su['Facturasupervision']['idinformesupervision'])) {
	            		echo "Facturada el " . $su['Facturasupervision']['facturacion'];
	            	} else {
	            		echo $this->Html->link(
	            			'Facturar', 
	            			array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_registrar', $su['Informesupervisor']['idinformesupervision']),
	            			array('class'=>'k-button')
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