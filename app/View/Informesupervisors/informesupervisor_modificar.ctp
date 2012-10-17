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
			?> Control y seguimiento » Informe supervisión » Modificar
			
		</div>
	</div>
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<?php echo $this->Form->create('Informesupervisor',array('action' => 'informesupervisor_modificar')); ?>
		<ul>
			<h2>Modificar informe de supervisión</h2>
			<li>
				<label>Código de Contrato: </label> <?php echo $this->request->data['Contratosupervisor']['codigocontrato']; ?>
			</li>
			<li>
				<?php echo $this->Form->input('tituloinformesup', 
					array(
						'label' => 'Título del informe:', 
						'class' => 'k-textbox',
						'id'=>'titulo', 
						'placeholder' => 'Título del informe de supervisión', 
						'rows'=> '5',
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var titulo= new LiveValidation( "titulo", { validMessage: " " } );
					titulo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			
			<li>
				
				<?php echo $this->Form->input('fechas', 
					array(
						'label' => 'Fecha:', 
						'id' => 'fechas',
						'value'=> $this->request->data['Informesupervisor']['fechafinsupervision'],
						'div' => array('class' => 'requerido')
						)); 
					?>
				<script type="text/javascript">
					var fechas= new LiveValidation( "fechas", { validMessage: " " } );
					fechas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>	
				
			</li>
			<li>
				<?php echo $this->Form->input('plazoejecuciondias', 
					array(
						'label' => 'Plazo:',
						'class' => 'k-textbox',  
						'id' => 'txplazo',
						'type'  => 'Text', 
						'placeholder' => 'Cantidad de días de supervisión'
						));
					?>
				<script type="text/javascript">
					var txplazo= new LiveValidation( "txplazo", { validMessage: " " } );
					txplazo.add( Validate.Numericality,{ onlyInteger: true,
														notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('valoravancefinanciero', 
					array(
						'label' => 'Avance financiero: ($)',
						'class' => 'k-textbox',  
						'id' => 'txavfinanciero',
						'type' => 'text',
						'placeholder' => 'Valor monetario de avance',
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var txavfinanciero = new LiveValidation( "txavfinanciero", { validMessage: " " } );
		            txavfinanciero.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script>
			</li>
			<li>
				<?php echo $this->Form->input('porcentajeavancefisico', 
					array(
						'label' => 'Avance físico (%):',
						'class' => 'k-textbox',  
						'id' => 'txavfisico',
						'type'  => 'Text', 
						'placeholder' => 'Porcentaje de avance', 
						'div' => array('class' => 'requerido')
						));
					?>
				<script type="text/javascript">
					var txavfisico= new LiveValidation( "txavfisico", { validMessage: " " } );
					txavfisico.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					
				</script>
			</li>
				<?php echo $this->Form->input('idinformesupervision',array('type'=>'hidden'))?>
				<?php echo $this->Form->input('Contratosupervisor.codigocontrato',array('type'=>'hidden'))?>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Modificar informe', 'class' => 'k-button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link(
				            	'Regresar', 
				            	array('controller' => 'Informesupervisors','action' => 'informesupervisor_index'),
				            	array('class'=>'k-button')
							);?>
						</td>
					</tr>
				</table>
			</li>
		</ul>
	</div>
</div>

<style scoped>

    .k-textbox {
        width: 300px;
        
        
    }
	
	.k-textbox:focus{background-color: rgba(255,255,255,.8);}
	
	.k-combobox {
        
    }
    
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
	    font-weight:bold;
	    margin:0 0 0 5px;
	}
	
	.LV_valid {
	    color:#00CC00;
	}
		
	.LV_invalid {
	    color:#CC0000;
		clear:both;
   		display:inline-block;
   		margin-left: 170px; 
   
	}
	    
	.LV_valid_field,
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
                
                $("#txavfinanciero").kendoNumericTextBox({
				     min: 0,
				     max: 999999999.99,
				     format: "c2",
				     decimals: 2,
				     spinners: false
				 });

				$("#txavfisico").kendoNumericTextBox({
				     min: 0,
				     max: 100.00,
				     format: "n",
				     decimals: 2,
				     spinners: false
				 });
				
				$("#fechas").kendoComboBox({
			         //placeholder: "Seleccionar...",
			         //index: -1,
			        suggest: true,
			        
			        dataTextField: "fechafin",
        			dataValueField: "fechaavance",
			    });
		   		
				
				
				});
                
            </script>