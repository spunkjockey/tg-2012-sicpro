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
			?> Personas
			
		</div>
	</div>
<?php $this->end(); ?>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar persona', 
		array('controller' => 'personas', 'action' => 'persona_registrar'),
		array('class'=>'k-button')
	); ?>
</div> 
<h2>Personas</h2>

<table id="grid">
    <tr>
        <th data-field="nombrespersona">Nombres</th>
        <th data-field="plaza" width="80px">Plaza</th>
        <th data-field="cargo" width="100px">Cargo funcional</th>
        <th data-field="accion" width="255px">Acción</th>
    </tr>

    <?php foreach ($personas as $person): ?>
    <tr>
        <td><?php echo $person['Persona']['nombrespersona'].' '.$person['Persona']['apellidospersona']; ?></td>
        <td><?php echo $person['Plaza']['plaza']; ?></td>
        <td><?php echo $person['Cargofuncional']['cargofuncional']; ?></td>
      <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'persona_modificar', $person['Persona']['idpersona']),
            	array('class'=>'k-button')
			);?>
			<?php echo $this->Html->link(
            	'Agregar usuario', 
            	array('action' => 'persona_agregar_usuario', $person['Persona']['idpersona']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'persona_eliminar', $person['Persona']['idpersona']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
       </td> 
    </tr>
    <?php endforeach; ?>
    <?php unset($personas); ?>
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
            			display: "{0} - {1} de {2} Personas",
            			empty: "No hay personas a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Personas por página",
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