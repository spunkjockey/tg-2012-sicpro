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
			?> » Proyectos 
			» Administración de Proyectos
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Administración de Proyectos</h2>
		<?php if($idrol == 5 || $idrol== 7)
			{ ?> 
				<div style='margin:4px 0' >
					<?php echo $this->Html->link(
						'<span class="k-icon k-i-plus"></span> Registrar proyecto', 
						array('controller' => 'proyectos', 'action' => 'proyecto_registrar'),
						array('class'=>'k-button', 'escape' => false)); 
					?>
					<?php echo $this->Html->link(
						'Asignar número de proyecto', 
						array('controller' => 'proyectos', 'action' => 'proyecto_asignar_num'),
						array('class'=>'k-button')); 
					?>
				</div>
				<?php //Debugger::dump($proyectos); ?>
				<table id="grid">
				    <tr>
				        <th data-field="numeroproyecto" >Número</th>
				        <th data-field="nombreproyecto" >Nombre proyecto</th>
				        <th data-field="estadoproyecto">Estado</th>
				        <th data-field="montoplaneado">Monto</th>
				        <th data-field="idfichatecnica">idficha</th>
				        <th data-field="accion">Acción</th>
				    </tr>
					<?php foreach ($proyectos as $proy): ?>
				    <tr>
				        <!--<td><?php echo $proy['Proyecto']['nombreproyecto']; ?></td>-->
				        <td><?php echo $proy['Proyecto']['numeroproyecto']; ?></td>
				        <td><?php echo $this->Html->link($proy['Proyecto']['nombreproyecto'], 
				            				array('action' => 'proyecto_detalles', $proy['Proyecto']['idproyecto']),
											array('class'=>'detalles')); ?></td>
				        <td><?php echo $proy['Proyecto']['estadoproyecto']; ?></td>
				      	<!--<td><?php echo '$ '.number_format($proy['Proyecto']['montoplaneado'],2); ?></td>-->
				      	<td><?php echo $proy['Proyecto']['montoplaneado']; ?></td>
				      	<td><?php echo $proy['Fichatecnica']['idfichatecnica']; ?></td>
				      	<td align="center">
				            <?php 
				            	/*echo $this->Html->link('Detalles', 
				            				array('action' => 'proyecto_detalles', $proy['Proyecto']['idproyecto']),
				            				array('class'=>'k-button'));*/ 
					            if ($proy['Proyecto']['estadoproyecto'] == 'Formulacion')
					            {
					            	echo $this->Html->link('<span class="k-icon k-i-pencil"></span>', 
								            	array('action' => 'proyecto_modificar', $proy['Proyecto']['idproyecto']),
								            	array('class'=>'k-button', 'escape' => false,'title'=>'Editar Proyecto'));
									echo $this->Form->postLink('<span class="k-icon k-i-close"></span>', 
					            				array('action' => 'proyecto_eliminar', $proy['Proyecto']['idproyecto']),
					            				array('confirm' => '¿Está seguro que desea eliminar el proyecto?','class'=>'k-button', 'escape' => false,'title'=>'Eliminar Proyecto'));
					            } else {
					            	echo 'Sin acciones disponibles';
					            }
					            
				            ?>
				           </td>
				    </tr>
				    <?php endforeach; ?>
				    <?php unset($proyectos); ?>
			</table>
	<?php 
            	}
            	else{
            		echo "Lo sentimos, su usuario no cuenta con los permisos adecuados para realizar esta función<br><br>";
            		
            	}
            	?>
	<table width="633">
		<tr>
			<td style="text-align: right;">
			<?php echo $this->Html->link(
	   			'Regresar', 
			   	array('controller'=>'Mains'),
	   			array('class'=>'k-button')
			);?>
			</td>
		</tr>
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
		           		schema: {
					    	model: {
					        	fields: {
					            	montoplaneado: {
					                	editable: false,
					                	type: "number"
					           		}
					            }
					     	}
				   		}
	            	},
	            	columns: [
			        	{ field: "numeroproyecto", width: 50 },
			        	{ field: "nombreproyecto" },
			        	"estadoproyecto",
			            { field: "montoplaneado", title: "Monto", format: "{0:c}", width: 100 },
			            "idfichatecnica",
			            { field: "accion", width: 160} 
					],
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
	        	
	        	grid.data("kendoGrid").hideColumn("estadoproyecto");
	        	
	        	grid.data("kendoGrid").hideColumn("idfichatecnica");
	        	
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

		 a.detalles:link {text-decoration:none; color: #045773;} /* Link no visitado*/
		 a.detalles:visited {text-decoration:none; color:#045773;} /*Link visitado*/
		 a.detalles:active {text-decoration:none; color:#045773; background:#CCCCCC} /*Link activo*/
		 a.detalles:hover {text-decoration:underline; color:#045773; background: #CCCCCC} /*Mause sobre el link*/
    
    
    </style>

<style scoped>
        #grid .k-button
        {
            vertical-align: middle;
            width: 28px;
            margin: 0 3px;
            padding: .1em .4em .3em;
            display: inline;
            
        }
    </style>
</div>


