<!-- File: /app/View/Informsupervisors/informesupervisor_resultado.ctp -->

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
			?> » Control y Seguimiento » Consultar Informe Supervisor
			
		</div>
	</div>
<?php $this->end(); ?>
<!--<?php Debugger::dump($infosupervision);?>-->

<div id="example" class="k-content">
	<div id="formulario">
<?php if(isset($infosupervision)) { ?>

		<h3>Datos de Informe Supervisión</h3>

<?php foreach ($infosupervision as $ifs): ?>
	<h4><?php echo $ifs['Informesupervisor']['tituloinformesup'] ?></h4>
	<strong>Fecha Fin: </strong><?php echo  date('d/m/Y',strtotime($ifs['Informesupervisor']['fechafinsupervision'])) ;?><br />
		<strong>Pazo Ejecución: </strong><?php echo $ifs['Informesupervisor']['plazoejecuciondias'] ;?><br />
	<strong>Avance Fisico: </strong><?php echo $ifs['Informesupervisor']['porcentajeavancefisico'] ;?>%<br />
	<strong>Avance Financiero: </strong> $<?php echo $ifs['Informesupervisor']['valoravancefinanciero'] ;?><br />
	
<?php
	$idsup = $ifs['Informesupervisor']['idinformesupervision'] ;
 endforeach ?>


		<h3>Archivos asociados</h3>
				<?php
					
					$results = $this->Upload->listing ('Informesupervisor', $idsup);
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
				
				
<?php	
}
else {
	echo "No hay Informacion para ese Informe de Supervisión.";
}?>
	<?php echo $this->Html->link('Regresar', 
           	array('controller' => 'Informesupervisors','action' => 'informesupervisor_consultar'),
           	array('class'=>'k-button'));
	?>

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