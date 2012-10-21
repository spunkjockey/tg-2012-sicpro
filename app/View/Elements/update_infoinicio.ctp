<!-- /app/views/elements/update_infoinicio.ctp -->
<?php if(isset($informacion)){
	//Debugger::dump($informacion);
	foreach ($informacion as $inf): ?>
		<p><label>Nombre Contrato: </label> <?php echo $inf['nombrecontrato']; ?></p>
		<p><label>Fecha Inicio: </label><?php echo date('d/m/Y',strtotime( $inf['fechainiciocontrato'])); ?></p>
		<p><label>Fecha Fin: </label><?php echo date('d/m/Y',strtotime($inf['fechafincontrato'])); ?></p>
		<!--<p><label>Orden de Inicio: </label><?php echo date('d/m/Y',strtotime($inf['ordeninicio'])); ?></p>-->
	<?php endforeach; ?>

			
	<?php echo $this->Form->input('Contrato.ordeninicio', 
		array(
			'label' => 'Orden de Inicio:', 
			'id'	=> 'datePicker1',
			'type'  => 'Text',
			'div' => array('id' => 'orden','class' => 'requerido')
			)); ?>
	
	<script type="text/javascript">
        var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode: "orden" } );
        datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
        datePicker1.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
    </script> 


	<?php echo $this->Form->input('Contrato.userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
	
	<li  class="accept">
		<table>
			<tr>
				<td><input type="submit" name="boton_2" id="boton_2" value="Registrar Orden de Inicio" dir="addordeninicio" class="k-button" /></td>
				<td>
					<?php echo $this->Html->link(
						'Regresar', 
						array('controller' => 'mains', 'action' => 'index'),
						array('class'=>'k-button')
					); ?>
				</td>
			</tr>
		</table>
	</li>
			
<?php } else { ?>
	<div style="margin: 10px auto; width: 400px">
	<?php echo 'No hay información disponible seleccione un contrato'; ?>
	</div>
<?php } ?>

<script>
	$(document).ready(function () { 
		$("#datePicker1").kendoDatePicker({
			culture:"es-ES",
			<?php	if(isset($informacion['Contrato']['fechainiciocontrato'])) { echo "min: kendo.parseDate('".$informacion['Contrato']['fechainiciocontrato']."'),";}?>
		   	<?php	if(isset($informacion['Contrato']['fechafincontrato'])) { echo "max: kendo.parseDate('".$informacion['Contrato']['fechafincontrato']."'),";}?>
		   	<?php	if(isset($informacion['Contrato']['ordeninicio'])) { echo "value: kendo.parseDate('".$informacion['Contrato']['ordeninicio']."'),";}?>
    		format: "dd/MM/yyyy" //Define el formato de fecha
    	});
    	$("input[type=submit]").click(function() {
			var accion = $(this).attr('dir');
		    $('form').attr('action', accion);
		    $('form').submit();
		});
	});
</script>

