<?php 
		if(isset($info['Fichatecnica']['descripcionproyecto']))
			$descripcion = $info['Fichatecnica']['descripcionproyecto']; 
		else
		   $descripcion= '';
		if(isset($info['Proyecto']['nombreproyecto']))
			$nombre = $info['Proyecto']['nombreproyecto']; 
		else
		   $nombre= '';
	?>
<li>
	<h3>Nombre proyecto:</h3> <?php echo $nombre?>
</li>
<li>
	<h3>Descripción:</h3> <?php echo $descripcion?>
</li>
