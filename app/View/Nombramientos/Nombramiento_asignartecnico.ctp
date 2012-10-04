<!-- File: /app/View/Nombramientos/Nombramiento_asignartecnico.ctp -->
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
			?> » Bienvenido a SICPRO
			
		</div>
	</div>
	
<?php $this->end(); ?>

     <div id="example" class="k-content">
		<div id="formulario">
			<h2>Asignar Tecnicos</h2>
            <?php echo $this->Form->create('Nombramiento'); ?>
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
				<li>
				<?php echo $this->Form->input('fechanombramiento', 
					array(
						'label' => 'Fecha Nombramiento:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						) ); ?>
				</li>
				<br/>
				<br/>
				<select name="myselect[]" id="myselect" class="multiselect" size="6" multiple="true">
					<?php foreach($tecnicos as $k => $v) {
						
	    				echo "<option value='$k'>$v</option>";
	  				}?>
				</select>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<br/>
				<li  class="accept">
					<table>
						<tr>
							<td>
								<?php echo $this->Form->end(array('label' => 'Registrar Tecnicos', 'class' => 'k-button', 'id' => 'button')); ?>
							</td>
							<td>
								<?php echo $this->Html->link('Cancelar',array('controller' => 'Mains', 'action' => 'index'),array('class'=>'k-button')); ?>
							</td>
						</tr>
					</table>
				</li>
				<?php echo $this->ajax->observeField( 'contratos', 
		    		array(
		        		'url' => array( 'action' => 'update_multic'),
		        		'update' => 'myselect'
		    		) 
				);  ?>
			</ul>
		</div>
	</div>

<style type="text/css">
		/* Recommended styles */
		.tsmsselect {
			width: 40%;
			float: left;
		}
		
		.tsmsselect select {
			width: 100%;
		}
		
		.tsmsoptions {
			width: 20%;
			float: left;
		}
		
		.tsmsoptions p {
			margin: 2px;
			text-align: center;
			font-size: larger;
			cursor: pointer;
		}
		
		.tsmsoptions p:hover {
			color: White;
			background-color: Silver;
		}
	</style>
<style scoped>

                .k-textbox {
                    width: 70px;
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
                    width: 150px;
                    text-align: right;
                    margin-right: 5px; 
                }
                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .required label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
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

<script type="text/javascript">
    $(document).ready(function () {    	
       	$(".multiselect").twosidedmultiselect();
       	
       	$("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto...",
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Nombramientos/proyectojson.json"
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
			                            read: "/Nombramientos/contratojson.json"
			                         }
			                        }
			            }).data("kendoDropDownList");  
			            
		$("#datePicker1").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});
    });
</script>