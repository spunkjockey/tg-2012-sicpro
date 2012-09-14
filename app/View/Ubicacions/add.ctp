<!-- File: /app/View/Ubicaciones/add.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Ubicacion</h2>
		
				<?php echo $this->Form->create('Ubicacion'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('departamentos',
					array(
						'label' => 'Departamento:', 
						'id' => 'select1',
						//'selected' => '05',
						//'empty' => 'Seleccione...', 
						'required' 
						, 
						'validationMessage' => 'Seleccione Departamento')); ?>
			</li>

			<li>
				<?php echo $this->Form->input('municipios',
					array(
						'label' => 'Municipio:', 
						'id' => 'select2',
						//'selected' => '05',
						//'empty' => 'Seleccione...', 
						'required' 
						, 
						'validationMessage' => 'Seleccione Municipios')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('direccion', 
					array(
						'label' => 'Direccion: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Objetivo General',
						"rows"=>"2",  
						'required', 
						'validationMessage' => 'Ingrese el Objetivo General')); ?>
			</li>
				
			<li  class="accept">
				<div id='divdiv'>
					
					
				</div>
			<!--	<?php echo $this->Html->link(
            	'Agregar Ubicacion', 
            	array('controller' => 'Ubicaciones','action' => 'add'/*, $emp['Empresa']['idempresa']*/),
            	array('class'=>'k-button')
				);?>-->
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Registrar Ubicacion', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
				
				<?php $options = array('url' => 'update_select','update' => 'select2');
				echo $this->ajax->observeField('select1',$options);?>
			</li>
            
            <li class="status">
            </li>
		</ul>
		<?php echo print_r($departamentos)?>
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
                
                $("#select1").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         index: 0,
			         suggest: true,
			         filter: 'none'
			    });
			    $("#select2").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         index: 0,
			         suggest: true,
			         filter: 'none'
			    });
               // var select = $("#select").data("kendoComboBox");
</script>