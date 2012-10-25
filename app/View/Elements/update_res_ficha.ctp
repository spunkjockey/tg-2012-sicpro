<h3>Proyecto: <?php echo $nomproy?></h3>
<p>
	<?php foreach ($fichatec as $ftec) 
	{ 
	?>
		<b>Descripción:</b><br>
			<?php echo $ftec['Fichatecnica']['descripcionproyecto']?> <br>
		<b>Problemática:</b><br>
			<?php echo $ftec['Fichatecnica']['problematica']?><br>
		<b>Objetivo general:</b><br>
			<?php echo $ftec['Fichatecnica']['objgeneral']?><br>
		<b>Objetivo especifico:</b><br>
			<?php echo $ftec['Fichatecnica']['objespecifico']?><br>
		<b>Resultados esperados:</b><br>
			<?php echo $ftec['Fichatecnica']['resultadosesperados']?><br>
		<b>Empleos generados:</b><br>
			<?php echo $ftec['Fichatecnica']['empleosgenerados']?><br>
		<b>Beneficiarios:</b><br>
			<?php echo $ftec['Fichatecnica']['beneficiarios']?><br>
	<?php
	}
	?> 
</p>

<h3>Componentes y metas</h3>
<p>
	<?php 
	
		foreach ($component as $com) 
		{ 
		?>
			<b>Componente: </b><?php echo $com['Componente']['nombrecomponente']?><br>
			<b>Descripción: </b><?php echo $com['Componente']['descripcioncomponente']?><br>
			<?php 
				$i=0;
				foreach ($metas as $met) 
				{
					if  ($com['Componente']['idcomponente']==$met['Componente']['idcomponente'])
						{
							$i++;
							if($i==1)
								echo "<b>Metas:</b><br>".$met['Meta']['descripcionmeta']."<br>";
							else 
								echo $met['Meta']['descripcionmeta']."<br>";
						}
				}
				echo "<br>";
		}	
		?>
</p>	
<h3>Ubicación</h3>
	<?php if(!empty($ubicaciones)) 
			{
				?>
<p>
	<?php 
		foreach ($ubicaciones as $ubi) 
		{
	?>
			<b>Dirección: </b><?php echo $ubi['Ubicacion']['direccion']?><br>
			<b>Municipio: </b><?php echo $ubi['Municipio']['municipio']?><br>
			<b>Departamento: </b><?php echo $ubi['Departamento']['departamento']?><br><br>
	<?php
		}
	?>
</p>
	<?php 
			}
		else
			echo "No disponible";
	?>


	
<ul>
	<li  class="accept">
	<?php echo $this->Html->link('Regresar', 
							array('controller' => 'Mains','action' => 'index'),
							array('class'=>'k-button')); ?>
	</li>
</ul>