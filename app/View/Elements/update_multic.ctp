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
					  <select id="disponibles" name="disponibles" size="4">
							<?php foreach ($disponibles as $dis):?>
		    				<option value='<?php echo $dis['Persona']['idpersona']; ?>'> <?php echo $dis['Persona']['nombrespersona'].' '.$dis['Persona']['apellidospersona']; ?></option>
						    <?php endforeach; ?>
				    		<?php unset($disponibles); ?>
					  </select>
		        	<?php }
					else {
						echo "No Tecnicos Disponibles<br />";
					}
					?>
			  		</td>
			  		<td>
			  			<!--<?php echo $this->Form->end(array('label' => '>', 'class' => 'k-button', 'id' => 'button')); ?>-->
			  			<input type="submit" name="boton_1" id="boton_1" value=">" dir="nombramiento_asignartecnico" class="k-button" onclick="validardisponibles();" />
			  			<input type="submit" name="boton_2" id="boton_2" value="<" dir="nombramiento_asignartecnico" class="k-button" onclick= "validarseleccionados();" />
			  		</td>
					<td>
					  <select id="seleccionados" name="seleccionados" size="4">
							<?php foreach ($seleccionados as $sel):?>
		    				<option value='<?php echo $sel['Nombramiento']['idnombramiento']; ?>'> <?php echo $sel['Persona']['nombrespersona'].' '.$sel['Persona']['apellidospersona']; ?></option>
						    <?php endforeach; ?>
				    		<?php unset($seleccionados); ?>
					  </select>
					  <div id="disponiblesinfo"></div>
			  		</td>
			  </tr>
			  <tr>
			  	<td colspan="3">
			  			<div id="errordisponibles" style="color:red; position: center"></div>
			  	</td>
			  </tr>
			  <tr>
			  			<?php if ($this->Form->isFieldError('Nombramiento.idpersona')) {
						    echo $this->Form->error('Nombramiento.idpersona');
						} ?>
			  </tr>
			</table>
							
<script>
    $(document).ready(function () {   
    $("#disponibles").click(function(){
    	$("#seleccionados").val("");
    });	
   	$("#seleccionados").click(function(){
    	$("#disponibles").val("");
    });	
    
    function validardisponibles(){
    	var select1 = $("#disponibles :selected").val();
		 if(select1 == undefined){
		 			alert('indefinido');
			    	$('#errordisponibles').text("Seleccione un  Técnico disponible");  
		       return false;
		    }
		 else{
		 		alert('ok');
		 		return true;
		 }
    }
  /*  $('#boton_1').click(function() {
		$('#NombramientoNombramientoAsignartecnicoForm').submit(function(){
		 var select1 = $("#disponibles :selected").val();
		 if(select1 == null){
			    	$('#errordisponibles').text("Seleccione un  Técnico disponible");  
		       return false;
		    }
		 else{
		 		return true;
		 }
		});

	});
	
    $('#boton_2').click(function() {
		$('#NombramientoNombramientoAsignartecnicoForm').submit(function(){
		 var select2 = $("#seleccionados :selected").val();
		 if(select2 == null){
			    	$('#errordisponibles').text("Seleccione un  Técnico Asignado");  
		       return false;
		    }
		 else{
		 		return true;
		 }
		});

	});
/*    
    $("#NombramientoNombramientoAsignartecnicoForm").submit(function(){
    	alert($("button").text());
    	var select = $("#disponibles :selected").val();
		 if(select == null){
			    	$('#errordisponibles').text("Seleccione un  Técnico disponible");  
		       return false;
		    }
		 else{
		 		return true;
		 }
	});		
    	
*/
	 $("input[type=submit]").click(function() {
		        var accion = $(this).attr('dir');
		        $('form').attr('action', accion);
		        $('form').submit();
	});
		
    });
</script>