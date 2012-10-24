<h3> Personal asignado al proyecto: <?php echo $nombre?></h3>
<p>Contratos de construcción</p>
<?php
	if(!empty($construc))
	{
		if($construc != false)
		{
			foreach ($construc as $con):
				echo "<p>";
						echo "Título: ".$con['Contratoconstructor']['nombrecontrato']."<br>";
						echo "Código: ".$con['Contratoconstructor']['codigocontrato']."<br>";
						echo "Administrador: ".$con['Persona']['nombrespersona']." ".$con['Persona']['apellidospersona']."<br>";
						echo "Técnicos asignados:<br>";
						echo "<blockquote>";
							if(!empty($tecnicos))
							{
								foreach ($tecnicos as $tec) 
								{
									if ($con['Contratoconstructor']['idcontrato']==$tec['Nombratecnico']['idcontrato'])	
										echo $tec['Nombratecnico']['nomcompleto']."<br>";
								}
							}
				echo "</blockquote></p>";
			endforeach;
		}
	}
	if(!empty($supervi))
	{
		echo "<p>Contratos de construcción</p>";
		foreach ($supervi as $sup) 
		{
			echo "<p>";
				echo "Título: ".$sup['Contratosupervisor']['nombrecontrato']."<br>";
				echo "Código: ".$sup['Contratosupervisor']['codigocontrato']."<br>";
				echo "Supervisa al contrato".$sup['Contratosupervisor']['con_idcontrato']."<br>";
				echo "Administrador: ".$sup['Persona']['nombrespersona']." ".$con['Persona']['apellidospersona']."<br>";
		}
	}
?>
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
			