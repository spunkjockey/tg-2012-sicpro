<?php
    class PersonasController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session','RequestHandler');
		public $uses = array('Persona','User','Plaza','Cargofuncional');
		
		public function persona_index()
		{
			$this->layout = 'cyanspark';
			$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
			$this->set('idrol',$rol);
			$this->set('personas',$this->Persona->find('all',array(
										'fields' => array('Persona.idpersona','Persona.nombrespersona','Persona.apellidospersona',
														  'Plaza.plaza','Cargofuncional.cargofuncional'),
										'order' => array('Persona.nombrespersona'))));
		}
		
		public function persona_registrar() 
		{
	        $this->layout = 'cyanspark';
			$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
			if ($this->request->is('post')) 
			{
				$data = array(
				    'Persona' => array(
				    	'nombrespersona' => $this->request->data['Persona']['nombrespersona'],
				    	'apellidospersona' => $this->request->data['Persona']['apellidospersona'],
				    	'idplaza' => $this->request->data['Persona']['plazas'],
				    	'idcargofuncional' => $this->request->data['Persona']['cargos'],
				    	'telefonocontacto' => $this->request->data['Persona']['telefonocontacto'],
				    	'correoelectronico' => $this->request->data['Persona']['correoelectronico']
					),
				    'User' => array(
				    	array(
				          'username' => $this->request->data['User']['username'],
				          'password' => $this->request->data['Persona']['password'],
				          'nombre' => $this->request->data['Persona']['nombrespersona'],
				          'apellidos' => $this->request->data['Persona']['apellidospersona'],
				          'estado' => $this->request->data['Persona']['estado'],
				          'idrol' => $this->request->data['Persona']['rol'],
				          'userc' => $this->Session->read('User.username')
						  )
				    ),
				);
				
				$this->User->set($this->request->data);
				
				if ($this->User->validates(array('fieldList' => array('username')))) {
				    // valido
				    if($this->Persona->saveAssociated($data, array('deep' => true))) {
						$this->Session->setFlash('La persona ha sido registrada','default',array('class'=>'success'));
						$this->redirect(array('action' => 'persona_index'));
					}
				} else {
				    // invalido
				    $errors = $this->User->validationErrors;
				}
				
				
				
				 
				
	        	//persona
	            /*
				 * $this->Persona->create();
	            $this->Persona->set('nombrespersona', $this->request->data['Persona']['nombrespersona']);
				$this->Persona->set('apellidospersona', $this->request->data['Persona']['apellidospersona']);
				$this->Persona->set('idplaza', $this->request->data['Persona']['plazas']);
				$this->Persona->set('idcargofuncional', $this->request->data['Persona']['cargos']);
				$this->Persona->set('telefonocontacto', $this->request->data['Persona']['telefonocontacto']);
				$this->Persona->set('correoelectronico', $this->request->data['Persona']['correoelectronico']);
				if($this->Persona->save())
					{
						$this->User->create();
						$id = $this->Persona->id;
						$this->User->set('idpersona', $this->Persona->id);
						$this->User->set('username', $this->request->data['Persona']['username']);
						$this->User->set('password', $this->request->data['Persona']['password']);
						$this->User->set('nombre', $this->request->data['Persona']['nombrespersona']);
						$this->User->set('apellidos', $this->request->data['Persona']['apellidospersona']);
						$this->User->set('estado', $this->request->data['Persona']['estado']);
						$this->User->set('idrol', $this->request->data['Persona']['rol']);
						$this->User->set('userc', $this->Session->read('User.username'));
						if($this->User->save())
						{
							$this->Session->setFlash('La persona ha sido registrada','default',array('class'=>'success'));
							$this->redirect(array('action' => 'persona_index'));
						}
						else 
						{
							if ($this->Persona->delete($id)) {
								
							}
							//$this->Session->setFlash('Ha ocurrido un error');
	                    }
					}
				else 
					{
						//$this->Session->setFlash('Ha ocurrido un error');
	                }
				 * 
				 * 
				 */
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
			$rol = $this->Persona->query("SELECT idrol, rol FROM sicpro2012.rol WHERE idrol NOT IN (4,9,8) ;");
			$this->set('rol', Hash::extract($rol, '{n}.0'));
			$this->set('_serialize', 'rol');
			$this->render('/json/jsonrol');	
		}
		
		    	
		function persona_modificar($id=null)
		{
			$this->layout = 'cyanspark';
			$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
			$this->Persona->id = $id;
			if ($this->request->is('get'))
			{
				$this->request->data = $this->Persona->read();
			} else {
				$this->Persona->set('nombrespersona', $this->request->data['Persona']['nombrespersona']);
				$this->Persona->set('apellidospersona', $this->request->data['Persona']['apellidospersona']);
				$this->Persona->set('idplaza', $this->request->data['Persona']['plazas']);
				$this->Persona->set('idcargofuncional', $this->request->data['Persona']['cargos']);
				$this->Persona->set('telefonocontacto', $this->request->data['Persona']['telefonocontacto']);
				$this->Persona->set('correoelectronico', $this->request->data['Persona']['correoelectronico']);
		        if ($this->Persona->save()) {
		            $this->Session->setFlash('La persona ha sido modificada.','default',array('class'=>'success'));
		            $this->redirect(array('action' => 'persona_index'));
		        } else {
		            //$this->Session->setFlash('Ha ocurrido un error. Este usuario no esta registrado como persona');
		        }
		    }
		}
		
		
		function persona_agregar_usuario($id=null)
		{
			$this->layout = 'cyanspark';
			$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
			$this->set('idpersona',$id);
			
			$nombres = $this->Persona->field('nombrespersona',array('idpersona'=>$id));
			$this->set('nombrespersona',$nombres);
			
			$apellidos = $this->Persona->field('apellidospersona',array('idpersona'=>$id));
			$this->set('apellidospersona',$apellidos);
			
			if(isset($id)) {
			$this->set('roles', Hash::combine($this->Persona->query("(SELECT 
			  rol.idrol, 
			  rol.rol
			FROM
			  sicpro2012.rol WHERE idrol NOT IN (4,8))
			 EXCEPT
			(SELECT 
			  rol.idrol, 
			  rol.rol
			FROM 
			  sicpro2012.users, 
			  sicpro2012.rol
			WHERE 
			  users.idrol = rol.idrol AND
			  users.idpersona =  " . $id . ");"),'{n}.0.idrol','{n}.0.rol'));
			 }
			if ($this->request->is('post')) 
		{
			//$this->User->create();

			$this->User->set('idpersona', $this->request->data['Persona']['idpersona']);
			$this->User->set('username', $this->request->data['Persona']['username']);
			$this->User->set('password', $this->request->data['Persona']['password']);
			$this->User->set('nombre', $this->request->data['Persona']['nombre']);
			$this->User->set('apellidos', $this->request->data['Persona']['apellidos']);
			$this->User->set('estado', $this->request->data['Persona']['estado']);
			$this->User->set('idrol', $this->request->data['Persona']['rol']);
			$this->User->set('userc', $this->Session->read('User.username'));
			
			if ($this->User->save())
			{
				$this->Session->setFlash('Usuario ha sido registrado.','default',array('class'=>'success'));
				$this->redirect(array('action' => 'persona_index'));
				
			}
			else 
			{
				//$this->Session->setFlash('Imposible agregar usuario' . $this->request->data['Persona']['idpersona']);
				$this->set('idpersona',$this->request->data['Persona']['idpersona']);
			
				$nombres = $this->Persona->field('nombrespersona',array('idpersona'=>$this->request->data['Persona']['idpersona']));
				$this->set('nombrespersona',$nombres);
				
				$apellidos = $this->Persona->field('apellidospersona',array('idpersona'=>$this->request->data['Persona']['idpersona']));
				$this->set('apellidospersona',$apellidos);
				
				if(isset($this->request->data['Persona']['idpersona'])) {
				$this->set('roles', Hash::combine($this->Persona->query("(SELECT 
				  rol.idrol, 
				  rol.rol
				FROM
				  sicpro2012.rol WHERE idrol NOT IN (4,8))
				 EXCEPT
				(SELECT 
				  rol.idrol, 
				  rol.rol
				FROM 
				  sicpro2012.users, 
				  sicpro2012.rol
				WHERE 
				  users.idrol = rol.idrol AND
				  users.idpersona =  " . $this->request->data['Persona']['idpersona'] . ");"),'{n}.0.idrol','{n}.0.rol'));
				 }
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
		
		function perfil_modificar($id=null){
			$this->layout = 'cyanspark';
			$this->Persona->id = $id;
			if ($this->request->is('get'))
			{
				$this->request->data = $this->Persona->read();
			} else {
				/*$this->Persona->set('nombrespersona', $this->request->data['Persona']['nombrespersona']);
				$this->Persona->set('apellidospersona', $this->request->data['Persona']['apellidospersona']);
				$this->Persona->set('idplaza', $this->request->data['Persona']['plazas']);
				$this->Persona->set('idcargofuncional', $this->request->data['Persona']['cargos']);*/
				$this->Persona->set('telefonocontacto', $this->request->data['Persona']['telefonocontacto']);
				$this->Persona->set('correoelectronico', $this->request->data['Persona']['correoelectronico']);
		        if ($this->Persona->save()) {
		            $this->Session->setFlash('Su perfil ha sido modificado','default',array('class'=>'success'));
		            $this->redirect(array('controller' => 'Mains'));
		        } else {
		            //$this->Session->setFlash('Ha ocurrido un error. Imposible editar persona');
		        }
		    }
		}
	}	
		
    
?>