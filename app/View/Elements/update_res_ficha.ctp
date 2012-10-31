<?php if(isset( $nomproy)) {?>
<div class="k-content">
<ul id="panelBar">
	<li class="k-state-activate" style="margin: 0;" title="Click para Ver" >
		<span class="k-link k-state-selected">Proyecto: <?php echo $nomproy?></span>
		
		<div style="padding: 30px 20px;">
			<?php foreach ($fichatec as $ftec): ?>
				<b>Numero Proyecto: </b><?php echo $ftec['Proyecto']['numeroproyecto']?><br>
				<b>Monto Planeado: </b>$<?php echo number_format($ftec['Proyecto']['montoplaneado'],2)?><br>
				<b>Estado Proyecto: </b><?php echo $ftec['Proyecto']['estadoproyecto']?><br>
			<?php endforeach ?>
			<h3>Fuentes de Financiamiento</h3>
			<?php foreach ($financias as $fi): ?>
				<b>Fuente: </b><?php echo $fi['Fuentefinanciamiento']['nombrefuente']?><br>
				<b>Monto: </b>$<?php echo number_format($fi['Financia']['montoparcial'],2)?><br><br>
			<?php endforeach ?>
		</div>
	</li>
	<li style="margin: 0;" title="Click para Ver">Ubicaciones
		<div style="padding: 30px 20px;">
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
		</div>	
	</li>
	<li style="margin: 0;" title="Click para Ver">Datos Generales
		<div style="padding: 30px 20px;">
			<h3>Datos Generales</h3>
				<?php foreach ($fichatec as $ftec) 
				{ 
				?>
					<p align="justify">
					<b>Descripción:</b><br>
						<?php echo $ftec['Fichatecnica']['descripcionproyecto']?> <br><br>
					<b>Problemática:</b><br>
						<?php echo $ftec['Fichatecnica']['problematica']?><br><br>
					<b>Objetivo general:</b><br>
						<?php echo $ftec['Fichatecnica']['objgeneral']?><br><br>
					<b>Objetivo especifico:</b><br>
						<?php echo $ftec['Fichatecnica']['objespecifico']?><br><br>
					<b>Resultados esperados:</b><br>
						<?php echo $ftec['Fichatecnica']['resultadosesperados']?><br><br>
					<b>Empleos generados:</b><br>
						<?php echo number_format($ftec['Fichatecnica']['empleosgenerados'])?><br><br>
					<b>Beneficiarios:</b><br>
						<?php echo number_format($ftec['Fichatecnica']['beneficiarios'])?><br></p>
				<?php
				}
				?> 
		</div>	
	</li>
	<li style="margin: 0;" title="Click para Ver">Componentes y Metas
		<div style="padding: 30px 20px;">
			<h3>Componentes y metas</h3>
			<p>
				<?php 
				
					foreach ($component as $com) 
					{ 
					?>
						<p align="justify">
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
							echo "<br></p>";
					}	
					?>
				</p>
		</div>	
	</li>
</ul>
<?php } 
	else
		echo "No hay resultados";
?>
<!--
<h3>Proyecto: <?php echo $nomproy?></h3>
<p>
	<?php foreach ($fichatec as $ftec) 
	{ 
	?>
		<p align="justify">
		<b>Descripción:</b><br>
			<?php echo $ftec['Fichatecnica']['descripcionproyecto']?> <br><br>
		<b>Problemática:</b><br>
			<?php echo $ftec['Fichatecnica']['problematica']?><br><br>
		<b>Objetivo general:</b><br>
			<?php echo $ftec['Fichatecnica']['objgeneral']?><br><br>
		<b>Objetivo especifico:</b><br>
			<?php echo $ftec['Fichatecnica']['objespecifico']?><br><br>
		<b>Resultados esperados:</b><br>
			<?php echo $ftec['Fichatecnica']['resultadosesperados']?><br><br>
		<b>Empleos generados:</b><br>
			<?php echo $ftec['Fichatecnica']['empleosgenerados']?><br><br>
		<b>Beneficiarios:</b><br>
			<?php echo $ftec['Fichatecnica']['beneficiarios']?><br></p>
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
			<p align="justify">
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
				echo "<br></p>";
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
</div>
-->
<style>
	#tablas {
		width: 500px;
		margin-left: 30px;
	}
	
	#Proyecto, #Contrato {
		border-collapse: collapse;
		color: black;
	}
	
	#Proyecto .primerac, #Contrato .primerac {
		font-family: "Trebuchet MS", Arial, sans-serif;
		font-weight: bold;
		text-align: right;
		padding-right: 10px;
		min-width: 80px;
	}
	
	/* 
	Cusco Sky table styles
	written by Braulio Soncco http://www.buayacorp.com
	*/

	#tablagrid table, #tablagrid th, #tablagrid td {
		border: 1px solid #D4E0EE;
		border-collapse: collapse;
		font-family: "Trebuchet MS", Arial, sans-serif;
		color: #555;
	}
	
	#tablagrid caption {
		font-size: 150%;
		font-weight: bold;
		margin: 5px;
	}
	
	#tablagrid td, #tablagrid th {
		padding: 4px;
		text-align: center;
	}
	
	#tablagrid thead th {
		text-align: center;
		background: #E6EDF5;
		color: #4F76A3;
		font-size: 100% !important;
	}
	
	#tablagrid tbody th {
		font-weight: bold;
	}
	
	#tablagrid tbody tr { background: #FCFDFE; }
	
	#tablagrid tbody tr.odd { background: #F7F9FC; }
	
	#tablagrid table a:link {
		color: #718ABE;
		text-decoration: none;
	}
	
	#tablagrid table a:visited {
		color: #718ABE;
		text-decoration: none;
	}
	
	#tablagrid table a:hover {
		color: #718ABE;
		text-decoration: underline !important;
	}
	
	#tablagrid tfoot th, #tablagrid tfoot td {
		font-size: 100%;
		font-weight: bold;
	}

</style>

<script>
	
	$(document).ready(function() {
    $("#panelBar").kendoPanelBar({
    	expandMode:"single"
    });
 
});
</script>