<!-- File: /app/View/Financias/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Asignación de Fondos</h2>
		<?php echo $this->Form->create('Financia'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'selectpro'//,
						//'empty'=>'Seleccione...'
						)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fuentes',
					array(
						'label' => 'Fuentes de financiamiento:', 
						'id' => 'selectfufin',
						//'empty'=>'Seleccione...'
						)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montoparcial',
					array(
						'label' => 'Monto:', 
						'id' => 'monto', 
						'type' => 'text',
						'maxlength' => 12)); ?>
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
				<?php //Debugger::dump($disponible);?> 
				
		</div> 			
		

		<h3>Detalles del Proyecto</h3>
		
			<p><strong class:'etiqueta'>Proyecto: </strong> <?php echo $proyecto['Proyecto']['nombreproyecto']; ?></p>
			<p><strong class:'etiqueta'>Estado Proyecto: </strong><?php echo $proyecto['Proyecto']['estadoproyecto']; ?></p>
			<p><strong class:'etiqueta'>Monto Planeado: </strong>:<?php echo "\$".number_format( $proyecto['Proyecto']['montoplaneado'], 2, '.', ','); ?></p>
		
		
		<table id="grid">
		    <tr>
		        
		        <th data-field="idfuentefinanciamiento">Fuente</th>
		        <th data-field="montoparcial">Monto</th>
		        <th data-field="userc">Usuario</th>
		        <th data-field="creacion">Fecha Asignación</th>
		    </tr> 
		
		    <!-- Here is where we loop through our $empresas array, printing out post info -->
		
		    
		    <?php foreach ($dproyectos as $pro): ?>
		    <tr>
		        
		        <td><?php echo $pro['Fuentefinanciamiento']['nombrefuente']; ?></td>
		        <td><?php echo $pro['Financia']['montoparcial']; ?></td>        
		        <td><?php echo $pro['Financia']['userc']; ?></td>
		        <td><?php echo $pro['Financia']['creacion']; ?></td>
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($dproyectos); ?>
		</table>
		
		</div>
		
		<script>
			$(document).ready(function() {
		    	$("#grid").kendoGrid({
		            	sortable: false,
		            	scrollable: false,
						dataSource: {
		                	aggregate: [{ field: "montoparcial", aggregate: "sum" }],
		                	schema: {
						      model: {
						         fields: {
						             montoparcial: {
						                editable: false,
						                type: "number"
						             }
						         }
						     }
						   }
						},
		                columns: [
		                            { field: "idfuentefinanciamiento", title: "Fuente" },
		                            { field: "montoparcial", title: "Monto", footerTemplate: "$ #=sum#" },
		                            { field: "userc", title: "Usuario"},
		                            { field: "creacion", title: "Fecha Asignación"}
		                                
		                 ]
		        	});
		        });
		</script>

		
		
		<?php  echo $this->ajax->observeField( 'selectpro', 
    		array(
        		'url' => array( 'action' => 'update_fuentefinanciamiento'),
        		'update' => 'selectfufin'
    		) 
		);  ?>
		
		<?php echo $this->ajax->observeField( 'selectpro', 
    		array(
        		'url' => array( 'action' => 'update_tablafinancia'),
        		'update' => 'tablafinancia'
    		) 
		); ?>
		
		<?php echo $this->ajax->observeField( 'selectfufin', 
    		array(
        		'url' => array( 'action' => 'update_disponible'),
        		'update' => 'divdos'
    		) 
		);  ?>


				
	</div>
</div>

            <style scoped>

                .k-textbox {
                    width: 11.8em;
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
                
                #tablafinancia {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }
            </style>
            
            <script>
                $(document).ready(function() {
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("#button").click(function() {
                        if (validator.validate()) {
                        	save();  
                        } 
                    });
                    
                    $("#selectpro").kendoComboBox({
                    	highLightFirst: true,
                    	filter: "contains"
                    });
                    
                    $("#selectfufin").kendoComboBox({
                    	highLightFirst: true,
                    	filter: "contains"
                    });
                    
                    var combobox = $("#selectpro").data("kendoComboBox");
                    combobox.list.width(400);
                    
                    var combobox = $("#selectfufin").data("kendoComboBox");
                    combobox.list.width(400);
                    
                    $("#monto").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					max: 999999999,
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
               
                	        
                
                });
                
                
            </script>
