<!-- /app/views/elements/update_infoinicio.ctp -->
<?php if(isset($informacion)){
	//Debugger::dump($informacion);
	foreach ($informacion as $inf): ?>
		<p><label>Nombre Contrato: </label> <?php echo $inf['nombrecontrato']; ?></p>
		<p><label>Fecha Inicio: </label><?php echo date('d/m/Y',strtotime( $inf['fechainiciocontrato'])); ?></p>
		<p><label>Fecha Fin: </label><?php echo date('d/m/Y',strtotime($inf['fechafincontrato'])); ?></p>
		<!--<p><label>Orden de Inicio: </label><?php echo date('d/m/Y',strtotime($inf['ordeninicio'])); ?></p>-->
	<?php endforeach; ?>

			
	<?php echo $this->Form->input('Contrato.ordeninicio', 
		array(
			'label' => 'Orden de Inicio:', 
			'id'	=> 'datePicker1',
			'type'  => 'Text',
			'div' => array('id' => 'ordeni','class' => 'requerido')
			)); ?>
	
	<script type="text/javascript">
        var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " ", insertAfterWhatNode: "ordeni" } );
        datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
        datePicker1.add(Validate.Format, { pattern: /^\d\d\/\d\d\/\d\d\d\d$/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
    </script> 


	<?php echo $this->Form->input('Contrato.userc', array('type' => 'hidden', 'value'=> $this->Session->read('User.username') )); ?>
	
	<li  class="accept">
		<table>
			<tr>
				<td><input type="submit" name="boton_2" id="boton_2" value="Registrar Orden de Inicio" dir="addordeninicio" class="k-button" /></td>
				<td>
					<?php echo $this->Html->link(
						'Regresar', 
						array('controller' => 'mains', 'action' => 'index'),
						array('class'=>'k-button')
					); ?>
				</td>
			</tr>
		</table>
	</li>
			
<?php } else { ?>
	<div style="margin: 10px auto; width: 400px">
	<?php echo 'No hay información disponible seleccione un contrato'; ?>
	</div>
<?php } ?>            


<style scoped>

                .k-textbox .k-dropdown {
                    width: 300px;
                    margin-left: 5px;
                    
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
                    color: gray;
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
               		margin-left: 160px; 
               
				}
				
				
				#error1, #error2  {
					margin:0 0 0 5px;
					color:#CC0000;
					clear:both;
               		display:none;
               		margin-left: 105px; 
				}
</style>
<script>
	$(document).ready(function () { 
		$("#datePicker1").kendoDatePicker({
			culture:"es-ES",
			<?php	if(isset($informacion['Contrato']['fechainiciocontrato'])) { echo "min: kendo.parseDate('".$informacion['Contrato']['fechainiciocontrato']."'),";}?>
		   	<?php	if(isset($informacion['Contrato']['fechafincontrato'])) { echo "max: kendo.parseDate('".$informacion['Contrato']['fechafincontrato']."'),";}?>
		   	<?php	if(isset($informacion['Contrato']['ordeninicio'])) { echo "value: kendo.parseDate('".$informacion['Contrato']['ordeninicio']."'),";}?>
    		format: "dd/MM/yyyy" //Define el formato de fecha
    	});
    	$("input[type=submit]").click(function() {
			var accion = $(this).attr('dir');
		    $('form').attr('action', accion);
		    $('form').submit();
		});
	});
</script>

