<?php 
	
	if(!empty($departamentos))
	{
		if(!empty($municipios))
		{
		?>
			<h3> Zonas beneficiadas con el desarrollo de proyectos</h3>
			<p>Comprendidos entre el período del <?php echo $inicio?> al <?php echo $fin?></p>
			<h4>Departamentos</h4>
			<div id=tablagrid>
			<table>
				<thead>
					<tr>
						<th data-field="depto">Departamentos</th>
						<th data-field="cant">Proyectos realizados</th>
					</tr>
					<tr>
						<?php foreach ($departamentos as $dep): ?>
						<tr>
							<td width="200px"><?php echo $dep['departamento'];?></td>
							<td width="125px"><?php echo $dep['cantidep'];?></td>
						</tr>
						<?php endforeach; ?>
					</tr>
				</thead>
			</table>
			</div>
			<h4>Municipios</h4>
			<div id=tablagrid>
				<table>
					<thead>
						<tr>
							<th data-field="municipio">Municipio</th>
							<th data-field="cant">Proyectos realizados</th>
						</tr>
						<tr>
							<?php foreach ($municipios as $mun): ?>
							<tr>
								<td width="200px"><?php echo $mun['municipio'];?></td>
								<td width="125px"><?php echo $mun['cantmuni'];?></td>
							</tr>
							<?php endforeach; ?>
						</tr>
					</thead>
				</table>
			</div>
			<ul>
				<li  class="accept">
					<?php 
						$fechaini = substr($inicio, 0, 2).substr($inicio, 3, 2).substr($inicio, -4);
						$fechafin = substr($fin, 0, 2).substr($fin, 3, 2).substr($fin, -4);
						echo $this->Html->link('Generar PDF', 
							array('controller' => 'Ubicacions','action' => 'ubicacion_rep_proy_depmuni_pdf',
										$fechaini, 
										$fechafin),
							array('class'=>'k-button','target' => '_blank')); ?>
				</li>
			</ul>
	<?php 
		}
		else
		{
			echo "<br>No existen coincidencias<br>
					  Verifique los parámetros para realizar una nueva búsqueda";
		}	
	}
	else
	{
		echo "<br>No existen coincidencias<br>
				  Verifique los parámetros para realizar una nueva búsqueda";
	}
?>

<style>
	

	#tablagrid table, #tablagrid th, #tablagrid td {
		border: 1px solid #D4E0EE;
		border-collapse: collapse;
		font-family: "Trebuchet MS", Arial, sans-serif;
		color: #555;
	}
	
	#tablagrid caption {
		font-size: 100%;
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