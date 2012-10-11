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
        								   notAnIntegerMessage: "Debe ser un número entero",
        								   notANumberMessage:"Debe ser un número"} );
        numero.add(Validate.Length, {minimum: 4, maximum: 6, 
        							 tooShortMessage:"Longitud mínima de 4 dígitos",
        							 tooLongMessage:"Longitud máxima de 6 dígitos"});
        
    </script>
    	
	
</li>

<li  class="accept">
	
	<?php echo $this->Form->end(array('label' => 'Asignar número proyecto', 'class' => 'k-button')); ?>
	<?php echo $this->Html->link('Regresar', 
						array('controller' => 'Proyectos','action' => 'proyecto_listado'),
						array('class'=>'k-button')); ?>
</li>