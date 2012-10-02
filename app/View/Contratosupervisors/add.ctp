<!-- File: /app/View/Contratosupervisors/add.ctp -->

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
		<h2>Registrar contrato supervisor</h2>
		<?php echo $this->Form->create('Contratosupervisor'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos', 
					array(
						'label' => 'Seleccione proyecto:', 
						'id' => 'proyectos',
						'required')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('contratos', 
					array(
						'label' => 'Contrato a supervisar:', 
						'id' => 'contratos',
						'required')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('codigocontrato', 
					array(
						'label' => 'Código contrato:', 
						'class' => 'k-textbox',
						'id' => 'codigo', 
						'placeholder' => 'Ej: 001-2012', 
						'required', 
						'validationMessage' => 'Ingrese el código de contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('nombrecontrato', 
					array(
						'label' => 'Nombre del contrato:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del contrato',
						'rows' => 2, 
						'required', 
						'validationMessage' => 'Ingrese nombre del contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montocon', 
					array(
						'label' => 'Monto: ($)',
						'class' => 'k-textbox',  
						'id' => 'txmonto',
						'type' => 'text',
						'placeholder' => 'Ingrese Monto',
						'required',
						'validationMessage' => 'Ingrese el monto original($)')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechainicontrato', 
					array(
						'label' => 'Fecha de inicio de contrato:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechafincontrato', 
					array(
						'label' => 'Fecha de fin de contrato:', 
						'id'	=> 'datePicker2',
						'type'  => 'Text')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('plazoejecucion', 
					array(
						'label' => 'Plazo de ejecución:', 
						'class' => 'k-textbox',
						'id' => 'txplazo', 
						'placeholder' => 'Cantidad de días', 
						'required', 
						'validationMessage' => 'Ingrese el plazo de ejecución')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('cantinf', 
					array(
						'label' => 'Cantidad informes:',
						'class' => 'k-textbox',  
						'id' => 'txcanti',
						'type' => 'text',
						'placeholder' => 'Cantidad ej: 3',
						'required',
						'validationMessage' => 'Ingrese cantidad de informes a entregar')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('obras', 
					array(
						'label' => 'Obras a desarrollar:', 
						'class' => 'k-textbox', 
						'rows' => 4, 
						'placeholder' => 'Descripción de obras')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('empresas', 
					array(
						'label' => 'Seleccione empresa:', 
						'id' => 'empresas',
						'required')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('admin', 
					array(
						'label' => 'Seleccione administrador:', 
						'id' => 'admin',
						'required')); ?>
			</li>
			
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar contrato', 'class' => 'k-button')); ?>
				
				<?php 
					$options = array('url' => 'update_consuper','update' => 'selectcon');
					echo $this->ajax->observeField('selectproy', $options);
				?>
			</li>
            <li class="status">
            </li>
		</ul>
	</div>
</div>

	<style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
			
                form .required label:after {
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
                    
                }

                .required {
                    font-weight: bold;
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
				
				$("#txplazo").kendoNumericTextBox({
                        min: 0,
    					max: 999,
    					decimals: 0,
    					placeholder: "Ej. 90",
    					spinners: false
                    });
                    
                $("#txcanti").kendoNumericTextBox({
                        min: 0,
    					max: 99,
    					decimals: 0,
    					placeholder: "Ej. 3",
    					spinners: false
                    });
				
				$("#selectproy").kendoComboBox({
					index: 0,
			        suggest: true,
			        filter: 'none'
				});
				
				$("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto...",
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratosupervisors/proyectojson.json"
			                            }
			                        }
			        });
			        var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			    var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                        optionLabel: "Seleccione contrato...",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratosupervisors/contratojson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
			        
			    $("#empresas").kendoDropDownList({
            			optionLabel: "Seleccione empresa...",
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
            			optionLabel: "Seleccione administrador...",
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