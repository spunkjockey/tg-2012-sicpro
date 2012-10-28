<!-- File: /app/View/Avanceprogramados/avanceprogramado_registraravance.ctp -->

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
			» Registrar Avance Programado
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Programación de Avance</h2>
		<?php echo $this->Form->create('Avanceprogramado'); ?>
		<ul>
			<li>
				<?php echo '<label>Código de Contrato:</label> '.$contrato['Contratoconstructor']['codigocontrato']; ?>
			</li>


			<li>
				<?php echo $this->Form->input('plazoejecuciondias', array(
								'label' => 'Plazo de Ejecución',
								'type' => 'text',
								'maxlength' => 3, 
								'id' => 'plazoejecuciondias',
								'class' => 'k-textbox',
								'div' => array('id' => 'plazo','class' => 'requerido')
							)); ?> 
				<script type="text/javascript">
					var plazoejecuciondias = new LiveValidation( "plazoejecuciondias", { validMessage: " ", insertAfterWhatNode: "plazo" } );
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
								'div' => array('id' => 'fecha', 'class' => 'requerido'),
								'style' => 'width:120px;',
								'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errorfechaavance'))
								
							)); ?>  
				<script type="text/javascript">
		            var fechaavance = new LiveValidation( "fechaavance", { validMessage: " ", insertAfterWhatNode: "fecha" } );
		            fechaavance.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            fechaavance.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener el siguiente formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('porcentajeavfisicoprog', array(
								'label' => 'Avance Físico (%):',
								'id' => 'porcentajeavfisicoprog',
								'class' => 'k-textbox',
								'placeholder' => 'Ej. 50',
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
								'label' => 'Monto Avance ($):',
								'id' => 'montoavfinancieroprog',
								'style' => 'width:120px;',
								'maxlength' => 12,
								'div' => array('id' => 'monto', 'class' => 'requerido')
							)); ?>
				<script type="text/javascript">
					var montoavfinancieroprog = new LiveValidation( "montoavfinancieroprog", { validMessage: " ", insertAfterWhatNode: "monto" } );
		            montoavfinancieroprog.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            montoavfinancieroprog.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>
						
						<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
			</li>	
			
			
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Agregar Nuevo Avance', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar',
								array('controller' => 'Avanceprogramados', 'action' => 'index',
										$contrato['Contratoconstructor']['idproyecto'],
										$contrato['Contratoconstructor']['idcontrato']
									),
								array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
			
			
			
						<li>
				<!-- Tabla de fedd back de los avances registrados -->
				<div id="#tabla" style="margin-top: 20px">
				<?php if(!empty($avances)) {?>
					<table id="grid" >
					    <tr>
					        <th data-field="plazoejecuciondias">Plazo de Ejecucion</th>
					        <th data-field="fechaavance">Fecha de Avance</th>
					        <th data-field="porcentajeavfisicoprog" width="175px">Avance Físico</th>
					        <th data-field="montoavfinancieroprog">Avance Financiero</th>
					        
					    </tr>
					    
					    <?php foreach ($avances as $av): ?>
					    <tr>
					        <td><?php echo $av['Avanceprogramado']['plazoejecuciondias']; ?></td>
					        <td><?php echo $av['Avanceprogramado']['fechaavance']; ?></td>
					        <td><?php echo $av['Avanceprogramado']['porcentajeavfisicoprog']/100; ?></td>
					        <td><?php echo $av['Avanceprogramado']['montoavfinancieroprog']; ?></td>
					    </tr>
					    <?php endforeach; ?>
					    <?php unset($avances); ?>
					</table>
				<?php } ?>
				</div>
				


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
                    padding-left: 130px;
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
    					
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
					        
					$("#grid").kendoGrid({
                        dataSource: {
                           schema: {
                                model: {
                                    fields: {
                                        plazoejecuciondias: { type: "integer" },
                                        fechaavance: { type: "date" },
                                        porcentajeavfisicoprog: { type: "number" },
                                        montoavfinancieroprog: { type: "number" }      
                                    }
                                }
                            },
                            
                            serverPaging: true,
                            serverFiltering: true,
                            serverSorting: true
                        },
                        
                        filterable: false,
                        sortable: false,
                        pageable: false,
                        scrollable: false,
                        columns: [{
                                field:"plazoejecuciondias",
                                width: 125 
                            }, {
                            	field: "fechaavance",
                            	format: "{0:dd/MM/yyyy}"
                            }, {
                                field: "porcentajeavfisicoprog",
                                title: "Avance Fisico",
                          		format: "{0:p}",
                                width: 125   
                            }, {
                                field: "montoavfinancieroprog",
                                title: "Avance Financiero",
                                format: "{0:c}",
                                width: 125
                                
                            }
                        ]
                    });
					

                $("#fechaavance").focusin(function () {
  						$("#errorfechaavance").fadeOut("slow");
  				});
                
					
					
                });
                
                
            </script>
