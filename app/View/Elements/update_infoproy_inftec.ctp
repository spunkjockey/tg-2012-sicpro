<?php 
		if(isset($info['Fichatecnica']['descripcionproyecto']))
			$descripcion = $info['Fichatecnica']['descripcionproyecto']; 
		else
		   $descripcion= '';
		if(isset($info['Proyecto']['nombreproyecto']))
			$nombre = $info['Proyecto']['nombreproyecto']; 
		else
		   $nombre= '';
	?>
<li>
	<h3>Nombre proyecto:</h3> <?php echo $nombre?>
</li>
<li>
	<h3>Descripción:</h3> <?php echo $descripcion?>
</li>
<li>
	<?php echo $this->Form->input('fechavisita', 
		array(
			'label' => 'Fecha de visita:', 
			'id'	=> 'datePicker1',
			'type'  => 'Text')); ?>
</li>
<li>
	<?php echo $this->Form->input('fechaelab', 
		array(
			'label' => 'Fecha de elaboración:', 
			'id'	=> 'datePicker2',
			'type'  => 'Text')); ?>
</li>
<li>
	<?php echo $this->Form->input('antecedentes', 
		array(
			'label' => 'Antecedentes:', 
			'class' => 'k-textbox', 
			'rows' => 4, 
			'placeholder' => 'Descripción de antecedentes')); ?>
</li>
<li>
	<?php echo $this->Form->input('anotaciones', 
		array(
			'label' => 'Anotaciones:', 
			'class' => 'k-textbox', 
			'rows' => 4, 
			'placeholder' => 'Observaciones de la visita')); ?>
</li>
<li  class="accept">
	<?php echo $this->Form->end(array('label' => 'Registrar informe', 'class' => 'k-button')); ?>
</li>

<script>
	$("#datePicker1").kendoDatePicker({
		format: "dd/MM/yyyy",
		culture: "es-ES"
		});
	
	$("#datePicker2").kendoDatePicker({
		format: "dd/MM/yyyy",
		culture: "es-ES"
		});

</script>