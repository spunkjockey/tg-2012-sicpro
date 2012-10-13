<!-- File: /app/View/Proyectos/proyecto_listado.ctp -->

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
			?> Administración de proyectos
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Proyectos</h2>
		<div style='margin:4px 0' >
			<?php echo $this->Html->link(
				'Registrar proyecto', 
				array('controller' => 'proyectos', 'action' => 'proyecto_registrar'),
				array('class'=>'k-button')); 
			?>
			<?php echo $this->Html->link(
				'Asignar número de proyecto', 
				array('controller' => 'proyectos', 'action' => 'proyecto_asignar_num'),
				array('class'=>'k-button')); 
			?>
		</div>
		
		<table id="grid">
		    <tr>
		        <th data-field="nombreproyecto" width="280px">Nombre proyecto</th>
		        <th data-field="estadoproyecto">Estado</th>
		        <th data-field="accion" width="210px">Acción</th>
		    </tr>
			<?php foreach ($proyectos as $proy): ?>
		    <tr>
		        <td><?php echo $proy['Proyecto']['nombreproyecto']; ?></td>
		        <td><?php echo $proy['Proyecto']['estadoproyecto']; ?></td>
		      	<td align="center">
		            <?php 
		            	echo $this->Html->link('Detalles', 
		            				array('action' => 'proyecto_detalles', $proy['Proyecto']['idproyecto']),
		            				array('class'=>'k-button')); 
			            if ($proy['Proyecto']['estadoproyecto'] == 'Formulacion')
			            {
			            	echo $this->Html->link('Editar', 
						            	array('action' => 'proyecto_modificar', $proy['Proyecto']['idproyecto']),
						            	array('class'=>'k-button'));
							echo $this->Form->postLink('Eliminar', 
			            				array('action' => 'proyecto_eliminar', $proy['Proyecto']['idproyecto']),
			            				array('confirm' => '¿Está seguro?','class'=>'k-button'));
			            }
		            ?>
		           </td>
		    </tr>
		    <?php endforeach; ?>
		    <?php unset($proyectos); ?>
	</table>
		
	</div>


	<script type="text/x-kendo-template" id="template">
	    <div class="toolbar">
	        <label class="estadoproyecto-label" for="estadoproyecto">Mostrar Proyectos por Estado:</label>
	        <input type="search" id="estadoproyecto" style="width: 230px"></input>
	    </div>
	</script>
	
	
	<script>
		$(document).ready(function() {
	    	var grid = $("#grid").kendoGrid({
	            	dataSource: {
		           		pageSize: 10,
	            	},
	            	pageable: true,
	            	pageable: {
	            		messages: {
	            			display: "{0} - {1} de {2} Proyectos",
	            			empty: "No proyectos a mostrar",
	            			page: "Página",
	            			of: "de {0}",
	            			itempsPerPage: "Proyectos por página",
	            			first: "Ir a la primera página",
	            			previous: "Ir a la página anterior",
	            			next: "Ir a la siguiente página",
	            			last: "Ir a la última página",
	            			refresh: "Actualizar"
	            		}
	            	},
	            	toolbar: kendo.template($("#template").html()),
	            	sortable: true,
	            	sortable: {
	 			    	mode: "single", // enables multi-column sorting
	        			allowUnsort: true
					},
					scrollable: false
	        	});
	        	
	        	var dropDown = $("#estadoproyecto").kendoDropDownList({
	            	dataTextField: "estadoproyecto",
	                dataValueField: "estadoproyecto",
	                autoBind: false,
	                optionLabel: "Todos los estados",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Proyectos/estadojson.json"
		               	}
		            },
	                change: function() {
	                    var value = this.value();
	                    //alert(value);
	                    if (value != "Todos los estados") {
	                        grid.data("kendoGrid").dataSource.filter({ field: "estadoproyecto", operator: "eq", value: value });
	                    } else {
	                        grid.data("kendoGrid").dataSource.filter({});
	                    }
	                }
	            });
	        });
	</script>

    <style scoped="scoped">
        #grid .k-toolbar
        {
            min-height: 27px;
        }
        .estadoproyecto-label
        {
            vertical-align: middle;
            padding-right: .5em;
        }
        #estadoproyecto
        {
            vertical-align: middle;
        }
        .toolbar {
            float: right;
            margin-right: .8em;
        }
    </style>


</div>


