<!-- File: /app/View/Fichatecnicas/fichatecnica_listarficha.ctp -->
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
			?> » Matenimiento » Perfil » Cambiar Contraseña 
			
		</div>
	</div>
	
<?php $this->end(); ?>

<?php //Debugger::dump($usuario) ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Cambiar Contraseña</h2>
		<?php echo $this->Form->create('User'); ?>
		<ul>
			<li>
				<?php echo '<label>Nombre:</label> '.$usuario['User']['nombrecomun']; ?>
				<?php echo $this->Form->hidden('idusuario', array('value' => $usuario['User']['id'] )); ?> 
			</li>
			<br />
			<li>
				<?php echo $this->Form->input('password', 
					array(
						'label' => 'Contraseña:', 
						'id' => 'password',
						'type' => 'password',
						'class' => 'k-textbox', 
						'value' => '',
						'maxlength' => 25,
						'placeholder' => 'Contraseña',
						'error' => array('attributes' => array('wrap' => 'span', 'class' => 'LV_validation_message LV_invalid', "id" => 'errorpassword')),
						'div' => array('class' => 'requerido') 
				)); ?>
				<script type="text/javascript">
		            var password = new LiveValidation( "password", { validMessage: " "} );
		            password.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			<br />
			<li>
				<?php echo $this->Form->input('newpassword', 
					array(
						'label' => 'Nueva Contraseña:', 
						'id' => 'passwordnew',
						'type' => 'password',
						'class' => 'k-textbox',
						'maxlength' => 25, 
						'placeholder' => 'Nueva Contraseña',
						'div' => array('class' => 'requerido') 
				)); ?>
				<script type="text/javascript">
		            var passwordnew = new LiveValidation( "passwordnew", { validMessage: " " } );
		            passwordnew.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            
		            passwordnew.add(Validate.Format, { pattern: /‎?^.{8,}$/, failureMessage: "Debe contener al menos 8 caracteres"  } );
		            passwordnew.add(Validate.Format, { pattern: /‎?^.*\d.*$/, failureMessage: "Debe contener al menos un número"  } );
		            passwordnew.add(Validate.Format, { pattern: /‎?^.*[ ].*$/, failureMessage: "No se permiten espacios en blanco", negate: true  } );
		            passwordnew.add(Validate.Format, { pattern: /‎?^.*(_+|\W+).*$/, failureMessage: "Debe contener al menos un caracter especial, por ejemplo: @ # % { ) "  } );
		            passwordnew.add(Validate.Format, { pattern: /‎?^.*[A-Z].*$/, failureMessage: "Debe contener al menos una letra mayúscula"  } );
		            passwordnew.add(Validate.Format, { pattern: /‎?^.*[a-z].*$/, failureMessage: "Debe contener al menos una letra minúscula"  } );
		        
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('newmatchpassword', 
					array(
						'label' => 'Confirme Contraseña:', 
						'id' => 'passwordnewmatch',
						'class' => 'k-textbox', 
						'type' => 'password',
						'maxlength' => 25,
						'placeholder' => 'Nueva Contraseña',
						'div' => array('class' => 'requerido') 
				)); ?>
				<script type="text/javascript">
		            var passwordnewmatch = new LiveValidation('passwordnewmatch', { validMessage: " " }  );
					passwordnewmatch.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					passwordnewmatch.add( Validate.Confirmation, { match: 'passwordnew', failureMessage: "La contraseña no coincide" } );
		        </script>
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Cambiar Contraseña', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar',
								array('controller' => 'Mains', 'action' => 'index'),
								array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
		</ul>
	</div>
</div>
		
			<style scoped>

                .k-textbox {
                    width: 175px;
                }
				
				#tablat {
					vertical-align: top;
				}
				
				#formulario {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }

                #formulario h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }
                
                #tablafinancia h3 {
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
                    margin-right: 5px; 
                }
                
                                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .requerido label:after {
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

 				.LV_validation_message{
				    /*font-weight:bold;*/
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
               		display:block;
               		margin-left: 155px;
				}
				    
			/*	.LV_valid_field,
				input.LV_valid_field:hover, 
				input.LV_valid_field:active,
				textarea.LV_valid_field:hover, 
				textarea.LV_valid_field:active {
				    border: 1px solid #00CC00;
				}
				    
				.LV_invalid_field, 
				input.LV_invalid_field:hover, 
				input.LV_invalid_field:active,
				textarea.LV_invalid_field:hover, 
				textarea.LV_invalid_field:active {
				    border: 1px solid #CC0000;
				}
                */

            </style>


