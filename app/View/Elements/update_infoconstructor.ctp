	<?php
	if($info!=false){
	foreach ($info as $inf): 
		?>
		<p><strong class:'etiqueta'>Título del contrato de construcción: </strong> <?php echo $inf['nombrecontrato']; ?></p>
		<p>
			<strong class:'etiqueta'>Vigente del </strong><?php echo date('d/m/Y',strtotime( $inf['fechainiciocontrato'])); ?>
			<strong class:'etiqueta'> al </strong><?php echo date('d/m/Y',strtotime($inf['fechafincontrato'])); ?>
			<strong class:'etiqueta'> con plazo de ejecución de </strong> <?php echo $inf['plazoejecucion']; ?> días
		</p>
	<?php endforeach; 
}?>