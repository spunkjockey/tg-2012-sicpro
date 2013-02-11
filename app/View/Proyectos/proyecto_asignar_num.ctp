<!-- File: /app/View/Proyectos/add_num.ctp -->

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
			?> Proyecto » Asignar Número de Proyecto
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	

	
	<div id="formulario">
		<h2>Asignar número de proyecto</h2>
		<?php echo $this->Form->create('Proyecto',array('action' => 'proyecto_asignar_num')); ?>
		<?php if($idrol == 5 || $idrol== 7)
			{ ?> 
		
		<ul>
			<li>
				<?php 
				
				echo $this->Form->input('proys', 
					array(
						'label' => 'Seleccione proyecto:', 
						'id' => 'proys',
						'class'=>'k-combobox',
						'div' => array('class' => 'requerido'))); 
						
						//Debugger::dump(current($num['Proyecto']['numeroproyecto']));
				?>
				<script type="text/javascript">
					var proys = new LiveValidation( "proys", { validMessage: " " } );
		            proys.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			<li>
				<div id=actnumero>
					
					
					<!--- aqui se actualizara el campo de numero de proyecto con el cambio de proyecto --->
					<?php 
					
					if(isset($num)) {
						$inio = current($num);
						$ini = $inio['Proyecto']['numeroproyecto'];
						//Debugger::dump($ini);
					}
					else {
						$ini = '';
					}
					
					echo $this->Form->input('numeroproyecto', 
						array(
							'label' => 'Número de Proyecto:', 
							'id' => 'numero',
							'value'=> $ini,
							'class' => 'k-textbox',  
							 
							'div' => array('id' => 'nproyo','class' => 'requerido'))); ?>
					<script type="text/javascript">
						var numero = new LiveValidation( "numero", { validMessage: " ", insertAfterWhatNode: 'nproyo' } );
					    numero.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					    numero.add( Validate.Numericality, { onlyInteger: true,
					    								   notAnIntegerMessage: "Debe ser un número sin parte decimal",
					    								   notANumberMessage:"Debe ser un número"} );
					    numero.add(Validate.Length, {minimum: 4, maximum: 6, 
					    							 tooShortMessage:"Longitud mínima de 4 dígitos",
					    							 tooLongMessage:"Longitud máxima de 6 dígitos"});
					    
					</script>
				</div>
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Registrar', 'class' => 'k-button')); ?>
						</td>
						<td>	
							<?php echo $this->Html->link('Regresar', 
								array('controller' => 'Proyectos','action' => 'proyecto_listado'),
								array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>	
			<!--
				<?php echo $this->ajax->observeField( 'proys', 
		    					array('url' => array( 'action' => 'update_numeroproy'),'update' => 'actnumero'));  ?>
			-->	
			
		<?php 
            	}
            	else{
            		echo "Lo sentimos, su usuario no cuenta con los permisos adecuados para realizar esta función<br><br>";
            		echo $this->Html->link('Regresar', 
									array('controller' => 'Mains','action' => 'index'),
									array('class'=>'k-button'));
            	}
            	?>		

		</ul>
		
	</div>
</div>

			<style scoped>

                .k-textbox {
                    width: 100px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
                    width: 400px;
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
                    padding-left: 160px;
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
			
            <script>
                $(document).ready(function() {
                    $("#proys").kendoDropDownList({
			            dataTextField: "nombreproyecto",
			            dataValueField: "idproyecto",
			            
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Proyectos/proyectosjson.json"
			                            }
			                       },
			            change: function() {
                            var value = this.value();
                            if (value) {
                                //alert("si dato "+value);
                                <?php foreach ($num as $nkey => $nvalue) {
                                	echo 'if(' . $nvalue['Proyecto']['idproyecto'] . '==value)
                                		{$("#numero").val("'.$nvalue['Proyecto']['numeroproyecto'].'");}
										';
    							}?>
								
                                
                            } else {
                                //alert("no dato "+value);
                                $('#numero').val('');
                            }
                        }
			        });
			        
			        var proys = $("#proys").data("kendoDropDownList");
                    proys.list.width(400);
                    
                    
                   
                });
                
                
            </script>