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
			?> Proyectos » Detalles
			
		</div>
	</div>
<?php $this->end(); ?>


<div id="formulario">
<h3>Informacion Proyecto</h3>
<table>
	<tr>
		<td width="150px"><strong>Proyecto</strong></td><td><?php echo $proyectos['Proyecto']['nombreproyecto']; ?></td>
	</tr>
	<tr>
		<td><strong>Número Proyecto</strong></td><td><?php echo $proyectos['Proyecto']['numeroproyecto']; ?></td>
	</tr>		
	<tr>
		<td><strong>Monto Planeado</strong></td><td><?php echo "$ ".number_format($proyectos['Proyecto']['montoplaneado']); ?></td>
	</tr>	
	<tr>
		<td><strong>Estado Proyecto</strong></td><td><?php echo ($proyectos['Proyecto']['estadoproyecto']); ?></td>
	</tr>
	<tr>
		<td><strong>División Responsable</strong></td><td><?php echo ($proyectos['Division']['divison']); ?></td>
	</tr>
	<tr>
		<td colspan="2" style="text-align: right">			
			<?php echo $this->Html->link('Regresar', 
						array('controller' => 'Proyectos','action' => 'proyecto_listado'),
						array('class'=>'k-button')); 
			?></td>
	</tr>
</table>	
</div>
			<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
                    width: 200px;
                }
                
                form .requerido label:after {
					font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
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
                    width: 150px;
                    text-align: right;
                    margin-right: 5px;
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
                span.k-tooltip {
                    margin-left: 6px;
                }
                
                .LV_validation_message{
				    
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}

            </style>