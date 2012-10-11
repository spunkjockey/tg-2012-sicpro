<!-- /app/views/elements/update_opcionesactualizar.ctp -->
	<?php
	if(!empty($informacion))
	{
	if($informacion != false){	
	foreach ($informacion as $inf): 
		switch ($inf['estadocontrato']) {
		    case 'en pausa':
				{
			        $options = array('en marcha' => 'En Marcha','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
		    case 'en marcha':
				{
			        $options = array('en pausa' => 'En Pausa','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
		    case 'cancelado':
				{
			        $options = array('en pausa' => 'En Pausa','finalizado' => 'Finalizado');
					$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
			case 'finalizado':
				{
			        $options = array('en pausa' => 'En Pausa','cancelado' => 'Cancelado');
					$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
			default:
				{
					$options = array('en pausa' => 'En Pausa','en marcha' => 'En Marcha','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => 'Estado de Proyecto','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
			break;
		}
	endforeach; 
	}}?>
