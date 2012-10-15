<li>
	<?php 
		if(isset($num['Proyecto']['numeroproyecto']))
			$numero = $num['Proyecto']['numeroproyecto']; 
		else
		   $numero = '';
	?>
			
		<!--- aqui se actualizara el campo de numero de proyecto con el cambio de proyecto --->
	<?php echo $this->Form->input('Proyecto.numeroproyecto', 
		array(
			'label' => 'Ingrese número de proyecto:', 
			'id' => 'numero',
			'value'=>$numero,
			'class' => 'k-textbox',  
			'placeholder' => 'Número del proyecto', 
			'div' => array('class' => 'requerido'))); ?>
	<script type="text/javascript">
		var numero = new LiveValidation( "numero", { validMessage: " " } );
        numero.add(Validate.Presence, { failureMessage: "No puedes dejar este campo en blanco" } );
        numero.add( Validate.Numericality, { onlyInteger: true,
        								   notAnIntegerMessage: "Debe ser un número sin parte decimal",
        								   notANumberMessage:"Debe ser un número"} );
        numero.add(Validate.Length, {minimum: 4, maximum: 6, 
        							 tooShortMessage:"Longitud mínima de 4 dígitos",
        							 tooLongMessage:"Longitud máxima de 6 dígitos"});
        
    </script>
    	
	
</li>

