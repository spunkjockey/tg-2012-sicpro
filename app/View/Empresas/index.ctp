<!-- File: /app/View/Empresas/index.ctp -->

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
			?> » Bienvenido a SICPRO » Mantenimiento » Empresa
			
		</div>
	</div>
	
<?php $this->end(); ?>

<h2>Empresas</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Empresa', 
		array('controller' => 'Empresas', 'action' => 'empresa_registrar'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="nombreempresa">Nombre empresa</th>
        <th data-field="representantelegal">Representante Legal</th>
        <th data-field="telefonorepresentante" width="55px">Telefono</th>
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
            	array('action' => 'empresa_modificar', $emp['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $emp['Empresa']['idempresa']),
                array('confirm' => '¿Está seguro que desea eliminar la empresa ?',
                		'class'=>'k-button')
            )?>
            <?php echo $this->Html->link(
            	'Detalles', 
            	array('action' => 'view', $emp['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>
            <!--<div id='popup'>
             <?php echo $this->Html->link(
            	'Detalles_w', 
            	'#',array('action' => 'view_w', $emp['Empresa']['idempresa']),
            	array('id' => 'openButton', 'class'=>'k-button')
			);?> 
			</div>
            <a href="#" onclick="cambiarid('<?php echo $emp['Empresa']['idempresa'];?>');" class="k-button">Agregar Metas</a>
            -->
        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($empresas); ?>

</table>
<div id="window"></div>

<script>
	$(document).ready(function() {
		
		<?php echo 'var idempresa = '.$emp["Empresa"]["idempresa"].';'; ?>
		
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
        	
    var idemp = 0;
	 function cambiarid(usuario) {
		alert("hola mundo");
		return false;
	}
	 
    var win = $("#window").kendoWindow({
	    draggable: false,
	    modal: true,
        title: "Centered Window",
        content: "empresas/view_w/"+idemp,
        visible: false
    }).data("kendoWindow");

	<?php //echo '$("#openButton"'.$emp['Empresa']['idempresa'].').click(function(){'; ?>
	$("#popup a.k-button").click(function(){
		var win = $("#window").data("kendoWindow");
		win.center();
		win.open();
	});
	

        });
</script>