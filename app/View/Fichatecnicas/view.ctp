<!-- File: /app/View/Fichatecnicas/view.ctp -->

<ul>
			<h3>Ficha Tecnica</h3>
			<p><b>Problematica: </b><?php echo $fichatecnicas['Fichatecnica']['problematica']; ?></p>

			<p><b>Objetivo General: </b><?php echo $fichatecnicas['Fichatecnica']['objgeneral']; ?></p>

			<p><b>Objetivo Especifico:</b><?php echo ($fichatecnicas['Fichatecnica']['objespecifico']); ?></p>
			
			<p><b>Descripcion del Proyecto:</b><?php echo ($fichatecnicas['Fichatecnica']['descripcionproyecto']); ?></p>
			
			<p><b>Empleos Generados: </b><?php echo ($fichatecnicas['Fichatecnica']['empleosgenerados']); ?></p>
			
			<p><b>Beneficiarios: </b><?php echo ($fichatecnicas['Fichatecnica']['beneficiarios']); ?></p>
			
			<p><b>Resultados Esperados: </b><?php echo ($fichatecnicas['Fichatecnica']['resultadosesperados']); ?></p>
			
			<!--<?php Debugger::dump($fichatecnicas);?>-->

			

<table id="grid">
    <tr>
        <th data-field="direccion">Direccion</th>
        <th data-field="departamento">Departamento</th>
        <th data-field="municipio">Municipio</th>
    </tr>			   
	<?php foreach ($ubicaciones as $ubi): ?>
    <tr>
        <td><?php echo $ubi['Ubicacion']['direccion']; ?></td>
        <td><?php echo $ubi['Departamento']['departamento']; ?></td>
        <td><?php echo $ubi['Municipio']['municipio']; ?></td>        
    </tr>
    <?php endforeach; ?>
    <?php unset($empresas); ?>
</table>
			
			<?php echo $this->Html->link(
            	'Agregar Ubicacion', 
            	array('controller' => 'Ubicacions','action' => 'add',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button')
			);?>
			
			<table title="Componentes" border='1'>
				<thead>
					<td>Nombre Componente</td>
					<td>Descripcion</td>
					<td>Metas</td>
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
            	'Agregar Componentes', 
            	array('controller' => 'Componentes','action' => 'add',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button')
			);?>
			
			<?php Debugger::dump($fichatecnicas)?>
<style scoped>
                .k-textbox {
                    width: 11.8em;
                }
				
				#formulario {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }

                h3 {
                    font-weight: normal;
                    font-size: 1.4em;
                    border-bottom: 1px solid #ccc;
                }

                #formulario ul {
                    list-style-type: none;
                    margin: 0;
                    padding: 0;
                }
                
                #formulario li {
                    margin: 10px 0 0 0;
                }

                label {
                    display: inline-block;
                    width: 150px;
                    text-align: right;
                    margin-right: 5px; 
                }
                
                .etiqueta {
                    display: inline-block;
                    width: 150px;
                    
                    margin-right: 5px; 
                }
                
                
                form .required label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}
                
                .required {
                    font-weight: bold;
                }

                .accept, .status {
                	padding-top: 15px;
                    padding-left: 150px;
                }

                .valid {
                    color: green;
                }

                .invalid {
                    color: red;
                }
                
                span.k-tooltip {
                    margin-left: 6px;
                }
                
                #tablafinancia {
                    width: 600px;
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                }
</style>