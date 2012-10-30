<!-- File: /app/View/Estimacion/ModificarEstimacion.ctp -->
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
		<h2>Editar Estimación de Avance</h2>
		<?php echo $this->Form->create('Estimacion'); ?>
		<ul>
			<li>
				<label>Código de Contrato: </label> <?php echo $this->request->data['Contratoconstructor']['codigocontrato']; ?>
			</li>
			<li>
				<?php echo $this->Form->input('tituloestimacion', 
					array(
						'label' => 'Título Estimación: ', 
						'class' => 'k-textbox', 
						'id'=>'tituloestimacion',
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
						'value' => date('d/m/Y',strtotime($this->request->data['Estimacion']['fechainicioestimacion'])),
						'maxlength'=> 10,
						'div' => array('id' => 'iniciofecha', 'class' => 'requerido')
						 ) ); ?>
					<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode: "iniciofecha" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('fechafinestimacion', 
					array(
						'label' => 'Fin Estimación:', 
						'id'	=> 'datePicker2',
						'value' => date('d/m/Y',strtotime($this->request->data['Estimacion']['fechafinestimacion'])),
						'type'  => 'Text',
						'maxlength'=> 10,
						'div' => array('id' => 'finfecha', 'class' => 'requerido')
						 ) ); ?>
				<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " ", insertAfterWhatNode: "finfecha" } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script>  
			</li>
			<li>
				<?php echo $this->Form->input('montoestimado', 
					array(
						'label' => 'Monto Estimado:',
						'id'    => 'moneda',
						'placeholder' => 'Monto Estimado', 
						'div' => array('id' => 'monto', 'class' => 'requerido')
						)); ?>
				<script type="text/javascript">
		            var moneda = new LiveValidation( "moneda", { validMessage: " ", insertAfterWhatNode: "monto" } );
		            moneda.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            moneda.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script> 
		    </li>
		    <li>
				<?php echo $this->Form->input('porcentajeestimadoavance', 
					array(
						'label' => 'Porcentaje Estimación: ', 
						'class' => 'k-textbox',
						'id'=>'porcentaje', 
						'type' => 'text',
						'style' => 'width: 150px;',
						'placeholder' => 'Porcentaje Estimado',
						'maxlength'=> 5,
						'div' => array('class' => 'requerido'))); ?>
				<script type="text/javascript">
		            var porcentaje = new LiveValidation( "porcentaje", { validMessage: " " } );
		            porcentaje.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            porcentaje.add( Validate.Numericality,{ minimum: 0, maximum: 100, tooLowMessage: "El porcentaje no puede ser menor a 0 %", tooHighMessage: "El porcentaje no debe ser mayor al 100 %", notANumberMessage:"Debe ser un número"} );
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('fechaestimacion', 
					array(
						'label' => 'Fecha Estimación:', 
						'id'	=> 'datePicker3',
						'type'  => 'Text',
						'maxlength'=> 10,
						'div' => array('id' => 'fecha', 'class' => 'requerido')
						 ) ); ?>
				<script type="text/javascript">
		            var datePicker3 = new LiveValidation( "datePicker3", { validMessage: " ", insertAfterWhatNode: "fecha"  } );
		            datePicker3.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker3.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        </script> 
						 
			</li>	
		<li  class="accept">
			<table>
			<tr><td>			    
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Editar Estimación', 'class' => 'k-button')); ?>
				</td><td>
				<?php echo $this->Html->link('Regresar', array('controller' => 'Estimacions','action' => 'index'),
            	array('class'=>'k-button'));?> </td></tr>
			</table>
			</li>
            
            <li class="status">
            </li>
            
            
            
		</ul>
		 
 
 
   </div>
  </div>
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
				    
			/*	.LV_valid_field,
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
	        change: startChange
	    }).data("kendoDatePicker");
		
	    var end = $("#datePicker2").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        change: endChange
	    }).data("kendoDatePicker");
		
	    start.max(end.value());
	    end.min(start.value());


		/*$("#datePicker1").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});
		$("#datePicker2").kendoDatePicker({
	 culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});*/
		$("#datePicker3").kendoDatePicker({
		   culture: "es-ES",
		   format: "dd/MM/yyyy" //Define el formato de fecha
		});
         $("#moneda").kendoNumericTextBox({
		     format: "c2", //Define currency type and 2 digits precision
		     spinners: false
		 });

	         
	                });
            </script>