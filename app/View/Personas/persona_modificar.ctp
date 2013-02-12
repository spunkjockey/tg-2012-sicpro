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
			?> Persona » Modificar persona
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		
		<?php echo $this->Form->create('Persona',array('action' => 'persona_modificar')); ?>
		<ul>
			<h2>Modificar persona</h2>
			<?php 
	if($idrol == 4)
			{ ?> 
				<li>
					<?php echo $this->Form->input('nombrespersona', 
						array(
							'label' => 'Nombres:', 
							'class' => 'k-textbox', 
							'id'	=>	'nombrespersona',
							'maxlength' => 50,
							'div' => array('class' => 'requerido'),
							'placeholder' => 'Nombres')); ?>
							
					<script type="text/javascript">
						var nombrespersona = new LiveValidation( "nombrespersona", { validMessage: " " } );
			            nombrespersona.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            nombrespersona.add(Validate.Format, { pattern: /^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i, failureMessage: "Solo letras" } );
		            </script>
				</li>
				<li>
					<?php echo $this->Form->input('apellidospersona', 
						array(
							'label' => 'Apellidos:', 
							'class' => 'k-textbox', 
							'div' => array('class' => 'requerido'),
							'id'	=> 'apellidospersona',
							'maxlength' => 50,
							'placeholder' => 'Apellidos')); ?>
							
				<script type="text/javascript">
						var nombrepersona = new LiveValidation( "apellidospersona", { validMessage: " " } );
			            nombrepersona.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            nombrepersona.add(Validate.Format, { pattern: /^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i, failureMessage: "Solo letras" } );
		            </script>
				</li>
				<li>
					<?php echo $this->Form->input('plazas', 
						array(
							'label' => 'Plaza:', 
							'class' => 'k-combobox',
							'div' => array('id'=>'plaz','class' => 'requerido'),
							'id' => 'plazas')); ?>
				<script type="text/javascript">
					var plazas = new LiveValidation('plazas' , { validMessage: " " , insertAfterWhatNode: "plaz"});
					plazas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
				</li>
				<li>
					<?php echo $this->Form->input('cargos', 
						array(
							'label' => 'Cargo funcional:',
							'class' => 'k-combobox', 
							'div' => array('id'=>'carg','class' => 'requerido'),
							'id' => 'cargos')); ?>
				<script type="text/javascript">
					var cargos = new LiveValidation('cargos' , { validMessage: " " , insertAfterWhatNode: "carg"});
					cargos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
				</li>
				<li>
					<?php echo $this->Form->input('telefonocontacto', 
						array(
							'label' => 'Telefono:', 
							'class' => 'k-textbox', 
							'id'	=>	'phone'
						)); ?>
				<script type="text/javascript">
		            var phone = new LiveValidation( "phone", { validMessage: " " } );
		            phone.add(Validate.Format, { pattern: /____-____/i, failureMessage: " ", negate: true } );
		            phone.add(Validate.Format, { pattern: /\d\d\d\d-\d\d\d\d/i, failureMessage: "El Numero de Telefono debe de tener 8 números"} );
		        </script> 
				</li>
				<li>
					<?php echo $this->Form->input('correoelectronico', 
						array(
							'label' => 'Correo electronico:', 
							'class' => 'k-textbox', 
							'div' => array('class' => 'requerido'),
							'id'	=> 'mail',
							'maxlength' => 50,
							'placeholder' => 'Ej. usuario@ejemplo.com')); ?>
							
				<script type="text/javascript">
					var mail = new LiveValidation('mail' , { validMessage: " " });
					mail.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					mail.add( Validate.Email , { failureMessage: "El correo electronico debe ser valido" });
		        </script> 
				</li>
				<li  class="accept">
					<table>
						<tr>
							<td>
								<?php echo $this->Form->end(array('label' => 'Modificar Persona', 'class' => 'k-button')); ?>	
							</td>
							<td>
								<?php echo $this->Html->link(
						   			'Regresar', 
								   	array('action'=>'persona_index'),
						   			array('class'=>'k-button')
								);?>	
							</td>
						</tr>
					</table>
					
				</li>
                <li class="status">
            	
            	</li>
            <?php 
            	}
            	else{
            		echo "Lo sentimos, su usuario no cuenta con los permisos adecuados para realizar esta función<br><br>";
            		echo $this->Html->link('Regresar', 
									array('controller' => 'Mains','action' => 'index'),
									array('class'=>'k-button'));
            	}
            	?>
		</ul>
	</div>
</div>

 <style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-combobox{
					width: 300px;
                    margin-left: 5px;
				}
				
			
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
                }

                #formulario h3 {
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
                    width: 160px;
                    text-align: right;
                    
                }

                /*.required {
                    font-weight: bold;
                }*/
                
                form .requerido label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}

                .accept, .status {
                	padding-top: 15px;
                    padding-left: 150px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                
               
               
                
				
				.LV_validation_message{
				    
				    margin:0 0 0 5px;
				    
				}
				
				.LV_valid {
				    color:#00CC00;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 165px; 
               
				}
            </style>
			
<script>
	$(document).ready(function() {
    
                
	$("#plazas").kendoDropDownList({
		optionLabel: "Seleccione plaza",
		dataTextField: "plaza",
		dataValueField: "idplaza",
		index: <?php echo $this->request->data['Persona']['idplaza']; ?>,
		dataSource: {
			type: "json",
			transport: 
			{
				read: "/Personas/plazajson.json"
			}
			                        }
	});
	var plazas = $("#plazas").data("kendoDropDownList");
				
	$("#cargos").kendoDropDownList({
            			optionLabel: "Seleccione cargo funcional",
			            dataTextField: "cargofuncional",
			            index: <?php echo $this->request->data['Persona']['idcargofuncional']; ?>,
			            dataValueField: "idcargofuncional",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Personas/cargojson.json"
			                            }
			                        }
			        });
			        var cargos = $("#cargos").data("kendoDropDownList");
				
				$("#phone").mask("9999-9999");
                 
				
				
				
				});
                
            </script>