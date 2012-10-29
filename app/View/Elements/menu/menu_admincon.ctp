<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li><?php echo $this->Html->link('Consultar Ficha Técnica', array('controller' => 'Fichatecnicas','action'=>'fichatecnica_consultarficha')); ?></li>
								</ul>
							</li>
							<li>Contratos
								<ul>
									<li><?php echo $this->Html->link('Consultar contrato', array('controller' => 'Contratos','action'=>'contrato_consultar')); ?></li>
									<li><?php echo $this->Html->link('Actualizar estado de contrato', array('controller' => 'Contratoconstructors','action'=>'contrato_actualizarestado')); ?></li>
									<li><?php echo $this->Html->link('Asignación de técnicos', array('controller' => 'nombramientos','action'=>'nombramiento_asignartecnico')); ?></li>
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
											<li><?php echo $this->Html->link('Consultar Informe supervisión', array('controller' => 'Informesupervisors','action'=>'informesupervisor_consultar')); ?></li>
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
											<li><?php echo $this->Html->link('Consultar informe técnico', array('controller' => 'Informetecnicos','action'=>'informetecnico_consultar')); ?></li>
										</ul>
									</li>	
									
								</ul>
							</li>	
							<li>Facturas
								<ul>
									<li><?php echo $this->Html->link('Administración de Facturas', array('controller' => 'Facturas','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Consultar facturas por proyecto', array('controller' => 'Facturas','action'=>'consultarporproyecto')); ?></li>
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
									<li><?php echo $this->Html->link('Personal asignado por contrato ', array('controller' => 'Nombramientos','action'=>'nombramiento_reporte_asignados')); ?></li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li disabled="disabled">Consultar fuente de financiamiento</li>
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
