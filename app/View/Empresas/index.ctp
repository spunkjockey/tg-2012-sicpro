<!-- File: /app/View/Empresas/index.ctp -->

<!-- File: /app/View/Departamentos/index.ctp -->

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
        <th data-field="nitempresa">NIT Empresa</th>
        <th data-field="nombreempresa">Nombre empresa</th>
        <th data-field="representantelegal">Representante Legal</th>
        <th data-field="direccionoficina">Direccion</th>
        <th data-field="telefonorepresentante">Telefono</th>
        <th data-field="correorepresentante">E-mail</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $empresas array, printing out post info -->

    <?php foreach ($empresas as $emp): ?>
    <tr>
        <td><?php echo $emp['Empresa']['nitempresa']; ?></td>
        <td><?php echo $emp['Empresa']['nombreempresa']; ?></td>
        <td><?php echo $emp['Empresa']['representantelegal']; ?></td>
        <td><?php echo $emp['Empresa']['direccionoficina']; ?></td>
        <td><?php echo $emp['Empresa']['telefonoempresa']; ?></td>
        <td><?php echo $emp['Empresa']['correorepresentante']; ?></td>
        
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $emp['Empresa']['id']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $emp['Empresa']['id']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($empresas); ?>
</table>

<script>
	$(document).ready(function() {
    	$("#grid").kendoGrid({
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
        	});
        });
</script>