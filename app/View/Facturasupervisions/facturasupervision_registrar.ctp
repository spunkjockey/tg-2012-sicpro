<!-- File: /app/View/Facturaestimacions/facturaestimacion_registrar.ctp -->

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
			?> » Facturas 
			» Administración de Facturas 
			» Registrar Factura de Supervisión
			
		</div>
	</div>
	
<?php $this->end(); ?>


<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Factura de Supervisión</h2>
		
		<?php /*Debugger::dump($this->request->data);*/ echo $this->Form->create('Facturasupervision'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('idinformesupervision', array(
								'label' => 'IDSupervision',
								'id' => 'idestimacion',
								'tye' => 'hidden',
								'class' => 'k-textbox',
								'value' => $this->request->data['Facturasupervision']['idinformesupervision'],
								'div' => array('class' => 'requerido')
							)); ?> 
			</li>
			<li>
				<?php echo $this->Form->input('numerofactura', array(
								'label' => 'Numero Factura',
								'id' => 'numerofactura',
								'class' => 'k-textbox',
								'div' => array('class' => 'requerido')
							)); ?> 
				<script type="text/javascript">
					var numerofactura = new LiveValidation( "numerofactura", { validMessage: " " } );
					numerofactura.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					numerofactura.add( Validate.Numericality,{ onlyInteger: true,
					   								   	notAnIntegerMessage: "Debe ser un número",
						            				 	notANumberMessage:"Debe ser un número"} );
					numerofactura.add(Validate.Length, {minimum: 1, maximum: 8, 
				           							 tooShortMessage:"Longitud mínima de 1 dígito",
				           							 tooLongMessage:"Longitud máxima de 8 dígitos"});
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('descripcionfactura', array(
								'label' => 'Descripción Factura',
								'id' => 'descripcionfactura',
								'rows'=>'3',
								'class' => 'k-textbox',
								'div' => array('class' => 'requerido')
							)); ?> 
				<script type="text/javascript">
					var descripcionfactura = new LiveValidation( "descripcionfactura", { validMessage: " " } );
					descripcionfactura.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('montofactura', array(
								'label' => 'Monto Factura',
								'id' => 'montofactura',
								'style' => 'width:120px;',
								'maxlength' => 12,
								'div' => array('id' => 'montof', 'class' => 'requerido'),
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errormontofactura'))
							)); ?>
				<script type="text/javascript">
					var montofactura = new LiveValidation( "montofactura", { validMessage: " ", insertAfterWhatNode: "montof" } );
		            montofactura.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            montofactura.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>
						
						<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
			</li>	
			<li>
				<?php echo $this->Form->input('fechafactura', array(
								'label' => 'Fecha de Avance',
								'type' => 'text', 
								'id' => 'fechafactura',
								'div' => array('id' => 'fechaf', 'class' => 'requerido'),
								'style' => 'width:120px;',
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errorfechafactura'))
								
							)); ?>  
				<script type="text/javascript">
		            var fechafactura = new LiveValidation( "fechafactura", { validMessage: " ", insertAfterWhatNode: "fechaf" } );
		            fechafactura.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            fechafactura.add(Validate.Format, { pattern: /[0-3]\d\/[0-1]\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener el siguiente formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Agregar Factura', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar',array('controller' => 'Facturas', 'action' => 'index'),array('class'=>'k-button')); ?>
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
				
				#descripcionfactura {
                    width: 250px;
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
               		margin-left: 130px;
				}
				    
			/*	.LV_valid_field,
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
                */

            </style>
            
            <script>
                $(document).ready(function() {
                    
					$("#fechafactura").kendoDatePicker({
		   				culture: "es-ES",
		   				format: "dd/MM/yyyy" //Define el formato de fecha
					});
                    
                    $("#montofactura").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
					        
					
					
				$("form").focusin(function () {
  						$("#flashMessage").fadeOut("slow");
  				});
                
                
                $("#fechafactura").focusin(function () {
  						$("#errorfechafactura").fadeOut("slow");
  				});
                
                errormontofactura
					
				$("#montofactura").focusin(function () {
  						$("#errormontofactura").fadeOut("slow");
  				});
					
                });
                
                
            </script>