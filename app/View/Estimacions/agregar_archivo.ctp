<!-- File: /app/View/Estimacions/agregar_archivo.ctp -->
<!-- File: /app/View/Fichatecnicas/view.ctp -->
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
			?> » Bienvenido a SICPRO » Control y Seguimiento » Estimación de Avances
			
		</div>
	</div>
	
<?php $this->end(); ?>
		   
<h2>Administración de Archivos</h2>
<div id="formulario">
		<?php echo $this->Form->create('Estimacion'); ?>
<ul>
	<li>
		<h3>Estimación: "<?php echo $info['Estimacion']['tituloestimacion']; ?>" <br><br>Perteneciente al 
			contrato: </label> <?php echo $info['Contratoconstructor']['codigocontrato']; ?><br></h3>
	</li>
	
</ul>
</div>
<table>
	<tr>
		<td>
			<?php echo $this->Upload->edit('Estimacion',$idestimacion); ?>
			
		
		
			<?php echo $this->Html->link(
				'Regresar', 
				array('controller' => 'Estimacions','action' => 'index'),
				array('class'=>'k-button')
			);?>
		</td>
	</tr>
</table>	
<style scoped>

                .k-textbox {
                    width: 300px;    
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
                    color:#000000;
                    /*border-bottom: 1px solid #ccc;*/
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
                    width: 140px;
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
                    color: gray;
                }
                span.k-tooltip {
                    margin-left: 6px;
                }
                
 				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
               		display:block;
               		margin-left: 145px;
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