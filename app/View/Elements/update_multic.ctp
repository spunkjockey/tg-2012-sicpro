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
<?php if(!empty($disponibles)){ ?>
				<table>
				<tr>
					<td><strong>Disponibles</strong></td>
					<td></td>
					<td><strong>Asignados</strong></td>
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
			  			<p><input type="submit" name="boton_1" id="boton_1" value=" > " title="Asignar" class="k-button" onclick="validardisponibles();" /></p>
			  			<p><input type="submit" name="boton_2" id="boton_2" value=" < " title="Desasignar" class="k-button" onclick= "validarseleccionados();" /></p>
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
			  		</center>
			  </tr>
			  <tr>
				  	<td><?php echo $this->Session->flash('disponibles'); ?></td>
			  		<td></td>
			  		<td><?php echo $this->Session->flash('seleccionados'); ?></td>
			  </tr>
			</table>
<?php } ?>
							
<script>
    $(document).ready(function () {
    	   
	    $("#disponibles").click(function(){
	    	$("#seleccionados").val("");
	    });	
	    
	   	$("#seleccionados").click(function(){
	    	$("#disponibles").val("");
	    });
    	
    });
</script>

<style>
select {
		background-color: #E3F1F7;
		font-size:12px; 
		width: 250px;
		height: 110px;
		/*padding:5px;
		margin:2px;*/
	}

option{
		background-color: #E3F1F7;
		font-size:12px; 
		width: 250px;
		padding:5px;
		margin:2px;
	}
</style>
