<?php
	if(isset($info['Contratosupervisor']['codigocontrato']))
	{
		$codcon = $info['Contratosupervisor']['codigocontrato'];
		$nomcon = $info['Contratosupervisor']['nombrecontrato'];
		$moncon = $info['Contratosupervisor']['montooriginal'];
		$caicon = $info['Contratosupervisor']['cantidadinformes'];
		$coidcon = $info['Contratosupervisor']['con_idcontrato'];
		$inicon = $info['Contratosupervisor']['fechainiciocontrato'];
		$fincon = $info['Contratosupervisor']['fechafincontrato'];
		$placon = $info['Contratosupervisor']['plazoejecucion'];
		$idecon = $info['Contratosupervisor']['idempresa'];
		$idpcon = $info['Contratosupervisor']['idpersona'];
		
	}
	else
	{
		$codcon = '';
		$nomcon = '';
		$moncon = '';
		$caicon = '';
		$coidcon = '';
		$inicon = '';
		$fincon = '';
		$placon = '';
		$idecon = '';
		$idpcon = '';
		
	}
	
	
	if(isset($info['Contratosupervisor']['detalleobras']))
		$obrcon=$info['Contratosupervisor']['detalleobras'];
	else 
		$obrcon='';
	?>
<li>
	<?php echo $this->Form->input('Contratosupervisor.conidcontratos', 
		array(
			'label' => 'Contrato de construcción a supervisar:', 
			'id' => 'construccion',
			'value'=>$coidcon,
			'div' => array('id'=>'contraasu','class' => 'requerido'))); ?>
	<script type="text/javascript">
		var construccion= new LiveValidation( "construccion", { validMessage: " " , insertAfterWhatNode: "contraasu" } );
		construccion.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
	</script>
</li>

<li>
	<?php echo $this->Form->input('Contratosupervisor.codigocontrato', 
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
	<?php echo $this->Form->input('Contratosupervisor.nombrecontrato', 
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
	<?php echo $this->Form->input('Contratosupervisor.montocon', 
		array(
			'label' => 'Monto: ($)',
			'class' => 'k-textbox',  
			'id' => 'txmonto',
			'value' => $moncon,
			'type' => 'text',
			'placeholder' => 'Monto del contrato',
			'div' => array('id'=>'montocont','class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
		var txmonto = new LiveValidation( "txmonto", { validMessage: " " , insertAfterWhatNode: "montocont"} );
        txmonto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>

<li>
	<?php echo $this->Form->input('Contratosupervisor.fechainicontrato', 
		array(
			'label' => 'Fecha inicio de vigencia:', 
			'id'	=> 'datePicker1',
			'value' => date('d/m/Y',strtotime($inicon)),
			'div' => array('id'=>'fchaini','class' => 'requerido'),
			'type'  => 'Text'
			));
		?>
		<script type="text/javascript">
		            var datePicker1 = new LiveValidation( "datePicker1", { validMessage: " " , insertAfterWhatNode: "fchaini"} );
		            datePicker1.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		            datePicker1.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		            datePicker1.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		</script> 
</li>
<li>
	<?php echo $this->Form->input('Contratosupervisor.fechafincontrato', 
		array(
			'label' => 'Fecha fin de vigencia:', 
			'id'	=> 'datePicker2',
			'value' => date('d/m/Y',strtotime($fincon)),
			'div' => array('id'=>'fchafin','class' => 'requerido'),
			'type'  => 'Text'
			)); 
		?>
		<script type="text/javascript">
		    var datePicker2 = new LiveValidation( "datePicker2", { validMessage: " " , insertAfterWhatNode: "fchafin"} );
		    datePicker2.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		    datePicker2.add(Validate.Format, { pattern: /\d\d\/\d\d\/\d\d\d\d/, failureMessage: "La Fecha debe contener un formato un formato DD/MM/AAAA"  } );
		   	datePicker2.add(Validate.Length,{is:10, wrongLengthMessage:"Longitud debe ser de 10 caracteres. Formato DD/MM/AAAA"});
		</script>
</li>
<li>
	<?php echo $this->Form->input('Contratosupervisor.plazoejecucion', 
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
	<?php echo $this->Form->input('Contratosupervisor.cantinf', 
		array(
			'label' => 'Cantidad informes:',
			'class' => 'k-textbox',  
			'id' => 'txcanti',
			'value'=>$caicon,
			'type' => 'text',
			'placeholder' => 'Cantidad ej: 3',
			'div' => array('class' => 'requerido'))); ?>
	<script type="text/javascript">
		var txcanti= new LiveValidation( "txcanti", { validMessage: " " } );
		txcanti.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
		txcanti.add( Validate.Numericality,{ onlyInteger: true,
		   								   	notAnIntegerMessage: "Debe ser un número entero",
			            				 	notANumberMessage:"Debe ser un número"} );
		txcanti.add(Validate.Length, {minimum: 1, maximum: 2, 
	           							 tooShortMessage:"Longitud mínima de 1 dígitos",
	           							 tooLongMessage:"Longitud máxima de 2 dígitos"});
	</script>
</li>
<li>
	<?php echo $this->Form->input('Contratosupervisor.obras', 
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
	<?php echo $this->Form->input('Contratosupervisor.empresas', 
		array(
			'label' => 'Empresa ejecutora:', 
			'id' => 'empresas',
			'class' => 'k-combobox',
			'value' => $idecon,
			'div' => array('id'=>'empsup','class' => 'requerido')
			));
		?>
	<script type="text/javascript">
		var empresas = new LiveValidation( "empresas", { validMessage: " " , insertAfterWhatNode: "empsup"} );
        empresas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('Contratosupervisor.admin', 
		array(
			'label' => 'Administrador del contrato:', 
			'id' => 'admin',
			'class' => 'k-combobox',
			'value' => $idpcon,
			'div' => array('id'=>'admcon','class' => 'requerido')
			)); 
		?>
	<script type="text/javascript">
		var admin = new LiveValidation( "admin", { validMessage: " " , insertAfterWhatNode: "admcon"} );
        admin.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
    
</li>
<li  class="accept">
	<table>
		<tr>
			<td>
				<?php echo $this->Form->end(array('label' => 'Modificar contrato', 'class' => 'k-button')); ?>
			</td>
			<td>
				<?php echo $this->Html->link('Regresar', 
					array('controller' => 'Mains','action' => 'index'),
					array('class'=>'k-button')); ?>
			</td>
		</tr>
	</table>
</li>
					




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
	 
    $("#empresas").kendoDropDownList({
			optionLabel: "Seleccione empresa",
			dataTextField: "nombreempresa",
            dataValueField: "idempresa",
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
	
	$("#codigo").mask("999-9999");
	});
	var construccion = $("#construccion").kendoDropDownList({
        autoBind: false,
        cascadeFrom: "proyectos",
        optionLabel: "Seleccione contrato",
        dataTextField: "codigocontrato",
        dataValueField: "idcontrato",
        dataSource: {
            type: "json",
            transport: {
                read: "/Contratosupervisors/conidcontratojson.json"
            }
        }
    }).data("kendoDropDownList");
    
</script>