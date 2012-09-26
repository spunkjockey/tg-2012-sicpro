<!-- File: /app/View/Contratoconstructors/actualizarestado.ctp -->

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Actualizar Estado de Contrato Constructor</h2>
		<?php echo $this->Form->create('Estado'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyecto:', 
						'id' => 'select1', 
						'required', 
						'validationMessage' => 'Seleccione Proyecto')); ?>
			</li>

			<!--<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contrato:', 
						'id' => 'select2', 
						'required', 
						'validationMessage' => 'Seleccione Contrato')); ?>
			</li>-->
			<li  class="accept">
				<div id='divdiv'>
				</div>
				<?php echo $this->Form->input('userm', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<?php echo $this->Form->end(array('label' => 'Actualizar Estado', 'class' => 'k-button')); ?>
				<?php echo $this->Form->button('Reset', array('type' => 'reset','class' => 'k-button')); ?>
				<!--<?php $options = array('url' => 'update_select','update' => 'select2');
				echo $this->ajax->observeField('select1',$options);?>-->
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
</script>