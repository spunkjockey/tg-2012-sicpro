<div class="navmenu" style="margin:0px auto; width: 970px">
						<ul id="menu">
							<li>Mantenimiento
								<ul>
									<li><?php echo $this->Html->link('Empresas', array('controller' => 'Empresas','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Fuente de financiamiento', array('controller' => 'Fuentefinanciamientos','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Administración de personal', array('controller' => 'Personas','action'=>'persona_index')); ?></li>
									<li><?php echo $this->Html->link('Administración de usuarios', array('controller' => 'Users','action'=>'user_index')); ?></li>
								</ul>
							</li>
							<li>Perfil
								<ul>
									<li><?php echo $this->Html->link('Cambiar Contraseña', array('controller' => 'Users','action'=>'cambiarpass')); ?></li>
								</ul>
							</li>
									<!--<li><?php echo $this->Html->link('División', array('controller' => 'divisions','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Plazas', array('controller' => 'plazas','action'=>'index')); ?></li>
									<li><?php echo $this->Html->link('Cargo funcional', array('controller' => 'cargofuncionals','action'=>'index')); ?></li>
								--->
						</ul>
				</div>	
