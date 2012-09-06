<!-- File: /app/View/Municipios/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Agregar Municipio</h2>
		<?php echo $this->Form->create('Municipio'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('departamentos',
					array(
						'label' => 'Departamento:', 
						'id' => 'select',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required' )); ?>
			</li>
			<li>
				<?php echo $this->Form->input('codigomunicipio', 
					array(
						'label' => 'Codigo Municipio:', 
						'class' => 'k-textbox', 
						'placeholder' => 'ej. 01', 
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
				<?php echo $this->Form->end(array('label' => 'Registrar Municipio', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
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
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
			
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
                });
                
               /* $("#select").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         //index: -1,
			         suggest: true
			    });*/
                var select = $("#select").data("kendoComboBox");
            </script>
