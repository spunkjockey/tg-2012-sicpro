<script src="/app/webroot/js/jquery.treeview/lib/jquery.cookie.js" type="text/javascript"></script>
<script src="/app/webroot/js/jquery.treeview/jquery.treeview.js" type="text/javascript"></script>

<link rel="stylesheet" href="/app/webroot/js/jquery.treeview/jquery.treeview.css" />

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
			?> » Mapa
			
		</div>
	</div>
	
<?php $this->end(); ?>

<div class="sitemap">
	
	
	<h2>Mapa del Sitio</h2>
	<div id="treecontrol">
		<a title="Contraer todo" href="#"><img class = "ima" src="/app/webroot/js/jquery.treeview/images/minus.gif" /> Contraer Todo</a>
		<a title="Expandir todo" href="#"><img class = "ima" src="/app/webroot/js/jquery.treeview/images/plus.gif" /> Expandir Todo</a>

	</div>
	
	<ul id="black" class="treeview-black">

							<li>
								<span>Proyectos</span>
								<ul>
									<li><?php echo $this->Html->link('Administración de proyectos', array('controller' => 'Proyectos','action'=>'proyecto_listado')); ?></li>
									<li><?php echo $this->Html->link('Asignar número de proyecto', array('controller' => 'Proyectos','action'=>'proyecto_asignar_num')); ?></li>
									<li><span>Ficha t&eacute;cnica</span>
										<ul>
											<li><?php echo $this->Html->link('Registrar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_registrarficha')); ?></li>
											<li><?php echo $this->Html->link('Modificar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_listarficha')); ?></li>
										</ul>
									
									</li>	
									<li><?php echo $this->Html->link('Asignación de Fondos', array('controller' => 'Financias','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Consultar Proyecto', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_consultarficha')); ?></li>
								</ul>
							</li>
							<li><span>Contratos</span>
								<ul>
									<li><?php echo $this->Html->link('Consultar contrato', array('controller' => 'Contratos','action'=>'contrato_consultar')); ?></li>
								</ul>
							</li>
							<li><span>Control y seguimiento</span>
								<ul>	
									<li><?php echo $this->Html->link('Actualizar porcentaje de avance en las metas', array('controller' => 'Metas','action'=>'meta_actualizarporcentaje')); ?></li>
								</ul>
							</li>	
							<li><span>Reportes</span>
								<ul>
									<li><?php echo $this->Html->link('Reporte general de proyecto', array('controller' => 'Proyectos','action'=>'proyecto_reportegeneral')); ?></li>
									<li><?php echo $this->Html->link('Historial de empresas ', array('controller' => 'Empresas','action'=>'empresa_rephistorial')); ?></li>
									<li><?php echo $this->Html->link('Consultar avances de contratos ', array('controller' => 'Contratos','action'=>'avancecontrato')); ?></li>
									<li><?php echo $this->Html->link('Estado de proyecto y contratos ', array('controller' => 'Proyectos','action'=>'proyecto_consultaestados')); ?></li>
									<li><?php echo $this->Html->link('Contratos asociados a proyectos ', array('controller' => 'Proyectos','action'=>'proyecto_reportecontratos')); ?></li>
									<li><?php echo $this->Html->link('Zonas donde se han desarrollado proyectos ', array('controller' => 'Ubicacions','action'=>'ubicacion_rep_proy_depmuni')); ?></li>
									<li><?php echo $this->Html->link('Beneficiarios y empleos generados ', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_rep_empbene')); ?></li>
								</ul>
							</li>
							<li><span>Mantenimiento</span>
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li><span>Fuentes de financiamiento</span>
										<ul>
											<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar fuentes de financiamiento</li>
										</ul>
									</li>
									
									<li><span>Perfil</span>
										<ul>
											<li disabled="disabled">Modificar perfil</li>
											<li><?php echo $this->Html->link('Cambiar Contraseña', array('controller' => 'Users','action'=>'cambiarpass')); ?></li>
											
										</ul>
									</li>
								</ul>
							</li>
						</ul>
				</div>	
<script>
	$(document).ready(function(){
	

	
	// third example
	$("#red").treeview({
		animated: "fast",
		collapsed: true,
		unique: true,
		persist: "cookie",
		toggle: function() {
			window.console && console.log("%o was toggled", this);
		}
	});
	
	// fourth example
	$("#black, #gray").treeview({
		control: "#treecontrol",
		persist: "cookie",
		cookieId: "treeview-black"
	});

});
</script>