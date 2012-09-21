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

			

<table id="tabla">
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
    <?php unset($ubicaciones); ?>
</table>
			
			<?php echo $this->Html->link(
            	'Agregar Ubicacion', 
            	array('controller' => 'Ubicacions','action' => 'add',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button')
			);?>
			<br> 
			<br>
			<!--<table id="tabla">
			    <tr>
			        <th data-field="Nombre Componente">Nombre Componente</th>
			        <th data-field="Descripcion componente">Descripcion componente</th>
			        <th data-field="Meta">Meta</th>
			    </tr>			   
				<?php foreach ($metas as $met): ?>
			    <tr>
			        <td><?php echo $met['Componente']['nombrecomponente']; ?></td>
			        <td><?php echo $met['Componente']['descripcioncomponente']; ?></td>
			        <td><?php echo $met['Meta']['descripcionmeta']; ?></td>        
			    </tr>
			    <?php endforeach; ?>
			</table>-->
			<?php echo $this->Html->link(
            	'Agregar Componentes', 
            	array('controller' => 'Componentes','action' => 'add',$fichatecnicas['Fichatecnica']['idfichatecnica']),
            	array('class'=>'k-button')
			);?>
			
			<!--<?php Debugger::dump($fichatecnicas)?>-->
			<!--<?php Debugger::dump($metas)?>-->
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
<script>
	$(document).ready(function() {
    	$("#tabla").kendoGrid({
            	dataSource: {
	           		pageSize: 10,
            	},
            	sortable: true,
            	sortable: {
 			    	mode: "single", // enables multi-column sorting
        			allowUnsort: true
				},
				scrollable: false
            	
            	
        	});
        });
</script>