<!-- File: /app/View/Ordendecambios/ordendecambio_registrar.ctp -->
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
			?> » Contratos » Orden de Cambio
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Orden de Cambio</h2>
		<?php echo $this->Form->create('Ordenc'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('tituloordendecambio', 
					array(
						'label' => 'Titulo :',
						'div' => array('class' => 'requerido'),
						'id'	=>	'titulo',
						'class' => 'k-textbox',
						'placeholder' => 'Titulo Orden de Cambio'
				)); ?>
				<script type="text/javascript">
		            var titulo = new LiveValidation( "titulo", { validMessage: " " } );
		            titulo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>				
				<?php echo $this->Form->input('montoordencambio', 
					array(
						'label' => 'Monto:', 
						'div' => array('id' => 'montop', 'class' => 'requerido'),
						'type' => 'text',
						'class' => 'k-textbox',
						'id'	=>	'montoordencambio', 
						'maxlength' => 13,
						'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errormonto')) 
				)); ?> 
				
				<script type="text/javascript">
					var montoordencambio = new LiveValidation( "montoordencambio", { validMessage: " " , insertAfterWhatNode: "montop" } );
		            montoordencambio.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            montoordencambio.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        </script>	
		         <?php if ($this->Form->isFieldError('Ordendecambio.montoordencambio')) {
 	 					echo $this->Form->error('Ordendecambio.montoordencambio'); } ?>
			</li>
			<li>
				<?php echo $this->Form->input('descripcionordencambio', 
					array(
						'label' => 'Descripcion:',
						'div' => array('class' => 'requerido'), 
						'class' => 'k-textbox', 
						'id'=> 'descripcionordencambio',
						'placeholder' => 'Descripcion Orden de Cambio',
						"rows"=>"5"
					)); ?>
				<script type="text/javascript">
		            var descripcionordencambio = new LiveValidation( "descripcionordencambio", { validMessage: " " } );
		            descripcionordencambio.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('fecharegistroorden', 
					array(
						'label' => 'Fecha:', 
						'id'	=> 'datePicker1',
						'div' => array('id' => 'fechare','class' => 'requerido'),
						'type'  => 'Text'
						));
					?>
				<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode:"fechare" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		            datePicker1.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		        </script>
		        <?php if ($this->Form->isFieldError('Ordendecambio.fecharegistroorden')) {
 	 					echo $this->Form->error('Ordendecambio.fecharegistroorden'); } ?>
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Registrar Orden de Cambio', 'class' => 'k-button')); ?>
						</td>

						<td>
							<?php echo $this->Html->link(
								'Regresar', 
								array('action' => 'ordendecambio_listar'),
								array('class'=>'k-button')
							); ?>	
						</td>
				</tr>
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
                    margin-right: 5px;
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
               		margin-left: 165px; 
               
				}
				    
			
                
            </style>
            
<script>
   $(document).ready(function() {

      $("#montoordencambio").kendoNumericTextBox({
    		format: "c2",
    		placeholder: "Ingrese el nuevo monto",
    		spinners: false
		});
	
		$("#datePicker1").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			<?php if(!empty($anterior)){	echo "min: kendo.parseDate('".$anterior['Ordendecambio']['fecharegistroorden']."'),";}?>
		   			culture: "es-ES"
		});
		                
	});
</script>