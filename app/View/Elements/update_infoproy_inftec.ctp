<li>
	<strong>Nombre proyecto:</strong> 
	<?php 
		if(isset($nombreproy))
			echo $nombreproy;
		else 
			echo "No disponible";
		?>
</li>
<li>
	<strong>Descripción: </strong> 
	<?php 
		if(isset($descripcion))
			echo $descripcion;
		else 
			echo "No disponible";
		?>
</li>