<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li>Proyecto
										<ul>
											<li><?php echo $this->Html->link('Registrar proyecto', array('controller' => 'proyectos','action'=>'add')); ?></li>
											<li><?php echo $this->Html->link('Modificar proyecto', array('controller' => 'proyectos','action'=>'edit')); ?></li>
											<li><?php echo $this->Html->link('Asignar número proyecto', array('controller' => 'proyectos','action'=>'add_num')); ?></li>
											<li disabled="disabled">Eliminar proyecto</li>
										</ul>
									</li>	
									<li>Ficha t&eacute;cnica
										<ul>
											<li><?php echo $this->Html->link('Registrar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'add')); ?></li>
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
									<li>Constructor
										<ul>
											<li><?php echo $this->Html->link('Registrar contrato constuctor', array('controller' => 'Contratoconstructors','action'=>'add')); ?></li>
											<li disabled="disabled">Modificar contrato constructor</li>
											<li disabled="disabled">Eliminar contrato constructor</li>
										</ul>
									</li>
									<li>Supervisor
										<ul>
											<li disabled="disabled">Registrar contrato supervisor</li>
											<li disabled="disabled">Modificar contrato supervisor</li>
											<li disabled="disabled">Eliminar contrato supervisor</li>
										</ul>
									</li>	
									<li disabled="disabled">Consultar contrato</li>
									<li disabled="disabled">Actualizar estado de contrato</li>
									<li><?php echo $this->Html->link('Registrar Orden de Inicio', array('controller' => 'Contratos','action'=>'addordeninicio')); ?></li>
									<li>Orden de Cambio</li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li>Programaci&oacute;n de avance
										<ul>
											<li disabled="disabled">Programaci&oacute;n de avance</li>
											<li disabled="disabled">Consultar Programaci&oacute;n</li>
										</ul>
									</li>
									<li>Informe de supervisi&oacute;n
										<ul>
											<li disabled="disabled">Registrar informe supervisi&oacute;n</li>
											<li disabled="disabled">Modificar informe supervisi&oacute;n</li>
											<li disabled="disabled">Eliminar informe supervisi&oacute;n</li>
											<li disabled="disabled">Consultar informe supervisi&oacute;n</li>
										</ul>
									</li>
									<li>Estimaci&oacute;n de avance
										<ul>
											<li disabled="disabled">Registrar estimaci&oacute;n de avance</li>
											<li disabled="disabled">Modificar estimaci&oacute;n de avance</li>
											<li disabled="disabled">Eliminar estimaci&oacute;n de avance</li>
											<li disabled="disabled">Consultar estimaci&oacute;n de avance</li>
										</ul>
									</li>	
									<li>Informe t&eacute;cnico
										<ul>
											<li disabled="disabled">Registrar informe t&eacute;cnico</li>
											<li disabled="disabled">Modificar informe t&eacute;cnico</li>
											<li disabled="disabled">Eliminar informe t&eacute;cnico</li>
											<li disabled="disabled">Consultar Informe T&eacute;cnico</li>
										</ul>
									</li>	
									<li disabled="disabled">Actualizar porcentaje de avance en las metas</li>
								</ul>
							</li>	
							<li>Facturas
								<ul>
									<li disabled="disabled">Registrar factura</li>
									<li disabled="disabled">Modificar factura</li>
									<li disabled="disabled">Eliminar factura</li>
									<li disabled="disabled">Consultar facturas por proyecto</li>
									<li disabled="disabled">Consultar facturas por contrato</li>
								</ul>
							</li>	
							<li disabled="disabled">Reportes
								<ul>
									<li>General de proyecto</li>
									<li>Historial de empresas</li>
									<li>Consultar avances de contratos</li>
									<li><?php echo $this->Html->link('Estado de proyecto y contratos ', array('controller' => 'Proyectos','action'=>'proyecto_consultaestados')); ?></li>
									<li>Contratos asociados a proyectos</li>
									<li>Lugares en los que se han desarrollado proyectos</li>
									<li>Beneficiarios y empleos generados</li>
									<li>Personal asignado &nbsp;por contrato</li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li>Personal
										<ul>
											<li><?php echo $this->Html->link('Registrar persona', array('controller' => 'personas','action'=>'add')); ?></li>
											<li disabled="disabled">Modificar personal</li>
											<li disabled="disabled">Eliminar personal</li>
											<li disabled="disabled">Consultar personal</li>
										</ul>
									</li>
									<li>Fuentes de financiamiento
										<ul>
											<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar fuente de financiamiento (en un periodo)</li>
										</ul>
									</li>
									<li>Administraci&oacute;n de usuario
										<ul>
											<li><?php echo $this->Html->link('Registrar usuario', array('controller' => 'users','action'=>'add')); ?></li>
											<li disabled="disabled">Modificar usuario</li>
											<li disabled="disabled">Eliminar usuario</li>
											<li disabled="disabled">Habilitar usuario</li>
										</ul>
									</li>
									<li>Perfil
										<ul>
											<li disabled="disabled">Modificar perfil</li>
											<li><?php echo $this->Html->link('Cambiar Contraseña', array('controller' => 'Users','action'=>'cambiarpass')); ?></li>
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
