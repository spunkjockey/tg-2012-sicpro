<!-- /app/views/elements/update_infoinicio.ctp -->
	<?php
	if($informacion!=false){
	foreach ($informacion as $inf): 
		?>
		<p><strong class:'etiqueta'>Nombre Contrato: </strong> <?php echo $inf['nombrecontrato']; ?></p>
		<p><strong class:'etiqueta'>Fecha Inicio: </strong><?php echo $inf['fechainiciocontrato']; ?></p>
		<p><strong class:'etiqueta'>Fecha Fin: </strong><?php echo $inf['fechafincontrato']; ?></p>
	<?php endforeach; 
}?>
