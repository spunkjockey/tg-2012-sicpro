<?php 
	if(isset($info['Contratoconstructor']['nombrecontrato']))
	{
		$nomcon = $info['Contratoconstructor']['nombrecontrato'];
		$inicon = $info['Contratoconstructor']['fechainiciocontrato'];
		$fincon = $info['Contratoconstructor']['fechafincontrato'];
		$placon = $info['Contratoconstructor']['plazoejecucion'];
	}
	else 
	{
		$nomcon ='';
		$inicon ='';
		$fincon ='';
		$placon ='';
	}
?>

<p><strong class:'etiqueta'>Título del contrato de construcción: </strong> <?php echo $nomcon; ?></p>
<p>
	<strong class:'etiqueta'>Vigente del </strong><?php echo date('d/m/Y',strtotime( $inicon)); ?>
	<strong class:'etiqueta'> al </strong><?php echo date('d/m/Y',strtotime($fincon)); ?>
	<strong class:'etiqueta'> con plazo de ejecución de </strong> <?php echo $placon; ?> días
</p>
