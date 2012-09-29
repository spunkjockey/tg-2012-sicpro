<!-- File: /app/View/Avanceprogramados/index.ctp -->

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
			?> » Control y Seguimiento 
			» Programación de Avances 
			» Registrar Avance
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<h2>Programación de Avance</h2>
		<?php echo $this->Form->create('Avanceprogramado'); ?>
		<ul>
			<li>
				<?php echo $this->Form->input('proyectos',
					array(
						'label' => 'Proyectos:', 
						'id' => 'selectpro'
					)); ?>
			</li>
			<li>
				<?php echo $this->Form->input('contratos',
					array(
						'label' => 'Contratos:', 
						'id' => 'selectcon'
					)); ?>
			</li>
			<li>
				<h3>Programación</h3>
			</li>
			<li>
				<table border="0" style="margin-left: 50px">
					<tr>
						<td colspan="4" align="left"><a class="k-button"><span class="k-icon k-i-plus"></span>Agregar Avance</a></td>
					</tr>
					<tr align="center">
						<th> Plazo </th>
						<th> Fecha </th>
						<th> Porcentaje </th>
						<th> Avance </th>
					</tr>
					
					<tr align="center">
						<td> <input type="text" class="k-textbox" name="Avanceprogramado.0.plazoejecuciondias" style="width:60px;margin:0" /> </td>
						<td> <input type="text" id="fechaav0" name="Avanceprogramado.0.fechaavance"/> </td>
						<td> <input type="text" class="k-textbox" id="porcenav0" name="Avanceprogramado.0.porcentajeavfisicoprog" style="width:60px;margin:0"/> </td>
						<td> <input type="text" id="montoav0" name="Avanceprogramado.0.montoavfinancieroprog" style="width:100px;margin:0"/> </td>
						<td><a class="k-button"><span class="k-icon k-i-pencil"></span></a> <a class="k-button"><span class="k-icon k-i-close"></span></a></td>
					</tr>

					
				</table>
			</li>
			<li  class="accept">
				<table>
					<tr>
						<td>
							<?php echo $this->Form->end(array('label' => 'Agregar Avances', 'class' => 'k-button', 'id' => 'button')); ?>
						</td>
						<td>
							<?php echo $this->Html->link('Cancelar',array('controller' => 'Mains', 'action' => 'index'),array('class'=>'k-button')); ?>
						</td>
					</tr>
				</table>
			</li>
		</ul>
	</div>
	<div id="window">
    	Content of the Window
        <?php echo $this->Html->link(
        	'Detalles', 
        	array('controller' => 'empresas', 'action' => 'view', 1),
        	array('class'=>'k-button')
		);?>
	</div>
	<button id="openButton" class="k-button">Open Window</button>
</div>
		
			<style scoped>

                .k-textbox {
                    width: 11.8em;
                }
				
				#formulario {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }

                #formulario h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }
                
                #tablafinancia h3 {
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
                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .required label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
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

                    $("#button").click(function() {
                        if (validator.validate()) {
                        	save();  
                        } 
                    });
                    
                    $("#selectpro").kendoComboBox({
                    	highLightFirst: true,
                    	filter: "contains"
                    });
                    
                    $("#selectcon").kendoComboBox({
                    	highLightFirst: true,
                    	filter: "contains"
                    });
                    
                    //var combobox = $("#selectpro").data("kendoComboBox");
                    //combobox.list.width(400);
                    
                    //var combobox = $("#selectfufin").data("kendoComboBox");
                    //combobox.list.width(400);
                    $("#fechaav0").kendoDatePicker({
		   				culture: "es-ES",
		   				format: "dd/MM/yyyy" //Define el formato de fecha
					});
                    
                    $("#montoav0").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					max: 999999999,
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
                    
                    $("#fechaav1").kendoDatePicker({
                    	culture: "es-ES",
		   				format: "dd/MM/yyyy" //Define el formato de fecha
					});
                    
                    $("#montoav1").kendoNumericTextBox({
                        format: "c",
                        decimals: 2,
                        min: 0,
    					max: 999999999,
    					placeholder: "Ej. 10000",
    					spinners: false
                    });
                    

    var win = $("#window").kendoWindow({
	    draggable: false,
	    modal: true,
        title: "Centered Window",
        visible: false
    }).data("kendoWindow");

$("#openButton").click(function(){
    var win = $("#window").data("kendoWindow");
    win.center();
    win.open();
 });

                    
                    
                
                });
                
                
            </script>
