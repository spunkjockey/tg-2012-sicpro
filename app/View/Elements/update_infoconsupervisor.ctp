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
			'div' => array('class' => 'requerido'))); ?>
	<script type="text/javascript">
		var construccion= new LiveValidation( "construccion", { validMessage: " " } );
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
			'div' => array('class' => 'requerido')
			)); 
	?>
	<script type="text/javascript">
		var txmonto = new LiveValidation( "txmonto", { validMessage: " " } );
        txmonto.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
</li>

<li>
	<?php echo $this->Form->input('Contratosupervisor.fechainicontrato', 
		array(
			'label' => 'Fecha inicio de vigencia:', 
			'id'	=> 'datePicker1',
			'value' => date('d/m/Y',strtotime($inicon)),
			'div' => array('class' => 'requerido'),
			'type'  => 'Text'
			));
		?>
</li>
<li>
	<?php echo $this->Form->input('Contratosupervisor.fechafincontrato', 
		array(
			'label' => 'Fecha fin de vigencia:', 
			'id'	=> 'datePicker2',
			'value' => date('d/m/Y',strtotime($fincon)),
			'div' => array('class' => 'requerido'),
			'type'  => 'Text'
			)); 
		?>
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
			'div' => array('class' => 'requerido')
			));
		?>
	<script type="text/javascript">
		var empresas = new LiveValidation( "empresas", { validMessage: " " } );
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
			'div' => array('class' => 'requerido')
			)); 
		?>
	<script type="text/javascript">
		var admin = new LiveValidation( "admin", { validMessage: " " } );
        admin.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
    </script>
    
</li>
<li  class="accept">
					<?php echo $this->Form->end(array('label' => 'Modificar contrato', 'class' => 'k-button')); ?>
				</li>
					<?php echo $this->Html->link('Regresar', 
										array('controller' => 'Mains','action' => 'index'),
										array('class'=>'k-button')); ?>




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