<!-- File: /app/View/Personas/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		
		<?php echo $this->Form->create('Persona'); ?>
		<ul>
			
				<h2>Registrar persona</h2>
				<li>
					<?php echo $this->Form->input('nombrespersona', 
						array(
							'label' => 'Nombres:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Nombres de la persona', 
							'required', 
							'validationMessage' => 'Ingrese nombres de la persona')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('apellidospersona', 
						array(
							'label' => 'Apellidos:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Apellidos de la persona', 
							'required', 
							'validationMessage' => 'Ingrese apellidos de la persona')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('plazas', 
						array(
							'label' => 'Plaza:', 
							'id' => 'selectpla',
							'empty' => 'Seleccione...',
							'required')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('cargos', 
						array(
							'label' => 'Cargo funcional:', 
							'id' => 'selectcar',
							'empty' => 'Seleccione...',
							'required')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('telefonocontacto', 
						array(
							'label' => 'Telefono:', 
							'class' => 'k-textbox', 
							'id'	=>	'phone',
							'placeholder' => 'Telefono Empresa', 
							'validationMessage' => 'Ingrese Telefono Empresa')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('correoelectronico', 
						array(
							'label' => 'Correo electronico:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Correo Electronico', 
							'required', 
							'validationMessage' => 'Ingrese Correo Electronico')); ?>
				</li>
			
				<h2>Registrar usuario principal</h2>
				<li>
					<?php echo $this->Form->input('username', 
						array(
							'label' => 'Nombre de usuario:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Usuario', 
							'required', 
							'validationMessage' => 'Ingrese nombre de usuario')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('roles', 
						array(
							'label' => 'Rol:', 
							'empty' => 'Seleccione...',
							'id' => 'selectrol',
							'required',
							'validationMessage' => 'Seleccione un rol')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('password', 
						array(
							'label' => 'Contraseña:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Contraseña', 
							'required', 
							'validationMessage' => 'Ingrese Contraseña')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('estado',
						array('options' => array(0 => 'Deshabilitado', 1 => 'Habilitado'),
							  'id' => 'selectedo')); ?>
				</li>
			
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar persona', 'class' => 'k-button')); ?>
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
                
				$("#selectpla").kendoComboBox();
				$("#selectcar").kendoComboBox();
				$("#selectrol").kendoComboBox();
				$("#selectedo").kendoComboBox();
				$("#phone").mask("9999-9999");
                 
				
				
				
				});
                
            </script>