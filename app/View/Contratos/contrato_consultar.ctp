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
        <th data-field="codigocontrato" width="20px">Codigo Contrato</th>
        <th data-field="numeroproyecto" width="20px">Proyecto</th>
        <th data-field="nombrecontrato" width="200px">Nombre Contrato</th>
        <th data-field="accion" width="80px">Acción</th>
    </tr>
          <?php foreach ($contratos as $cc): ?>
    <tr>
        <td><?php echo $cc['Contrato']['codigocontrato']; ?></td>
        <td><?php echo $cc['Proyecto']['numeroproyecto']; ?></td>
        <td><?php echo $cc['Contrato']['nombrecontrato']; ?></td>        
        <td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-find"></span>', 
            	array('action' => 'contrato_detalle', $cc['Contrato']['idcontrato']),
            	array('class'=>'k-button','escape' => false,'title' => 'Detalle Contrato')
			);?>
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

    	$("#grid").kendoGrid({
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
				scrollable: false
        	});

        });
</script>