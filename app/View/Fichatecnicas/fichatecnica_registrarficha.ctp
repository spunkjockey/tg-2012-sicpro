<!-- File: /app/View/Fichatecnicas/fichatecnica_registrarficha.ctp -->
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

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Registrar Ficha Tecnica</h2>
		<div style="color: #959595;">Paso 1 de 2</div>
				<?php echo $this->Form->create('Fichatecnica'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'div' => array('id' => 'proyo', 'class' => 'requerido'),
						'class' => 'k-dropdownlist',
						'id' => 'proyectos'
						
					)); ?>
					<div id="errorproyecto" class="LV_validation_message LV_invalid"></div>
				<script type="text/javascript">
		            var proyectos = new LiveValidation( "proyectos", { validMessage: " ", insertAfterWhatNode: "proyo" } );
		            proyectos.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('problematica', 
					array(
						'label' => 'Problematica: ', 
						'div' => array('class' => 'requerido'),
						'class' => 'k-textbox', 
						'placeholder' => 'Problematica',
						'id' => 'problematica',
						"rows"=>"5"
						)); ?>
				<script type="text/javascript">
		            var problematica = new LiveValidation( "problematica", { validMessage: " " } );
		            problematica.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('objgeneral', 
					array(
						'label' => 'Objetivo General: ', 
						'div' => array('class' => 'requerido'),
						'class' => 'k-textbox', 
						'placeholder' => 'Objetivo General',
						'id' => 'objgeneral',
						"rows"=>"5"
						)); ?>
				<script type="text/javascript">
		            var objgeneral = new LiveValidation( "objgeneral", { validMessage: " " } );
		            objgeneral.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('objespecifico', 
					array(
						'label' => 'Objetivo Especifico: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Objetivo Especifico',
						"rows"=>"5"
						)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('descripcionproyecto', 
					array(
						'label' => 'Descripcion : ',
						'div' => array('class' => 'requerido'), 
						'class' => 'k-textbox', 
						'placeholder' => 'Descipcion',
						"rows"=>"6",
						'id' => 'descripcion'
						)); ?>
				<script type="text/javascript">
		            var descripcion = new LiveValidation( "descripcion", { validMessage: " " } );
		            descripcion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('empleosgenerados', 
					array(
						'label' => 'Empleos Generados: ', 
						'div' => array('id' => 'empleos','class' => 'requerido'),
						'id' => 'numero1',
						'type' => 'text',
						'class' => 'k-textbox', 
						'placeholder' => 'Empleos Generados',
						'maxlength' => "7"
						)); ?>
				<script type="text/javascript">
		            var numero1 = new LiveValidation( "numero1", { validMessage: " ", insertAfterWhatNode: "empleos" } );
		            numero1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            numero1.add( Validate.Numericality,{ onlyInteger: true,
					   								   	notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('beneficiarios', 
					array(
						'label' => 'Beneficiarios: ', 
						'div' => array('id' => 'benefic', 'class' => 'requerido'),
						'type' => 'text',
						'id' => 'numero2',
						'class' => 'k-textbox', 
						'placeholder' => 'Beneficiarios',
						'maxlength' => "7"
						)); ?>
				<script type="text/javascript">
		            var numero2 = new LiveValidation( "numero2", { validMessage: " ", insertAfterWhatNode: "benefic" } );
		            numero2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            numero2.add( Validate.Numericality,{ onlyInteger: true,
					   								   	notAnIntegerMessage: "Debe ser un número entero",
						            				 	notANumberMessage:"Debe ser un número"} );
		        </script> 
			</li>
			<li>
				<?php echo $this->Form->input('resultadosesperados', 
					array(
						'label' => 'Resultados: ', 
						'class' => 'k-textbox', 
						'placeholder' => 'Resultados Esperados',
						"rows"=>"7"
						)); ?>
			</li>							
			
			<li  class="accept">
				<?php echo $this->Form->input('userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
				<table>
				<tr><td style="margin-left: 10px;">
				<?php echo $this->Form->end(array('label' => 'Registrar Ficha', 'class' => 'k-button', 'id' => 'submit')); ?>
				</td>
				<td>
				<?php echo $this->Html->link('Regresar',
					array('controller' => 'Mains', 'action' => 'index'),array('id' => 'regresar','class'=>'k-button')); 
				?>	
				</td></tr>
				</table>
				</li>
            
            <li class="status">
            </li>
		</ul>
	</div>
</div>

<style scoped>

                .k-textbox {
                    width: 400px;
               }
				
				.k-dropdownlist{
                    width: 400px;
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
                    margin-right: 5px;
                    
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
                    padding-left: 165px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                
               
               
                
				
				.LV_validation_message{
				    /*font-weight:bold;*/
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
               		margin-left: 165px; 
               
				}

                #errorproyecto {
                	display: none;
                }
</style>

<script>
	$(document).ready(function() {
    
    	$("form").submit(function() {
			var proyecto = proyo.value();
		    if (proyecto) {
		        //alert("exito");
		        $("#errorproyecto").hide();
		        return true;
		    } else {
		    	//alert("fracaso");
		    	//$("#errorproyecto").hide();
		    	$("#errorproyecto").show().text("Seleccione un proyecto para continuar");
		    	return false;
		    }
		});
    	
    	var proyo =$("#proyectos").kendoDropDownList({
			optionLabel: "Seleccione Proyecto",
            dataTextField: "nombreproyecto",
            dataValueField: "idproyecto",
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Fichatecnicas/proyectojson.json"
                            }
                       }
             
        }).data("kendoDropDownList");
       
      
       $("#numero1").kendoNumericTextBox({
                min: 0000001,
				max: 9999999,
				format : "{0:n0}",
				decimals: 0,
				placeholder: "Ej. 100",
				spinners: false
            });
            
       $("#numero2").kendoNumericTextBox({
                min: 0000001,
				max: 9999999,
				format : "{0:n0}",
				decimals: 0,
				placeholder: "Ej. 100",
				spinners: false
            });
            
        $("#problematica").focusIn(function() {
        	$("#errorproyecto").hide();
        });
    });                    
</script>