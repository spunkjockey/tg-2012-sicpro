<!-- /app/views/elements/update_disponible.ctp -->
<?php if(!empty($disponible)) { ?>
	<h3>Detalle Fuente financiamiento</h3>
	<p><strong class:'etiqueta'>Monto Disponible: </strong><?php echo '$'.number_format($disponible, 2, '.', ',')?> 
<?php } ?>	
<?php //Debugger::dump($disponible);?> 
		

