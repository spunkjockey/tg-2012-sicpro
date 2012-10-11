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
<p><strong class:'etiqueta'>Nombre del proyecto: </strong> <?php echo $nomproy; ?></p>
