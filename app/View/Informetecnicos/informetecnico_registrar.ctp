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
			?> Control y seguimiento » Informe técnico » Registrar informe técnico 
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar informe técnico</h2>
		<?php echo $this->Form->create('Contratosupervisor'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('contratos',array(
							'label' => 'Seleccione código de Contrato:', 
							'id' => 'selectcon',
							'required')); ?>
			</li>
			<li>
				Nombre proyecto: 
			</li>
			<li>
				Descripción:
			</li>
			<li>
				<?php echo $this->Form->input('fechainicontrato', 
					array(
						'label' => 'Fecha de visita:', 
						'id'	=> 'datePicker1',
						'type'  => 'Text')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('antecedentes', 
					array(
						'label' => 'Antecedentes:', 
						'class' => 'k-textbox', 
						'rows' => 4, 
						'placeholder' => 'Descripción de antecedentes')); ?>
			</li>
			<li>
				<?php echo $this->Form->input('anotaciones', 
					array(
						'label' => 'Anotaciones:', 
						'class' => 'k-textbox', 
						'rows' => 4, 
						'placeholder' => 'Observaciones de la visita')); ?>
			</li>
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar informe', 'class' => 'k-button')); ?>
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
                
				$("#selectcon").kendoComboBox({
					index: 0,
			        suggest: true,
			        filter: 'none'
				});
				$("#datePicker1").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				
				
				
				});
                
</script>		
