<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li>Proyecto
										<ul>
											<li><?php echo $this->Html->link('Registrar proyecto', array('controller' => 'proyectos','action'=>'proyecto_registrar')); ?></li>
											<li><?php echo $this->Html->link('Modificar proyecto', array('controller' => 'proyectos','action'=>'proyecto_listado')); ?></li>
											<li><?php echo $this->Html->link('Asignar número proyecto', array('controller' => 'proyectos','action'=>'proyecto_asignar_num')); ?></li>
											<li disabled="disabled">Eliminar proyecto</li>
										</ul>
									</li>	
									<li>Ficha t&eacute;cnica
										<ul>
											<li><?php echo $this->Html->link('Registrar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_registrarficha')); ?></li>
											<li disabled="disabled">Modificar ficha t&eacute;cnica</li>
											<li disabled="disabled">Eliminar ficha t&eacute;cnica</li>
											<li disabled="disabled">Consultar ficha t&eacute;cnica</li>
										</ul>
									</li>	
									<li><?php echo $this->Html->link('Asignación de Fondos', array('controller' => 'Financias','action'=>'index')); ?></li>
								</ul>
							</li>
							<li>Contratos
								<ul>
									<li disabled="disabled">Consultar contrato</li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li disabled="disabled">Actualizar porcentaje de avance en las metas</li>
								</ul>
							</li>	
							<li disabled="disabled">Reportes
								<ul>
									<li>Reporte general de proyecto</li>
									<li>Consultar avances de contratos</li>
									<li>Estado de proyecto y contratos</li>
									<li>Contratos asociados a proyectos</li>
									<li>Lugares en los que se han desarrollado proyectos</li>
									<li>Beneficiarios y empleos generados</li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li>Fuentes de financiamiento
										<ul>
											<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar fuente de financiamiento (en un periodo)</li>
										</ul>
									</li>
									
									<li>Perfil
										<ul>
											<li disabled="disabled">Modificar perfil</li>
											<li disabled="disabled">Cambiar contrase&ntilde;a</li>
											<li disabled="disabled">Consultar perfil</li>
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
