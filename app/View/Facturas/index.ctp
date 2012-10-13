<!-- File: /app/View/Facturas/index.ctp -->

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
			?> » Facturas 
			» Administración de Facturas 
			
			
		</div>
	</div>
	
<?php $this->end(); ?>



<div id="example" class="k-content">
	<div id="formulario">
		<h2>Seleccionar Contrato:</h2>
		<?php echo $this->Form->create('Facturas'); ?>
		<ul>
			<!--<li>
				<?php echo 'idproyecto ' . $idproyecto; ?>
			</li>
			<li>
				<?php echo 'idcontrato ' . $idcontrato; ?>
			</li>-->
			<li>
				
			</li>
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

	<div id='facturas'>
	
	<h2>Detalle Facturación</h2>

<?php if(isset($contrato)) { ?>
	<div>
		<ul style="list-style-type: none;
	                    margin: 10px;
	                    padding: 5px; color: black">
		<li><?php echo '<strong>Código:</strong> '. $contrato['Contrato']['codigocontrato']; ?></li> 
		<li><?php echo '<strong>Nombre de Contrato:</strong>'. $contrato['Contrato']['nombrecontrato']; ?></li>
		<li><?php echo '<strong>Monto:</strong> $'. number_format($contrato['Contrato']['montooriginal'],2); ?></li>
		<li><?php echo '<strong>Variación:</strong> $'. number_format($contrato['Contrato']['variacion'],2); ?></li>
		<li><?php echo '<strong>Orden de Inicio:</strong> '.  date('d/m/Y',strtotime($contrato['Contrato']['ordeninicio'])); ?></li>
		</ul>
	</div>
<?php } ?>


<?php if(isset($estimacion)) {?>
	<table id="grid">
	    <tr>
	        <th data-field="tituloestimacion">Título</th>
	        <th data-field="montoestimado">Monto</th>
	        <th data-field="porcentajeestimadoavance">Porcentaje</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($estimacion as $es): ?>
	    <tr>
	        <td><?php echo $es['Estimacion']['tituloestimacion']; ?></td>
	        <!--<td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>-->
	        <td><?php echo '$ ' . number_format($es['Estimacion']['montoestimado'],2); ?></td>
	        <td><?php echo number_format($es['Estimacion']['porcentajeestimadoavance'],2) . ' %'; ?></td>
	        
	        <td align="center">
	            <?php 
	            
	            	if(!empty($es['Facturaestimacion']['idfacturaestimacion'])) {
	            		echo "Facturada el " . $es['Facturaestimacion']['facturacion'];

		            	/*echo $this->Html->link(
			            	'<span class="k-icon k-i-pencil"></span>', 
			            	array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_modificar', $es['Facturaestimacion']['idfacturaestimacion']),
			            	array('class'=>'k-button', 'escape' => false)
						);*/
						
			            echo $this->Html->link(
			                '<span class="k-icon k-i-close"></span>Eliminar',
			                array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_eliminar', $es['Facturaestimacion']['idfacturaestimacion']),
			                array('confirm' => '¿Está seguro?','class'=>'k-button', 'escape' => false)
			            );

	            	} else {
	            		echo $this->Html->link(
	            			'<span class="k-icon k-i-plus"></span>Facturar', 
	            			array('controller' => 'Facturaestimacions', 'action' => 'facturaestimacion_registrar', $es['Estimacion']['idestimacion']),
	            			array('class'=>'k-button', 'escape' => false)
						);
					}
	            /*echo $this->Html->link(
	            	'Facturar', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado']),
	            	array('class'=>'k-button')
				);
				 * 
				 */?>
	            
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($estimacion); ?>
	</table>
<?php } ?>


<?php if(isset($supervisor)) {?>
	<table id="grid">
	    <tr>
	        <th data-field="tituloinformesup">Título</th>
	        <th data-field="valoravancefinanciero">Monto</th>
	        <th data-field="porcentajeavancefisico">Porcentaje</th>
	        <th data-field="accion">Acción</th>
	    </tr>
	    
	    <?php foreach ($supervisor as $su): ?>
	    <tr>
	        <td><?php echo $su['Informesupervisor']['tituloinformesup']; ?></td>
	        <!--<td><?php echo date('d/m/Y',strtotime($av['Avanceprogramado']['fechaavance'])); ?></td>-->
	        <td><?php echo '$ ' . number_format($su['Informesupervisor']['valoravancefinanciero'],2); ?></td>
	        <td><?php echo number_format($su['Informesupervisor']['porcentajeavancefisico'],2) . ' %'; ?></td>
	        
	        <td align="center">
	            <?php 
	            
	            	if(!empty($su['Facturasupervision']['idinformesupervision'])) {
	            		echo "Facturada el " . $su['Facturasupervision']['facturacion'];
						
		            	/*echo $this->Html->link(
			            	'<span class="k-icon k-i-pencil"></span>', 
			            	array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_modificar', $su['Facturasupervision']['idinformesupervision']),
			            	array('class'=>'k-button', 'escape' => false)
						);*/
						
			            echo $this->Html->link(
			                '<span class="k-icon k-i-close"></span>Eliminar',
			                array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_eliminar', $su['Facturasupervision']['idfacturasupervision']),
			                array('confirm' => '¿Está seguro?','class'=>'k-button', 'escape' => false)
			            );


	            	} else {
	            		echo $this->Html->link(
	            			'<span class="k-icon k-i-plus"></span>Facturar', 
	            			array('controller' => 'Facturasupervisions', 'action' => 'facturasupervision_registrar', $su['Informesupervisor']['idinformesupervision']),
	            			array('class'=>'k-button', 'escape' => false)
						);
	            	}
	            
	                      
	            /*echo $this->Html->link(
	            	'Facturar', 
	            	array('action' => 'Avanceprogramado_editaravance', $av['Avanceprogramado']['idavanceprogramado']),
	            	array('class'=>'k-button')
				);
				 * 
				 */?>
	            
	            
	        </td>
	    </tr>
	    <?php endforeach; ?>
	    <?php unset($supervisor); ?>
	</table>
<?php } ?>


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
	
		<?php echo $this->ajax->observeForm( 'FacturasIndexForm', 
    		array(
        		'url' => array( 'action' => 'update_facturas'),
        		'update' => 'facturas'
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
		                            read: "/Facturas/proyectojson.json"
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
		                            read: "/Facturas/contratojson.json"
		                        }
		                    }
		                }).data("kendoDropDownList");
		                
			$("#AvanceprogramadoIndexForm").submit( function(){
		        var selectpro = $("#proyectos").val();
		        var selectfue = $("#contratos").val();
		 			
		            if(selectpro == ""){
		                $('#error1').text("Seleccione un Proyecto");
		                return false;
		            } else if(selectfue == ""){
		                $('#error2').text("Seleccione un Contrato");
		                return false;
		            } else {
		                $('.error-message').hide();
		                alert('Ok!');
		                return true;
		            }
		    });
		});
	</script>


</div>

