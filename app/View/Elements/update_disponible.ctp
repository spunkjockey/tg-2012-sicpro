<!-- /app/views/elements/update_disponible.ctp -->
<?php if(isset($disponible)) { ?>
	<h3>Detalle Fuente financiamiento</h3>
	<p><strong class:'etiqueta'>Título Estimación: </strong><?php echo $titulo;?>
	<p><strong class:'etiqueta'>Monto Disponible: </strong><?php echo '$'.number_format($disponible, 2, '.', ',')?> 
<?php } ?>	
<?php //Debugger::dump($disponible);?> 
		

