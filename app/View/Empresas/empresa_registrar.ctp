<!-- File: /app/View/Empresas/add.ctp -->
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
			?> » Mantenimiento » Empresa » Registrar Empresa
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Empresa</h2>
		<?php echo $this->Form->create('Empresa'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('nitempresa', 
					array(
						'label' => 'NIT Empresa:',
						'div' => array('class' => 'requerido'),
						'id'	=>	'nit',
						'class' => 'k-textbox',
						'placeholder' => 'Numero de Identificacion Tributaria'
				)); ?>
				<script type="text/javascript">
		            var nit = new LiveValidation( "nit", { validMessage: " " } );
		            nit.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            nit.add(Validate.Format, { pattern: /____-______-___-_/i, failureMessage: "No puedes dejar este campo en blanco", negate: true } );
		            nit.add(Validate.Format, { pattern: /\d\d\d\d-\d\d\d\d\d\d-\d\d\d-\d/i, failureMessage: "El NIT debe de tener 14 números"} );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('nombreempresa', 
					array(
						'label' => 'Nombre Empresa:', 
						'div' => array('class' => 'requerido'),
						'class' => 'k-textbox',
						'id'	=>	'nombreempresa', 
						'placeholder' => 'Nombre Empresa', 
						"rows"=>"2" 
				)); ?> 
				<script type="text/javascript">
		            var nombreempresa = new LiveValidation( "nombreempresa", { validMessage: " " } );
		            nombreempresa.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            nombreempresa.add(Validate.Format, { pattern: /[a-zA-Z0-9_ ]+/, failureMessage: "El nombre de la empresa debe ser alfanumerico" } );
		            
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('representantelegal', 
					array(
						'label' => 'Nombre Representante:',
						'div' => array('class' => 'requerido'), 
						'class' => 'k-textbox', 
						'id'=> 'representantelegal',
						'placeholder' => 'Nombre del Representante'
					)); ?>
				<script type="text/javascript">
		            var representantelegal = new LiveValidation( "representantelegal", { validMessage: " " } );
		            representantelegal.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            representantelegal.add(Validate.Format, { pattern: /^[a-zA-Z áéíóúÁÉÍÓÚñÑ]+$/i, failureMessage: "Solo letras" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('direccionoficina', 
					array(
						'label' => 'Direccion:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Direccion Empresa', 
						"rows"=>"2"
					)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('telefonoempresa', 
					array(
						'label' => 'Telefono:', 
						'div' => array('class' => 'requerido'),
						'class' => 'k-textbox', 
						'id'	=>	'phone',
						'placeholder' => 'Telefono Empresa' 
						)); ?>
				<script type="text/javascript">
		            var phone = new LiveValidation( "phone", { validMessage: " " } );
		            phone.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            phone.add(Validate.Format, { pattern: /____-____/i, failureMessage: "No puedes dejar este campo en blanco", negate: true } );
		            phone.add(Validate.Format, { pattern: /\d\d\d\d-\d\d\d\d/i, failureMessage: "El Numero de Telefono debe de tener 8 números"} );
		        </script> 
			</li>	
			<li>
				<?php echo $this->Form->input('correorepresentante', 
					array(
						'label' => 'E-mail:',
						'class' => 'k-textbox', 
						'placeholder' => 'Correo Electronico',
						'id' => 'mail'
						)); ?>
						
				<script type="text/javascript">
					var mail = new LiveValidation('mail' , { validMessage: " " });
					mail.add( Validate.Email , { failureMessage: "El correo electronico debe ser valido" });
		        </script> 
			</li>	
			<li  class="accept">
				<table>
					<tr>
						
						<td>
							<?php echo $this->Form->end(array('label' => 'Registrar Empresa', 'class' => 'k-button')); ?>
						</td>
						<td>
						<?php echo $this->Html->link(
							'Regresar', 
							array('controller' => 'Empresas', 'action' => 'index'),
							array('class'=>'k-button')
						); ?>	
						</td>
				</tr>
				</table>
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

                /*.required {
                    font-weight: bold;
                }*/
                
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
                
               
               
                
				
				.LV_validation_message{
				    
				    margin:0 0 0 5px;
				    
				}
				
				.LV_valid {
				    color:#00CC00;
				    display: none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 170px; 
               
				}
				    
				
                
            </style>
            
            <script>
                $(document).ready(function() {
                    
                    $("#phone").mask("9999-9999");
                    
                   $("#nit").mask("9999-999999-999-9");
                });
            </script>