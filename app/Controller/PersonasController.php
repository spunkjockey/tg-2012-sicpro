<?php
    class PersonasController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session','RequestHandler');
		public $uses = array('Persona','User','Plaza','Cargofuncional');
		
		public function persona_index()
		{
			$this->layout = 'cyanspark';
			$this->set('personas',$this->Persona->find('all',array(
										'fields' => array('Persona.idpersona','Persona.nombrespersona','Persona.apellidospersona',
														  'Plaza.plaza','Cargofuncional.cargofuncional'),
										'order' => array('Persona.nombrespersona'))));
		}
		
		public function persona_registrar() 
		{
	        $this->layout = 'cyanspark';
			if ($this->request->is('post')) 
			{
	        	//persona
	            $this->Persona->create();
	            $this->Persona->set('nombrespersona', $this->request->data['Persona']['nombrespersona']);
				$this->Persona->set('apellidospersona', $this->request->data['Persona']['apellidospersona']);
				$this->Persona->set('idplaza', $this->request->data['Persona']['plazas']);
				$this->Persona->set('idcargofuncional', $this->request->data['Persona']['cargos']);
				$this->Persona->set('telefonocontacto', $this->request->data['Persona']['telefonocontacto']);
				$this->Persona->set('correoelectronico', $this->request->data['Persona']['correoelectronico']);
				if($this->Persona->save())
					{
						$this->User->create();
						$this->User->set('idpersona', $this->Persona->id);
						$this->User->set('username', $this->request->data['Persona']['username']);
						$this->User->set('password', $this->request->data['Persona']['password']);
						$this->User->set('nombre', $this->request->data['Persona']['nombrespersona']);
						$this->User->set('apellidos', $this->request->data['Persona']['apellidospersona']);
						$this->User->set('estado', $this->request->data['Persona']['estado']);
						$this->User->set('idrol', $this->request->data['Persona']['rol']);
						
						if($this->User->save())
						{
							$this->Session->setFlash('La persona ha sido registrada','default',array('class'=>'success'));
							$this->redirect(array('action' => 'persona_index'));
						}
						else 
						{
							$this->Session->setFlash('Ha ocurrido un error');
	                    }
					}
				else 
					{
						$this->Session->setFlash('Ha ocurrido un error');
	                }
			}
		}

		public function plazajson()
		{
			$plazas = $this->Plaza->find('all',array('fields' => array('Plaza.idplaza', 'Plaza.plaza')));
			$this->set('plazas', Hash::extract($plazas, "{n}.Plaza"));
			$this->set('_serialize', 'plazas');
			$this->render('/json/jsonplazas');
		}
		public function cargojson()
		{
			$cargos = $this->Cargofuncional->find('all',
												array('fields' => array('Cargofuncional.idcargofuncional', 'Cargofuncional.cargofuncional')));
			
			$this->set('cargos', Hash::extract($cargos, "{n}.Cargofuncional"));
			$this->set('_serialize', 'cargos');
			$this->render('/json/jsoncargos');
		}
		public function rolesjson()
		{
			$rol = $this->Persona->query("SELECT idrol, rol FROM sicpro2012.rol;");
			$this->set('rol', Hash::extract($rol, '{n}.0'));
			$this->set('_serialize', 'rol');
			$this->render('/json/jsonrol');	
		}
    	
		function persona_modificar($id=null)
		{
			$this->layout = 'cyanspark';
			
			if ($this->request->is('get'))
			{
				$this->data = $this->Persona->read(null,$id);
			}
			if ($this->request->is('post')) 
			{
				
			}
		}
		
		
		function persona_agregar_usuario($id=null)
		{
			$this->layout = 'cyanspark';
			
			if ($this->request->is('get'))
			{
				$this->data = $this->Persona->read(null,$id);
			}
			if ($this->request->is('post')) 
		{
			$this->User->set('idpersona', $id);
			$this->User->set('username', $this->request->data['Persona']['username']);
			$this->User->set('password', $this->request->data['Persona']['password']);
			$this->User->set('nombre', $this->request->data['Persona']['nombrespersona']);
			$this->User->set('apellidos', $this->request->data['Persona']['apellidospersona']);
			$this->User->set('estado', $this->request->data['Persona']['estado']);
			$this->User->set('idrol', $this->request->data['Persona']['rol']);
			if ($this->User->save())
			{
				$this->Session->setFlash('Usuario ha sido registrado.','default',array('class'=>'success'));
				$this->redirect(array('action' => 'persona_index'));
			}
			else 
			{
				$this->Session->setFlash('Imposible agregar usuario');
			}
		}
		}
		
		function persona_eliminar($id) 
		{
		    if (!$this->request->is('post')) 
		    {
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Persona->delete($id)) {
		        $this->Session->setFlash('Persona eliminada','default',array('class'=>'success'));
		        $this->redirect(array('action' => 'persona_index'));
		    }
		}
	}	
		
    
?>