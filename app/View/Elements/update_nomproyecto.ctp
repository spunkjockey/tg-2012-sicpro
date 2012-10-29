<?php
	if(isset($info['Proyecto']['nombreproyecto']))
	{
		$nomproy = $info['Proyecto']['nombreproyecto'];
	}
	else
	{
		$nomproy='';
	}
?>
<table>
	<tr>
		<td><label>Nombre del proyecto: </label></td> 
		<td><?php echo $nomproy; ?></td>
	</tr>
</table>