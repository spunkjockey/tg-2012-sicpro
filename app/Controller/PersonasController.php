<?php
    class PersonasController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session');
		public $uses = array('Persona','User');
		
		public function add() 
		{
	        $this->layout = 'cyanspark';
			$this->set('plazas', $this->Persona->Plaza->find('list',
												array('fields' => array('Plaza.idplaza', 'Plaza.plaza'))));
			$this->set('cargos', $this->Persona->Cargofuncional->find('list',
												array('fields' => array('Cargofuncional.idcargofuncional', 'Cargofuncional.cargofuncional'))));
			$rol = $this->Persona->query("SELECT idrol, rol FROM sicpro2012.rol;");
			$this->set('roles', Set::combine($rol, "{n}.0.idrol","{n}.0.rol"));
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
						$this->User->set('idrol', $this->request->data['Persona']['roles']);
						
						if($this->User->save())
						{
							$this->Session->setFlash('La persona ha sido registrada');
							$this->redirect(array('controller'=>'mains', 'action' => 'index'));
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
    }	
		
    
?>