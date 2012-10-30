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
<table>
	<tr>
	<td><label>Título del contrato: </label> </td><td> <?php echo $info['Contratosupervisor']['nombrecontrato']; ?></p></td>
	</tr>
	<tr>
	<td><label>Plazo de ejecución: </label> </td><td> <?php echo $info['Contratosupervisor']['plazoejecucion']; ?> días</td>  
	</tr>
	<tr>
	<td><label>Orden de inicio: </label> </td><td> <?php echo date('d/m/Y',strtotime($ordini)); ?></td>
	</tr>
</table>