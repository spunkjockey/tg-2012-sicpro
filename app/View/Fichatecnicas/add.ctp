<!-- File: /app/View/Fichatecnicas/add.ctp -->

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
						//'selected' => '05',
						'empty' => 'Seleccione...', 
						'required' )); ?>
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
						'required', 
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
						'class' => 'k-textbox', 
						'placeholder' => 'Empleos Generados', 
						'required', 
						'validationMessage' => 'Ingrese la cantidad de empleos')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('beneficiarios', 
					array(
						'label' => 'Beneficiarios: ', 
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
						'required', 
						'validationMessage' => 'Ingrese los Resultados Esperados')); ?>
			</li>							
			
			<li  class="accept">
			<!--	<?php echo $this->Html->link(
            	'Agregar Ubicacion', 
            	array('controller' => 'Ubicaciones','action' => 'add'/*, $emp['Empresa']['idempresa']*/),
            	array('class'=>'k-button')
				);?>-->
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Registrar Ficha', 'class' => 'k-button')); ?>
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
                
                $("#select").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         //index: -1,
			         suggest: true
			    });
               // var select = $("#select").data("kendoComboBox");
</script>