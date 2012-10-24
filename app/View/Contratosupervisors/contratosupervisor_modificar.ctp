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
			?> Contrato supervisor » Registrar contrato supervisor
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar contrato supervisor</h2>
		<?php echo $this->Form->create('Contratosupervisor',array('action' => 'contratosupervisor_modificar')); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos', 
					array(
						'label' => 'Seleccione proyecto:', 
						'id' => 'proyectos',
						'div' => array('id'=>'proyo','class' => 'requerido'))); ?>
				<script type="text/javascript">
					var proyectos= new LiveValidation( "proyectos", { validMessage: " " , insertAfterWhatNode: "proyo"} );
					proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('contratos', 
					array(
						'label' => 'Contrato de supervisión:', 
						'id' => 'contratos',
						'div' => array('id'=>'contras','class' => 'requerido'))); ?>
				<script type="text/javascript">
					var contratos= new LiveValidation( "contratos", { validMessage: " " , insertAfterWhatNode: "contras" } );
					contratos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<div id=infoproy>
				<!--- Aqui se muestra el nombre del proyecto seleccionado	-->	
				<!--- se utiliza la funcion update_nomproyecto				-->
			</div>
			<div id=infoconsupervisor>
				<!--- Aqui se carga el formulario para modificar contrato sueprvisor 	-->
				<!--- se utiliza la funcion update_infoconsupervisor							-->	
			</div>
			
		</ul>
		
		<?php echo $this->ajax->observeField( 'proyectos',array(
			        		'url' => array( 'action' => 'update_nomproyecto'),
			        		'update' => 'infoproy'));  
					?>
		<?php echo $this->ajax->observeField( 'contratos',array(
			        		'url' => array( 'action' => 'update_infoconsupervisor'),
			        		'update' => 'infoconsupervisor'));  
					?>
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
                
				$("#txmonto").kendoNumericTextBox({
				     min: 0,
				     max: 999999999.99,
				     format: "c2",
				     decimals: 2,
				     spinners: false
				 });
				
				$("#selectproy").kendoComboBox({
					index: 0,
			        suggest: true,
			        filter: 'none'
				});
				
				$("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto",
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratosupervisors/proyectoconjson.json"
			                            }
			                        }
			        });
			        var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			    var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                        optionLabel: "Seleccione contrato",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratosupervisors/contratossuperjson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
			        
			    $("#empresas").kendoDropDownList({
            			optionLabel: "Seleccione empresa",
			            dataTextField: "nombreempresa",
			            dataValueField: "idempresa",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/empresajson.json"
			                            }
			                        }
			        });
			        var empresas = $("#empresas").data("kendoDropDownList");
			    
			    $("#admin").kendoDropDownList({
            			optionLabel: "Seleccione administrador",
			            dataTextField: "nomcompleto",
			            dataValueField: "idpersona",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratosupervisors/adminjson.json"
			                            }
			                        }
			        });
			        var admin = $("#admin").data("kendoDropDownList");
				
				$("#codigo").mask("999-9999");
				
						
				$("#datePicker1").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				$("#datePicker2").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				
				
				});
                
            </script>
