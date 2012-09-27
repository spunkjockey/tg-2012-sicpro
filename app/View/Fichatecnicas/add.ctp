<!-- File: /app/View/Fichatecnicas/add.ctp -->
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
		<h2>Registrar Ficha Tecnica</h2>
		
				<?php echo $this->Form->create('Fichatecnica'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'select',
						'class' => 'k-combobox',
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required' , 
						'validationMessage' => 'Seleccione Proyecto')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('problematica', 
					array(
						'label' => 'Problematica: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Problematica',
						"rows"=>"5", 
						'required', 
						'validationMessage' => 'Ingrese la Problematica')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('objgeneral', 
					array(
						'label' => 'Objetivo General: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Objetivo General',
						"rows"=>"2",  
						'required', 
						'validationMessage' => 'Ingrese el Objetivo General')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('objespecifico', 
					array(
						'label' => 'Objetivo Especifico: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Objetivo Especifico',
						"rows"=>"2", 
						'validationMessage' => 'Ingrese el Objetivo Especifico')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('descripcionproyecto', 
					array(
						'label' => 'Descripcion : ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Descipcion',
						"rows"=>"6", 
						'required', 
						'validationMessage' => 'Ingrese la Descripcion del Proyecto')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('empleosgenerados', 
					array(
						'label' => 'Empleos Generados: ', 
						'id' => 'numero1',
						'class' => 'k-textbox', 
						'placeholder' => 'Empleos Generados', 
						'required', 
						'validationMessage' => 'Ingrese la cantidad de empleos')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('beneficiarios', 
					array(
						'label' => 'Beneficiarios: ', 
						'id' => 'numero2',
						'class' => 'k-textbox', 
						'placeholder' => 'Beneficiarios',
						"rows"=>"2", 
						'required', 
						'validationMessage' => 'Ingrese Beneficiarios')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('resultadosesperados', 
					array(
						'label' => 'Resultados: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Resultados Esperados',
						"rows"=>"3", 
						'validationMessage' => 'Ingrese los Resultados Esperados')); ?>
			</li>							
			
			<li  class="accept">
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Registrar Ficha', 'class' => 'k-button')); ?>
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
				
				.k-combobox
				{
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
                

                $("#select").kendoComboBox({
			         placeholder: "Seleccionar...",
			         //index: -1,
			         suggest: true
			    });
               // var select = $("#select").data("kendoComboBox");
               
               var combobox = $("#select").data("kendoComboBox");
               combobox.list.width(400);
               });
               
               $("#numero1").kendoNumericTextBox({
                        min: 000000,
    					max: 999999,
    					decimals: 0,
    					placeholder: "Ej. 100",
    					spinners: false
                    });
                    
               $("#numero2").kendoNumericTextBox({
                        min: 000000,
    					max: 999999,
    					decimals: 0,
    					placeholder: "Ej. 100",
    					spinners: false
                    });

                    
</script>