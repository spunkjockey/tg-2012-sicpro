<!-- File: /app/View/Municipios/index.ctp -->

<h2>Municipios</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Agregar Municipio', 
		array('controller' => 'municipios', 'action' => 'add'),
		array('class'=>'k-button')
	); ?>
</div> 
<div id="formulario">
<table id="grid">
    <tr>
        <th data-field="codigomunicipio">Código Municipio</th>
        <th data-field="departamento">Departamento</th>
        <th data-field="municipio">Municipio</th>
        <th data-field="accion">Acción</th>
    </tr>

    <!-- Here is where we loop through our $departamentos array, printing out post info -->

    <?php foreach ($municipios as $muni): ?>
    <tr>
        <td class="numerooo"><?php echo $muni['Municipio']['codigomunicipio']; ?></td>
        <td><?php echo $muni['Departamento']['departamento']; ?></td>
        <td><?php echo $muni['Municipio']['municipio']; ?></td>
        <td>
            <?php echo $this->Html->link(
            	'Editar', 
            	array('action' => 'edit', $muni['Municipio']['idmunicipio']),
            	array('class'=>'k-button')
			);?>
            <?php echo $this->Form->postLink(
                'Eliminar',
                array('action' => 'delete', $muni['Municipio']['idmunicipio']),
                array('confirm' => '¿Está seguro?','class'=>'k-button')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($municipios); ?>
</table>

<style scoped>

                #formulario td { 
                 
                    margin: 5px;
                    padding: 5px;                   
                }
</style>
</div>
<script>

	$(document).ready(function() {
		
		
		
    	$("#grid").kendoGrid({
            	height: 300,
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				groupable: true,
         		scrollable: true,
         		/*scrollable: {
         			virtual: true
         		}*/
        	});
        });
      /*$(window).bind("resize", function() {
			    var gridElement = $("#grid"),
			        newHeight = gridElement.innerHeight(),
			        otherElements = gridElement.children().not(".k-grid-content"),
			        otherElementsHeight = 0;
			
			    otherElements.each(function(){
			        otherElementsHeight += $(this).outerHeight();
			    });
			
			    gridElement.children(".k-grid-content").height(newHeight - otherElementsHeight);
			});*/
</script>