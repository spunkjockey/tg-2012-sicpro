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
	<?php echo $this->Form->input('Informetecnico.fechavisita', 
		array(
			'label' => 'Fecha de visita:', 
			'id'	=> 'datePicker1',
			'type'  => 'Text')); ?>
		<script type="text/javascript">
            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " } );
            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
        </script> 
</li>
<li>
	<?php echo $this->Form->input('Informetecnico.fechaelab', 
		array(
			'label' => 'Fecha de elaboración:', 
			'id'	=> 'datePicker2',
			'type'  => 'Text')); ?>
		<script type="text/javascript">
            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " } );
            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
        </script> 
</li>
<li>
	<?php echo $this->Form->input('Informetecnico.antecedentes', 
		array(
			'label' => 'Antecedentes:', 
			'class' => 'k-textbox',
			'id'=> 'txantecedentes', 
			'rows' => 4, 
			'placeholder' => 'Descripción de antecedentes')); ?>
		<script type="text/javascript">
			var txantecedentes = new LiveValidation( "txantecedentes", { validMessage: " " } );
	        txantecedentes.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
	    </script>
</li>
<li>
	<?php echo $this->Form->input('Informetecnico.anotaciones', 
		array(
			'label' => 'Anotaciones:', 
			'class' => 'k-textbox',
			'id'=> 'txanotacion', 
			'rows' => 4, 
			'placeholder' => 'Observaciones de la visita')); ?>
		<script type="text/javascript">
			var txanotacion = new LiveValidation( "txanotacion", { validMessage: " " } );
	        txanotacion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
	    </script>
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