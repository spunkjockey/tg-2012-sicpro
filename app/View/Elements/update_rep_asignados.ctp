<?php if(!empty($nombre)) { ?> 
	<h3> Personal asignado al proyecto: <?php echo $nombre?></h3>
	<h4>Contratos de construcción</h4>
	<?php if(!empty($construc)) {
		if($construc != false) { ?>
			<table border="0px" width="600px">
				<?php foreach ($construc as $con) { ?>
					<tr> <td id="chead"><?php	echo "Título: "; ?> </td><td> <?php echo $con['Contratoconstructor']['nombrecontrato']; ?> </td></tr> 
					<tr> <td id="chead"><?php	echo "Código: "; ?> </td><td> <?php echo $con['Contratoconstructor']['codigocontrato']; ?> </td></tr>
					<tr> <td id="chead"><?php	echo "Administrador: "; ?> </td><td> <?php echo $con['Persona']['nombrespersona']." ".$con['Persona']['apellidospersona']; ?> </td></tr>
					<tr> <td id="chead"><?php	echo "Técnicos asignados:";  ?> </td></tr>
	 				<tr> <td id="chead"><?php 	if(!empty($tecnicos))	{
	 									foreach ($tecnicos as $tec) {
	 										echo '<ol>';
	 										if ($con['Contratoconstructor']['idcontrato']==$tec['Nombratecnico']['idcontrato'])	
	 											echo '<tr><td></td><td><li>'.$tec['Nombratecnico']['nomcompleto'].'</li></td></tr>';
	 									}	echo '</ol>';
	 								} ?>
					</tr>
					<tr height="50px"></tr>
				<?php } ?>
			</table>
			<?php }
		if(!empty($supervi))
		{
			echo "<h4>Contratos de supervisión</h4>"; ?>
			<table border="0px" width="600px">
			<?php foreach ($supervi as $sup) { ?>
				<tr> <td id="chead"><?php	echo "Título: "; ?> </td><td> <?php echo $sup['Contratosupervisor']['nombrecontrato']; ?> </td></tr>
				<tr> <td id="chead"><?php	echo "Código: "; ?> </td><td> <?php echo $sup['Contratosupervisor']['codigocontrato']; ?> </td></tr>
				<tr> <td id="chead"><?php	echo "Administrador: "; ?> </td><td> <?php echo $sup['Persona']['nombrespersona']." ".$con['Persona']['apellidospersona']; ?> </td></tr>
				<tr> 
					<td id="chead"><?php	echo "Supervisa al contrato"; ?> </td>
					<?php if($construc != false) {  
						foreach ($construc as $con) { 
							if($sup['Contratosupervisor']['con_idcontrato']==$con['Contratoconstructor']['idcontrato']) ?>
								<td> <?php echo $con['Contratoconstructor']['codigocontrato'] ?> </td>
					<?php	}
					} ?>
				</tr>
				
			<?php } ?>
			</table>
		<?php } ?>
	<ul>
				<li  class="accept">
					<?php echo $this->Form->input('Nombramiento.idproyecto', 
						array('type' => 'hidden',
							  'value'=> $idproyecto)); ?>
					
					<?php 
						echo $this->Html->link('Generar PDF', 
							array('controller' => 'Nombramientos','action' => 'nombramiento_reporte_asignados_pdf',
										$idproyecto),
							array('class'=>'k-button','target' => '_blank')); ?>
				</li>
			</ul>
		<?php }
			} else { ?>	
			<div id="noresults">No hay asignaciones en este proyecto</div>
		<?php } ?>

<style>
	

	#chead {
		width: 150px;
		font-family: "Trebuchet MS", Arial, sans-serif;
		font-size: 100%;
		font-weight: bold;
		margin: 5px;
	}
	
	
	#noresults {
		margin-left: 40px;
	}
	


</style>