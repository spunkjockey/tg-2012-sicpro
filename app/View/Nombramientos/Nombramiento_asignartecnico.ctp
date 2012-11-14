<!-- File: /app/View/Nombramientos/nombramiento_asignartecnico.ctp -->
<?php $this->start('menu');
	switch ($this->Session->read('User.idrol')) {
		case 9:
	        echo $this->element('menu/menu_all');
	        break;
	    case 8:
	        echo $this->element('menu/menu_observer');
	        break;
			
	    case 7:
	        echo $this->element('menu/menu_jefeplan');
	        break;
		case 6:
	        echo $this->element('menu/menu_tecproy');
	        break;
	    case 5:
	        echo $this->element('menu/menu_tecplan');
	        break;
	    case 4:
	        echo $this->element('menu/menu_adminsys');
	        break;
		case 3:
	        echo $this->element('menu/menu_admincon');
	        break;
	    case 2:
	        echo $this->element('menu/menu_adminproy');
	        break;
	    case 1:
	        echo $this->element('menu/menu_director');
	        break;			
	}
$this->end(); ?>

<?php $this->start('breadcrumb'); ?>
	
	<div id="menuderastros">
		<div id="rastros">
			
			<?php
			echo $this->Html->image("home.png", array(
	    		"alt" => "Inicio",
	    		'url' => array('controller' => 'mains'),
				'width' => '30px',
				'class' => 'homeimg'
			));
			?> » Contrato » Asignación de Técnico
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Asignar Tecnicos</h2>
        <?php echo $this->Form->create('Nombramiento'); ?>
        <ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'class' => 'k-dropdownlist'
					)); ?>
					<div id="error1" class="error-message"></div>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos',
						'class' => 'k-dropdownlist'
					)); ?>
					<div id="error2" class="error-message"></div>
			</li>

			<div id="listpicker">
				<?php if(!empty($disponibles) || !empty($seleccionados)){ ?>
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
				  		
				  </tr>
				  <tr>
				  	<td><?php echo $this->Session->flash('disponibles'); ?></td>
			  		<td></td>
			  		<td><?php echo $this->Session->flash('seleccionados'); ?></td>
				  </tr>
				</table>
										
				<?php }
				?>
									
				<script>
				    $("#disponibles").click(function(){
				    	$("#seleccionados").val("");
				    });	
				   	$("#seleccionados").click(function(){
				    	$("#disponibles").val("");
				    });	
				    
				    
				</script>
				
				<style>
					select {
						background-color: #E3F1F7;
						font-size:12px; 
						width: 250px;
						height: 110px;
					}
					
					option{
						background-color: #E3F1F7;
						font-size:12px; 
						width: 250px;
						padding:5px;
						margin:2px;
					}
				</style>	
			</div>


			<div id='loading' style="text-align: center; width: 600px; display: none;"><?php echo $this->Html->image('spinner.gif', array('alt' => 'cargando', "style" => "border: 0;")); ?></div>
			
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Html->link('Regresar',
								array('controller' => 'Mains', 'action' => 'index'),array('id' => 'regresar','class'=>'k-button')); 
							?>				
						</td>
						<td>
							<!--<?php echo $this->Form->end(array('label' => 'Registrar Tecnicos', 'class' => 'k-button', 'id' => 'button')); ?>-->
						</td>
					</tr>
				</table>
			</li>
			
			<?php echo $this->ajax->observeField( 'contratos', 
	    		array(
	        		'url' => array( 'action' => 'update_tecdispo'),
	        		'update' => 'listpicker',
	        		'indicator' => 'loading',
					'before' => '$("#listpicker").html(" ")',
	    		) 
			);  ?>
			
			<?php echo $this->ajax->observeField( 'proyectos', 
	    		array(
	        		'url' => array( 'action' => 'update_tecdispo'),
	        		'update' => 'listpicker'
	    		) 
			);  ?>
		</ul>
	</div>
</div>
<style scoped>

            .k-textbox {
                width: 70px;
            }
			
			#tablat {
				vertical-align: top;
			}
			
			#formulario {
                width: 600px;
                margin: 15px 0;
                padding: 10px 20px 20px 0px;
            }

            #formulario h3 {
                font-weight: normal;
                font-size: 1.4em;
                border-bottom: 1px solid #ccc;
            }
            
            #tablafinancia h3 {
                font-weight: normal;
                font-size: 1.4em;
                border-bottom: 1px solid #ccc;
            }

            #formulario ul {
                list-style-type: none;
                margin: 0;
                padding: 0;
            }
            
            #formulario li {
                margin: 10px 0 0 0;
            }

            label {
                display: inline-block;
                width: 150px;
                text-align: right;
                margin-right: 5px; 
            }
            
            .etiqueta {
                display: inline-block;
                width: 150px;
                
                margin-right: 5px; 
            }
            
            
            form .required label:after {
            	font-size: 1.4em;
				color: #e32;
				content: '*';
				display:inline;
			}
            
            .required {
                font-weight: bold;
            }

            .accept, .status {
            	padding-top: 15px;
                padding-left: 490px;
            }

            .valid {
                color: green;
            }

            .invalid {
                color: red;
            }
            
            span.k-tooltip {
                margin-left: 6px;
            }
            
            #listpicker {
            	display: block;
            	width: 600px; 
            	height: 150px;
            	margin: 25px;
            }
            
         	.LV_validation_message{
			    /*font-weight:bold;*/
			    margin:0 0 0 5px;
			}
			
			.LV_valid {
			    color:#00CC00;
			    margin-left: 10px;
			    display: none;
			}
				
			.LV_invalid {
			    color:#CC0000;
           		display:block;
           		
			}
</style>

<script type="text/javascript">
$(document).ready(function () {    	
	
   	/*$(".multiselect").twosidedmultiselect();*/
   	
   	$("#proyectos").kendoDropDownList({
        			optionLabel: "Seleccione proyecto",
		            dataTextField: "numeroproyecto",
		            dataValueField: "idproyecto",
		            <?php if(isset($idproyecto)){echo "value: ".$idproyecto.",";}?>
		            dataSource: {
		                            type: "json",
		                            transport: {
		                                read: "/Nombramientos/proyectojson.json"
		                            }
		                        }
		        });
		        
	var proyectos = $("#proyectos").data("kendoDropDownList");
		        
	var contratos = $("#contratos").kendoDropDownList({
		            autoBind: true,
		            cascadeFrom: "proyectos",
		            optionLabel: "Seleccione contrato",
		            dataTextField: "codigocontrato",
		            dataValueField: "idcontrato",
		            <?php if(isset($idcontrato)){echo "value: ".$idcontrato.",";}?>
		            dataSource: {
		                         type: "json",
		                         transport: {
		                            read: "/Nombramientos/contratojson.json"
		                         }
		                        }
		            }).data("kendoDropDownList");  
		            
	$("#datePicker1").kendoDatePicker({
	   culture: "es-ES",
	   format: "dd/MM/yyyy" //Define el formato de fecha
	});
	
	
			 $('#error1').hide();
			 $('#error2').hide();
                $("#NombramientoNombramientoAsignartecnicoForm").submit( function(){
			        var selectpro = $("#proyectos").val();
			        var selectcon = $("#contratos").val();
			 			$('#error1').hide();
			 			$('#error2').hide();
			            if(selectpro == ""){
			            	$('#error1').show();
			                $('#error1').text("Seleccione un Proyecto");
			                
			                return false;
			            } else if(selectcon == ""){
			            	$('#error2').show();
			                $('#error2').text("Seleccione un Contrato");
			                
			                return false;
			            } else {
			                $('.error-message').hide();
			                return true;
			            }
			    });
	
});
</script>