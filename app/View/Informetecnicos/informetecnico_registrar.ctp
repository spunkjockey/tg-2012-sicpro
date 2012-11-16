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
			?> Control y seguimiento » Informe técnico » Registrar informe técnico 
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar informe técnico</h2>
		<?php echo $this->Form->create('Informetecnico'); ?>
		<ul>
			<li>
				<?php 
					echo $this->Form->input('contratos', array(
							'label' => 'Código de Contrato:', 
							'div' => array('id' => 'contrat', 'class' => 'requerido'),
							'id' => 'contratos'));
				?>
				<script type="text/javascript">
					var contratos= new LiveValidation( "contratos", { validMessage: " " , insertAfterWhatNode: "contrat" } );
					contratos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<div id=infoproy>
				
			</div>
			<li>
				<?php echo $this->Form->input('Informetecnico.fechavisita', 
					array(
						'label' => 'Fecha de visita:', 
						'id'	=> 'datePicker1',
						'div' => array('id'=>'fechavis','class' => 'requerido'),
						'type'  => 'Text')); ?>
					<script type="text/javascript">
			            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " , insertAfterWhatNode: "fechavis"} );
			            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
			        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('Informetecnico.fechaelaboracion', 
					array(
						'label' => 'Fecha de elaboración:', 
						'id'	=> 'datePicker2',
						'div' => array('id'=>'fechaela','class' => 'requerido'),
						'type'  => 'Text')); ?>
					<script type="text/javascript">
			            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " "  , insertAfterWhatNode: "fechaela" } );
			            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
			        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('Informetecnico.antecedentes', 
					array(
						'label' => 'Antecedentes:', 
						'class' => 'k-textbox',
						'id'=> 'txantecedentes', 
						'div' => array('class' => 'requerido'),
						'rows' => 4, 
						'placeholder' => 'Descripción de antecedentes')); ?>
					<script type="text/javascript">
						var txantecedentes = new LiveValidation( "txantecedentes", { validMessage: " " } );
				        txantecedentes.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				    </script>
			</li>
			<li>
				<?php echo $this->Form->input('Informetecnico.anotaciones', 
					array(
						'label' => 'Anotaciones:', 
						'class' => 'k-textbox',
						'id'=> 'txanotacion',
						'div' => array('class' => 'requerido'), 
						'rows' => 4, 
						'placeholder' => 'Observaciones de la visita')); ?>
					<script type="text/javascript">
						var txanotacion = new LiveValidation( "txanotacion", { validMessage: " " } );
				        txanotacion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				    </script>
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Registrar informe', 'class' => 'k-button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar', 
				            	array('controller' => 'Mains','action' => 'index'),
				            	array('class'=>'k-button'));?>
						</td>
					</tr>
				</table>
			</li>
			<?php echo $this->ajax->observeField( 'contratos',array(
				        		'url' => array( 'action' => 'update_infoproy_inftec'),
				        		'update' => 'infoproy'));  ?>
			<li class="status">
			</li>
		</ul>
	</div>
</div>

<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
                    width: 300px;
                }
                
                form .requerido label:after {
					font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
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
                    width: 150px;
                    text-align: right;
                    margin-right: 5px;
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
				    margin:0 0 0 5px;
				    display: none;
				}
				
				.LV_valid {
				    color:#00CC00;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}
				    
            </style>
			
<script>
                $(document).ready(function() {
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            //status.text("Hooray! Your tickets has been booked!").addClass("valid");
                            } else {
                            //status.text("Oops! There is invalid data in the form.").addClass("invalid");
                        }
                    });
                
                function filtrarDrop() 
			   		{
						var startDate = datePicker1.value();
						var endDate = datePicker2.value();
					}    
				        
					function startChange() {
						var startDate = datePicker1.value();
						if (startDate) {
				            startDate = new Date(startDate);
				            startDate.setDate(startDate.getDate());
				            datePicker2.min(startDate);
				    	}
				    }
					
					function endChange() {
						var endDate = datePicker2.value();
					    if (endDate) {
					        endDate = new Date(endDate);
					        endDate.setDate(endDate.getDate());
					        datePicker1.max(endDate);
					    }
					}
				
				    var datePicker1 = $("#datePicker1").kendoDatePicker({
				        culture: "es-ES",
					   	format: "dd/MM/yyyy",
				        change: startChange,
				        close: filtrarDrop
				    }).data("kendoDatePicker");
					
				    var datePicker2 = $("#datePicker2").kendoDatePicker({
				        culture: "es-ES",
					   	format: "dd/MM/yyyy",
				        change: endChange,
				        close: filtrarDrop
				    }).data("kendoDatePicker");
					
				    datePicker1.max(datePicker2.value());
				    datePicker2.min(datePicker1.value());
                
				$("#contratos").kendoDropDownList({
            			optionLabel: "Seleccione contrato",
			            dataTextField: "codigocontrato",
			            dataValueField: "idcontrato",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Informetecnicos/contratojson.json"
			                            }
			                        }
			        });
			        
			        var contratos = $("#contratos").data("kendoDropDownList");
				
				
				});
                
                
                
</script>		
