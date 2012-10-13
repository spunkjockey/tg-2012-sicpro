<!-- /app/views/elements/update_multic.ctp -->
	
	<!--<?php
	if($informacion!=false){
	foreach ($informacion as $inf): 
		?>		
		<option value="<?php echo $inf['Persona']['idpersona']; ?>"><?php echo $inf['Persona']['nombrespersona']; ?></option>
	<?php endforeach; 
}?>-->

<!--<?php Debugger::dump($disponibles); ?>
<?php Debugger::dump($seleccionados); ?>-->

				<table>
				<tr>
					<td>Disponibles</td>
					<td></td>
					<td>Asignados</td>
				</tr>
				<tr>
					<td>
					<!--<?php echo $this->Form->create('Disponibles'); ?>-->
					<?php if(!empty($disponibles)){ ?>
					  <div id="contenedordisponibles">
					  <select id="disponibles" name="disponibles" multiple="multiple">
							<?php foreach ($disponibles as $dis):?>
		    				<option value='<?php echo $dis['Persona']['idpersona']; ?>'> <?php echo $dis['Persona']['nombrespersona'].' '.$dis['Persona']['apellidospersona']; ?></option>
						    <?php endforeach; ?>
				    		<?php unset($disponibles); ?>
					  </select>
					  </div>
					  <br /><span id="nombramientoInfo"></span>
		        	<?php }
					else {
						echo "No Tecnicos Disponibles<br />";
					}
					?>
			  		</td>
			  		<td>
			  			<!--<?php echo $this->Form->end(array('label' => '>', 'class' => 'k-button', 'id' => 'button')); ?>-->
			  			<input type="submit" name="boton_1" id="boton_1" value=">" dir="Nombramiento_asignartecnico" class="k-button"/>
			  			<input type="submit" name="boton_2" id="boton_2" value="<" dir="Nombramiento_asignartecnico" class="k-button" />
			  		</td>
					<td>
					  <select id="seleccionados" name="seleccionados" multiple="multiple">
							<?php foreach ($seleccionados as $sel):?>
		    				<option value='<?php echo $sel['Nombramiento']['idnombramiento']; ?>'> <?php echo $sel['Persona']['nombrespersona'].' '.$sel['Persona']['apellidospersona']; ?></option>
						    <?php endforeach; ?>
				    		<?php unset($seleccionados); ?>
					  </select>
			  		</td>
			  </tr>
			  <tr>
			  			<?php if ($this->Form->isFieldError('Nombramiento.idpersona')) {
						    echo $this->Form->error('Nombramiento.idpersona');
						} ?>
			  </tr>
			</table>
							
<script type="text/javascript">
$(document).ready(function(){
    $('#disponibles').multiselect({
        noneSelectedText: 'Select Something (required)',
        selectedList: 3,
        classes: 'my-select'
    });
    $.validator.addMethod("needsSelection", function(value, element) {
        return $(element).multiselect("getChecked").length > 0;
    });

    $.validator.addMethod("isPercent", function(value, element) {
        return parseFloat(value) >= 0 && parseFloat(value) <= 100;
    });

    $.validator.messages.needsSelection = 'You gotta pick something.';
    $.validator.messages.isPercent = 'Must be between 0% and 100%';

    $('#NombramientoNombramientoAsignartecnicoForm').validate({
        rules: {
            disponibles: "required needsSelection",
            input1: "required isPercent",
            input2: "required",
            input3: "required"
        },
        errorClass: 'invalid'
    });


                                        
});
</script>