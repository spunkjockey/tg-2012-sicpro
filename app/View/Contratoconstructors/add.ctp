<!-- File: /app/View/Contratoconstructors/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar contrato constructor</h2>
		<?php echo $this->Form->create('Proyecto'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proys', 
					array(
						'label' => 'Seleccione proyecto:', 
						'id' => 'selecto',
						'empty' => 'Seleccione...',
						'required')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('codigocontrato', 
					array(
						'label' => 'Código contrato:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Ej: 001-2012', 
						'required', 
						'validationMessage' => 'Ingrese el código de contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('nombrecontrato', 
					array(
						'label' => 'Nombre del contrato:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del contrato', 
						'required', 
						'validationMessage' => 'Ingrese nombre del contrato')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('montocon', 
					array(
						'label' => 'Monto: ($)',
						'class' => 'k-textbox',  
						'id' => 'textbox',
						'type' => 'text',
						'placeholder' => 'Ingrese Monto',
						'required',
						'validationMessage' => 'Ingrese el monto original($)')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('anticipo', 
					array(
						'label' => 'Anticipo: ($)',
						'class' => 'k-textbox',  
						'id' => 'textbox',
						'type' => 'text',
						'placeholder' => 'Ingrese anticipo',
						'required',
						'validationMessage' => 'Ingrese el monto original($)')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechacontrato', 
					array(
						'label' => 'Fecha de inicio de contrato:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text')); ?>
			</li>
		</ul>
	</div>
</div>

	<style scoped>

                .k-textbox {
                    width: 300px;
                    margin-left: 5px;
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
			
                form .required label:after {
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
                    color: red;
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
                
				$("#selecto").kendoComboBox();
				
				$("#phone").mask("9999-9999");
                $("#datePicker1").kendoDatePicker({
		   			format: "yyyy/MM/dd" //Define el formato de fecha
		   		});
				
				
				
				});
                
            </script>