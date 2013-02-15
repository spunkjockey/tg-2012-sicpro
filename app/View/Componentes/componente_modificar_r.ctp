<!-- File: /app/View/Componentes/componente_modificar.ctp -->
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
			?> » Proyectos » Ficha Tecnica » Registrar Ficha Tecnica
			
		</div>
	</div>
	
<?php $this->end(); ?>
<!--<?php Debugger::dump($componentesficha); ?>-->
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Modificar Componentes</h2>
		
				<?php echo $this->Form->create('Componente'); ?>
		<ul>
			<li>
			<?php echo $this->Form->input('nombrecomponente', 
					array(
						'label' => 'Nombre Componente:', 
						'class' => 'k-textbox', 
						'div' => array('class' => 'requerido'),
						'value' => $componentesficha['0']['nombrecomponente'],
						'id' => 'nombrecomponente',
						'placeholder' => 'Nombre del Componente')); ?>
				<script type="text/javascript">
		            var nombrecomponente = new LiveValidation( "nombrecomponente", { validMessage: " " } );
		            nombrecomponente.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
			<?php echo $this->Form->input('descripcioncomponente', 
					array(
						'label' => 'Descripcion Componente:', 
						'class' => 'k-textbox', 
						'value' => $componentesficha['0']['descripcioncomponente'],
						'placeholder' => 'Descripcion del Componente')); ?>
			</li>
			<?php echo $this->Form->input('idcomponente', array('type' => 'hidden','value'=>$idcomponente)); ?>
			<li  class="accept">
			<table>
			<tr>
				<td>				
				<?php echo $this->Form->end(array('label' => 'Modificar Componente', 'class' => 'k-button')); ?>
				</td>
				<td>
				<?php echo $this->Html->link(
					'Regresar', 
					array('controller' => 'Componentes', 'action' => 'componente_listar_r',$idfichatecnica),
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
				
				.k-dropdownlist{
                    width: 200px;
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
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 165px; 
               
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