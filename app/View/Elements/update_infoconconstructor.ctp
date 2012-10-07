<!---
<?php
							if(isset($num['Proyecto']['numeroproyecto']))
								$numero = $num['Proyecto']['numeroproyecto']; 
							else
							   $numero = '';
						?>
--->
	<?php Debugger::dump($info); ?>
<li>
	<?php echo $this->Form->input('codigocontrato', 
		array(
			'label' => 'Código contrato:', 
			'class' => 'k-textbox',
			'id'=>'codigo',
			'value' => $info['Contratoconstructor']['codigocontrato'], 
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
	<?php echo $this->Form->input('nombrecontrato', 
		array(
			'label' => 'Título del contrato:', 
			'class' => 'k-textbox',
			'id'=>'nombrecontrato',
			'value' => $info['Contratoconstructor']['nombrecontrato'], 
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
	<?php echo $this->Form->input('montocon', 
		array(
			'label' => 'Monto: ($)',
			'class' => 'k-textbox',  
			'id' => 'txmonto',
			'value' => $info['Contratoconstructor']['montooriginal'],
			'type' => 'text',
			'placeholder' => 'Monto del contrato',
			'div' => array('class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
		var txmonto = new LiveValidation( "txmonto", { validMessage: " " } );
        txmonto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('anticipo', 
		array(
			'label' => 'Anticipo: ($)',
			'class' => 'k-textbox',  
			'id' => 'txanticipo',
			'value' => $info['Contratoconstructor']['anticipo'],
			'type' => 'text',
			'placeholder' => 'Anticipo del contrato',
			'div' => array('class' => 'requerido'))); 
	?>
	<script type="text/javascript">
		var txanticipo = new LiveValidation( "txanticipo", { validMessage: " " } );
        txanticipo.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('fechainicontrato', 
		array(
			'label' => 'Fecha inicio de vigencia:', 
			'id'	=> 'datePicker1',
			'value' => date('d/m/Y',strtotime($info['Contratoconstructor']['fechainiciocontrato'])),
			'div' => array('class' => 'requerido'),
			'type'  => 'Text'
			));
		?>
</li>
<li>
	<?php echo $this->Form->input('fechafincontrato', 
		array(
			'label' => 'Fecha fin de vigencia:', 
			'id'	=> 'datePicker2',
			'value' => date('d/m/Y',strtotime($info['Contratoconstructor']['fechafincontrato'])),
			'div' => array('class' => 'requerido'),
			'type'  => 'Text'
			)); 
		?>
</li>
<li>
	<?php echo $this->Form->input('plazoejecucion', 
		array(
			'label' => 'Plazo de ejecución:',
			'class' => 'k-textbox',  
			'id' => 'txplazo',
			'value' => $info['Contratoconstructor']['plazoejecucion'],
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
	<?php echo $this->Form->input('obras', 
		array(
			'label' => 'Obras a desarrollar:', 
			'class' => 'k-textbox',
			'value' => $info['Contratoconstructor']['detalleobras'],
			'rows' => 4, 
			'placeholder' => 'Descripción de obras'
			));
		?>
</li>
<li>
	<?php echo $this->Form->input('empresas', 
		array(
			'label' => 'Seleccione empresa:', 
			'id' => 'empresas',
			'value' => $info['Contratoconstructor']['idempresa'],
			'div' => array('class' => 'requerido')
			));
		?>
	<script type="text/javascript">
		var empresas = new LiveValidation( "empresas", { validMessage: " " } );
        empresas.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>
<li>
	<?php echo $this->Form->input('admin', 
		array(
			'label' => 'Seleccione administrador:', 
			'id' => 'admin',
			'value' => $info['Contratoconstructor']['idpersona'],
			'div' => array('class' => 'requerido')
			)); 
		?>
	<script type="text/javascript">
		var admin = new LiveValidation( "admin", { validMessage: " " } );
        admin.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
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
	
	
	$("#datePicker1").kendoDatePicker({
		format: "dd/MM/yyyy",
		culture: "es-ES"
	});
	$("#datePicker2").kendoDatePicker({
		format: "dd/MM/yyyy",
		culture: "es-ES"
	});
	
	$("#codigo").mask("999-9999");
	});
    
</script>