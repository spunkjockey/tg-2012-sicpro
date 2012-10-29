<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li><?php echo $this->Html->link('Administración de proyectos', array('controller' => 'Proyectos','action'=>'proyecto_listado')); ?></li>
									<li><?php echo $this->Html->link('Asignar número de proyecto', array('controller' => 'Proyectos','action'=>'proyecto_asignar_num')); ?></li>
									<li>Ficha t&eacute;cnica
										<ul>
											<li><?php echo $this->Html->link('Registrar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_registrarficha')); ?></li>
											<li><?php echo $this->Html->link('Modificar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_listarficha')); ?></li>
											<li><?php echo $this->Html->link('Consultar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_consultarficha')); ?></li>
										</ul>
									</li>		
									<li><?php echo $this->Html->link('Asignación de Fondos', array('controller' => 'Financias','action'=>'index')); ?></li>
								</ul>
							</li>
							<li>Contratos
								<ul>
									<li><?php echo $this->Html->link('Consultar contrato', array('controller' => 'Contratos','action'=>'contrato_consultar')); ?></li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li><?php echo $this->Html->link('Actualizar porcentaje de avance en las metas', array('controller' => 'Metas','action'=>'meta_actualizarporcentaje')); ?></li>
								</ul>
							</li>	
							<li>Reportes
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
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li>Fuentes de financiamiento
										<ul>
											<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar fuentes de financiamiento</li>
										</ul>
									</li>
									
									<li>Perfil
										<ul>
											<li disabled="disabled">Modificar perfil</li>
											<li><?php echo $this->Html->link('Cambiar Contraseña', array('controller' => 'Users','action'=>'cambiarpass')); ?></li>
										</ul>
									</li>
									<!--<li><?php echo $this->Html->link('División', array('controller' => 'divisions','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Departamentos', array('controller' => 'departamentos','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Municipios', array('controller' => 'municipios','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Plazas', array('controller' => 'plazas','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Cargo funcional', array('controller' => 'cargofuncionals','action'=>'index')); ?></li>
									<li>Roles</li>-->
								</ul>
							</li>
						</ul>
				</div>	
