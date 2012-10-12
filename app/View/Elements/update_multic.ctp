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
					  <select id="disponibles" name="disponibles" multiple="multiple">
							<?php foreach ($disponibles as $dis):?>
		    				<option value='<?php echo $dis['Persona']['idpersona']; ?>'> <?php echo $dis['Persona']['nombrespersona'].' '.$dis['Persona']['apellidospersona']; ?></option>
						    <?php endforeach; ?>
				    		<?php unset($disponibles); ?>
					  </select>
						<script type="text/javascript">
				            var disponibles = new LiveValidation( "disponibles", {onlyOnSubmit: true });
				            disponibles.add(Validate.Selected, { failureMessage: "Selecciona un tecnico" } );
		        		</script> 
		        	<?php }
					else {
						echo "No Tecnicos Disponibles<br />";
					}
					?>
			  		</td>
			  		<td>
			  			<?php echo $this->Form->end(array('label' => '>', 'class' => 'k-button', 'id' => 'button')); ?>
			  			<!--<input type="submit" name="boton_1" id="boton_1" value=">" dir="Nombramiento_asignartecnico" />
			  			<input type="submit" name="boton_1" id="boton_2" value="<" dir="Nombramiento_desasignartecnico" />-->
			  		</td>
					<td>
					  <select id="seleccionados" name="seleccionados" multiple="multiple">
							<?php foreach ($seleccionados as $sel):?>
		    				<option value='<?php echo $sel['Persona']['idpersona']; ?>'> <?php echo $sel['Persona']['nombrespersona'].' '.$sel['Persona']['apellidospersona']; ?></option>
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
							
			

<!--
<script type="text/javascript">
    $(document).ready(function () {    	

		    $("input[type=submit]").click(function() {
		        var accion = $(this).attr('dir');
		        $('form').attr('action', accion);
		        $('form').submit();
	   		 });
		
    });
</script>-->