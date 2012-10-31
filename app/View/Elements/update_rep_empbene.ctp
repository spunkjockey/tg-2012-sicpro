<?php
	if(!empty($proys))
	{
		if($proys != false)
		{
			?>
			<h3> Proyectos a cargo de la división: <?php echo $nomdiv?></h3>
			<p>Comprendidos entre el período del <?php echo $inicio?> al <?php echo $fin?></p>
			<div id= tablagrid>
			<table>
				<thead>
				<tr>
					<th data-field="Proyecto">Proyecto</th>
					<th data-field="numero">Número</th>
					<th data-field="beneficiarios">Beneficiarios</th>
					<th data-field="empleos">Empleos generados</th>
				</tr>
				<tr>
					<?php foreach ($proys as $pro): ?>
					<tr>
						<td width="300px" style="text-align: left;"><?php echo $pro['Proyembe']['nombreproyecto'];?></td>
						<td width="75px"><?php echo $pro['Proyembe']['numeroproyecto'];?></td>
						<td width="75px"><?php echo $pro['Proyembe']['beneficiarios'];?></td> 
						<td width="75px"><?php echo $pro['Proyembe']['empleosgenerados'];?></td>   
					</tr>
					<?php endforeach; ?>
				</tr>
				</thead>
			</table>
			</div>
			<ul>
			<li  class="accept">
				<?php echo $this->Form->input('Proyembe.iddivision', 
					array('type' => 'hidden',
						  'value'=> $proys[0]['Proyembe']['iddivision'])); ?>
				
				<?php 
					$fechaini = substr($inicio, 0, 2).substr($inicio, 3, 2).substr($inicio, -4);
					$fechafin = substr($fin, 0, 2).substr($fin, 3, 2).substr($fin, -4);
					echo $this->Html->link('Generar PDF', 
						array('controller' => 'Fichatecnicas','action' => 'fichatecnica_rep_empbene_pdf',
									$proys[0]['Proyembe']['iddivision'],
									$fechaini, 
									$fechafin),
						array('class'=>'k-button','target' => '_blank')); ?>
			</li>
		</ul>
		<?php unset($proys); ?>	
			<?php	
			}
		else
			{
				echo "<br>No existen coincidencias para la búsqueda<br>
						  Ingrese nuevos parámetros para realizar una nueva búsqueda";
			}	
		}
	else
		echo "<br>No existen coincidencias para la búsqueda<br>
				  Ingrese nuevos parámetros para realizar una nueva búsqueda";
?>

<style>
	
	
	#Proyecto {
		border-collapse: collapse;
		color: black;
	}
	
	#Proyecto .primerac {
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