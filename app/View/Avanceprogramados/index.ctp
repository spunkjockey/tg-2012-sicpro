<!-- File: /app/View/Avanceprogramados/index.ctp -->

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
				<table border="0" style="margin-left: 50px">
					<tr align="center">
						<th> Plazo </th>
						<th> Fecha </th>
						<th> Porcentaje </th>
						<th> Avance </th>
					</tr>
					
					<tr align="center">
						<td> <input type="text" class="k-textbox" name="Avanceprogramado.0.plazoejecuciondias" style="width:60px;margin:0" /> </td>
						<td> <input type="text" id="fechaav0" name="Avanceprogramado.0.fechaavance"/> </td>
						<td> <input type="text" id="porcenav0" name="Avanceprogramado.0.porcentajeavfisicoprog" style="width:60px;margin:0"/> </td>
						<td> <input type="text" id="montoav0" name="Avanceprogramado.0.montoavfinancieroprog" style="width:100px;margin:0"/> </td>
					</tr>

					<tr align="center">
						<td> <input type="text" class="k-textbox" name="Avanceprogramado.1.plazoejecuciondias" style="width:60px;margin:0" /> </td>
						<td> <input type="text" id="fechaav1" name="Avanceprogramado.1.fechaavance"/> </td>
						<td> <input type="text" id="porcenav1" name="Avanceprogramado.1.porcentajeavfisicoprog" style="width:60px;margin:0"/> </td>
						<td> <input type="text" id="montoav1" name="Avanceprogramado.1.montoavfinancieroprog" style="width:100px;margin:0"/> </td>
						<td><img src="images/close.gif" alt="Eliminar"></td>
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
                    
                    $("#porcenav0").kendoNumericTextBox({
                        format: "p",
                        min: 0,
    					max: 100,
    					placeholder: "Ej. 35.20",
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
                    
                    $("#porcenav1").kendoNumericTextBox({
                        format: "p",
                        min: 0,
    					max: 100,
    					placeholder: "Ej. 35.20",
    					spinners: false
                    });               
                	        
                
                });
                
                
            </script>
