<!-- File: /app/View/Componentes/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Componentes</h2>
		
				<?php echo $this->Form->create('Componentes'); ?>
		<ul>
			<?php echo $this->Form->input('nombrecomponente', 
					array(
						'label' => 'Nombre Componente:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del Componente', 
						'required', 
						'validationMessage' => 'Ingrese Nombre del Componente')); ?>
			</li>
			<?php echo $this->Form->input('descripcioncomponente', 
					array(
						'label' => 'Descripcion Componente:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Descripcion del Componente', 
						'required', 
						'validationMessage' => 'Ingrese la descripcion del Componente')); ?>
			</li>
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar Componente', 'class' => 'k-button')); ?>
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
                    width: 160px;
                    text-align: right;
                    
                }

                .required {
                    font-weight: bold;
                }
                
                form .required label:after {
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