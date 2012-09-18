<!-- File: /app/View/Orden de inicio/registrar_Orden de inicio.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Agregar Orden de Inicio</h2>
		<?php echo $this->Form->create('Contrato'); ?>
		<ul>
			
			<li>
                <?php echo $this->Form->input('contratos',
					array(
						'label' => 'Codigo de Contrato:', 
						'id' => 'select',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required', 
						'validationMessage' => 'Seleccione Codigo de contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('ordeninicio', 
					array(
						'label' => 'Orden de Inicio:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text'
						/*'class' => 'k-textbox', 
						'placeholder' => 'Fecha Disponibilidad', 
						'required', 
						'validationMessage' => 'Ingrese la Fecha de Disponibilidad')
						 */) ); ?>
			</li>
			<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>	
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Orden de Inicio', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
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
		 
		 $("#select").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         //index: -1,
			         suggest: true
			    });
	         
	                });
            </script>
            