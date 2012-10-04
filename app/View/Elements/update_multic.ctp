<!-- /app/views/elements/update_multic.ctp -->
	<?php
	if($informacion!=false){
	foreach ($informacion as $inf): 
		?>		
		<option value="<?php echo $inf['Persona']['idpersona']; ?>" selected="true"><?php echo $inf['Persona']['nombrespersona']; ?></option>
	<?php endforeach; 
}?>
