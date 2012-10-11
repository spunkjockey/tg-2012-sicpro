<?php
	if($info!=false){
	foreach ($info as $inf): 
		?>
		<p><strong class:'etiqueta'>Nombre del proyecto: </strong> <?php echo $inf['nombreproyecto']; ?></p>
	<?php endforeach; 
}?>