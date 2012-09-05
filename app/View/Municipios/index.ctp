<!-- File: /app/View/Municipios/index.ctp -->

<h2>Municipios</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar Municipio', 
		array('controller' => 'municipios', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="codigomunicipio">Código</th>
        <th data-field="departamento">Departamento</th>
        <th data-field="municipio">Municipio</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $departamentos array, printing out post info -->

    <?php foreach ($municipios as $muni): ?>
    <tr>
        <td><?php echo $muni['Municipio']['codigomunicipio']; ?></td>
        <td><?php echo $muni['Departamento']['departamento']; ?></td>
        <td><?php echo $muni['Municipio']['municipio']; ?></td>
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $muni['Municipio']['id']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $muni['Municipio']['id']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($municipios); ?>
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