<!-- /app/views/elements/update_infocontrato.ctp -->
<!--<?php echo $this->element('sql_dump'); ?>-->

	<?php
	//$inf = array_unique ($informacion);
	//Debugger::dump($informacion);
	if(!empty($informacion))
	{
	if($informacion != false){
		?>
		<p><strong class:'etiqueta'>Nombre Contrato: </strong> <?php echo $informacion['0']['nombrecontrato']; ?></p>
		<p><strong class:'etiqueta'>Estado Actual: </strong><?php echo $informacion['0']['estadocontrato']; ?></p>
	<?php 
	}
}?>