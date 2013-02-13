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
						'div' => array('id' => 'proyo','class' => 'requerido')
						)); 
				?>
				<script type="text/javascript">
					var proyectos= new LiveValidation( "proyectos", { validMessage: " ", insertAfterWhatNode: "proyo" } );
					proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('contratos', 
					array(
						'label' => 'Contrato de supervisión:', 
						'id' => 'contratos',
						'div' => array('id' => 'contro','class' => 'requerido'))); ?>
				<script type="text/javascript">
					var contratos= new LiveValidation( "contratos", { validMessage: " ", insertAfterWhatNode: "contro" } );
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
				
				<?php echo $this->Form->input('fechas', 
					array(
						'label' => 'Fecha evaluación avance:', 
						'id' => 'fechas',
						'div' => array('id' => 'fecho', 'class' => 'requerido')
						)); 
					?>
				<script type="text/javascript">
					var fechas= new LiveValidation( "fechas", { validMessage: " ", insertAfterWhatNode: "fecho" } );
					fechas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>	
				
			</li>
			
			<li>
				<?php echo $this->Form->input('tituloinforme', 
					array(
						'label' => 'Título del informe:', 
						'class' => 'k-textbox',
						'id'=>'titulo', 
						'placeholder' => 'Título del informe de supervisión', 
						'rows'=> 2,
						'maxlength'=>100, 
						'div' => array('class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var titulo= new LiveValidation( "titulo", { validMessage: " " } );
					titulo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
			</li>
			
			<li>
				<?php echo $this->Form->input('plazoejecucion', 
					array(
						'label' => 'Plazo:',
						'class' => 'k-textbox',  
						'id' => 'txplazo',
						'type'  => 'Text', 
						'placeholder' => 'ej. 45',
						'maxlength' => 4,
						'div' => array('id' => 'plazo','class' => 'requerido')
						));
					?>
				<script type="text/javascript">
					var txplazo= new LiveValidation( "txplazo", { validMessage: " ", insertAfterWhatNode: "plazo" } );
					txplazo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					txplazo.add( Validate.Numericality,{ onlyInteger: true,
														notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
				</script>
			</li>
			<li>
				<?php echo $this->Form->input('avfisico', 
					array(
						'label' => 'Avance físico:',
						'class' => 'k-textbox',  
						'id' => 'txavfisico',
						'type'  => 'Text', 
						'maxlength' => 5,
						'placeholder' => 'Porcentaje de avance', 
						'div' => array('id' => 'porce','class' => 'requerido')
						));
					?>
				<script type="text/javascript">
					var txavfisico= new LiveValidation( "txavfisico", { validMessage: " ", insertAfterWhatNode: "porce" } );
					txavfisico.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					txavfisico.add( Validate.Numericality,{ minimum: 0, maximum: 100, tooLowMessage: "El porcentaje no puede ser menor a 0 %", tooHighMessage: "El porcentaje no debe ser mayor al 100 %", notANumberMessage:"Debe ser un número"} );
		            
				</script>
				
			</li>
			<li>
				<?php echo $this->Form->input('valoravancefinanciero', 
					array(
						'label' => 'Avance financiero: ',
						'class' => 'k-textbox',  
						'id' => 'txavfinanciero',
						'type' => 'text',
						'placeholder' => 'ej. 1000',
						'maxlength' => 12,
						'div' => array('id' => 'monto','class' => 'requerido')
						)); ?>
				<script type="text/javascript">
					var txavfinanciero = new LiveValidation( "txavfinanciero", { validMessage: " ", insertAfterWhatNode: "monto" } );
		            txavfinanciero.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
					txavfinanciero.add( Validate.Numericality, { minimum: 0, maximum: 999999999.99, tooLowMessage: "El monto no puede ser menor a $0.00", tooHighMessage: "El monto no puede ser mayor a $999,999,999.99", notANumberMessage: "Debe ser un número" } );
		        		        
		        </script>
			</li>
			
				<?php echo $this->Form->input('idinformesupervision',array('type'=>'hidden'))?>
				
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Registrar', 'class' => 'k-button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Regresar', 
				            	array('controller' => 'Mains','action' => 'index'),
				            	array('class'=>'k-button'));?>
						</td>
					</tr>
				</table>
				
			
				 
			</li>
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
   		margin-left: 155px; 
   
	}
	    

</style>

<script>
	$(document).ready(function() {
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
			    
			    var fechas = $("#fechas").kendoDropDownList({
			                        autoBind: false,
			                        cascadeFrom: "contratos",
			                        optionLabel: "Seleccione fecha",
			                        dataTextField: "fechafin",
			                        dataValueField: "fechaavance",
			                        dataSource: {
			                            type: "json",
			                            transport: {
			                                read: "/Informesupervisors/fechasjson.json"
			                            }
			                        }
			                    }).data("kendoDropDownList");
			        
			    $("#txavfinanciero").kendoNumericTextBox({
				     min: 0,
				     
				     format: "c2",
				     decimals: 2,
				     spinners: false
				 });
				 
				 $("#txplazo").kendoNumericTextBox({
				     min: 0,
				     format: "n0",
				     spinners: false
				 });


				$("#txavfisico").kendoNumericTextBox({
				     min: 0,
				     
				     format: "n",
				     decimals: 2,
				     spinners: false
				 });
				
				
				
				
				});
                
            </script>