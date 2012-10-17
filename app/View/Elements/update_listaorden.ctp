<?php
//Debugger::dump($ultimo);?>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Orden de Cambio', 
		array('controller' => 'Ordendecambios', 'action' => 'ordendecambio_registrar',$this->data['ordenc']['contratos']),
		array('class'=>'k-button')
	); ?>
</div> 
<?php
//Debugger::dump($ordenes);

if(!empty($ordenes)){ ?>
<table id="grid">
    <tr>
        <th data-field="tituloordendecambio">Titulo Orden de Cambio</th>
        <th data-field="montoordencambio" width="90px">Monto</th>
        <th data-field="descripcionordencambio">Descripcion</th>
        <th data-field="creacion" width="60px">Fecha</th>
        
        
        <th data-field="accion" width="80px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $empresas array, printing out post info -->
    <?php foreach ($ordenes as $or): ?>
    <tr>
        <td><?php echo $or['Ordendecambio']['tituloordendecambio']; ?></td>  
        <td><?php echo "$ ".$or['Ordendecambio']['montoordencambio']; ?></td> 
		<td><?php echo $or['Ordendecambio']['descripcionordencambio']; ?></td> 
		<td><?php echo date('d/m/Y',strtotime($or['Ordendecambio']['fecharegistroorden'])); ?></td> 
        <td align="center">
        	<?php if(isset($ultimo) && $or['Ordendecambio']['idordencambio']==$ultimo['Ordendecambio']['idordencambio']){ ?>
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>', 
            	array('action' => 'ordendecambio_modificar', $or['Ordendecambio']['idordencambio']),
            	array('class'=>'k-button','escape' => false)
			);?>
			
			
            <?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('action' => 'ordendecambio_eliminar', $or['Ordendecambio']['idordencambio']),
                array('confirm' => '¿Está seguro que desea eliminar la Orden de Cambio ?',
                		'class'=>'k-button','escape' => false)
            );
            }
            ?>
        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($ordenes); ?>

</table>
<?php }
else {
	echo "No hay Ordenes de Cambio<br />";
}
?>
<style scoped>
		        #grid .k-button
		        {
		            vertical-align: middle;
		            width: 28px;
		            margin: 0 3px;
		            padding: .1em .4em .3em;
		            display: inline;
		            
		        }

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-dropdownlist{
                    width: 300px;
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
    	$("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 5,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Ordenes de Cambio",
            			empty: "No Ordenes de cambio a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Ordenes de Cambio por página",
            			first: "Ir a la primera página",
            			previous: "Ir a la página anterior",
            			next: "Ir a la siguiente página",
            			last: "Ir a la última página",
            			refresh: "Actualizar"
            		}
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
        	});
        	
        $(window).load(function () {
        		sleep(5);
  				$("#flashMessage").fadeOut("slow");
  			});
                
        });
</script>