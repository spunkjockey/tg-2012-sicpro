<!-- File: /app/View/Componentes/add.ctp -->
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
			?> » Bienvenido a SICPRO
			
		</div>
	</div>
	
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Componentes</h2>
		
				<?php echo $this->Form->create('Componentes'); ?>
		<ul>
			<li>
			<?php echo $this->Form->input('Componente.nombrecomponente', 
					array(
						'label' => 'Nombre Componente:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Nombre del Componente', 
						'required', 
						'validationMessage' => 'Ingrese Nombre del Componente')); ?>
			</li>
			<li>
			<?php echo $this->Form->input('Componente.descripcioncomponente', 
					array(
						'label' => 'Descripcion Componente:', 
						'class' => 'k-textbox', 
						'placeholder' => 'Descripcion del Componente', 
						'required', 
						'validationMessage' => 'Ingrese la descripcion del Componente')); ?>
			</li>
			<li  class="accept" align="right" >
				<a href="#" onclick="AgregarCampos('<?php echo $this->Session->read('User.username');?>');" class="k-button">Agregar Metas</a>		
			</li>
		
			
			<ul id="metas">
			
	    	</ul>
			<li  class="accept">
				<?php echo $this->Form->input('Componente.idfichatecnica', array('type' => 'hidden','value'=>$idfichatecnica)); ?>
				<!--<?php echo $this->Form->input('Meta.0.userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->input('Meta.1.userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->input('Meta.2.userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>-->
				<?php echo $this->Form->end(array('label' => 'Registrar Componente', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
				<?php echo $this->Html->link(
					'Regresar', 
					array('controller' => 'Fichatecnicas', 'action' => 'view',$idfichatecnica),
					array('class'=>'k-button')
				); ?>
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
                    margin-right: 5px;
                    
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
					var validator = $("#formulario").kendoValidator().data("kendoValidator");

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
<script type="text/javascript">
	var nextinput = 0;
	function AgregarCampos(usuario) {
		nextinput++;
		campo = '<li class="meta'+ nextinput +'"><label for="Meta'+nextinput+'Descripcionmeta">Descripcion Meta:</label><textarea name="data[Meta]['+nextinput+'][descripcionmeta]" class="k-textbox" placeholder="Meta" required="required" validationMessage="Ingrese la meta" cols="30" rows="6" id="Meta'+ nextinput +'Descripcionmeta"></textarea><a href="#" onclick= "borrar( '+ nextinput +');"" class="k-button"">Borrar</a></li><input type="hidden" name="data[Meta]['+nextinput+'][userc]" value="'+usuario+'" id="Meta'+nextinput+'Userc"/>';
		$("#metas").append(campo);
		return false;
	}
	function borrar(cual) {
    	$("li.meta"+cual).remove();
    	return false;
	}
</script>