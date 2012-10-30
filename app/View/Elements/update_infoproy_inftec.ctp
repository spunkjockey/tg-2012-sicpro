<table>
	<tr>
		<td valign="top" width="140px" style="text-align: right; padding-right: 10px; vertical-align: top;">
		<li>
			<strong>Nombre proyecto:</strong> 
		</td><td>
			<?php 
				if(isset($nombreproy))
					echo $nombreproy;
				else 
					echo "No disponible";
				?>
		</li>
		</td>
	</tr>
	<tr>
		<td valign="top" width="140px" style="text-align: right; padding-right: 10px; vertical-align: top;">
		<li>
			<strong>Descripción: </strong>
			</td><td> 
			<?php 
				if(isset($descripcion))
					echo $descripcion;
				else 
					echo "No disponible";
				?>
		</li>
		</td>
	</tr>
</table>