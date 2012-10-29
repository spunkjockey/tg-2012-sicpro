<!-- File: /app/View/Contratoconstructors/contratosupervisor_listar.ctp -->
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
			?> » Contratos » Contrato Supervisor
			
		</div>
	</div>
	
<?php $this->end(); ?>

<!--<?php Debugger::dump($contratoss);?>-->

<h2>Contratos</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Contrato Supervisor', 
		array('controller' => 'Contratosupervisors', 'action' => 'contratosupervisor_registrar'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
	<tr>
        <th data-field="codigocontrato" width="20px">Codigo Contrato</th>
        <th data-field="numeroproyecto" width="20px">Proyecto</th>
        <th data-field="nombrecontrato" width="200px">Nombre Contrato</th>
        <th data-field="accion" width="60px">Acción</th>
    </tr>
          <?php foreach ($contratoss as $cc): ?>
    <tr>
        <td><?php echo $cc['Contratosupervisor']['codigocontrato']; ?></td>
        <td><?php echo $cc['Proyecto']['numeroproyecto']; ?></td>
        <td><?php echo $cc['Contratosupervisor']['nombrecontrato']; ?></td>        
        <td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>', 
            	array('action' => 'Contratosupervisor_modificar', $cc['Contratosupervisor']['idcontrato']),
            	array('class'=>'k-button','escape' => false,'title' => 'Editar Contrato')
			);?>
            <?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('action' => 'contratosupervisor_eliminar', $cc['Contratosupervisor']['idcontrato']),
                array('confirm' => '¿Está seguro que desea eliminar el Contrato de supervisión ?',
                		'class'=>'k-button','escape' => false,'title' => 'Eliminar Contrato')
            )?>
            <!--<?php echo $this->Html->link(
            	'Detalles', 
            	array('action' => 'view', $cc['Empresa']['idempresa']),
            	array('class'=>'k-button')
			);?>-->
        </td>
        
    </tr>
    <?php endforeach; ?>
    <?php unset($contratoss); ?>
</table>

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