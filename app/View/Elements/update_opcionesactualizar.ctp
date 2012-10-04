<!-- /app/views/elements/update_opcionesactualizar.ctp -->
	<?php
	if($informacion != false){	
	foreach ($informacion as $inf): 
		if($inf['estadocontrato']=='pausado')
		{
				$options = array('marcha' => 'En Marcha','cancelado' => 'Cancelado','finalizado' => 'Finalizado');					
		}
		else {
				$options = array('cancelado' => 'Cancelado','pausado' => 'Pausado','finalizado' => 'Finalizado');
			}
			$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
			echo $this->Form->radio('Estados', $options, $attributes);
	endforeach; 
	}?>
