<!-- File: /app/View/Contratoconstructors/actualizarestado.ctp -->
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
			?> » Bienvenido a SICPRO » Actualizar Estado Contrato
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Actualizar Estado de Contrato Constructor</h2>
		<?php echo $this->Form->create('Estado'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos'
					)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos'
					)); ?>
			</li>
			<div id="info_contrato">
					<!--Con ajax se llena el contenido con la informacion del contrato seleccionado-->


			</div>
			<br><br>
			<li id='opcionesact'>
				
			</li>
			<li  class="accept">
				<div id='divdiv'>
				</div>

				<!--<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>-->
				<?php echo $this->Form->end(array('label' => 'Actualizar Estado', 'class' => 'k-button')); ?>
				
			
				<?php echo $this->ajax->observeField( 'contratos', 
		    		array(
		        		'url' => array( 'action' => 'update_infocontrato'),
		        		'update' => 'info_contrato'
		    		) 
				);  ?>
				<?php echo $this->ajax->observeField( 'contratos', 
		    		array(
		        		'url' => array( 'action' => 'update_opcionesactualizar'),
		        		'update' => 'opcionesact'
		    		) 
				);  ?>

			</li>
            <li class="status">
            </li>
		</ul>
	</div>
</div>


<style scoped>

                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                .k-textbox {
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
                $("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto...",
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/proyectoejecjson.json"
			                            }
			                        }
			        });
  
                
			    var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			    var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: true,
			                        cascadeFrom: "proyectos",
			                        optionLabel: "Seleccione contrato...",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/contratojson.json"
			                            }
			                        }
			    }).data("kendoDropDownList");
			});
</script>