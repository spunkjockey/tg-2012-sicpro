<?php
	if(!empty($proys))
	{
		if($proys != false)
		{
			?>
			<h3> Proyectos a cargo de la división: <?php echo $nomdiv?></h3>
			<p>Comprendidos entre el período del <?php echo $inicio?> al <?php echo $fin?></p>
			<table>
				<tr>
					<td>Proyecto</td>
					<td>Número</td>
					<td>Beneficiarios</td>
					<td>Empleos generados</td>
				</tr>
				<tr>
					<?php foreach ($proys as $pro): ?>
					<tr>
						<td width="200px"><?php echo $pro['Proyembe']['nombreproyecto'];?></td>
						<td width="75px"><?php echo $pro['Proyembe']['numeroproyecto'];?></td>
						<td width="75px"><?php echo $pro['Proyembe']['beneficiarios'];?></td> 
						<td width="75px"><?php echo $pro['Proyembe']['empleosgenerados'];?></td>   
					</tr>
					<?php endforeach; ?>
				</tr>
			</table>
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
				echo "No existen coincidencias para la búsqueda";
			}	
		}
	else
		echo "No existen coincidencias para la búsqueda";
?>