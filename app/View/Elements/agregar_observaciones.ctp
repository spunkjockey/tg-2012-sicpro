<?php
	if(isset($datos['User']['idpersona']))
	{
		$idper=$datos['User']['idpersona'];
		$rolus=$datos['Rol']['rol'];
	}
	else {
		$idper='';
		$rolus='';
	}
	echo "<h3>Observaciones:</h3>";
	switch ($rolus) {
		case 'Director':
		case 'Admincon':
		case 'Tecproy':
			echo "<li>";
			echo $this->Form->input('Informetecnico.observ', 
					array(
						'label' => 'Observaciones:', 
						'id' => 'obser',
						'class'=>'k-textbox',
						'placeholder'=>'Ingrese sus observaciones a este informe',
						'rows'=>'5',
						'div' => array('class' => 'requerido')
						));
				 
			echo "</li>";
			echo $this->Form->input('Informetecnico.idpersona', 
					array(
					'value'=>$idper,
					'type' => 'hidden'));
			echo "<li  class=\"accept\">";
				echo $this->Form->end(array('label' => 'Agregar observación', 'class' => 'k-button'));
			echo "</li>";
			
			
			break;
		default:
			echo "<strong>Lo sentimos!</strong><br>
				   Usted no se encuentra habilitado para ingresar observaciones a este informe técnico";
			break;
	}
?>
<script type="text/javascript">
					var obser= new LiveValidation( "obser", { validMessage: " " } );
					obser.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
				</script>
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
                
				});
                
            </script>