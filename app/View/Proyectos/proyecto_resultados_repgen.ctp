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
			?> Reporte general de proyecto
			
		</div>
	</div>
<?php $this->end(); ?>

<div id="example" class="k-content">
	<div id="formulario">
		<?php echo $this->Form->create('Proyecto',array('action' => 'proyecto_resultados_repgen','target' => '_blank')); ?>

		
			<h3><?php echo $dataproy[0]['Proyecto']['nombreproyecto'];?></h3>
			<p>
				Número de proyecto: <?php echo $dataproy[0]['Proyecto']['numeroproyecto'];?><br>
				Estado actual: <?php echo $dataproy[0]['Proyecto']['estadoproyecto'];?><br>
				División responsable; <?php echo $dataproy[0]['Division']['divison'];?>
			</p>
		
		
		<h3>Financiamientos</h3>
			<table>
				<tr>
					<td width="200px">Fondo</td>
					<td width="200px">Monto destinado</td>
				</tr>
				<?php $totalfuente = 0;?>
				<?php foreach ($fuentes as $ff): ?>
				<tr>
					<td>
						<?php echo $ff['Fuentefinanciamiento']['nombrefuente'];?>
					</td>
					<td>
						<?php echo "$".number_format($ff['Financia']['montoparcial'],2);?>
						<?php $totalfuente = $totalfuente + $ff['Financia']['montoparcial'];?>
					</td>
				</tr>
				<?php endforeach; ?>
				<?php unset($fuentes); ?>	
			</table>
		<br>
		Fondo total destinado: <?php echo "$".number_format($totalfuente,2); ?>
		<h3>Contratos</h3>
			<table>
				<tr>
					<td>Código</td>
					<td>Tipo</td>
					<td>Monto original</td>
					<td>Plazo de ejecución</td>
					<td>Orden de inicio</td>
					<td>Administrador</td>
				</tr>
				<?php foreach ($contratos as $con): ?>
					<tr>
						<td><?php echo $con['Contrato']['codigocontrato'];?></td>
						<td><?php echo $con['Contrato']['tipocontrato'];?></td>
						<td><?php echo "$".number_format($con['Contrato']['montooriginal'],2);?></td>
						<td><?php echo $con['Contrato']['plazoejecucion'];?></td>
						<td><?php 
								if(isset($con['Contrato']['ordeninicio']))
									echo date('d/m/Y',strtotime($con['Contrato']['ordeninicio']));
								else
									echo "No definida";
								?></td>
						<td><?php echo $con['Persona']['nombrespersona']." ".$con['Persona']['apellidospersona']?></td>
					</tr>
					<?php endforeach; ?>
				<?php unset($contratos); ?>
			</table>
		<ul>
			<li  class="accept">
			<table>
				<tr>
					<td>
						<?php echo $this->Form->input('Proyecto.idproyecto', 
							array('type' => 'hidden',
								  'value'=> $dataproy[0]['Proyecto']['idproyecto'])); ?>
						<?php echo $this->Form->end(array('label' => 'Generar PDF', 
									'class' => 'k-button', 'id' => 'button')); ?>
					</td>
					<td>
						<?php echo $this->Html->link('Regresar', 
							array('controller' => 'Proyectos','action' => 'proyecto_reportegeneral'),
							array('class'=>'k-button')); ?>
					</td>
				</tr>
			</table>
			</li>
			
		</ul>
	</div>
</div>

<style scoped>

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
                    width: 200px;
                    text-align: right;
                    margin-right: 5px;
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
                
            </style>
            
<script>
                $(document).ready(function() {
                    
                    var validator = $("#formulario").kendoValidator().data("kendoValidator"),
                    status = $(".status");

                    $("#button").click(function() {
                        if (validator.validate()) {
                        	save();  
                        } 
                    });
                
                
            </script>