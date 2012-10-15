<?php
	if(isset($info['Informetecnico']['antecedentes']))
	{
		$antec=$info['Informetecnico']['antecedentes'];
		$anota=$info['Informetecnico']['anotacion'];
	}
	else {
		$antec='';
		$anota='';
	}
?>
<li>
	<h3>Contenido informe:</h3> 
	<p><strong>Antecedentes</strong>:<br>
		<?php echo $antec?>
	</p>
</li>
<li>
	<p><strong>Anotaciones:</strong><br>
		<?php echo $anota?></p>
</li>