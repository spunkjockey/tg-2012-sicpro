<!----
	Esta función permite recuperar datos del contrato supervisor para ser mostrados
	en el formulario
	-->
<?php 
		if(isset($info['Contratosupervisor']['ordeninicio']))
			$ordini = $info['Contratosupervisor']['ordeninicio']; 
		else
		   $ordini= '';
		
?>
<p><label>Título del contrato: </label><?php echo $info['Contratosupervisor']['nombrecontrato']; ?></p>
<p><label>Plazo de ejecución: </label> <?php echo $info['Contratosupervisor']['plazoejecucion']; ?> días  
<label'>Orden de inicio: </label> <?php echo date('d/m/Y',strtotime($ordini)); ?></p>