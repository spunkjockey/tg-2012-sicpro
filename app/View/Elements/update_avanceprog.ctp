<?php if(isset($nombrecontrato)) { ?>
<div>
	<ul style="list-style-type: none;
                    margin: 10px;
                    padding: 5px; color: black">
	<li><?php echo '<strong>Nombre Contrato:</strong> '.$nombrecontrato; ?></li> 
	<li><?php echo '<strong>Monto:</strong> $'.number_format($montooriginal,2); ?></li>
	<li><?php echo '<strong>Plazo Ejecución:</strong> '.$plazoejecucion; ?></li>
	<?php if(isset($ordeninicio)){?>
		<li><?php echo '<strong>Orden de Inicio:</strong> '. date('d/m/Y',strtotime($ordeninicio)); ?></li>
	<?php } ?>
	</ul>
</div>

<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'<span class="k-icon k-i-plus"></span> Agregar Avance Programado', 
		array('action' => 'Avanceprogramado_agregaravance',$idcontrato),
		array('class'=>'k-button', 'escape' => false)
	); ?>
</div> 

<?php } ?>

<?php if(!empty($avances)) {?>

	<table id="grid">
	    <tr>
	        <th data-field="plazoejecuciondias">Plazo</th>
	        <th data-field="fechaavance">Fecha</th>
	        <th data-field="porcentajeavfisicoprog" width="175px">Avance Físico</th>
	        <th data-field="montoavfinancieroprog">Avance Financiero</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($avances as $av): ?>
	    <tr>
	        <td><?php echo $av['Avanceprogramado']['plazoejecuciondias']; ?></td>
	        <td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>
	        <td><?php echo number_format($av['Avanceprogramado']['porcentajeavfisicoprog'],2) . ' %'; ?></td>
	        <td><?php echo '$ ' . number_format($av['Avanceprogramado']['montoavfinancieroprog'],2); ?></td>
	        <td align="center">
	            <?php echo $this->Html->link(
	            	'<span class="k-icon k-i-pencil"></span>', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado']),
	            	array('class'=>'k-button', 'escape' => false)
				);?>
	            <?php echo $this->Form->postLink(
	                '<span class="k-icon k-i-close"></span>',
	                array('action' => 'Avanceprogramado_eliminaravance', $av['Avanceprogramado']['idavanceprogramado']),
	                array('confirm' => '¿Está seguro?','class'=>'k-button', 'escape' => false)
	            )?>
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($avances); ?>
	</table>
<?php } else {
	echo 'No existen avances asociados a este proyecto';
} ?>


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