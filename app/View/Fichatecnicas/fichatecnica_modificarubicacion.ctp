<!-- File: /app/View/Fichatecnicas/fichatecnica_modificarubicacion.ctp -->
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
<!--<?php Debugger::dump($ubicaciones); ?>-->
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Ubicacion', 
		array('controller' => 'Ubicacions', 'action' => 'ubicacion_registrarmod',$idfichatecnica),
		array('class'=>'k-button')
	); ?>
</div> 
<?php if(!empty($ubicaciones)){ ?>
<table id="grid">
    <tr>
        <th data-field="direccion">Direccion</th>
        <th data-field="municipio">Municipio</th>
        <th data-field="departamento">Departamento</th>
        <th data-field="accion" width="70px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $empresas array, printing out post info -->

    <?php foreach ($ubicaciones as $ubi): ?>
    <tr>
        <td><?php echo $ubi['Ubicacion']['direccion']; ?></td>   
        <td><?php echo $ubi['Municipio']['municipio']; ?></td>
        <td><?php echo $ubi['Departamento']['departamento']; ?></td>  
        <td align="center">
           <!-- <?php echo $this->Html->link(
            	'Modificar', 
            	array('action' => 'fichatecnica_modificarficha', $ubi['Ubicacion']['idubicacion']),
            	array('class'=>'k-button')
			);?>-->
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('controller'=>'Ubicacions','action' => 'ubicacion_eliminar', $ubi['Ubicacion']['idubicacion'],$idfichatecnica),
                array('confirm' => '¿Está seguro que desea la ubicacion?',
                		'class'=>'k-button')
            )?>
        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($ubicaciones); ?>

</table>
<?php }
else {
	echo "No hay Ubicaciones registradas para esta Ficha Tecnica<br />";
}
?>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Regresar', 
		array('controller' => 'Fichatecnicas', 'action' => 'fichatecnica_listarficha'),
		array('class'=>'k-button')
	); ?>
</div>
<style scoped>

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
	           		pageSize: 10,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Ubicaciones",
            			empty: "No hay Ubicaciones a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Ubicaciones por página",
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
        });
</script>