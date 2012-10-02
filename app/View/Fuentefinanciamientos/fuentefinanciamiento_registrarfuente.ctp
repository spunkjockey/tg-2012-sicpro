<!-- File: /app/View/Fuentefinanciamientos/registrar_fuente.ctp -->
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
			?> » Bienvenido a SICPRO
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Fuente Financiamiento</h2>
		<?php echo $this->Form->create('Fuentefinanciamiento'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('nombrefuente', 
					array(
						'label' => 'Nombre Fuente Financiamiento:',
					
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre de fuente de financiamiento', 
						'required', 
						'validationMessage' => 'Ingrese Nombre de Fuente de Financiamiento')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montoinicial', 
					array(
						'label' => 'Monto Inicial:',
						'id'    => 'moneda',
						'placeholder' => 'Monto Inicial', 
						'validationMessage' => 'Ingrese el Monto Inicial')); ?>
		</li>
		
			<li>
				<?php echo $this->Form->input('fechadisponible', 
					array(
						'label' => 'Fecha Disponibilidad:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						/*'class' => 'k-textbox', 
						'placeholder' => 'Fecha Disponibilidad', 
						'required', 
						'validationMessage' => 'Ingrese la Fecha de Disponibilidad')
						 */) ); ?>
			</li>
		
			
			<li>
                <?php echo $this->Form->input('tipofuentes',
					array(
						'label' => 'Tipo Fuente:', 
						'id' => 'fuentes',
					)); ?>
			</li>
			<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>	
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Fuente', 'class' => 'k-button')); ?>
				
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
                    color: gray;
                }
                span.k-tooltip {
                    margin-left: 6px;
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
		   format: "yyyy/MM/dd" //Define el formato de fecha
		});
         $("#moneda").kendoNumericTextBox({
		     format: "c2", //Define currency type and 2 digits precision
		     spinners: false
		 });
		 
		$("#fuentes").kendoDropDownList({
            			optionLabel: "Seleccione Tipo fuente...",
			            dataTextField: "tipofuente",
			            dataValueField: "id",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Fuentefinanciamientos/fuentejson.json"
			                            }
			                        }
			        });
	         
	                });
            </script>