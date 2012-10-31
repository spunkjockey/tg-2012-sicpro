<!-- File: /app/View/Avanceprogramados/index.ctp -->

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
			
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Seleccionar Contrato:</h2>
		<?php echo $this->Form->create('Avanceprogramado'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'class' => 'k-combobox'
					)); ?>
				<div id="error1" class="error-message"></div>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos',
						'class' => 'k-combobox'
					)); ?>
				<div id="error2" class="error-message"></div>
			</li>
						<!--<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>-->
		</ul>
	</div>
</div>
		
<h2>Programación de Avance</h2>
<div id='avanceprog'>
	
	<?php if(isset($nombrecontrato)) { ?>
<div>
	<ul style="list-style-type: none;
                    margin: 10px;
                    padding: 5px; color: black">
	<li><?php echo '<strong>Nombre Contrato:</strong> '.$nombrecontrato; ?></li> 
	<li><?php echo '<strong>Monto:</strong> $'.number_format($montooriginal,2); ?></li>
	<li><?php echo '<strong>Plazo Ejecución:</strong> '.$plazoejecucion; ?></li>
	<li><?php echo '<strong>Orden de Inicio:</strong> '. date('d/m/Y',strtotime($ordeninicio)); ?></li>
	</ul>
</div>

<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'<span class="k-icon k-i-plus"></span> Agregar Avance Programado', 
		array('action' => 'Avanceprogramado_agregaravance',$idcontrato),
		array('class'=>'k-button', 'escape' => false)
	); ?>
</div> 

<?php } ?>

<?php if(!empty($avances)) {?>

	<table id="grid">
	    <tr>
	        <th data-field="plazoejecuciondias">Plazo</th>
	        <th data-field="fechaavance">Fecha</th>
	        <th data-field="porcentajeavfisicoprog" width="175px">Avance Físico</th>
	        <th data-field="montoavfinancieroprog">Avance Financiero</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($avances as $av): ?>
	    <tr>
	        <td><?php echo $av['Avanceprogramado']['plazoejecuciondias']; ?></td>
	        <td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>
	        <td><?php echo number_format($av['Avanceprogramado']['porcentajeavfisicoprog'],2) . ' %'; ?></td>
	        <td><?php echo '$ ' . number_format($av['Avanceprogramado']['montoavfinancieroprog'],2); ?></td>
	        <td align="center">
	            <?php echo $this->Html->link(
	            	'<span class="k-icon k-i-pencil"></span>', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado'],$idcontrato),
	            	array('class'=>'k-button', 'escape' => false, 'title'=>'Editar avance')
				);?>
	            <?php echo $this->Form->postLink(
	                '<span class="k-icon k-i-close"></span>',
	                array('action' => 'Avanceprogramado_eliminaravance', $av['Avanceprogramado']['idavanceprogramado']),
	                array('confirm' => '¿Está seguro?','class'=>'k-button', 'escape' => false, 'title'=>'Eliminar avance')
	            )?>
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($avances); ?>
	</table>
<?php } else {
	echo 'No existen avances asociados a este proyecto';
} ?>
<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false,
        	});
        	
        });       
</script>
	
	
</div>

		<?php echo $this->ajax->observeForm( 'AvanceprogramadoIndexForm', 
    		array(
        		'url' => array( 'action' => 'update_avanceprog'),
        		'update' => 'avanceprog'
    		) 
		); ?>


			<style scoped>

                .k-textbox {
                    width: 70px;
                }
                
                .k-combobox {
                    width: 200px;
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
                

					
				.error-message {
				    color:#CC0000;
               		display:block;
               		margin-left: 130px;
               		margin:0 0 0 5px;
				}

            </style>
            
            <script>
                $(document).ready(function() {
                    
					$("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto",
			            
			            dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            <?php if(isset($idproyecto)) { echo 'value: ' . $idproyecto . ','; } ?> 
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Avanceprogramados/proyectojson.json"
			                            }
			                        }
			        });
			        
			        var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			        var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: true,
			                        <?php if(isset($idcontrato)) { echo 'value: ' . $idcontrato . ','; } ?>
			                        cascadeFrom: "proyectos",
			                        optionLabel: "Seleccione contrato",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Avanceprogramados/contratojson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
			                   

                    $("#fechaavance").kendoDatePicker({
		   				culture: "es-ES",
		   				format: "dd/MM/yyyy" //Define el formato de fecha
					});
                    
                    $("#montoavfinancieroprog").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					max: 999999999,
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
                    
  					$("#AvanceprogramadoIndexForm").submit( function(){
				        var selectpro = $("#proyectos").val();
				        var selectfue = $("#contratos").val();
				 			
				            if(selectpro == ""){
				                $('#error1').show().text("Seleccione un Proyecto");
				                return false;
				            } else if(selectfue == ""){
				                $('#error2').show().text("Seleccione un Contrato");
				                return false;
				            } else {
				                $('.error-message').hide();
				                //alert('Ok!');
				                return true;
				            }
				    });
                });
                
                
            </script>
