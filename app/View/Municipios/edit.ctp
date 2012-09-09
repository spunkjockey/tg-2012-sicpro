<!-- File: /app/View/Departamentos/edit.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Editar Municipio</h2>
		<?php echo $this->Form->create('Municipio'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('iddepartamento', 
					array(
						'label' => 'Codigo Departamento:', 
						'class' => 'k-textbox', 
						'placeholder' => 'ej. 07', 
						'required', 
						'validationMessage' => 'Ingrese Codigo Departamento')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('codigomunicipio', 
					array(
						'label' => 'Codigo Municipio:', 
						'class' => 'k-textbox', 
						'placeholder' => 'ej. 07', 
						'required', 
						'validationMessage' => 'Ingrese Codigo Municipio')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('municipio', 
					array(
						'label' => 'Municipio:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre Municipio', 
						'required', 
						'validationMessage' => 'Ingrese Nombre Municipio')); ?>
			</li>
			<li  class="accept">
				<?php echo $this->Form->input('id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->input('departamento_id', array('type' => 'hidden')); ?>
				<?php echo $this->Form->end(array('label' => 'Editar Municipio', 'class' => 'k-button')); ?>
			</li>
            
            <li class="status">
            </li>
		</ul>
		 
 
 
   </div>
  </div>
 <style scoped>

                .k-textbox {
                    width: 11.8em;
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
                    
                    var select = $("#select").data("kendoComboBox");
                });
            </script>
