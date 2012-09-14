<!-- File: /app/View/Fichatecnicas/view.ctp -->

<ul>

			<p><b>Problematica: </b><?php echo $ficha['Fichatecnica']['problematica']; ?></p>

			<p><b>Objetivo General: </b><?php echo $ficha['Fichatecnica']['objgeneral']; ?></p>

			<p><b>Objetivo Especifico:</b><?php echo ($ficha['Fichatecnica']['objespecifico']); ?></p>
			
			<p><b>Descripcion del Proyecto:</b><?php echo ($ficha['Fichatecnica']['descripcionproyecto']); ?></p>
			
			<p><b>Empleos Generados: </b><?php echo ($ficha['Fichatecnica']['empleosgenerados']); ?></p>
			
			<p><b>Beneficiarios: </b><?php echo ($ficha['Fichatecnica']['beneficiarios']); ?></p>
			
			<p><b>Resultados Esperados: </b><?php echo ($ficha['Fichatecnica']['resultadosesperados']); ?></p>
			
			<table title="Ubicacion">
				<thead>
					<td>Direccion</td>
					<td>Municipio</td>
					<td>Departamento</td>
				</thead>
				<tr>
					<td>
						1
					</td>
					<td>
						2
					</td>
					<td>
						3
					</td>
				</tr>
			</table>
			
			<?php echo $this->Html->link(
            	'Agregar Ubicacion', 
            	array('controller' => 'Ubicacions','action' => 'add'/*, $emp['Empresa']['idempresa']*/),
            	array('class'=>'k-button')
			);?>