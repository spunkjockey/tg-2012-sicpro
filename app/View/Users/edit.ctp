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
			?> Usuario » Modificar usuario
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar usuario</h2>
		<?php echo $this->Form->create('User'); ?>
    	<ul>
	    	<?php 
	if($idrol == 4)
			{ ?> 
	    	<?php if(empty($this->data['User']['idpersona'])) { ?>
	    	<li>
				<?php echo $this->Form->input('nombre', 
					array(
						'label' => 'Nombres:', 
						'class' => 'k-textbox', 
						'id' => 'nombres',
						'maxlength' => 50,
						'placeholder' => 'Nombre del usuario',
						'div' => array('class' => 'requerido') 
					)); ?>
			</li>
			
			<script type="text/javascript">
			            var nombres = new LiveValidation( "nombres", { validMessage: " "} );
			            nombres.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            nombres.add(Validate.Format, { pattern: /^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i, failureMessage: "Solo letras" } );
		    </script>
			<li>
				<?php echo $this->Form->input('apellidos', 
					array(
						'label' => 'Apellidos:', 
						'class' => 'k-textbox',
						'id' => 'apellidos',
						'maxlength' => 50,  
						'placeholder' => 'Apellido del usuario',
						'div' => array('class' => 'requerido') 
					)); ?>
			<script type="text/javascript">
			            var apellidos = new LiveValidation( "apellidos", { validMessage: " "} );
			            apellidos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            apellidos.add(Validate.Format, { pattern: /^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i, failureMessage: "Solo letras" } );
		    </script>
			</li>
			<script type="text/javascript">
			            var roles = new LiveValidation( "roles", { validMessage: " ", insertAfterWhatNode: "divrol" } );
			            roles.add(Validate.Presence, { failureMessage: "Seleccione un rol para continuar" } );
			            
		    </script>
		    
		   <?php } else { ?>
		    	<li>
					<label>Nombres: </label><?php echo $this->data['User']['nombre'];?>
					<?php echo $this->Form->input('nombre', array('type' => 'hidden', 'value' => $this->data['User']['nombre'])); ?>
				</li>
				
		    	<li>
					<label>Apellidos: </label><?php echo $this->data['User']['apellidos'];?>
					<?php echo $this->Form->input('apellidos', array('type' => 'hidden', 'value' => $this->data['User']['apellidos'])); ?>
				</li>
			<?php } ?>
		   	
		    
	    	<li>
				<label>Nombre de usuario: </label><?php echo $this->data['User']['username'];?>
				<?php echo $this->Form->input('username', array('type' => 'hidden', 'value' => $this->data['User']['username'])); ?>
			</li>
			
	    	<li>
				<label>Rol: </label><?php echo $this->data['Rol']['rol'];?>
				<?php echo $this->Form->input('Rol.rol', array('type' => 'hidden', 'value' => $this->data['Rol']['rol'])); ?>
			</li>
	    	
	    	<!--<li>
				<?php echo $this->Form->input('username', 
						array(
							'label' => 'Nombre de usuario:', 
							'class' => 'k-textbox', 
							'id' => 'username',
							'maxlength' => 20,
							'placeholder' => 'Usuario',
							'div' => array('class' => 'requerido') 
					)); ?>
					<script type="text/javascript">
			            var username = new LiveValidation( "username", { validMessage: " " } );
			            username.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            username.add(Validate.Format, { pattern: /‎?^.*[ ].*$/, failureMessage: "No se permiten espacios en blanco", negate: true  } );
			            username.add(Validate.Format, { pattern: /‎?^.{6,}$/, failureMessage: "Debe contener al menos 6 caracteres"  } );
		        	</script>
				</li>
	    -->
	    	<!--<li>
				<?php echo $this->Form->input('nombre', 
					array(
						'label' => 'Nombres:', 
						'class' => 'k-textbox', 
						'readOnly' => 'readOnly',
						'id' => 'nombres',
						'placeholder' => 'Nombre del usuario'
						//'div' => array('class' => 'requerido') 
					)); ?>
			</li>
			<script type="text/javascript">
			            var nombres = new LiveValidation( "nombres", { validMessage: " "} );
			            nombres.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            
		    </script>
			<li>
				<?php echo $this->Form->input('apellidos', 
					array(
						'label' => 'Apellidos:', 
						'class' => 'k-textbox',
						'readOnly' => 'readOnly',
						'id' => 'apellidos',  
						'placeholder' => 'Apellido del usuario'
						//'div' => array('class' => 'requerido') 
					)); ?>
			<script type="text/javascript">
			            var apellidos = new LiveValidation( "apellidos", { validMessage: " "} );
			            apellidos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            
		    </script>
			</li>
			<script type="text/javascript">
			            var roles = new LiveValidation( "roles", { validMessage: " ", insertAfterWhatNode: "divrol" } );
			            roles.add(Validate.Presence, { failureMessage: "Seleccione un rol para continuar" } );
			            
		    </script>
	    	<li>
				<?php echo $this->Form->input('username', 
						array(
							'label' => 'Nombre de usuario:', 
							'class' => 'k-textbox', 
							'readOnly' => 'readOnly',
							'id' => 'username',
							'placeholder' => 'Usuario'
							//'div' => array('class' => 'requerido') 
					)); ?>
					<script type="text/javascript">
			            var username = new LiveValidation( "username", { validMessage: " " } );
			            username.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
			            username.add(Validate.Format, { pattern: /‎?^.*[ ].*$/, failureMessage: "No se permiten espacios en blanco", negate: true  } );
		        	</script>
				</li> 
				<li>
					<?php echo $this->Form->input('Rol.rol', 
						array(
							'label' => 'Rol:', 
							'class' => 'k-textbox',
							'readOnly' => 'readOnly'
							)); ?>

				</li> -->
				<br />
				<li>
					<div id="cbox">
						<input type="checkbox" name="ch" id="ch" onclick="modificarEstado()"  value="1" > Cambiar Contraseña
					</div> 
					

					<script>
						function modificarEstado() { 
							if(document.getElementById("ch").checked)  { 
								document.getElementById("password").disabled =false;
							} else { 
								document.getElementById("password").value ="";
								document.getElementById("password").disabled=true;
							} 
						}
					</script>
					
				</li>
				<li>
					<?php echo $this->Form->input('newpassword', 
						array(
							'label' => 'Nueva Contraseña:', 
							'type' => 'password',
							'id' => 'password',
							'class' => 'k-textbox',
							'disabled' => true,  
							'maxlength' => 25,
							'placeholder' => 'Contraseña',
							'div' => array('class' => 'requerido') 
					)); ?>
				<script type="text/javascript">
		            var password = new LiveValidation( "password", { validMessage: " " } );
		            password.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            password.add(Validate.Format, { pattern: /‎?^.{8,}$/, failureMessage: "Debe contener al menos 8 caracteres"  } );
		            password.add(Validate.Format, { pattern: /‎?^.*\d.*$/, failureMessage: "Debe contener al menos un número"  } );
		            password.add(Validate.Format, { pattern: /‎?^.*(_+|\W+).*$/, failureMessage: "Debe contener al menos un caracter especial, por ejemplo: @ # % { ) " } );
		            password.add(Validate.Format, { pattern: /‎?^.*[ ].*$/, failureMessage: "No se permiten espacios en blanco", negate: true  } );
		            //password.add(Validate.Format, { pattern: /‎?^.*\W+.*$/, failureMessage: "Debe contener al menos un caracter especial, por ejemplo: @ # % { ) ""  } );
		            password.add(Validate.Format, { pattern: /‎?^.*[A-Z].*$/, failureMessage: "Debe contener al menos una letra mayúscula"  } );
		            password.add(Validate.Format, { pattern: /‎?^.*[a-z].*$/, failureMessage: "Debe contener al menos una letra minúscula"  } );
		        </script>
				</li>
				
				
				<!--<li>
					<?php echo $this->Form->input('estado', 
								array(
								'label' => 'Estado: ',
								
								'id' => 'estados',
								'value' => $this->request->data['User']['estado'],
								'div' => array('class' => 'requerido'),
								'options' => array(0 => 'Deshabilitado', 
												   1 => 'Habilitado'))); ?>
				</li>-->
				<li  class="accept">
				<table>
					<tr>
					<td>
						<?php echo $this->Form->end(array('label' => 'Modificar Usuario', 'class' => 'k-button')); ?>
					</td>
					<td>
						<?php echo $this->Html->link('Regresar',
							array('action' => 'user_index'),
							array('class'=>'k-button')); ?>
					</td>
					</tr>
				</table>
				</li>
	            <li class="status">
	            <?php 
            	}
            	else{
            		echo "Lo sentimos, su usuario no cuenta con los permisos adecuados para realizar esta función<br><br>";
            		echo $this->Html->link('Regresar', 
									array('controller' => 'Mains','action' => 'index'),
									array('class'=>'k-button'));
            	}
            	?>
			</ul>
    	</div>
   </div>

<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
			
                form .requerido label:after {
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
                    margin-right: 5px;
                    
                }
                
                #cbox {
                	display: inline-block;
                    width: 150px;
                    margin-left: 155px;
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
				    
				    margin:0 0 0 5px;
				}
				
				.LV_valid {
				    color:#00CC00;
				    margin-left: 10px;
				}
					
				.LV_invalid {
				    color:#CC0000;
				    
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}
				
                
            </style>
			
			<script>
                $(document).ready(function() {

					$("#estados").kendoDropDownList();
					$("#phone").mask("9999-9999");
				});
                
            </script>