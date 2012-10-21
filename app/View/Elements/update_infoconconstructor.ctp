<?php
	if(isset($info['Contratoconstructor']['codigocontrato']))
	{
		$codcon = $info['Contratoconstructor']['codigocontrato'];
		$nomcon = $info['Contratoconstructor']['nombrecontrato'];
		$moncon = $info['Contratoconstructor']['montooriginal'];
		$antcon = $info['Contratoconstructor']['anticipo'];
		$inicon = $info['Contratoconstructor']['fechainiciocontrato'];
		$fincon = $info['Contratoconstructor']['fechafincontrato'];
		$placon = $info['Contratoconstructor']['plazoejecucion'];
		$idecon = $info['Contratoconstructor']['idempresa'];
		$idpcon = $info['Contratoconstructor']['idpersona'];
		
	}
	else
	{
		$codcon = '';
		$nomcon = '';
		$moncon = '';
		$antcon = '';
		$inicon = '';
		$fincon = '';
		$placon = '';
		$idecon = '';
		$idpcon = '';
		
	}
	
	
	if(isset($info['Contratoconstructor']['detalleobras']))
		$obrcon=$info['Contratoconstructor']['detalleobras'];
	else 
		$obrcon='';
	?>
<li>
	<?php echo $this->Form->input('Contratoconstructor.codigocontrato', 
		array(
			'label' => 'Código del contrato:', 
			'class' => 'k-textbox',
			'id'=>'codigo',
			'value' => $codcon, 
			'placeholder' => 'Ej: 001-2012', 
			'div' => array('class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
        var codigo = new LiveValidation( "codigo", { validMessage: " " } );
        codigo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
        codigo.add(Validate.Format, { pattern: /___-____/i, failureMessage: "No puedes dejar este campo en blanco", negate: true } );
        codigo.add(Validate.Format, { pattern: /\d\d\d-\d\d\d\d/i, failureMessage: "El código de contrato debe tener 7 números"} );
    </script> 
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.nombrecontrato', 
		array(
			'label' => 'Título del contrato:', 
			'class' => 'k-textbox',
			'id'=>'nombrecontrato',
			'value' => $nomcon, 
			'placeholder' => 'Nombre del contrato', 
			'rows'=> 2, 
			'div' => array('class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
		var nombrecontrato= new LiveValidation( "nombrecontrato", { validMessage: " " } );
		nombrecontrato.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
	</script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.montocon', 
		array(
			'label' => 'Monto: ($)',
			'class' => 'k-textbox',  
			'id' => 'txmonto',
			'value' => $moncon,
			'type' => 'text',
			'placeholder' => 'Monto del contrato',
			'div' => array('id'=>'monto','class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
		var txmonto = new LiveValidation( "txmonto", { validMessage: " " , insertAfterWhatNode: "monto"  } );
        txmonto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.anticipo', 
		array(
			'label' => 'Anticipo: ($)',
			'class' => 'k-textbox',  
			'id' => 'txanticipo',
			'value' => $antcon,
			'type' => 'text',
			'placeholder' => 'Anticipo del contrato',
			'div' => array('id'=>'antici','class' => 'requerido'))); 
	?>
	<script type="text/javascript">
		var txanticipo = new LiveValidation( "txanticipo", { validMessage: " " , insertAfterWhatNode: "antici"} );
        txanticipo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.fechainicontrato', 
		array(
			'label' => 'Fecha inicio de vigencia:', 
			'id'	=> 'datePicker1',
			'value' => date('d/m/Y',strtotime($inicon)),
			'div' => array('id'=>'fechaini','class' => 'requerido'),
			'type'  => 'Text'
			));
		?>
		<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " , insertAfterWhatNode: "fechaini" } );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		            datePicker1.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		</script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.fechafincontrato', 
		array(
			'label' => 'Fecha fin de vigencia:', 
			'id'	=> 'datePicker2',
			'value' => date('d/m/Y',strtotime($fincon)),
			'div' => array('id'=>'fechafin','class' => 'requerido'),
			'type'  => 'Text'
			)); 
		?>
		
		<script type="text/javascript">
		            var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " , insertAfterWhatNode: "fechafin" } );
		            datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		        	datePicker2.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		</script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.plazoejecucion', 
		array(
			'label' => 'Plazo de ejecución:',
			'class' => 'k-textbox',  
			'id' => 'txplazo',
			'value' => $placon,
			'type'  => 'Text', 
			'placeholder' => 'Cantidad de días', 
			'div' => array('class' => 'requerido')
		));
		?>
	<script type="text/javascript">
		var txplazo= new LiveValidation( "txplazo", { validMessage: " " } );
		txplazo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		txplazo.add( Validate.Numericality,{ onlyInteger: true,
		   								   	notAnIntegerMessage: "Debe ser un número entero",
			            				 	notANumberMessage:"Debe ser un número"} );
		txplazo.add(Validate.Length, {minimum: 2, maximum: 3, 
	           							 tooShortMessage:"Longitud mínima de 2 dígitos",
	           							 tooLongMessage:"Longitud máxima de 3 dígitos"});
	</script>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.obras', 
		array(
			'label' => 'Obras a desarrollar:', 
			'class' => 'k-textbox',
			'value' => $obrcon,
			'rows' => 4, 
			'placeholder' => 'Descripción de obras'
			));
		?>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.empresas', 
		array(
			'label' => 'Empresa ejecutora:', 
			'id' => 'empresas',
			'value' => $idecon,
			'div' => array('id'=>'empeje','class' => 'requerido')
			));
		?>
	<script type="text/javascript">
		var empresas = new LiveValidation( "empresas", { validMessage: " " , insertAfterWhatNode: "empeje" } );
        empresas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
    <div id="errorempresa" class="LV_validation_message LV_invalid"></div>
</li>
<li>
	<?php echo $this->Form->input('Contratoconstructor.admin', 
		array(
			'label' => 'Administrador del contrato:', 
			'id' => 'admin',
			'class' => 'k-combobox',
			'value' => $idpcon,
			'div' => array('class' => 'requerido')
			)); 
		?>
	<script type="text/javascript">
		var admin = new LiveValidation( "admin", { validMessage: " " } );
        admin.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
    
</li>
<li  class="accept">
	<table>
		<tr>
			<td>
				<!--<button  type="submit" name="Modificar" id="boton_1" value="Modificar" dir="contratoconstructor_modificar" class="k-button" onclick="evaluarempresa()" />--></button>
				<?php echo $this->Form->end(array('label' => 'Modificar', 'class' => 'k-button')); ?>
			</td>
			<td>	
				<?php echo $this->Html->link('Regresar', 
						array('controller' => 'Mains','action' => 'index'),
						array('class'=>'k-button')); ?>
			</td>
		</tr>
	</table>
</li>					
					<?php echo $this->ajax->observeField( 'contratos',array(
			        		'url' => array( 'action' => 'update_infoconconstructor'),
			        		'update' => 'infoconconstructor'));  
					?>

<style scoped>

                .k-textbox {
                    width: 300px;
                    
                    
                }
				
				.k-textbox:focus{background-color: rgba(255,255,255,.8);}
				
				.k-combobox {
                    width: 200px;
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
				    display:none;
				}
					
				.LV_invalid {
				    color:#CC0000;
					clear:both;
               		display:inline-block;
               		margin-left: 155px; 
               
				}
				
				#errorempresa{
					display: none;
				}
				   
</style>
<script>
    $(document).ready(function() {
        var validator = $("#formulario").kendoValidator().data("kendoValidator"),
        status = $(".status");


	$("#txmonto").kendoNumericTextBox({
	     min: 0,
	     max: 999999999.99,
	     format: "c2",
	     decimals: 2,
	     spinners: false
	 });

	$("#txanticipo").kendoNumericTextBox({
	     min: 0,
	     max: 999999999.99,
	     format: "c2",
	     decimals: 2,
	     spinners: false
	 });
	 
    $("#empresas").kendoComboBox({
			optionLabel: "Seleccione empresa",
			dataTextField: "nombreempresa",
            dataValueField: "idempresa",
            filter: "contains",
			highLightFirst: false,
			ignoreCase: false,
			change: limpiaremp,
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Contratoconstructors/empresajson.json"
                            }
                        }
        });
        var empresas = $("#empresas").data("kendoDropDownList");
    
    $("#admin").kendoDropDownList({
			optionLabel: "Seleccione administrador",
			dataTextField: "nomcompleto",
            dataValueField: "idpersona",
            dataSource: {
                            type: "json",
                            transport: {
                                read: "/Contratoconstructors/adminjson.json"
                            }
                        }
        });
        var admin = $("#admin").data("kendoDropDownList");
	
	

	
	$("#codigo").mask("999-9999");
	
	function limpiaremp(){        
		$('#errorempresa').hide("slow");
	}	
	
	function filtrarDrop() {
		var startDate = start.value();
		var endDate = end.value();
			//alert('dafuq');
			/*proy.data("kendoDropDownList").dataSource.filter([
				     { field: "creacion", operator: "gte", value: startDate },
				     { field: "creacion", operator: "lte", value: endDate }
				]);
			*/
			
			//proy.data("kendoDropDownList").dataSource.filter({ field: "idproyecto", operator: "eq", value: 5});
	}
		
	
	function startChange() {
		var startDate = start.value();
		if (startDate) {
            startDate = new Date(startDate);
            startDate.setDate(startDate.getDate() + 1);
            end.min(startDate);
    	}
    }
	
	function endChange() {
		var endDate = end.value();
	    if (endDate) {
	        endDate = new Date(endDate);
	        endDate.setDate(endDate.getDate() - 1);
	        start.max(endDate);
	    }
	}

    var start = $("#datePicker1").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: startChange,
        close: filtrarDrop
    }).data("kendoDatePicker");
	
    var end = $("#datePicker2").kendoDatePicker({
        culture: "es-ES",
	   	format: "dd/MM/yyyy",
        change: endChange,
        close: filtrarDrop
    }).data("kendoDatePicker");
	
    start.max(end.value());
    end.min(start.value());
    
	});
    
</script>