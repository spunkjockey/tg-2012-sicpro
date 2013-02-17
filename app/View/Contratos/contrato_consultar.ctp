<!-- File: /app/View/Contratos/contrato_consultar.ctp -->
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
			?> » Contratos » Consultar Contrato
			
		</div>
	</div>
	
<?php $this->end(); ?>

<!--<?php Debugger::dump($contratos);?>-->

<h2>Contratos</h2>


<table id="grid">
	<tr>
        <th data-field="numeroproyecto" >Proyecto</th>
        <th data-field="codigocontrato" >Codigo</th>
        <th data-field="nombrecontrato" >Contrato</th>
        <th data-field="tipocontrato" >Tipo</th>
        <th data-field="estadocontrato" >Estado</th>
        <th data-field="montooriginal" >Monto</th>
        <th data-field="montofinal" >Monto Final</th>
        
    </tr>
          <?php foreach ($contratos as $cc): ?>
    <tr>
        <td><?php echo $cc['Proyecto']['numeroproyecto']; ?></td>
        <td><?php echo $cc['Contrato']['codigocontrato']; ?></td>
        
        <td><?php echo $this->Html->link(
            	$cc['Contrato']['nombrecontrato'], 
            	array('action' => 'contrato_detalle', $cc['Contrato']['idcontrato']),
            	array('class'=>'detalles')
			);?></td>
        
        <td><?php echo $cc['Contrato']['tipocontrato']; ?></td>
        <td><?php echo $cc['Contrato']['estadocontrato']; ?></td>
        <td><?php echo '$'.number_format($cc['Contrato']['montooriginal'],2); ?></td>
        <!--<td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-find"></span>', 
            	array('action' => 'contrato_detalle', $cc['Contrato']['idcontrato']),
            	array('class'=>'k-button','escape' => false,'title' => 'Detalle Contrato')
			);?>-->

        </td>
        <td><?php echo '$'.number_format($cc['Contrato']['montooriginal']+$cc['Contrato']['variacion'],2); ?></td>
        <!--<td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-find"></span>', 
            	array('action' => 'contrato_detalle', $cc['Contrato']['idcontrato']),
            	array('class'=>'k-button','escape' => false,'title' => 'Detalle Contrato')
			);?>-->

        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($contratos); ?>
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

<style scoped="scoped">
    #grid .k-toolbar
    {
        min-height: 27px;
    }
    .category-label
    {
        vertical-align: middle;
        padding-right: .5em;
    }
    #category
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

<script type="text/x-kendo-template" id="template">
    <div class="toolbar">
        <label class="category-label" for="category">Número Proyecto:</label>
        <input type="search" id="tipocontrato" style="width: 230px"></input>
    </div>
</script>

<!--
<table style="margin-left: 100px; margin-bottom: 20px;">
	<tr>
	<td>Tipo de Contrato</td><td><div id="tipocontrato" style="width: 300px"></div></td>
	</tr>
	<tr>
	<td>Estado de Contrato</td><td><div id="estadocontrato" style="width: 300px"></div></td>
	</tr>
</table>
-->

<script>
	$(document).ready(function() {

    	var grid = $("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
	           		group: { field: "numeroproyecto" }
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Contratos",
            			empty: "No hay contratos",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Contratos por página",
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
				toolbar: kendo.template($("#template").html()),
				columns: [ {
                                field: "numeroproyecto",
                                title: "Proyecto"
                            } , {
                                field: "codigocontrato",
                                width: 100
                            } , {
                                field: "nombrecontrato",
                                width: 300
                            } , {
                                field: "tipocontrato",
                                width: 50
                            } , {
                                field: "estadocontrato",
                                width: 100
                            } , {
                                field: "montooriginal",
                                width: 100
                            } , {
                                field: "montofinal",
                                width: 100
                            }
                            
                        ]
        	});
        	
        	grid.data("kendoGrid").hideColumn("numeroproyecto");
        	grid.data("kendoGrid").hideColumn("estadocontrato");
	        grid.data("kendoGrid").hideColumn("tipocontrato");


		function chequear() {
            //var valuee = dropDown.data("kendoDropDownList").value();
            var valuet = dropDown1.data("kendoComboBox").value();
            /*if(valuee == null) {
            	valuee = "Todos los estados";
            }*/
            //alert(valuet);
            if(valuet == null) {
            	valuet = "";
            }
            
            if(valuet != "") {
            	grid.data("kendoGrid").dataSource.filter({ field: "numeroproyecto", operator: "eq", value: valuet });
            } else {
            	grid.data("kendoGrid").dataSource.filter({  });
            }
            /*if(valuee != null && valuet != null) {
            	//alert("filtrar")
	            if (valuee != "Todos los estados" && valuet != "Ambos") {
	                grid.data("kendoGrid").dataSource.filter({ field: "estadocontrato", operator: "eq", value: valuee },{ field: "tipocontrato", operator: "eq", value: valuet });
	            } 
	            
	            if (valuee != "Todos los estados" && valuet == "Ambos") {
	                grid.data("kendoGrid").dataSource.filter({ field: "estadocontrato", operator: "eq", value: valuee });
	            }
	            
	            if (valuee == "Todos los estados" && valuet != "Ambos") {
	                grid.data("kendoGrid").dataSource.filter({ field: "tipocontrato", operator: "eq", value: valuet });
	            }
	            
	            if (valuee == "Todos los estados" && valuet == "Ambos") {
	                   grid.data("kendoGrid").dataSource.filter({});
	            }
            }*/
	    }


	var  dropDown1 = $("#tipocontrato").kendoComboBox({
			        dataTextField: "numeroproyecto",
	                dataValueField: "numeroproyecto",
	                autoBind: false,
	                optionLabel: "Todos los proyectos",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Contratos/tipojson.json"
		               	}
		            },
	                change: chequear
	            });
        


/*		var dropDown = $("#estadocontrato").kendoDropDownList({
	            	dataTextField: "estadocontrato",
	                dataValueField: "estadocontrato",
	                autoBind: false,
	                optionLabel: "Todos los estados",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Contratos/estadojson.json"
		               	}
		            },
	                change: chequear   });
*/
  });

</script>