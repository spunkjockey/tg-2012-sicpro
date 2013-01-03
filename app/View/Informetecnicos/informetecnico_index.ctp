<!-- File: /app/View/Informetecnico/informetecnico_index.ctp -->
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
			?> » Control y Seguimiento » Informes técnicos
			
		</div>
	</div>
	
<?php $this->end(); ?>
<h2>Registrar Informe Técnico</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'<span class="k-icon k-i-plus"></span> Registrar Informe Técnico', 
		array('controller' => 'Informetecnicos', 'action' => 'informetecnico_registrar'),
		array('class'=>'k-button','escape' => false)
	);  ?>
</div> 

<table id="grid">
    <tr>
        <th data-field="codigocontrato">CodigoContrato</th>
        <th data-field="idcontrato">IdContrato</th>
        <th data-field="fechavisita" width="200px">Fecha visita</th>
        <th data-field="fechaelaboracion">Fecha de elaboración</th>
        
        <th data-field="accion">Acción</th>
    </tr>

    
    
    <?php foreach ( $informes as $infor): ?>
    <tr>
        <td><?php echo $infor['Contratoconstructor'] ['codigocontrato']; ?></td>
        <td><?php echo $infor['Informetecnico'] ['idcontrato']; ?></td>
        <td><?php echo date('d/m/Y',strtotime ($infor['Informetecnico'] ['fechavisita'])); ?></td>
        <td><?php echo date('d/m/Y',strtotime ($infor['Informetecnico']['fechaelaboracion'])); ?></td>
          
        <td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>', 
            	array('action' => 'informetecnico_modificar', $infor['Informetecnico']['idinformetecnico']),
            	array('class'=>'k-button', 'escape' => false, "title"=>"Editar")
			);?>
			<?php echo $this->Html->link(
            	'<span class="k-icon k-i-folder-up"></span>', 
            	array('action' => 'informetecnico_subirfotos',$infor['Informetecnico']['idinformetecnico']),
            	array('class'=>'k-button', 'escape' => false, "title"=>"Cargar fotos")
			);?>
            <?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('action' => 'informetecnico_eliminar', $infor['Informetecnico']['idinformetecnico']),
                array('confirm' => '¿Está seguro que desea eliminar el informe tecnico seleccionado?','class'=>'k-button', 'escape' => false, "title"=>"Eliminar")
            )?>
           

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



<!-- <div id="grid2"> </div> -->

<script type="text/x-kendo-template" id="template">
    <div class="toolbar">
        <label class="codigocontrato-label" for="codigocontrato">Mostrar informes por contrato:</label>
        <input type="search" id="codigocontrato" style="width: 230px"></input>
    </div>
</script>

    <style scoped="scoped">
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
		
		
		
    	var grid =$("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
	           		group: { field: "codigocontrato" }
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Informes",
            			empty: "No hay informes técnicos a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Informes por página",
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
				columns: [
                            { field: "codigocontrato", title: "Codigo Contrato" },
                            "idcontrato",
                            { field:"fechavisita", width:75},
                            { field:"fechaelaboracion", width:75 },
                            
                            { field:"accion", width:130 }
                            
                            
                        ],
				scrollable: false
            	});
           
          
         	
       
            	
            	var dropDown = $("#codigocontrato").kendoDropDownList({
	            	dataTextField: "codigocontrato",
	                dataValueField: "idcontrato",
	                autoBind: false,
	                optionLabel: "Todos los contratos",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Informetecnicos/contratoinforjson.json"
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
        	 gridyy.hideColumn("idcontrato"); 
        	 gridyy.hideColumn("codigocontrato"); 
        });
</script>