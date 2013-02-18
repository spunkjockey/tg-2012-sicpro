<!-- File: /app/View/Informetecnicos/informetecnico_subirfotos.ctp -->
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
			?> » Control y Seguimiento » Informe tecnico
			
		</div>
	</div>
	
<?php $this->end(); ?>
		   
<h2>Subida de fotografías</h2>
<b>
	<table>
			<tr>
				Visita realizada el <?php echo date("d-m-Y",strtotime($visita));?>
			</tr>
			<tr>
				<td width="15%">Proyecto: </td>
				<td><?php echo $nomproy ?></td>
			</tr>
			<tr>
				<td width="15%">Contrato: </td>
				<td><?php echo $nomcon?></td>
			</tr>
			
		</table>
</b>
<table>
	<tr>
		<td>
			<?php echo $this->Upload->edit('Informetecnico',$idinformetecnico); ?>
			
		
		
			<?php echo $this->Html->link(
				'Regresar', 
				array('controller' => 'Informetecnicos','action' => 'informetecnico_index'),
				array('class'=>'k-button')
			);?>
		</td>
	</tr>
</table>	
<style scoped>
				#titulo {
					color:#3A90CA;
				}
				#capa1{
					margin-left: 20px;
					color:#000000;
				}
				.capa2{
					margin-left: 40px;
					color:#3E3E3E;
				}
                .k-textbox {
                    width: 11.8em;
                }
				
				#formulario {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }

                h3 {
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
                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .required label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}
                
                .required {
                    font-weight: bold;
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
                
                #tablafinancia {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }
</style>
<script>
	$(document).ready(function() {
    	$("#tabla").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
		$("#tabla2").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
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