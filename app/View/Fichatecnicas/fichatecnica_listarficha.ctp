<!-- File: /app/View/Fichatecnicas/fichatecnica_listarficha.ctp -->
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
			?> » Proyectos » Ficha Tecnica » Modificar Ficha Tecnica
			
		</div>
	</div>
	
<?php $this->end(); ?>
<!--<?php Debugger::dump($fichas); ?>-->
<?php if(!empty($fichas)){ ?>
	<h2>Fichas Técnicas</h2>
<table id="grid">
    <tr>
        <th data-field="nombreproyeto">Nombre Proyecto</th>
        <th data-field="accion" width="260px">Acción</th>
    </tr>

    <!-- Here is where we loop through our $empresas array, printing out post info -->

    <?php foreach ($fichas as $fc): ?>
    <tr>
        <td><?php echo $fc['Proyecto']['nombreproyecto']; ?></td>
        <?php if( $fc['Proyecto']['estadoproyecto']=='Formulacion' || $fc['Proyecto']['estadoproyecto']=='Licitacion'|| $fc['Proyecto']['estadoproyecto']=='Adjudicacion') 
        { ?>
        	

        <td align="center">        	
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>Ficha', 
            	array('action' => 'fichatecnica_modificarficha', $fc['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button', 'escape' => false,'title'=>'Modificar Ficha')
			);?>
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>Ubi.',
            	array('action' => 'fichatecnica_modificarubicacion', $fc['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button', 'escape' => false,'title'=>'Modificar Ubicación')
			);?>
            <?php echo $this->Html->link(
            	'<span class="k-icon k-i-pencil"></span>Comp.',
            	array('controller'=>'Componentes','action' => 'componente_listar', $fc['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button', 'escape' => false,'title'=>'Modificar Componente')
			);?>
			<?php echo $this->Form->postLink(
                '<span class="k-icon k-i-close"></span>',
                array('controller'=>'Fichatecnicas','action' => 'fichatecnica_eliminar', $fc['Fichatecnica']['idfichatecnica']),
                array('confirm' => '¿Está seguro que desea la Ficha Técnica?',
                		'class'=>'k-button','escape' => false,'title'=>'Eliminar Ficha','style'=>'width: 30px; min-width:30px; margin: 0px; text-align: center; height: 26px;')
            )?>
        </td>
        <?php }
        else
        {?>
        	<td>
        		El proyecto se encuentra en ejecucion o finalizado
        	</td>
        <?php }?>     
    </tr>
    <?php endforeach; ?>
    <?php unset($fichas); ?>

</table>
<?php }
else {
	echo "No hay Fichas Tecnicas<br />";
}
?>
	<table width="630">
		<tr>
			<td style="text-align: right;">
			<?php echo $this->Html->link(
	   			'Regresar', 
			   	array('controller'=>'Mains'),
	   			array('class'=>'k-button')
			);?>
			</td>
		</tr>
	</table>

<style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-dropdownlist{
                    width: 300px;
                }
			
			
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
                }

                #formulario h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }

                #formulario ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                #formulario li {
                    margin: 10px 0 0 0;
                }

                label {
                    display: inline-block;
                    width: 160px;
                    text-align: right;
                    
                }

                /*.required {
                    font-weight: bold;
                }*/
                
                form .requerido label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}

                .accept, .status {
                	padding-top: 15px;
                    padding-left: 150px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                
               
               
                
				
				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 170px; 
               
				}
				/*    
				.LV_valid_field,
				input.LV_valid_field:hover, 
				input.LV_valid_field:active,
				textarea.LV_valid_field:hover, 
				textarea.LV_valid_field:active {
				    border: 1px solid #00CC00;
				}
				    
				.LV_invalid_field, 
				input.LV_invalid_field:hover, 
				input.LV_invalid_field:active,
				textarea.LV_invalid_field:hover, 
				textarea.LV_invalid_field:active {
				    border: 1px solid #CC0000;
				}
                */
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
            			display: "{0} - {1} de {2} Fichas Tecnicas",
            			empty: "No Fichas a mostrar",
            			page: "Página",
            			of: "de {0}",
            			itempsPerPage: "Fichas por página",
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
        	
        $(window).load(function () {
        		sleep(5);
  				$("#flashMessage").fadeOut("slow");
  			});
                
        });
</script>