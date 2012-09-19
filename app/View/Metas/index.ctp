<!-- File: /app/View/Metas/index.ctp -->

<h2>Empresas</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Metas', 
		array('controller' => 'Metas', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>