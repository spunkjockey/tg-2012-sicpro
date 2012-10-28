
<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li><?php echo $this->Html->link('Administración de proyectos', array('controller' => 'Proyectos','action'=>'proyecto_listado')); ?></li>
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
									<li>Constructor
										<ul>
											<li><?php echo $this->Html->link('Administrar contrato constuctor', array('controller' => 'Contratoconstructors','action'=>'contratoconstructor_listar')); ?></li>
										</ul>
									</li>
									<li>Supervisor
										<ul>
											<li><?php echo $this->Html->link('Administrar contrato supervisor', array('controller' => 'Contratosupervisors','action'=>'contratosupervisor_listar')); ?></li>
										</ul>
									</li>	
									<li><?php echo $this->Html->link('Consultar contrato', array('controller' => 'Contratos','action'=>'contrato_consultar')); ?></li>
									<li><?php echo $this->Html->link('Actualizar estado de contrato', array('controller' => 'Contratoconstructors','action'=>'contrato_actualizarestado')); ?></li>
									<li><?php echo $this->Html->link('Asignación de técnicos', array('controller' => 'Nombramientos','action'=>'nombramiento_asignartecnico')); ?></li>
									<li><?php echo $this->Html->link('Orden de Inicio', array('controller' => 'Contratos','action'=>'addordeninicio')); ?></li>
									<li><?php echo $this->Html->link('Orden de Cambio', array('controller' => 'Ordendecambios','action'=>'ordendecambio_listar')); ?></li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li>Programaci&oacute;n de avance
										<ul>
											<li><?php echo $this->Html->link('Programación de Avance', array('controller' => 'Avanceprogramados','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar Programaci&oacute;n</li>
										</ul>
									</li>
									<li>Informe de supervisi&oacute;n
										<ul>
											<li><?php echo $this->Html->link('Informe supervisión', array('controller' => 'Informesupervisors','action'=>'informesupervisor_index')); ?></li>
											<li disabled="disabled">Consultar informe supervisi&oacute;n</li>
										</ul>
									</li>
									<li>Estimaci&oacute;n de avance
										<ul>
											<li><?php echo $this->Html->link('Estimación de Avance', array('controller' => 'Estimacions','action'=>'index')); ?></li>
											<li><?php echo $this->Html->link('Consultar Estimación de Avance', array('controller' => 'Estimacions','action'=>'estimacion_consultar')); ?></li>
										</ul>
									</li>	
									<li>Informe t&eacute;cnico
										<ul>
											<li><?php echo $this->Html->link('Informe técnico', array('controller' => 'Informetecnicos','action'=>'informetecnico_registrar')); ?></li>
											<li><?php echo $this->Html->link('Consultar informe técnico', array('controller' => 'Informetecnicos','action'=>'informetecnico_consultar')); ?></li>
										</ul>
									</li>	
									<li><?php echo $this->Html->link('Actualizar porcentaje de avance en las metas', array('controller' => 'Metas','action'=>'meta_actualizarporcentaje')); ?></li>
								</ul>
							</li>	
							<li>Facturas
								<ul>
									<li><?php echo $this->Html->link('Administración de Facturas', array('controller' => 'Facturas','action'=>'index')); ?></li>
									<li disabled="disabled">Consultar facturas por proyecto</li>
									<li disabled="disabled">Consultar facturas por contrato</li>
								</ul>
							</li>	
							<li>Reportes
								<ul>
									<li><?php echo $this->Html->link('Reporte general de proyecto', array('controller' => 'Proyectos','action'=>'proyecto_reportegeneral')); ?></li>
									<li><?php echo $this->Html->link('Historial de empresas ', array('controller' => 'Empresas','action'=>'empresa_rephistorial')); ?></li>
									<li disabled="disabled">Consultar avances de contratos</li>
									<li><?php echo $this->Html->link('Estado de proyecto y contratos ', array('controller' => 'Proyectos','action'=>'proyecto_consultaestados')); ?></li>
									<li><?php echo $this->Html->link('Contratos asociados a proyectos ', array('controller' => 'Proyectos','action'=>'proyecto_reportecontratos')); ?></li>
									<li><?php echo $this->Html->link('Zonas donde se han desarrollado proyectos ', array('controller' => 'Ubicacions','action'=>'ubicacion_rep_proy_depmuni')); ?></li>
									<li><?php echo $this->Html->link('Beneficiarios y empleos generados ', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_rep_empbene')); ?></li>
									<li><?php echo $this->Html->link('Personal asignado por contrato ', array('controller' => 'Nombramientos','action'=>'nombramiento_reporte_asignados')); ?></li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'Empresas','action'=>'index')); ?></li>
									<li>Fuentes de financiamiento
										<ul>
											<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
											<li disabled="disabled">Consultar fuente de financiamiento (en un periodo)</li>
										</ul>
									</li>
									<li><?php echo $this->Html->link('Administración de personal', array('controller' => 'Personas','action'=>'persona_index')); ?></li>
									<li><?php echo $this->Html->link('Administración de usuarios', array('controller' => 'Users','action'=>'user_index')); ?></li>
									
									
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
