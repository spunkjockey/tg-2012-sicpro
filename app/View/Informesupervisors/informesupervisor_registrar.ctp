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
			?> Control y seguimiento » Informe supervisión » Registrar
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<?php echo $this->Form->create('Informesupervisor'); ?>
		<ul>
			<h2>Registrar informe de supervisión</h2>
			<li>
				<?php echo $this->Form->input('proyectos', 
					array(
						'label' => 'Proyecto:', 
						'id' => 'proyectos',
						'div' => array('class' => 'requerido')
						)); 
				?>
				<script type="text/javascript">
					var proyectos= new LiveValidation( "proyectos", { validMessage: " " } );
					proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('contratos', 
					array(
						'label' => 'Contrato de supervisión:', 
						'id' => 'contratos',
						'div' => array('class' => 'requerido'))); ?>
				<script type="text/javascript">
					var contratos= new LiveValidation( "contratos", { validMessage: " " } );
					contratos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<div id=infoproy>
					<!--- Aqui se carga el nombre del proyecto seleccionado-->
				</div>
				<div id=infocontrato>
				<!--- Aqui se muestran datos sobre el contrato seleccionado -->
				</div>
			</li>
			<li>
				<?php echo $this->Form->input('tituloinforme', 
					array(
						'label' => 'Título del informe:', 
						'class' => 'k-textbox',
						'id'=>'titulo', 
						'placeholder' => 'Título del informe de supervisión', 
						'rows'=> 2, 
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var titulo= new LiveValidation( "titulo", { validMessage: " " } );
					titulo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('fechainicio', 
					array(
						'label' => 'Fecha inicio:', 
						'id'	=> 'datePicker1',
						'div' => array('class' => 'requerido'),
						'type'  => 'Text'
						));
					?>
				<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		            datePicker1.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		        </script>
		         <?php if ($this->Form->isFieldError('fechainiciosupervision')) {
				    echo $this->Form->error('fechainiciosupervision');
				} ?>
			</li>
			<li>
				<?php echo $this->Form->input('fechafin', 
					array(
						'label' => 'Fecha fin:', 
						'id'	=> 'datePicker2',
						'div' => array('class' => 'requerido'),
						'type'  => 'Text'
						)); 
					?>
				<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        	datePicker2.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		        </script>
		        <?php if ($this->Form->isFieldError('fechafinsupervision')) {
				    echo $this->Form->error('fechafinsupervision');
				} ?>
			</li>
			<li>
				<?php echo $this->Form->input('plazoejecucion', 
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
				<?php echo $this->Form->input('avfinanciero', 
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
				<?php echo $this->Form->input('avfisico', 
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
				
			<li  class="accept">
				<?php echo $this->Form->end(array('label' => 'Registrar informe', 'class' => 'k-button')); ?>
			</li>
				 <?php echo $this->Html->link(
            	'Regresar', 
            	array('controller' => 'Informesupervisors','action' => 'informesupervisor_index'),
            	array('class'=>'k-button')
			);?>
			
				<?php echo $this->ajax->observeField( 'proyectos',array(
			        		'url' => array( 'action' => 'update_nomproyecto'),
			        		'update' => 'infoproy'));  
					?>
				
				<?php echo $this->ajax->observeField( 'contratos',array(
			        		'url' => array( 'action' => 'update_infocontrato'),
			        		'update' => 'infocontrato'));  
					?>	
		</ul>
	</div>
</div>

<style scoped>

    .k-textbox {
        width: 300px;
        
        
    }
	
	.k-textbox:focus{background-color: rgba(255,255,255,.8);}
	
	.k-combobox {
        width: 300px;
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
                
                $("#proyectos").kendoDropDownList({
            			optionLabel: "Seleccione proyecto",
            			dataTextField: "numeroproyecto",
			            dataValueField: "idproyecto",
			            dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Informesupervisors/proyectosjson.json"
			                            }
			                        }
			        });
			        var proyectos = $("#proyectos").data("kendoDropDownList");
			        
			    var contratos = $("#contratos").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "proyectos",
			                        optionLabel: "Seleccione contrato",
			                        dataTextField: "codigocontrato",
			                        dataValueField: "idcontrato",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Informesupervisors/contratosjson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
			        
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
				
				
				$("#datePicker1").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				$("#datePicker2").kendoDatePicker({
		   			format: "dd/MM/yyyy",
		   			culture: "es-ES"
		   		});
				
				
				});
                
            </script>