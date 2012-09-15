<!-- File: /app/View/fuentefinanciamiento/edit.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Editar Fuente de Financiamiento</h2>
		<?php echo $this->Form->create('Fuentefinanciamiento'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('nombrefuente', 
					array(
						'label' => 'Fuente:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre Fuente de Financiamiento', 
						'required', 
						'validationMessage' => 'Ingrese Nombre de Fuente de Financiamiento')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montoinicial', 
					array(
						'label' => 'Monto:', 
						'id'    => 'moneda',
						'placeholder' => 'Monto Inicial', 
						'required', 
						'validationMessage' => 'Ingrese el Monto Inicial')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechadisponible',
					array(
						'label' => 'Fecha:', 
						'id'	=> 'datePicker1',
						'type' => 'text'
						)); ?>
			</li>
			<li>
				 <?php echo $this->Form->input('tipofuentes',
					array(
						'label' => 'Tipo Fuente:', 
						'id' => 'select',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required', 
						'validationMessage' => 'Seleccione Tipo de Fuente')); ?>
			</li>	
		
		<li  class="accept">
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>	
				<?php echo $this->Form->end(array('label' => 'Editar Fuente', 'class' => 'k-button')); ?>
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
	         
	                });
            </script>