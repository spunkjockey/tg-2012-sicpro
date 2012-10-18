<!-- /app/views/elements/update_opcionesactualizar.ctp -->
<?php
	if(!empty($informacion))
	{
	if($informacion != false){
		switch ($informacion['estadocontrato']) {
		    case 'en pausa':
				{
			        $options = array('en marcha' => 'En Marcha','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => '<strong>Estado de Proyecto</strong>','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
		    case 'en marcha':
				{
			        $options = array('en pausa' => 'En Pausa','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => '<strong>Estado de Proyecto</strong>','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
		    case 'cancelado':
				{
			        $options = array('en pausa' => 'En Pausa','finalizado' => 'Finalizado');
					$attributes = array('legend' => '<strong>Estado de Proyecto</strong>','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
			case 'finalizado':
				{
			        $options = array('en pausa' => 'En Pausa','cancelado' => 'Cancelado');
					$attributes = array('legend' => '<strong>Estado de Proyecto</strong>','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes);
				}
		        break;
			default:
				{
					$options = array('en pausa' =>'En Pausa','en marcha' => 'En Marcha','cancelado' => 'Cancelado','finalizado' => 'Finalizado');
					$attributes = array('legend' => '<strong>Estado de Proyecto</strong>','separator'=>'<br />','required'=>true);
					echo $this->Form->radio('Estados', $options, $attributes,array('class'=>'lb'));
				}
			break;
		}
	}}?>
	
<style scoped>
.lb {
	color:red;
	font-size:24px; 
}
fieldset{
	border-style:solid;
	border-width:1px;
	border-color:#AAA1B0;
	background-color: #E3F1F7;
	width: 250px;
	float: auto;
	display:block;
	margin:0 auto 0 auto;
}
label {
	margin:0 auto 0 auto;
	padding: 0 10px 0 0;
	display:block;
}
	
input[type=radio]{
	margin:0 auto 0 auto;
	padding: 0 10px 0 100px;
	background-color:red;
}
	
</style>