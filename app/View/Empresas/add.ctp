<!-- File: /app/View/Empresas/registrar_empresa.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Agregar Empresa</h2>
		<?php echo $this->Form->create('Empresa'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('nitempresa', 
					array(
						'label' => 'NIT Empresa:',
						//'type' => 'text',
						//'maxlength'=>'14', 
						'id'	=>	'nit',
						'class' => 'k-textbox', 
						'placeholder' => 'Numero de Identificacion Tributaria', 
						/*'required',*/ 
						'validationMessage' => 'Ingrese NIT Empresa')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('nombreempresa', 
					array(
						'label' => 'Nombre Empresa:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre Empresa', 
						'required', 
						'validationMessage' => 'Ingrese Nombre Empresa')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('representantelegal', 
					array(
						'label' => 'Nombre Representante:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del Representante', 
						'required', 
						'validationMessage' => 'Ingrese Nombre del Representante')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('direccionoficina', 
					array(
						'label' => 'Direccion:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Direccion Empresa', 
						"cols"=>"5",
						"rows"=>"5",
						'validationMessage' => 'Ingrese Direccion Empresa')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('telefonoempresa', 
					array(
						'label' => 'Telefono:', 
						'class' => 'k-textbox', 
						'id'	=>	'phone',
						'placeholder' => 'Telefono Empresa', 
						'validationMessage' => 'Ingrese Telefono Empresa')); ?>
			</li>	
			<li>
				<?php echo $this->Form->input('correorepresentante', 
					array(
						'label' => 'E-mail:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Correo Electronico', 
						'required', 
						'validationMessage' => 'Ingrese Correo Electronico')); ?>
			</li>	
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Empresa', 'class' => 'k-button')); ?>
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
                    
                    $("#phone").mask("9999-9999");
                    
                   $("#nit").mask("9999-999999-999-9");
                });
            </script>