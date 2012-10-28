
   <!-- File: /app/View/Fuentefinanciamiento/index.ctp -->
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
			?> » Bienvenido a SICPRO » Mantenimiento » Fuente Financiamiento
			
		</div>
	</div>

<?php $this->end(); ?>
<h2>Fuente de Financiamiento</h2>
<div style='margin:4px 0' >
	<?php echo $this->Html->link(
		'Registrar Fuente de Financiamiento', 
		array('controller' => 'Fuentefinanciamientos', 'action' => 'fuentefinanciamiento_registrarfuente'),
		array('class'=>'k-button')
	); ?>
</div> 
<table id="grid">
    <tr>
        <th data-field="nombrefuente">Nombre Fuente</th>
        <th data-field="montoinicial">Monto</th>
        <th data-field="montodisponible">Disponible</th>
        <th data-field="tipofuente">Tipo de Fuente</th>
        <th data-field="accion">Acción</th>
    </tr>

    <!-- Here is where we loop through our $fuente array, printing out post info -->

    <?php foreach ($fuentefinanciamientos as $fuente): ?>
    <tr>
        <td><?php echo $fuente['Fuentefinanciamiento']['nombrefuente']; ?></td>
        <td><?php echo '$ ' . number_format($fuente['Fuentefinanciamiento']['montoinicial'],2); ?></td>
        <td><?php echo '$ ' . number_format($fuente['Fuentefinanciamiento']['montodisponible'],2); ?></td>
        <!--<td><?php echo date('d/m/Y',strtotime($fuente['Fuentefinanciamiento']['fechadisponible'])); ?></td>-->  
        <td><?php echo $fuente['Tipofuente']['tipofuente']; ?></td>      
        <td align="center">
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>', 
            	array('action' => 'fuentefinanciamiento_modificarfuente', $fuente['Fuentefinanciamiento']['idfuentefinanciamiento']),
            	array('class'=>'k-button','escape' => false,'title' => 'Editar Fuente Financiamiento')
			);?>
            <?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('action' => 'delete', $fuente['Fuentefinanciamiento']['idfuentefinanciamiento']),
                array('confirm' => '¿Está seguro que desea eliminar los datos de la Fuente de Financiamiento?','class'=>'k-button','escape' => false,'title' => 'Eliminar Fuente Financiamiento')
            )?>
            
        </td>
    </tr>
    <?php endforeach; ?>
    <?php unset($fuentefinanciamientos); ?>
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
            			display: "{0} - {1} de {2} Fuentes de Financiamiento",
            			empty: "No hay fuentes de financiamiento a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "fuentes de financiamiento por página",
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
				scrollable: false,
				columns: [ {
                                field: "nombrefuente",
                                width: 180
                                
                            } , {
                                field: "montoinicial",
                                width: 110
                                
                            } , {
                                width: 110,
                                field: "montodisponible"
                            } , {
                                field: "tipofuente",
                                width: 100,
                            } , {
                                field: "accion",
                                width: 80
                                
                            } 
                        ]
            	
            	
        	});
        });
</script>