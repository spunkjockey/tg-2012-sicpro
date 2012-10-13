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
		'Registrar informe de supervisión', 
		array('controller' => 'informesupervisors', 'action' => 'informesupervisor_registrar'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="tituloinforme">Título informe</th>
        <th data-field="periodo" width="100px">Período</th>
        <th data-field="accion" width="250px">Acción</th>
    </tr>

    <?php foreach ($informes as $info): ?>
    <tr>
        <td>
        	<?php echo $info['Informesupervisor']['tituloinformesup']; ?>
        </td>
        <td>
        	<?php echo date('d/m/Y',strtotime($info['Informesupervisor']['fechainiciosupervision'])); ?>
        	al <?php echo date('d/m/Y',strtotime($info['Informesupervisor']['fechafinsupervision'])); ?>
        </td>
       	<td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'informesupervisor_modificar', $info['Informesupervisor']['idinformesupervision']),
            	array('class'=>'k-button')
			);?>
			<?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'informesupervisor_eliminar', $info['Informesupervisor']['idinformesupervision']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            <?php echo $this->Html->link(
            	'Cargar archivo', 
            	array('action' => 'informesupervisor_cargar_archivo', $info['Informesupervisor']['idinformesupervision']),
            	array('class'=>'k-button')
			);?>
            
       	</td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($informes); ?>
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
            			display: "{0} - {1} de {2} Informes",
            			empty: "No hay informes a mostrar",
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
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
        });
</script>