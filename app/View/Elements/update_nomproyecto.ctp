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
<p><label>Nombre del proyecto: </label> <?php echo $nomproy; ?></p>
