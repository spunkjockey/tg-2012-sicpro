<!-- File: /app/View/Empresas/index.ctp -->

<h2>Empresas</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Empresa', 
		array('controller' => 'Empresas', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="nombreempresa">Nombre empresa</th>
        <th data-field="representantelegal">Representante Legal</th>
        <th data-field="telefonorepresentante">Telefono</th>
        <th data-field="accion" width="225px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $empresas array, printing out post info -->

    <?php foreach ($empresas as $emp): ?>
    <tr>
        <td><?php echo $emp['Empresa']['nombreempresa']; ?></td>
        <td><?php echo $emp['Empresa']['representantelegal']; ?></td>
        <td><?php echo $emp['Empresa']['telefonoempresa']; ?></td>        
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $emp['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $emp['Empresa']['idempresa']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            <?php echo $this->Html->link(
            	'Detalles', 
            	array('action' => 'view', $emp['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Html->link(
            	'Detalles_w', 
            	'#',//array('action' => 'view_w', $emp['Empresa']['idempresa']),
            	array('id' => 'openButton', 'class'=>'k-button',
            	'onclick'=>'agregarcampo("<?php echo $this->Session->read("User.username");?>");')
			);?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($empresas); ?>
</table>
<div id="window"></div>
<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	pageable: true,
            	pageable: {
            		messages: {
            			display: "{0} - {1} de {2} Empresas",
            			empty: "No empresas a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Empresas por página",
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
        	
    var win = $("#window").kendoWindow({
	    draggable: false,
	    modal: true,
        title: "Centered Window",
        content: "empresas/view_w/1",
        visible: false
    }).data("kendoWindow");

$("#openButton").click(function(){
    var win = $("#window").data("kendoWindow");
    win.center();
    win.open();
 });

        	
        	
        });
</script>