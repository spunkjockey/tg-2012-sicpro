<!-- File: /app/View/Departamentos/index.ctp -->

<?php $this->start('menu');
	echo $this->element('menu/menu_all');
$this->end(); ?>

<h2>Departamentos</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar Departamento', 
		array('controller' => 'departamentos', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 

<table id="grid">
    <tr>
        <th data-field="codigodepartamento">Código</th>
        <th data-field="departamento">Departamento</th>
        <th data-field="accion" width="175px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $departamentos array, printing out post info -->

    <?php foreach ($departamentos as $depto): ?>
    <tr>
        <td><?php echo $depto['Departamento']['codigodepartamento']; ?></td>
        <td><?php echo $depto['Departamento']['departamento']; ?></td>
        <td align="center">
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $depto['Departamento']['iddepartamento']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $depto['Departamento']['iddepartamento']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($departamentos); ?>
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