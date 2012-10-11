<?php 
		if(isset($info['Contratosupervisor']['ordeninicio']))
			$ordini = $info['Contratosupervisor']['ordeninicio']; 
		else
		   $ordini= '';
		
?>
<p><strong class:'etiqueta'>Título del contrato: </strong><?php echo $info['Contratosupervisor']['nombrecontrato']; ?></p>
<p><strong class:'etiqueta'>Plazo de ejecución: </strong> <?php echo $info['Contratosupervisor']['plazoejecucion']; ?> días  
	<strong class:'etiqueta'>Orden de inicio: </strong> <?php echo $ordini; ?></p>