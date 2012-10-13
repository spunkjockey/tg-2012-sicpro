<!-- File: /app/View/Ubicaciones/add.ctp -->
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
			?> » Proyecto » Ficha Tecnica » Modificar Ficha Tecnica
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Ubicacion</h2>
		
				<?php echo $this->Form->create('Ubicacion'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('departamentos',
					array(
						'label' => 'Departamento:', 
						'id' => 'departamentos',
						'class' => 'k-dropdownlist'
					)); ?>
				<script type="text/javascript">
		            var departamentos = new LiveValidation( "departamentos", { validMessage: " " } );
		            departamentos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>

			<li>
				<?php echo $this->Form->input('municipios',
					array(
						'label' => 'Municipio:', 
						'id' => 'municipios',
						'class' => 'k-dropdownlist'
					)); ?>
				<script type="text/javascript">
		            var municipios = new LiveValidation( "municipios", { validMessage: " " } );
		            municipios.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
		        <?php if ($this->Form->isFieldError('idmunicipio')) {
				    echo $this->Form->error('idmunicipio');
				} ?>
			</li>
			<li>
				<?php echo $this->Form->input('direccion', 
					array(
						'label' => 'Direccion: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Direccion',
						"rows"=>"2")); ?>
			</li>
			<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>	
			<li  class="accept">
			<table>
			<tr>
				<td>			
				<?php echo $this->Html->link(
					'Regresar', 
					array('controller' => 'Fichatecnicas', 'action' => 'fichatecnica_modificarubicacion',$idfct),
					array('class'=>'k-button')
				); ?>
				</td>
				<td>
				<?php echo $this->Form->end(array('label' => 'Registrar Ubicacion', 'class' => 'k-button')); ?>
				</td>
			</tr>
			</table>
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
				
				.k-dropdownlist{
                    width: 200px;
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
				    font-weight:bold;
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 170px; 
               
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
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            //status.text("Hooray! Your tickets has been booked!").addClass("valid");
                            } else {
                            //status.text("Oops! There is invalid data in the form.").addClass("invalid");
                        }
                    });
                    $("#departamentos").kendoDropDownList({
            			optionLabel: "Seleccione departamento",
			            dataTextField: "departamento",
			            dataValueField: "iddepartamento",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Ubicacions/departamentojson.json"
			                            }
			                        }
			        });
			    	var departamentos = $("#departamentos").data("kendoDropDownList");
			        
			    	var municipios = $("#municipios").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "departamentos",
			                        optionLabel: "Seleccione Municpio",
			                        dataTextField: "municipio",
			                        dataValueField: "idmunicipio",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Ubicacions/municipiojson.json"
			                            }
			                        }
			    }).data("kendoDropDownList");
                });
</script>