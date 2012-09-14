<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<?php echo $this -> Html -> charset(); ?>
		<title> <?php echo $title_for_layout; ?> </title>
		<?php
		//echo $this -> Html -> meta('icon');
		echo $this->Html->meta('icono.ico','icono.ico',array('type' => 'icon'));

		echo $this -> Html -> css('style.cyanspark');
		echo $this -> Html -> css('kendostyles/kendo.common.min');
		echo $this -> Html-> css('kendostyles/kendo.blueopal.min');
		
		echo $this -> Html -> script('cyanspark/cufon-yui');
		echo $this -> Html -> script('cyanspark/arial');
		echo $this -> Html -> script('cyanspark/cuf_run');
		echo $this -> Html -> script('kendojs/jquery.min');
		echo $this -> Html -> script('kendojs/kendo.web.min');
		echo $this -> Html -> script('flot/jquery.flot');
		echo $this -> Html -> script('jquery.maskedinput-1.3.min');

		echo $this -> fetch('meta');
		echo $this -> fetch('css');
		echo $this -> fetch('script');
		?>
		
	</head>
	<body>
		<div class="main">
			<div class="menu_nav">
				<div class="menu_nav_resize">
					<ul>
						<li class="active">
							<?php echo $this->Html->link('Inicio', array('controller' => 'mains','action'=>'index')); ?>
						</li>
						<li>
							<a href="#">Como Navegar</a>
						</li>
						<li>
							<a href="#">Mapa</a>
						</li>
					</ul>
				</div>
				<div class="clr"></div>
				
			</div>
			<div class="usuario">
				<?php echo 'Bienvenido ' . 
					$this->Session->read('User.username') . ' ' . 
					$this->Html->link('Cerrar Sesión', array('controller' => 'users','action'=>'logout')); ?> 
			</div>
			<div class="header">
				<div class="header_resize">

				</div>
			</div>
			<div class="content">
				<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Planeaci&oacute;n
								<ul>
									<li>Proyectos
										<ul>
											<li><?php echo $this->Html->link('Registrar proyecto', array('controller' => 'proyectos','action'=>'add')); ?></li>
											<li>Modificar proyecto</li>
											<li>Asignar n&uacute;mero proyecto</li>
											<li>Eliminar proyecto</li>
										</ul>
									</li>	
									<li>Ficha t&eacute;cnica
										<ul>
											<li><?php echo $this->Html->link('Registrar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'add')); ?></li>
											<li>Modificar ficha t&eacute;cnica</li>
											<li>Eliminar ficha t&eacute;cnica</li>
											<li>Consultar ficha t&eacute;cnica</li>
										</ul>
									</li>
									<li>Fuente de financiamiento
										<ul>
											<li>Registrar fuente de financiamiento</li>
											<li>Modificar fuente de financiamiento</li>
											<li>Eliminar fuente de financiamiento</li>
											<li>Consultar fuente de financiamiento (en un periodo)</li>
										</ul>
									</li>	
									<li><?php echo $this->Html->link('Asignación de Fondos', array('controller' => 'Financias','action'=>'index')); ?></li>
								</ul>
							</li>
							<li>Contratos
								<ul>
									<li>Constructor
										<ul>
											<li>Registrar contrato constructor</li>
											<li>Modificar contrato constructor</li>
											<li>Eliminar contrato constructor</li>
										</ul>
									</li>
									<li>Supervisor
										<ul>
											<li>Registrar contrato supervisor</li>
											<li>Modificar contrato supervisor</li>
											<li>Eliminar contrato supervisor</li>
										</ul>
									</li>	
									<li>Consultar contrato</li>
									<li>Actualizar estado de contrato</li>
									<li>Asignaci&oacute;n de t&eacute;cnicos</li>
									<li>Orden de inicio
										<ul>
											<li>Registrar Orden de Inicio</li>
											<li>Modificar Orden de Inicio</li>
										</ul>
									</li>
									<li>Orden de Cambio
										<ul>
											<li>Registrar orden de cambio</li>
											<li>Modificar orden de cambio</li>
										</ul>
									</li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li>Programaci&oacute;n de avance
										<ul>
											<li>Programaci&oacute;n de avance</li>
											<li>Consultar Programaci&oacute;n</li>
										</ul>
									</li>
									<li>Informe de supervisi&oacute;n
										<ul>
											<li>Registrar informe supervisi&oacute;n</li>
											<li>Modificar informe supervisi&oacute;n</li>
											<li>Eliminar informe supervisi&oacute;n</li>
											<li>Consultar informe supervisi&oacute;n</li>
										</ul>
									</li>
									<li>Estimaci&oacute;n de avance
										<ul>
											<li>Registrar estimaci&oacute;n de avance</li>
											<li>Modificar estimaci&oacute;n de avance</li>
											<li>Eliminar estimaci&oacute;n de avance</li>
											<li>Consultar estimaci&oacute;n de avance</li>
										</ul>
									</li>	
									<li>Informe t&eacute;cnico
										<ul>
											<li>Registrar informe t&eacute;cnico</li>
											<li>Modificar informe t&eacute;cnico</li>
											<li>Eliminar informe t&eacute;cnico</li>
											<li>Consultar Informe T&eacute;cnico</li>
										</ul>
									</li>	
									<li>Actualizar porcentaje de avance en las metas</li>
								</ul>
							</li>	
							<li>Facturas
								<ul>
									<li>Registrar factura</li>
									<li>Modificar factura</li>
									<li>Eliminar factura</li>
									<li>Consultar facturas por proyecto</li>
									<li>Consultar facturas por contrato</li>
								</ul>
							</li>	
							<li>Personal
								<ul>
									<li>Registrar personal</li>
									<li>Modificar personal</li>
									<li>Eliminar personal</li>
									<li>Consultar personal</li>
								</ul>
							</li>
							<li>Administraci&oacute;n de usuario
								<ul>
									<li>Registrar usuario</li>
									<li>Modificar usuario</li>
									<li>Eliminar usuario</li>
									<li>Habilitar usuario</li>
								</ul>
							</li>
							<li>Reportes
								<ul>
									<li>General de proyecto</li>
									<li>Historial de empresas</li>
									<li>Consultar avances de contratos</li>
									<li>Estado de proyecto y contratos</li>
									<li>Contratos asociados a proyectos</li>
									<li>Lugares en los que se han desarrollado proyectos</li>
									<li>Beneficiarios y empleos generados</li>
									<li>Personal asignado &nbsp;por contrato</li>
								</ul>
							</li>
							<li>Cat&aacute;logos
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('División', array('controller' => 'divisions','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Departamentos', array('controller' => 'departamentos','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Municipios', array('controller' => 'municipios','action'=>'index')); ?></li>
									<li>Plaza</li>
									<li>Cargo funcional</li>
									<li>Roles</li>
								</ul>
							</li>
							<li>Perfil
								<ul>
									<li>Modificar perfil</li>
									<li>Cambiar contrase&ntilde;a</li>
									<li>Consultar perfil</li>
								</ul>
							</li>
						</ul>
				</div>	
				<div class="content_resize">
					<div class="mainbar">
						<div class="article">
							<?php echo $this->Session->flash(); ?>
							<?php echo $this->fetch('content'); ?>
						</div>

						<!--<div class="article">
							<h2><span>Lorem Ipsum</span> Dolor Sit</h2>
							<p>
								Posted by <a href="#">Owner</a> | Filed under <a href="#">templates</a>, <a href="#">internet</a>
							</p>
							<p>
								Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo.</a> Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam. Cras fringilla magna. Phasellus suscipit, leo a pharetra condimentum, lorem tellus eleifend magna, eget fringilla velit magna id neque. Curabitur vel urna. In tristique orci porttitor ipsum. Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam.
							</p>
							<img src="img/cyanspark/img3.jpg" width="287" height="97" alt="" class="fl" /><img src="img/cyanspark/img4.jpg" width="287" height="97" alt="" />
							<p>
								<a href="#">Read more</a> | March 15, 2015
							</p> 
						</div> -->
					</div>
					<div class="sidebar">
						<!-- <div class="searchform">
							<form id="formsearch" name="formsearch" method="post" action="#">
								<input name="button_search" src="img/cyanspark/search_btn.gif" class="button_search" type="image" />
								<span>
									<input name="editbox_search" class="editbox_search" id="editbox_search" maxlength="80" value="Search" type="text" />
								</span>
							</form>
							<div class="clr"></div>
						</div> 
						<div class="gadget">
							<h2 class="star"><span>Sidebar</span> Menu</h2>
							<ul class="sb_menu">
								<li>
									<a href="#">Home</a>
								</li>
								<li>
									<a href="#">TemplateInfo</a>
								</li>
								<li>
									<a href="#">Style Demo</a>
								</li>
								<li>
									<a href="#">Blog</a>
								</li>
								<li>
									<a href="#">Archives</a>
								</li>
								<li>
									<a href="#">Website Templates</a>
								</li>
							</ul>
						</div> -->
						<div class="gadget">
							<h2 class="star"><span>Notificaciones</span></h2>
							<ul class="ex_menu">
								<li>
									<a href="#">Cambio de Estado Proyecto 0610</a>
									<br />
									El Proyecto 0610 ha cambiado de Licitacion a Iniciado
								</li>
								<li>
									<a href="#">Estimacion Registrada</a>
									<br />
									Estimacion 01 del Contrato 005/2011 ha sido registrada
								</li>
								<li>
									<a href="#">Informe Tecnico Registrado</a>
									<br />
									Informe Tecnico de Juan Perez ha sido registrado del contrato 005/2011
								</li>
								<li>
									<a href="#">Informe Tecnico Registrado</a>
									<br />
									Informe Tecnico de Pedro Lainez ha sido registrado del contrato 006/2011
								</li>
							</ul>
						</div>
					</div>
					<div class="clr"></div>
				</div>
			</div>
			<div class="fbg">
				
				

				<!-- <div class="fbg_resize">
					<div class="col c1">
						<h2>Image Galley</h2>
						<img src="img/cyanspark/pix1.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix2.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix3.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix4.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix5.jpg" width="58" height="58" alt="" /><img src="img/cyanspark/pix6.jpg" width="58" height="58" alt="" />
					</div>
					<div class="col c2">
						<h2>Lorem Ipsum</h2>
						<p>
							Lorem ipsum dolor
							<br />
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. <a href="#">Morbi tincidunt, orci ac convallis aliquam</a>, lectus turpis varius lorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum, dui pede condimentum odio, ac blandit ante orci ut diam.
						</p>
					</div>
					<div class="col c3">
						<h2>About</h2>
						<img src="img/cyanspark/white.jpg" width="66" height="66" alt="" />
						<p>
							Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Donec libero. Suspendisse bibendum. Cras id urna. Morbi tincidunt, orci ac convallis aliquam, lectus turpis varius lorem, eu posuere nunc justo tempus leo. llorem, eu posuere nunc justo tempus leo. Donec mattis, purus nec placerat bibendum. <a href="#">Learn more...</a>
						</p>
					</div>
					<div class="clr"></div>
				</div> -->
			</div>
			<div class="footer">
				<div class="footer_resize">
					<p class="lf">
						&copy; Sistema Informático para Control y Seguimiento de Proyectos. </a>
					</p>
					<ul class="fmenu">
						<li class="active">
							<?php echo $this->Html->link('Inicio', array('controller' => 'mains','action'=>'index')); ?>
						</li>
						<li>
							<a href="#">Como Navegar</a>
						</li>
						<li>
							<a href="#">Mapa</a>
						</li>
					</ul>
					<div class="clr"></div>
				</div>
			</div>
		</div>
	</body>
	<!-- Scripts -->
	<script>
		$("document").ready(function(){
			$("#menu").kendoMenu()
		})
	</script>

</html>
