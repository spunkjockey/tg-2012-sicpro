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
			?> Control y seguimiento » Informe supervisión 
			
		</div>
	</div>
<?php $this->end(); ?>

<h2>Informe supervisión</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'<span class="k-icon k-i-plus"></span> Registrar informe de supervisión', 
		array('controller' => 'informesupervisors', 'action' => 'informesupervisor_registrar'),
		array('class'=>'k-button','escape' => false)
	); /*Debugger::dump($informes);*/?>
</div> 
<table id="grid">
    <tr>
        <th data-field="codigocontrato">CodigoContrato</th>
        <th data-field="idcontrato">IdContrato</th>
        <th data-field="tituloinforme">Título informe</th>
        <th data-field="periodo">Fecha</th>
        <th data-field="porcentajeavancefisico">Porcentaje</th>
        <th data-field="valoravancefinanciero">Monto</th>
        <th data-field="accion">Acción</th>
    </tr>

    <?php foreach ($informes as $info): ?>
    <tr>
        <td><?php echo $info['Contratosupervisor']['codigocontrato']; ?></td>
        <td><?php echo $info['Informesupervisor']['idcontrato']; ?></td>
        <td>
        	<?php echo $info['Informesupervisor']['tituloinformesup']; ?>
        </td>
        <td>
        	<?php echo date('d/m/Y',strtotime($info['Informesupervisor']['fechafinsupervision'])); ?>
        </td>
        <td><?php echo number_format ($info['Informesupervisor']['porcentajeavancefisico'],2) . '%'; ?></td> 
        <td><?php echo '$ ' . number_format ($info['Informesupervisor']['valoravancefinanciero'],2); ?></td>   
       	<td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>', 
            	array('action' => 'informesupervisor_modificar', $info['Informesupervisor']['idinformesupervision']),
            	array('class'=>'k-button', 'escape' => false, "title"=>"Editar")
			);?>
			<?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('action' => 'informesupervisor_eliminar', $info['Informesupervisor']['idinformesupervision']),
                array('confirm' => '¿Está seguro que desea eliminar el informe de supervisión seleccionado?','class'=>'k-button', 'escape' => false, "title"=>"Eliminar")
            )?>
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-folder-up"></span>',
            	array('action' => 'informesupervisor_cargar_archivo', $info['Informesupervisor']['idinformesupervision']),
            	array('class'=>'k-button', 'escape' => false, "title"=>"Cargar Archivo")
			);?>
            
       	</td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($informes); ?>
</table>
</table>
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

<script type="text/x-kendo-template" id="template">
    <div class="toolbar">
        <label class="codigocontrato-label" for="codigocontrato">Mostrar Informes de Supervision por Contrato:</label>
        <input type="search" id="codigocontrato" style="width: 230px"></input>
    </div>
</script>

<style scoped>
        #grid .k-button
        {
            vertical-align: middle;
            width: 28px;
            margin: 0 3px;
            padding: .1em .4em .3em;
            display: inline;
            
        }
        
                #grid .k-toolbar
        {
            min-height: 27px;
        }
        .codigocontrato-label
        {
            vertical-align: middle;
            padding-right: .5em;
        }
        #codigocontrato
        {
            vertical-align: middle;
        }
        .toolbar {
            float: right;
            margin-right: .8em;
        }
    </style>
<script>
	$(document).ready(function() {
    	var grid = $("#grid").kendoGrid({
    			//height: 200,
            	dataSource: {
	           		pageSize: 10,
	           		group: { field: "codigocontrato" }
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Informes de Supervisión",
            			empty: "No hay informes de supervisión a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Informes de Supervisión por página",
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
				scrollable: false,
				columns: [
                            { field: "codigocontrato", title: "Codigo Contrato" },
                            "idcontrato",
                            "tituloinforme",
                            { field:"periodo", width:75 },
                            { field:"porcentajeavancefisico", width:75 },
                            { field:"valoravancefinanciero", width:125 },
                            { field:"accion", width:130 }
                            
                            
                        ],
				toolbar: kendo.template($("#template").html())
            	
            	
        	});
        	
        	var dropDown = $("#codigocontrato").kendoDropDownList({
	            	dataTextField: "codigocontrato",
	                dataValueField: "idcontrato",
	                autoBind: false,
	                optionLabel: "Todos los contratos",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Informesupervisors/contratosinfjson.json"
		               	}
		               	
		            },
	                change: function() {
	                    var value = this.value();
	                    //alert(value);
	                    if (value) {
	                        grid.data("kendoGrid").dataSource.filter({ field: "idcontrato", operator: "eq", value: parseInt(value) });
	                    } else {
	                        grid.data("kendoGrid").dataSource.filter({});
	                    }
	                }
	            });
        	
        	
        	
        	var gridyy = $("#grid").data("kendoGrid");
        	 gridyy.hideColumn("codigocontrato");
        	 gridyy.hideColumn("idcontrato");
        });
</script>