<!-- File: /app/View/Ordendecambios/ordendecambio_listar.ctp -->
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
			?> » Contratos » Orden de Cambio
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Orden de Cambio</h2>
		<?php echo $this->Form->create('ordenc'); ?>
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
			<li  class="accept">
				<div id='divdiv'>
				</div>

				<!--<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>-->
				<?php echo $this->Form->end(); ?>
				
				<?php echo $this->ajax->observeField( 'contratos', 
		    		array(
		        		'url' => array( 'action' => 'update_infoconconstructor'),
		        		'update' => 'listaordenes'
		    		) 
				);  ?>
			</li>
            <li class="status">
            </li>
		</ul>
	</div>
	<div id="listaordenes">
		<!--Carga con ajax el grid de las ordesnes de cambio para el contrato seleccionado -->
	</div>
</div>
	<?php echo $this->Html->link(
	   	'Regresar', 
	   	array('controller'=>'Mains'),
	   	array('class'=>'k-button')
	);?>
<style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-dropdownlist{
                    width: 150px;
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
                $("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto",
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Ordendecambios/proyectojson.json"
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
			                                read: "/Ordendecambios/contratojson.json"
			                            }
			                        }
			    }).data("kendoDropDownList");
			    
			    proyectos.bind("change", function() {
    						contratos.value("-1");
    						contratos.refresh();   						
				});
			    
			     $('#error1').hide();
				 $('#error2').hide();
                    $("#EstadoContratoActualizarestadoForm").submit( function(){
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
				                /*alert('Ok!');*/
				                return true;
				            }
				    });
				    
				   
			});
</script>