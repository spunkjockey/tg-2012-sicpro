<!-- File: /app/View/Financias/index.ctp -->

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
			?> » Proyectos » Asignación de Fondos
			
		</div>
	</div>
	
<?php $this->end(); ?>


<div id="example" class="k-content">
	<div id="formulario">
		<h2>Asignación de Fondos</h2>
		<?php echo $this->Form->create('Financia'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'div' => array('class' => 'requerido'),
						'class' => 'k-combobox'
						)); ?>
				<script type="text/javascript">
		            var proyectos = new LiveValidation( "proyectos", { validMessage: " " } );
		            proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			<li>
				
				<?php echo $this->Form->input('fuentes',
					array(
						'label' => 'Fuentes de financiamiento:', 
						'id' => 'fuentes',
						'div' => array('class' => 'requerido'),
						'class' => 'k-combobox'
						)); ?>
				<script type="text/javascript">
		            var fuentes = new LiveValidation( "fuentes", { validMessage: " " } );
		            fuentes.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>		
			</li>
			<li> 
				
				<?php echo $this->Form->input('montoparcial',
					array(
						'label' => 'Monto:',
						'div' => array('class' => 'requerido'), 
						'id' => 'monto', 
						'type' => 'text',
						'class' => 'k-textbox',
						'maxlength' => 12,
						'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errormonto'))
					)); ?>
					
				
				<script type="text/javascript">
					var monto = new LiveValidation( "monto", { validMessage: "Correcto" } );
		            monto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            monto.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>	
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Asignar Fuente', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Cancelar',array('controller' => 'Mains', 'action' => 'index'),array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
		</ul>
		
		<div id='tablafinancia'>
			<div id='divdos'>
				
				<?php if(!empty($disponible)) { ?>
					<h3>Detalle Fuente financiamiento</h3>
					<p><strong class:'etiqueta'>Monto Disponible: </strong><?php echo '$'.number_format($disponible, 2, '.', ',')?> 
				<?php } ?>
					
			</div> 			
		</div>
		


		<?php echo $this->ajax->observeForm( 'FinanciaIndexForm', 
    		array(
        		'url' => array( 'action' => 'update_tablafinancia'),
        		'update' => 'tablafinancia'
    		) 
		); ?>
		<!--
		<?php echo $this->ajax->observeField( 'fuentes', 
    		array(
        		'url' => array( 'action' => 'update_disponible'),
        		'update' => 'divdos'
    		) 
		);  ?> -->
				
	</div>
</div>

            <style scoped>

                
                .k-textbox {
                    width: 200px;
                }
                
                .k-combobox {
                    width: 300px;
                }
				
				#formulario #divdos{
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
                    width: 160px;
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
                
                #tablafinancia {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
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
               		margin-left: 10px; 
               
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
                    $("#proyectos").kendoComboBox({
            			placeholder: "Seleccione un Proyecto",
            			dataTextField: "nombreproyecto",
			            dataValueField: "idproyecto",
						dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Financias/proyectojson.json"
			                            }
			                        }
			        });
			        
			        var proyectos = $("#proyectos").data("kendoComboBox");
			        proyectos.list.width(400);
			        
			        var fuentes = $("#fuentes").kendoComboBox({
			                        placeholder: "Seleccione una Fuente",
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                        dataTextField: "nombrefuente",
			                        dataValueField: "idfuentefinanciamiento",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Financias/fuentejson.json"
			                            }
			                        }
			                    }).data("kendoComboBox");
                    fuentes.list.width(400);
                   
                	$("#monto").kendoNumericTextBox({
					    min: 0,
    					format: "c2",
    					placeholder: "Ingrese un monto",
    					spinners: false
					});
                
                  $("form").focusin(function () {
  						$("#flashMessage").fadeOut("slow");
  				});
                
                
                $("#monto").focusin(function () {
  						$("#errormonto").fadeOut("slow");
  				});
                
                });
                
                
            </script>
