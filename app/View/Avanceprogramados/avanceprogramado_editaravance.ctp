<!-- File: /app/View/Avanceprogramados/avanceprogramado_editaravance.ctp -->

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
			?> » Control y Seguimiento 
			» Programación de Avances 
			» Editar Avance Programado
			
		</div>
	</div>
	
<?php $this->end();?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Editar programación de Avance</h2>
		<?php echo $this->Form->create('Avanceprogramado'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('plazoejecuciondias', array(
								'label' => 'Plazo de Ejecución',
								'type' => 'text',
								'maxlength' => 3, 
								'id' => 'plazoejecuciondias',
								'class' => 'k-textbox',
								'div' => array('class' => 'requerido')
							)); ?> 
				<script type="text/javascript">
					var plazoejecuciondias = new LiveValidation( "plazoejecuciondias", { validMessage: " " } );
					plazoejecuciondias.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					plazoejecuciondias.add( Validate.Numericality,{ onlyInteger: true,
					   								   	notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
					plazoejecuciondias.add(Validate.Length, {minimum: 1, maximum: 3, 
				           							 tooShortMessage:"Longitud mínima de 1 dígito",
				           							 tooLongMessage:"Longitud máxima de 3 dígitos"});
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('fechaavance', array(
								'label' => 'Fecha de Avance',
								'type' => 'text', 
								'id' => 'fechaavance',
								'div' => array('class' => 'requerido'),
								'style' => 'width:120px;',
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errorfechaavance'))
								
							)); ?>  
				<script type="text/javascript">
		            var fechaavance = new LiveValidation( "fechaavance", { validMessage: " " } );
		            fechaavance.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            fechaavance.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener el siguiente formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('porcentajeavfisicoprog', array(
								'label' => 'Avance Físico',
								'id' => 'porcentajeavfisicoprog',
								'class' => 'k-textbox',
								'maxlength' => 5,
								'type' => 'text',
								'div' => array('class' => 'requerido')
							)); ?>
				<script type="text/javascript">
					var porcentajeavfisicoprog = new LiveValidation( "porcentajeavfisicoprog", { validMessage: " " } );
		            porcentajeavfisicoprog.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            porcentajeavfisicoprog.add( Validate.Numericality,{ minimum: 0, maximum: 100, tooLowMessage: "El porcentaje no puede ser menor a 0 %", tooHighMessage: "El porcentaje no debe ser mayor al 100 %", notANumberMessage:"Debe ser un número"} );
		            
		        </script>				 
			</li>
			<li>
				<?php echo $this->Form->input('montoavfinancieroprog', array(
								'label' => 'Monto Avance',
								'id' => 'montoavfinancieroprog',
								'style' => 'width:120px;',
								'maxlength' => 12,
								'div' => array('class' => 'requerido')
							)); ?>
				<script type="text/javascript">
					var montoavfinancieroprog = new LiveValidation( "montoavfinancieroprog", { validMessage: " " } );
		            montoavfinancieroprog.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            montoavfinancieroprog.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>
						
						<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
			</li>		
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Editar Avance', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Cancelar',array('controller' => 'Avanceprogramados', 'action' => 'index'),array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
		</ul>
	</div>
</div>
		
			<style scoped>

                .k-textbox {
                    width: 120px;
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
                    width: 125px;
                    text-align: right;
                    margin-right: 5px; 
                }
                
                                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
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
                
                span.k-tooltip {
                    margin-left: 6px;
                }

 				.LV_validation_message{
				    font-weight:bold;
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				}
					
				.LV_invalid {
				    color:#CC0000;
				    
					clear:both;
               		display:inline-block;
               		margin-left: 25px; 
               
				}
				    
				.LV_valid_field,
				input.LV_valid_field:hover, 
				input.LV_valid_field:active,
				textarea.LV_valid_field:hover, 
				textarea.LV_valid_field:active {
				    border: 1px solid #00CC00;
				}
				    
				.LV_invalid_field, 
				input.LV_invalid_field:hover, 
				input.LV_invalid_field:active,
				textarea.LV_invalid_field:hover, 
				textarea.LV_invalid_field:active {
				    border: 1px solid #CC0000;
				}
                

            </style>
            
            <script>
                $(document).ready(function() {
                    
					$("#fechaavance").kendoDatePicker({
		   				culture: "es-ES",
		   				format: "dd/MM/yyyy" //Define el formato de fecha
					});
                    
                    $("#montoavfinancieroprog").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					max: 999999999,
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
                    
				    
					$("form").focusin(function () {
	  						$("#flashMessage").fadeOut("slow");
	  				});
	                
	                
	                $("#fechaavance").focusin(function () {
	  						$("#errorfechaavance").fadeOut("slow");
	  				});
	  				
                });
                
                
            </script>
