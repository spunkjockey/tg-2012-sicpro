<!-- File: /app/View/Estimacions/estimacion_detalles.ctp -->
<?php $this->start('menu');
	switch ($this->Session->read('User.idrol')) {
		case 9:
	        echo $this->element('menu/menu_all');
	        break;
	    case 8:
	        echo $this->element('menu/menu_observer');
	        break;
	    case 7:
	        echo $this->element('menu/menu_jefeplan');
	        break;
		case 6:
	        echo $this->element('menu/menu_tecproy');
	        break;
	    case 5:
	        echo $this->element('menu/menu_tecplan');
	        break;
	    case 4:
	        echo $this->element('menu/menu_adminsys');
	        break;
		case 3:
	        echo $this->element('menu/menu_admincon');
	        break;
	    case 2:
	        echo $this->element('menu/menu_adminproy');
	        break;
	    case 1:
	        echo $this->element('menu/menu_director');
	        break;			
	}
$this->end(); ?>


<?php $this->start('breadcrumb'); ?>
	
	<div id="menuderastros">
		<div id="rastros">
			
			<?php
			echo $this->Html->image("home.png", array(
	    		"alt" => "Inicio",
	    		'url' => array('controller' => 'mains'),
				'width' => '30px',
				'class' => 'homeimg'
			));
			?> » Control y Seguimiento » Detalles Estimación de Avance
		</div>
	</div>
<?php $this->end(); ?>
<div id="example" class="k-content">
	<div id="formulario">
		<h2>Datos de estimación de avance</h2>

		<?php
			if($estima!=false)
				foreach ($estima as $est) 
				{
				?>
					<h3><?php echo $est['Estimacion']['tituloestimacion'] ?></h3>
						<table>
							<tr>
								<td>Perteneciente al contrato </td>
								<td><?php echo $info['Contratoconstructor']['codigocontrato']; ?></td>
							</tr>
							<tr>
								<td>Período de la estimación </td>
								<td><?php echo "Del ".date('d/m/Y',strtotime($est['Estimacion'] ['fechainicioestimacion']))." al".date('d/m/Y',strtotime($est['Estimacion'] ['fechafinestimacion'])) ?></td>
							</tr>
							<tr>
								<td>Realizada</td>
								<td><?php echo date('d/m/Y',strtotime($est['Estimacion'] ['fechaestimacion']));?></td>
							</tr>
							<tr>
								<td>Monto estimado </td>
								<td>$<?php echo number_format($est['Estimacion']['montoestimado'],2); ?> </td>
							</tr>
							<tr>
								<td>Porcentaje estimado de avance</td>
								<td><?php echo number_format($est['Estimacion']['porcentajeestimadoavance'],2)?>% </td>
							</tr>
						</table>
						
					
					
				<?php	
				}
			else 
				echo "No hay información asociada a esta estimación";
		?>
		<h2>Archivos asociados a la estimación</h2>
				<?php
					$results = $this->Upload->listing ('Estimacion', $idestimacion);
					$directory = $results['directory'];
					$baseUrl = $results['baseUrl'];
					$files = $results['files'];
					echo "<table>";
					foreach ($files as $file) {
					    $type = pathinfo($file, PATHINFO_EXTENSION);
					    $f = basename($file);
					    $url = $baseUrl . "/$f";
					    echo "<tr><td>";
					    echo "<img src='" . Router::url("/") . "ajax_multi_upload/img/fileicons/$type.png' /> <a href='$url'>" . $f . "</a><br />\n";
						echo "</td></tr>";
					}
					echo "</table>";
				?>
			
			<table>
			<tr><td>			    
				<?php echo $this->Html->link('Regresar', array('controller' => 'Estimacions','action' => 'estimacion_consultar'),
            	array('class'=>'k-button'));?> </td></tr>
			</table>
			
			
	</div>
</div>
 <style scoped>

                .k-textbox {
                    width: 300px;   
                }
                
				form .requerido label:after {
                	font-size: 1.4em;
					color: #e32;
					content: '*';
					display:inline;
				}
                
			
                #formulario {
                    width: 600px;
                    /*height: 323px;*/
                    margin: 15px 0;
                    padding: 10px 20px 20px 0px;
                    /*background: url('../../content/web/validator/ticketsOnline.png') transparent no-repeat 0 0;*/
                }

                #formulario h3 {
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
                    width: 140px;
                    text-align: right;
                    margin-right: 5px;
                    
                }


                .accept, .status {
                	padding-top: 15px;
                    padding-left: 150px;
                }

                
            </style>