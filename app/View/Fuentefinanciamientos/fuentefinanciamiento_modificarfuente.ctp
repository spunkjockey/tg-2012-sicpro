<!-- File: /app/View/fuentefinanciamiento/modificarfuente.ctp -->
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
			?> » Bienvenido a SICPRO » Mantenimiento » Fuente Financiamiento
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Editar Fuente de Financiamiento</h2>
		<?php echo $this->Form->create('Fuentefinanciamiento',array('action' => 'fuentefinanciamiento_modificarfuente')); ?>
		<ul>
			
			<li>
				<?php echo $this->Form->input('nombrefuente', 
					array(
						'label' => 'Nombre Fuente Financiamiento:',
					     'id'=> 'nombrefuente',
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre de fuente de financiamiento', 
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
		            var nombrefuente = new LiveValidation( "nombrefuente", { validMessage: " " } );
		            nombrefuente.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            nombrefuente.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El nombre de la fuente debe ser alfanumerico" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('montoinicial', 
					array(
						'label' => 'Monto disponible actual:', 
						'id'    => 'moneda',
						'maxlength'=> 11,
						'class' => 'k-textbox',
						'type'=>'text',
						'placeholder' => 'Monto Inicial', 
						'div' => array('id' => 'dmonto','class' => 'requerido'))); ?>
				<script type="text/javascript">
		            var moneda = new LiveValidation( "moneda", { validMessage: " ", insertAfterWhatNode: "dmonto" } );
		            moneda.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            //moneda.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El monto de la fuente debe ser numérico" } );
		            moneda.add(Validate.Numericality, { minimum: 0.00, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99"  } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('fechadisponible',
					array(
						'label' => 'Fecha:', 
						'id'	=> 'datePicker1',
						'type' => 'Text',
						'maxlength'=> 10,
						'div' => array('id' => 'dfecha','class' => 'requerido')
						)); ?>
			   <script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode: "dfecha" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato DD/MM/AAAA" } );
		        </script> 
			</li>
			<li>
                <?php echo $this->Form->input('idtipofuente',
					array(
						'label' => 'Tipo Fuente:', 
						'id' => 'fuentes',
						'class' => '.k-combobox',
						'div' => array('id' => 'dfuentes','class' => 'requerido')
					)); ?>
			</li>
			<?php echo $this->Form->hidden('id'); ?>
			<?php echo $this->Form->hidden('idfuentefinanciamiento'); ?>
			
			<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>	
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Editar Fuente', 'class' => 'k-button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar', array(
									'controller' => 'Fuentefinanciamientos',
									'action' => 'index'),
			    					array('class'=>'k-button'));?>
						</td>
					</tr>
				</table>
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
		
		$("#moneda").kendoNumericTextBox({
		     format: "c2", //Define currency type and 2 digits precision
		     spinners: false
		     //min:0.01 
		     //max:999999999.99
		 });

		var fecha = $("#datePicker1").kendoDatePicker({
	        culture: "es-ES",
		   	format: "dd/MM/yyyy",
	        <?php if(isset( $this->request->data['Fuentefinanciamiento']['fechadisponible'] )) 
						{
							 echo 'value: kendo.parseDate("'. $this->request->data['Fuentefinanciamiento']['fechadisponible'] .'", "yyyy-MM-dd"),'; } 
						
						?>
	    }).data("kendoDatePicker");
		
		
		
		 
		$("#fuentes").kendoDropDownList({
            			
			            dataTextField: "tipofuente",
			            dataValueField: "idtipofuente",
			            
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Fuentefinanciamientos/fuentejson.json"
			                            }
			                        }
			                        
			        });
        var fuentes = $("#fuentes").data("kendoDropDownList");
        
        
       
        
        
            
        });
</script>