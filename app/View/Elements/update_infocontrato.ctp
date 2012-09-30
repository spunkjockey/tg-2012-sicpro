<!-- /app/views/elements/update_infocontrato.ctp -->
	<?php
	if($informacion!=false){
	foreach ($informacion as $inf): 
		?>
		<p><strong class:'etiqueta'>Nombre Contrato: </strong> <?php echo $inf['nombrecontrato']; ?></p>
		<p><strong class:'etiqueta'>Estado Actual: </strong><?php echo $inf['estadocontrato']; ?></p>
	<?php endforeach; 
}?>

