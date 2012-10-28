<!-- File: /app/View/Fichatecnicas/fichatecnica_consultarficha.ctp -->
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
			?> » Proyectos » Ficha Tecnica » Consultar Ficha Tecnica
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Consultar ficha técnica</h2>
		<?php echo $this->ajax->form(array(
				'type' => 'post',
			    'options' => array(
					        'model'=>'Fichatecnica',
					        'update'=>'resultadosficha',
					        'url' => array('action' => 'update_res_ficha')
							))); ?>	
		
		<div id="shipping">
            <label for="input" class="info">Seleccione un proyecto:</label>
			<table border="0">
            	<tr>
            		<!--<td><input id="proyectos" /></td>-->
            		<td><?php echo $this->form->input('proyectos',array(
            					'id'=>'proyectos',
            					'label'=>false,
            					'div' => array('id'=>'proyo','class' => 'requerido'),
            					//'div'=>false,
            					'autofocus'=>'autofocus'
							));
						?>
					
					</td>
            
             		<td><?php echo $this->Form->end(array('label' => 'Buscar', 'class' => 'k-button', 'id' => 'button')); ?></td>
             		<!--<td><a class="k-button"><span class="k-icon k-i-search"></span></a></td>-->
             	</tr>
             
			</table>
            <div class="hint">Inicie escribiendo el nombre de un proyecto</div>

		</div>
		<ul>
			<li  class="accept">
			<?php echo $this->Html->link('Regresar', 
									array('controller' => 'Mains','action' => 'index'),
									array('class'=>'k-button')); ?>
			</li>
		</ul>
		<div id="resultadosficha"> 
			
		</div>
		<div id="proyo"></div>
	</div>
</div>
<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
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
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 170px; 
               
				}
				    
				
				#shipping {
				width: 350px;
				height: 100px;
				padding: 0 0 0 30px;
				margin: 30px 30px 10px 0;
			}

            .k-autocomplete
            {
                width: 250px;
				vertical-align: middle;
            }

            .hint {
                line-height: 22px;
                color: #aaa;
                font-style: italic;
				font-size: .9em;
				color:#959595;
            }
            </style>
	
	<script>
		$(document).ready(function() {
	      	var autoComplete = $("#proyectos").kendoAutoComplete({
            	dataTextField: "nombreproyecto",
            	filter: 'contains',
            	minLength: 1,
            	//placeholder: "Ingrese un número de proyecto",
            	suggest: true,
                //dataValueField: "idproyecto",
                //autoBind: false,
                //optionLabel: "Todos los contratos",
                dataSource: {
                	type: "json",
                	//serverFiltering: true,
                    //serverPaging: true,
                    //pageSize: 20,
	                transport: {
	                	read: "/Fichatecnicas/proyectosfichajson.json"
	               	}
	            }
            });
		});
	</script> 