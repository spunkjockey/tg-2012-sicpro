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

<table style="margin-left: 100px; margin-bottom: 20px;">
	<tr>
	<td>Tipo de Contrato</td><td><div id="tipocontrato" style="width: 300px"></div></td>
	</tr>
	<tr>
	<td>Estado de Contrato</td><td><div id="estadocontrato" style="width: 300px"></div></td>
	</tr>
</table>
<table id="grid">
	<tr>
        <th data-field="numeroproyecto" >Proyecto</th>
        <th data-field="codigocontrato" >Codigo</th>
        <th data-field="nombrecontrato" >Contrato</th>
        <th data-field="tipocontrato" >Tipo</th>
        <th data-field="estadocontrato" >Estado</th>
        <th data-field="montooriginal" >Monto</th>
        
    </tr>
          <?php foreach ($contratos as $cc): ?>
    <tr>
        <td><?php echo $cc['Proyecto']['numeroproyecto']; ?></td>
        <td><?php echo $cc['Contrato']['codigocontrato']; ?></td>
        <td><?php echo $cc['Contrato']['nombrecontrato']; ?></td>
        <td><?php echo $cc['Contrato']['tipocontrato']; ?></td>
        <td><?php echo $cc['Contrato']['estadocontrato']; ?></td>
        <td><?php echo '$'.number_format($cc['Contrato']['montooriginal'],2); ?></td>
        <!--<td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-find"></span>', 
            	array('action' => 'contrato_detalle', $cc['Contrato']['idcontrato']),
            	array('class'=>'k-button','escape' => false,'title' => 'Detalle Contrato')
			);?>-->
            <!--<?php echo $this->Html->link(
            	'Detalles', 
            	array('action' => 'view', $cc['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>-->
        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($contratos); ?>
</table>



<script>
	$(document).ready(function() {

    	var grid = $("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
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
				scrollable: true,
				height: 400,
				columns: [ {
                                field: "numeroproyecto",
                                width: 100
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
                                width: 110
                            }
                        ]
        	});
        	
        	grid.data("kendoGrid").hideColumn("estadocontrato");
	        grid.data("kendoGrid").hideColumn("tipocontrato");


		function chequear() {
            var valuee = dropDown.data("kendoDropDownList").value();
            var valuet = dropDown1.data("kendoDropDownList").value();
            if(valuee == null) {
            	valuee = "Todos los estados";
            }
            
            if(valuet == null) {
            	valuet = "Ambos";
            }
            
            if(valuee != null && valuet != null) {
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
            }
	    }


	var  dropDown1 = $("#tipocontrato").kendoDropDownList({
			            	dataTextField: "tipocontrato",
	                dataValueField: "tipocontrato",
	                autoBind: false,
	                optionLabel: "Ambos",
	                dataSource: {
	                	type: "json",
		                transport: {
		                	read: "/Contratos/tipojson.json"
		               	}
		            },
	                change: chequear
	            });
        


		var dropDown = $("#estadocontrato").kendoDropDownList({
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

  });

</script>