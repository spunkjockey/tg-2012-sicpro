<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Proyectos
								<ul>
									<li>Ficha t&eacute;cnica
										<ul>
											<li disabled="disabled">Consultar ficha t&eacute;cnica</li>
										</ul>
									</li>	
								</ul>
							</li>
							<li>Contratos
								<ul>
									<li disabled="disabled">Consultar contrato</li>
								</ul>
							</li>
							<li>Control y seguimiento
								<ul>
									<li>Programaci&oacute;n de avance
										<ul>
											<li disabled="disabled">Consultar Programaci&oacute;n</li>
										</ul>
									</li>
									<li>Informe de supervisi&oacute;n
										<ul>
											<li disabled="disabled">Consultar informe supervisi&oacute;n</li>
										</ul>
									</li>
									<li>Estimaci&oacute;n de avance
										<ul>
											<li disabled="disabled">Consultar estimaci&oacute;n de avance</li>
										</ul>
									</li>	
									<li>Informe t&eacute;cnico
										<ul>
											<li><?php echo $this->Html->link('Consultar informe técnico', array('controller' => 'Informetecnicos','action'=>'informetecnico_observaciones')); ?></li>
										</ul>
									</li>	
									<li disabled="disabled">Actualizar porcentaje de avance en las metas</li>
								</ul>
							</li>	
							<li>Facturas
								<ul>
									<li disabled="disabled">Consultar facturas por proyecto</li>
									<li disabled="disabled">Consultar facturas por contrato</li>
								</ul>
							</li>	
							<li>Reportes
								<ul>
									<li disabled="disabled">General de proyecto</li>
									<li disabled="disabled">Historial de empresas</li>
									<li disabled="disabled">Consultar avances de contratos</li>
									<li><?php echo $this->Html->link('Estado de proyecto y contratos ', array('controller' => 'Proyectos','action'=>'proyecto_consultaestados')); ?></li>
									<li disabled="disabled">Contratos asociados a proyectos</li>
									<li disabled="disabled">Lugares en los que se han desarrollado proyectos</li>
									<li disabled="disabled">Beneficiarios y empleos generados</li>
									<li disabled="disabled">Personal asignado &nbsp;por contrato</li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li>Fuentes de financiamiento
										<ul>
											<li disabled="disabled">Consultar fuente de financiamiento (en un periodo)</li>
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
