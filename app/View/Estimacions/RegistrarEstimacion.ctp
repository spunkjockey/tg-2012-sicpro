<!-- File: /app/View/Estimacions/RegistrarEstimacion.ctp -->
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
			?> » Bienvenido a SICPRO » Control y Seguimiento » Estimación de Avance
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Estimación de Avance</h2>
		
		<?php echo $this->Form->create('Estimacion'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'proyectos',
						'div' => array('class' => 'requerido')
					)); ?>
			</li>
				<li>
				<?php echo $this->Form->input('idcontrato',
					array(
						'label' => 'Contratos:', 
						'id' => 'contratos',
						'div' => array('class' => 'requerido')
					)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('tituloestimacion', 
					array(
						'label' => 'Título Estimación: ',
						'id'=> 'tituloestimacion', 
						'class' => 'k-textbox', 
						'placeholder' => 'Título Estimación',
						'div' => array('class' => 'requerido'))); ?>
				<script type="text/javascript">
		            var tituloestimacion = new LiveValidation( "tituloestimacion", { validMessage: " " } );
		            tituloestimacion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            tituloestimacion.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El Titulo de Estimación debe ser alfanumerico" } );
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('fechainicioestimacion', 
					array(
						'label' => 'Inicio Estimación:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text',
						'div' => array('class' => 'requerido')
						 ) ); ?>
					<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('fechafinestimacion', 
					array(
						'label' => 'Fin Estimación:', 
						'id'	=> 'datePicker2',
						'type'  => 'Text',
						'div' => array('class' => 'requerido')
						 ) ); ?>
				<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script>  
			</li>
			<li>
				<?php echo $this->Form->input('montoestimado', 
					array(
						'label' => 'Monto Estimado:',
						'id'    => 'moneda',
						'type'=>'text',
						'placeholder' => 'Monto Estimado',
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
		            var moneda = new LiveValidation( "moneda", { validMessage: " " } );
		            moneda.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            moneda.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El monto de la Estimación debe ser numérico" } );
		        </script> 
		    </li>
		    <li>
				<?php echo $this->Form->input('porcentajeestimadoavance', 
					array(
						'label' => 'Porcentaje Estimación: ', 
						'class' => 'k-textbox', 
						'id'=>  'porcentaje',
						'type' => 'text',
						'placeholder' => 'Porcentaje Estimado',
						'maxlength'=> 4,
						'div' => array('class' => 'requerido'))); ?>
				<script type="text/javascript">
		            var porcentaje = new LiveValidation( "porcentaje", { validMessage: " " } );
		            porcentaje.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            porcentaje.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El Titulo de Estimación debe ser numérico" } );
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('fechaestimacion', 
					array(
						'label' => 'Fecha Estimación:', 
						'id'	=> 'datePicker3',
						'type'  => 'Text',
						'div' => array('class' => 'requerido')
						 ) ); ?>
				<script type="text/javascript">
		            var datePicker3 = new LiveValidation( "datePicker3", { validMessage: " " } );
		            datePicker3.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker3.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<div id='prueba'>
				
			</div>
			<li  class="accept">
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				
<table border="0">
<tr>
<td><?php echo $this->Form->end(array('label' => 'Registrar Estimación', 'class' => 'k-button')); ?>
</td><td>
    <?php echo $this->Html->link('Regresar', array('controller' => 'Estimacions','action' => 'index'),
    array('class'=>'k-button'));?>
</td></tr>
</table>
				<?php $options = array('url' => 'update_selectContrato1','update' => 'select2');
				echo $this->ajax->observeField('select1',$options);?>
				
			</li>
				
			 <li class="status">
            </li>
            
		</ul>

	</div>
</div>

            <style scoped>

                .k-textbox {
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
                    width: 210px;
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
				    font-weight:bold;
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
            </style>
            
            <script>
                $(document).ready(function() {
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("button").click(function() {
                        if (validator.validate()) {
                            //status.text("Hooray! Your tickets has been booked!").addClass("valid");
                            } else {
                            //status.text("Oops! There is invalid data in the form.").addClass("invalid");
                        }
                    });


		$("#datePicker1").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy"  //Define el formato de fecha
		});
		$("#datePicker2").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});
		$("#datePicker3").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});
         $("#moneda").kendoNumericTextBox({
		     format: "c2", //Define currency type and 2 digits precision
		     spinners: false,
		     min:0, max:999999999.99
		 });
		 
		 $("#porcentaje").kendoNumericTextBox({
   			format: "p0", // format as percentage with % sign
   			min: 0,
   			max: 1,
  		    step: 0.01
		 });
		 
		$("#proyectos").kendoDropDownList({
		            			
					            dataTextField: "numeroproyecto",
					            dataValueField: "idproyecto",
					            dataSource: {
					                            type: "json",
					                            transport: {
					                                read: "/Estimacions/proyectojson.json"
					                            }
					                        }
					        });

		var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			        var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                        
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Avanceprogramados/contratojson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
	                });
            </script>
			
