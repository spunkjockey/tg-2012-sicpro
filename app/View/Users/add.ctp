<!-- app/View/Users/add.ctp -->

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
			?> Usuario » Registrar usuario
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar usuario</h2>
		<?php echo $this->Form->create('User'); ?>
    	<ul>
	    	<li>
				<?php echo $this->Form->input('nombrespersona', 
					array(
						'label' => 'Nombres:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del usuario', 
						'required', 
						'validationMessage' => 'Ingrese nombre')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('apellidospersona', 
					array(
						'label' => 'Apellidos:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Apellido del usuario', 
						'required', 
						'validationMessage' => 'Ingrese apellidos')); ?>
			</li>
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
					<?php echo $this->Form->input('password', 
						array(
							'label' => 'Contraseña:', 
							'class' => 'k-textbox', 
							'placeholder' => 'Contraseña', 
							'required', 
							'validationMessage' => 'Ingrese Contraseña')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('roles', 
						array(
							'label' => 'Rol:', 
							'empty' => 'Seleccione...',
							'required',
							'id' => 'roles',
							'validationMessage' => 'Seleccione un rol')); ?>
				</li>
				<li>
					<?php echo $this->Form->input('estado', 
								array(
								'id' => 'estados',
								'options' => array(0 => 'Deshabilitado', 
												   1 => 'Habilitado'))); ?>
				</li>
				<li  class="accept">
					<?php echo $this->Form->end(array('label' => 'Registrar persona', 'class' => 'k-button')); ?>
				</li>
	            <li class="status">
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
				$("#roles").kendoComboBox();
				$("#estados").kendoComboBox();
				
				$("#phone").mask("9999-9999");
                 
				
				
				
				});
                
            </script>