<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Contratos
								<ul>
									<li>Constructor
										<ul>
											<li><?php echo $this->Html->link('Registrar contrato constuctor', array('controller' => 'Contratoconstructors','action'=>'contratoconstructor_registrar')); ?></li>
											<li><?php echo $this->Html->link('Modificar contrato constuctor', array('controller' => 'Contratoconstructors','action'=>'contratoconstructor_modificar')); ?></li>
											<li disabled="disabled">Eliminar contrato constructor</li>
										</ul>
									</li>
									<li>Supervisor
										<ul>
											<li><?php echo $this->Html->link('Registrar contrato supervisor', array('controller' => 'Contratosupervisors','action'=>'contratosupervisor_registrar')); ?></li>
											<li><?php echo $this->Html->link('Modificar contrato supervisor', array('controller' => 'Contratosupervisors','action'=>'contratosupervisor_modificar')); ?></li>
											<li disabled="disabled">Eliminar contrato supervisor</li>
										</ul>
									</li>		
									<li disabled="disabled">Consultar contrato</li>
									<li><?php echo $this->Html->link('Actualizar estado de contrato', array('controller' => 'Contratoconstructors','action'=>'contrato_actualizarestado')); ?></li>
									<li><?php echo $this->Html->link('Asignación de técnicos', array('controller' => 'Nombramientos','action'=>'Nombramiento_asignartecnico')); ?></li>
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
											<li disabled="disabled">Consultar Informe T&eacute;cnico</li>
										</ul>
									</li>
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
									<li disabled="disabled">Estado de proyecto y contratos</li>
									<li disabled="disabled">Contratos asociados a proyectos</li>
									<li disabled="disabled">Lugares en los que se han desarrollado proyectos</li>
									<li disabled="disabled">Beneficiarios y empleos generados</li>
									<li disabled="disabled">Personal asignado &nbsp;por contrato</li>
								</ul>
							</li>
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'empresas','action'=>'index')); ?></li>
									<li>Fuentes de financiamiento
										<ul>
											<li disabled="disabled">Consultar fuente de financiamiento (en un periodo)</li>
										</ul>
									</li>
									<li><?php echo $this->Html->link('Administración de personal', array('controller' => 'personas','action'=>'persona_index')); ?></li>
									<li><?php echo $this->Html->link('Administración de usuarios', array('controller' => 'users','action'=>'user_index')); ?></li>
									
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
