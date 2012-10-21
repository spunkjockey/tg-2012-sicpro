<!-- File: /app/View/Orden de inicio/registrar_Orden de inicio.ctp -->
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

			?> » Bienvenido a SICPRO » Contratos » Registrar Orden de Inicio
		</div>
		</div>
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Agregar Orden de Inicio</h2>
		<?php echo $this->Form->create('Contrato'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'class' => 'k-dropdown'
					)); ?>
				<div id="error1"></div>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos',
						'class' => 'k-dropdown'
					)); ?>
				<div id="error2"></div>
			</li>
			<div id='info_contrato'>
				
			</div>


<?php //echo $this->Form->end(); ?>
				<?php echo $this->ajax->observeForm( 'ContratoAddordeninicioForm', 
		    		array(
		        		'url' => array( 'action' => 'update_infoinicio'),
		        		'update' => 'info_contrato'
		    		) 
				);  ?>
			
            
          
		</ul>
		
	</div>
</div>

            <style scoped>

                .k-textbox .k-dropdown {
                    width: 300px;
                    margin-left: 5px;
                    
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
                    color: gray;
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
               		margin-left: 105px; 
               
				}
				
				
				#error1, #error2  {
					margin:0 0 0 5px;
					color:#CC0000;
					clear:both;
               		display:none;
               		margin-left: 105px; 
				}

				    
				
            </style>
            
            <script>
                $(document).ready(function() {



		 

	              $("#proyectos").kendoDropDownList({
		            			optionLabel: "Seleccione proyecto",
					            dataTextField: "numeroproyecto",
					            dataValueField: "idproyecto",
					            dataSource: {
					                            type: "json",
					                            transport: {
					                                read: "/Contratos/proyectoordenjson.json"
					                            }
					                       },
					            change: function() { $('#error1').hide(); }
					        });

		var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			        var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                     	optionLabel: "Seleccione contrato",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratos/contratojson.json"
			                            }
			                        },
			                        change: function() { $('#error2').hide(); }
			                    }).data("kendoDropDownList");
	                });
	                
	                
	               $("form").submit( function(){
				        var selectpro = $("#proyectos").val();
				        var selectfue = $("#contratos").val();
				 			//alert(selectpro);
				 			//alert(selectfue);
				            if(selectpro == ""){
				                $('#error1').show().text("Seleccione un Proyecto");
				                return false;
				            } else if(selectfue == ""){
				                $('#error2').show().text("Seleccione un Contrato");
				                return false;
				            } else {
				                $('.error-message').hide();
				                //alert('Ok!');
				                return true;
				            }
				    });
            </script>
            