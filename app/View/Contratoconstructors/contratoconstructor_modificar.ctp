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
			?> Contrato constructor » Modificar Contrato Constructor 
			
		</div>
	</div>
<?php $this->end(); ?>


<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar contrato constructor</h2>
		<?php 
		echo $this->Form->create('Contratoconstructor',array('action' => 'contratoconstructor_modificar')); ?>
		<ul>
			<?php 
	if($idrol == 2)
			{ ?> 
			<li>
				<!--- Aqui se carga el nombre del proyecto seleccionado-->
				<table>
					<tr>
						<td><label>Nombre Proyecto: </label></td>
						<td><?php echo $nproy;	?></td>
						
						
					</tr>
				</table>
			</li>
			<li>
				<?php echo $this->Form->input('codigocontrato', 
					array(
						'label' => 'Código del contrato:', 
						'class' => 'k-textbox',
						'id'=>'codigo',
						'div' => array('class' => 'requerido'), 
						'placeholder' => 'Ej: 001-2012'
						)); ?>
				<script type="text/javascript">
		            var codigo = new LiveValidation( "codigo", { validMessage: " " } );
		            codigo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            codigo.add(Validate.Format, { pattern: /___-____/i, failureMessage: "No puedes dejar este campo en blanco", negate: true } );
		            codigo.add(Validate.Format, { pattern: /\d\d\d-\d\d\d\d/i, failureMessage: "El código de contrato debe tener 7 números"} );
		        </script> 
		         <?php if ($this->Form->isFieldError('Contrato.codigocontrato')) {
 	 					echo $this->Form->error('Contrato.codigocontrato'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('nombrecontrato', 
					array(
						'label' => 'Título del contrato:', 
						'class' => 'k-textbox',
						'id'=>'nombrecontrato', 
						'placeholder' => 'Nombre del contrato', 
						'rows'=> 2, 
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var nombrecontrato= new LiveValidation( "nombrecontrato", { validMessage: " " } );
					nombrecontrato.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('montooriginal', 
					array(
						'label' => 'Monto: ($)',
						'class' => 'k-textbox',  
						'id' => 'txmonto',
						'type' => 'text',
						'maxlength' => '12',
						'placeholder' => 'Monto del contrato',
						'div' => array('id' => 'monto','class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var txmonto = new LiveValidation( "txmonto", { validMessage: " ", insertAfterWhatNode: "monto"  } );
		            txmonto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		       		txmonto.add( Validate.Numericality, { minimum: 0.01, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.01", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>
		        <?php if ($this->Form->isFieldError('Contrato.montooriginal')) {
 	 					echo $this->Form->error('Contrato.montooriginal'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('anticipo', 
					array(
						'label' => 'Anticipo: ($)',
						'class' => 'k-textbox',  
						'id' => 'txanticipo',
						'type' => 'text',
						'maxlength' => '12',
						'placeholder' => 'Anticipo del contrato',
						'div' => array('id'=> 'antic','class' => 'requerido'))); ?>
				<script type="text/javascript">
					var txanticipo = new LiveValidation( "txanticipo", { validMessage: " " , insertAfterWhatNode: "antic" } );
		            txanticipo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		       		txanticipo.add( Validate.Numericality, { minimum: 0.00, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.01", tooHighMessage: "El anticipo no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>
		        <div id="erroranticipo" class="LV_validation_message LV_invalid"></div>
			</li>
			<li>
				<?php echo $this->Form->input('fechainiciocontrato', 
					array(
						'label' => 'Fecha inicio de vigencia:', 
						'id'	=> 'datePicker1',
						//'value' => date('d/m/Y',strtotime($this->request->data['Contratoconstructor']['fechainiciocontrato'])),
						'div' => array('id'=>'fechaini','class' => 'requerido'),
						'type'  => 'Text'
						));
					?>
				<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " , insertAfterWhatNode: "fechaini" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		            datePicker1.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		        </script>
		        <?php if ($this->Form->isFieldError('Contrato.fechainiciocontrato')) {
 	 					echo $this->Form->error('Contrato.fechainiciocontrato'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechafincontrato', 
					array(
						'label' => 'Fecha fin de vigencia:', 
						'id'	=> 'datePicker2',
						//'value' => date('d/m/Y',strtotime($this->request->data['Contratoconstructor']['fechafincontrato'])),
						'div' => array('id'=>'fechafin','class' => 'requerido'),
						'type'  => 'Text'
						)); 
					?>
				<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " , insertAfterWhatNode: "fechafin" } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        	datePicker2.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		        </script>
		         <?php if ($this->Form->isFieldError('Contrato.fechafincontrato')) {
 	 					echo $this->Form->error('Contrato.fechafincontrato'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('plazoejecucion', 
					array(
						'label' => 'Plazo de ejecución:',
						'class' => 'k-textbox',  
						'id' => 'txplazo',
						'type'  => 'Text', 
						'maxlength' => '4',
						'style' => 'width: 150px;',
						'placeholder' => 'Cantidad de días', 
						'div' => array('class' => 'requerido', 'id' => 'diasdiv')
						));
					?>
				<script type="text/javascript">
					var txplazo= new LiveValidation( "txplazo", { validMessage: " ", insertAfterWhatNode: "diasdiv" } );
					txplazo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					txplazo.add( Validate.Numericality,{ onlyInteger: true,
					   								   	notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
					txplazo.add( Validate.Numericality, { minimum: 1, tooLowMessage: "Plazo de ejecución mínimo a 1" } );
					
				</script>
				<?php if ($this->Form->isFieldError('Contrato.plazoejecucion')) {
 	 					echo $this->Form->error('Contrato.plazoejecucion'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('detalleobras', 
					array(
						'label' => 'Obras a desarrollar:', 
						'class' => 'k-textbox',
						'rows' => 4, 
						'placeholder' => 'Descripción de obras'
						));
					?>
			</li>
			<li>
				<?php echo $this->Form->input('idempresa', 
					array(
						'label' => 'Empresa ejecutora:', 
						'id' => 'empresas',
						'div' => array('id'=>'empeje','class' => 'requerido')
						));
					?>
				<script type="text/javascript">
					var empresas = new LiveValidation( "empresas", { validMessage: " " , insertAfterWhatNode: "empeje"  } );
		            empresas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
		        <div id="errorempresa" class="LV_validation_message LV_invalid"></div>
			</li>
			<li>
				<?php echo $this->Form->input('idpersona', 
					array(
						'label' => 'Administrador del contrato:', 
						'id' => 'admin',
						'class' => 'k-kendobox',
						'div' => array('id'=>'admc','class' => 'requerido')
						)); 
					?>
				<script type="text/javascript">
					var admin = new LiveValidation( "admin", { validMessage: " " , insertAfterWhatNode: "admc"  } );
		            admin.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			
			<?php echo $this->Form->hidden('idcontrato');
					echo $this->Form->hidden('idproyecto');	
			?>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Modificar', 'id'=>'button','class' => 'k-button')); ?>
						</td>
						<td>	
							<?php echo $this->Html->link('Regresar', 
								array('controller' => 'Contratoconstructors','action' => 'contratoconstructor_listar'),
								array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
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

                .k-textbox, .k-kendobox{
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

                textarea {
				white-space: normal !important;
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
				    display:none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}
				
				#errorempresa{
					display: none;
				}
				   
</style>
			
			<script>
                $(document).ready(function() {
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                   $("#ContratoconstructorContratoconstructorModificarForm").submit(function() {
	                       	
	                       	if($('#txmonto').val()*0.30 >= $('#txanticipo').val()) {
	                       		$('#erroranticipo').hide();
								
								if(empresas.dataItem()){
									$('#errorempresa').hide();
									return true;
								}
								else {
									$('#errorempresa').show().text('No Existe la empresa');
									return false;
								}
								
	                       	} else {
	                       		$('#erroranticipo').show().text('El anticipo no debe ser mayor al 30% del monto');
								return false;
	                       	}
                    });
                    
                    $("#txanticipo").focusin(function() {
				         $('#erroranticipo').hide();
				    });
                                    

				$("#txmonto").kendoNumericTextBox({
				     min: 0,
				     format: "c2",
				     decimals: 2,
				     spinners: false
				 });

				$("#txanticipo").kendoNumericTextBox({
				     min: 0,
				     format: "c2",
				     decimals: 2,
				     spinners: false
				 });
				 
				 
                $("#txplazo").kendoNumericTextBox({
				     min: 0,
				     format: "{0:n0}",
				     decimals: 0,
				     placeholder: "Ej. 60",
				     spinners: false
				 });
                
                
				$("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto",
            			dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/proyectojson.json"
			                            }
			                        }
			        });
			        var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			    $("#empresas").kendoComboBox({
            			optionLabel: "Seleccione empresa",
            			dataTextField: "nombreempresa",
			            dataValueField: "idempresa",
			            filter: "contains",
			            highLightFirst: false,
			            ignoreCase: false,
			            change: limpiaremp,
			            //suggest: true,
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/empresajson.json"
			                            }
			                        }
			        });
			        var empresas = $("#empresas").data("kendoComboBox");
			        empresas.list.width(300);
			    
			    $("#admin").kendoDropDownList({
            			optionLabel: "Seleccione administrador",
            			dataTextField: "nomcompleto",
			            dataValueField: "idpersona",
			            <?php if( isset($this->request->data['Persona']['idpersona']))
						 {echo "value: " . $this->request->data['Persona']['idpersona'] . ",";}
						?>
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Contratoconstructors/adminjson.json"
			                            }
			                        }
			        });
			        var admin = $("#admin").data("kendoDropDownList");
			        admin.list.width(300);
				
		/*		
				$("#datePicker1").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				$("#datePicker2").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
			*/	
				$("#codigo").mask("999-9999");

		function limpiaremp(){        
				$('#errorempresa').hide("slow");
		}
		
		
		
	function filtrarDrop() {
		var startDate = start.value();
		var endDate = end.value();
			//alert('dafuq');
			/*proy.data("kendoDropDownList").dataSource.filter([
				     { field: "creacion", operator: "gte", value: startDate },
				     { field: "creacion", operator: "lte", value: endDate }
				]);
			*/
			
			//proy.data("kendoDropDownList").dataSource.filter({ field: "idproyecto", operator: "eq", value: 5});
	}
		
	
	function startChange() {
		var startDate = start.value();
		if (startDate) {
            startDate = new Date(startDate);
            startDate.setDate(startDate.getDate() + 1);
            end.min(startDate);
    	}
    }
	
	function endChange() {
		var endDate = end.value();
	    if (endDate) {
	        endDate = new Date(endDate);
	        endDate.setDate(endDate.getDate() - 1);
	        start.max(endDate);
	    }
	}

    var start = $("#datePicker1").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: startChange,
        close: filtrarDrop,
        <?php if(isset( $this->request->data['Contratoconstructor']['fechainiciocontrato'] )) 
			{ echo 'value: kendo.parseDate("'. $this->request->data['Contratoconstructor']['fechainiciocontrato'] .'", "yyyy-MM-dd"),'; } 
			?>
    }).data("kendoDatePicker");
	
    var end = $("#datePicker2").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: endChange,
        close: filtrarDrop,
        <?php if(isset( $this->request->data['Contratoconstructor']['fechafincontrato'] )) 
			{
			echo 'value: kendo.parseDate("'. $this->request->data['Contratoconstructor']['fechafincontrato'] .'", "yyyy-MM-dd"),'; 
			} 
			?>
    }).data("kendoDatePicker");
	
    start.max(end.value());
    end.min(start.value());
				
				});    
</script>