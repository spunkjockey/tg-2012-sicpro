<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
		public $helpers = array('Html', 'Form', 'Session', 'Js');
    	public $components = array('Session','RequestHandler');
		public $uses = array('User','Rol','Auditoria_sesion');
	
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout');
    }

    public function index() {
        $this->User->recursive = 0;
        $this->set('users', $this->paginate());
    }
	
	
	public function login() {
		$this->layout = '8loginform';
		$this->set('title_for_layout', 'Login');
	    if($this->Auth->loggedIn()) {
	    	$this->redirect(array('controller'=>'mains'));
		} else {
	    	if ($this->request->is('post')) {
	    		
	    	    $conteo = $this->User->find('count', array(
	    	    				'conditions' => array('User.username' => trim($this->data['User']['username']))));
				//comprobar si existe
				if($conteo != 0 ) {	
					$usuarios = $this->User->findByUsername(trim($this->data['User']['username']));
		    	    //Debugger::dump($usuarios);
		    	    //comprobar si esta habilitado en el sistema
		    	    if($usuarios['User']['estado'] == TRUE) {
		    	    	
						$user['User']['username'] = trim($this->data['User']['username']);
						$user['User']['password'] = $this->data['User']['password'];
			    	    //logear en el sistema	
			    	    if ($this->Auth->login()) {
				        	$someone = $this->User->findByUsername(trim($this->data['User']['username']));
							$this->Session->write('User.username',$someone['User']['username']);
							$this->Session->write('User.idpersona',$someone['User']['idpersona']);
							$this->Session->write('User.idrol',$someone['User']['idrol']);
							$this->Session->write('User.useragent',$this->request->header('User-Agent'));
							$this->Session->write('User.userip',$this->request->clientIp());
							$this->Session->write('User.nombre',$someone['User']['nombre']);
							$this->Session->write('User.apellidos',$someone['User']['apellidos']);
							$this->Session->write('User.id',$someone['User']['id']);
							
							$this->Auditoria_sesion->set('ipmaquina', $this->request->clientIp());
							$this->Auditoria_sesion->set('useragent',$this->request->header('User-Agent'));
							$this->Auditoria_sesion->set('username',$someone['User']['username']);
							$this->Auditoria_sesion->set('login', date("Y-m-d H:i:s"));
							if ($this->Auditoria_sesion->save()) {
								$this->Session->write('User.idauditoria',$this->Auditoria_sesion->getInsertID());
								$this->redirect($this->Auth->redirect());
					        } else {
					        	$this->Session->setFlash(__('Ha ocurrido un error con la base de datos, notifique al administrador sobre este problema', 'default', array('class' => 'errorlogin')));
								$this->Session->destroy();
    							$this->Auth->logout();
					        } 
							
				            //$this->redirect(array('controller'=>'mains'));
				        } else {
				            $this->Session->setFlash(__('Usuario o Contraseña Incorrecta, intente otra vez', 'default', array('class' => 'errorlogin')));
				        }
					} else {
						$this->Session->setFlash(__('El usuario se encuentra deshabilitado', 'default', array('class' => 'errorlogin')));
					}
				} else {
					$this->Session->setFlash(__('El usuario no existe en el sistema', 'default', array('class' => 'errorlogin')));
				}
	      	}
    	}
	}
	
	public function logout() {
		if($this->Session->check('User.idauditoria')) {
			$this->Auditoria_sesion->id = $this->Session->read('User.idauditoria');
			$this->Auditoria_sesion->set('logout', date("Y-m-d H:i:s"));
			if ($this->Auditoria_sesion->save()) {
	            $this->Session->destroy();
	    		$this->redirect($this->Auth->logout());
	        } else {
				$this->Session->setFlash(__('Un error inseperado ha ocurrido', 'default', array('class' => 'errorlogin')));
			}
		} else {
			$this->Session->destroy();
	    	$this->redirect($this->Auth->logout());
		}

		
	}

    public function view($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario Invalido'));
        }
        $this->set('user', $this->User->read(null, $id));
    }
	
	function user_index()
	{
		$this->layout = 'cyanspark';
		$this->set('usuarios',$this->User->find('all',array(
										'fields' => array('User.id','User.nombre','User.apellidos','User.username','User.estado','Rol.rol'),
										'conditions' => array('User.idrol != 9'),
										'order' => array('User.nombre','User.apellidos'))));
	}

    public function add() {
        $this->layout = 'cyanspark';
		$this->set('roles', $this->User->Rol->find('list',
												array('fields' => array('Rol.idrol', 'Rol.rol'),
													'conditions' => array('Rol.idrol IN (4,8)')
													)));
        if ($this->request->is('post')) 
        {
            $this->User->create();
			$this->User->set('username', $this->request->data['User']['username']);
			$this->User->set('password', $this->request->data['User']['password']);
			$this->User->set('nombre', $this->request->data['User']['nombrespersona']);
			$this->User->set('apellidos', $this->request->data['User']['apellidospersona']);
			$this->User->set('estado', $this->request->data['User']['estado']);
			$this->User->set('idrol', $this->request->data['User']['roles']);
			$this->User->set('userc', $this->Session->read('User.username'));
            if ($this->User->save()) 
            {
                $this->Session->setFlash(__('El Usuario ha sido registrado con exito'),'default',array('class'=>'success'));
                $this->redirect(array('controller'=>'mains', 'action' => 'index'));
            } 
            else 
            {
                //$this->Session->setFlash('Ha ocurrido un error');
            }
        }
    }

    public function edit($id = null) {
    	$this->layout = 'cyanspark';
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            	$this->User->create();
			
			$this->User->read(null, $id);
			$this->User->set('password', $this->request->data['User']['newpassword']);
			$this->User->set('userm', $this->Session->read('User.username'));
			$this->User->set('modified', date("Y-m-d H:i:s"));
			if ($this->User->save($id, array(
										'fieldList'=>array('password','userm','modified'))))
				{
            //if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido actualizado'),'default',array('class'=>'success'));
                $this->redirect(array('action' => 'user_index'));
            } else {
                $this->Session->setFlash(__('El usuario no puede ser registrado. Intente otra vez.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function cambiarestado($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        $this->User->create();
		
		$this->User->read(null, $id);
		$estado = $this->User->field('estado');
		if($estado == 1) {
			$this->User->set('estado', 0);
			$nestado = 'Deshabilitado';
		} else {
			$this->User->set('estado', 1);
			$nestado = 'Habilitado';
		}
		
			
			if ($this->User->save($id, array('fieldList'=>array('estado'))))
			{
            	$this->Session->setFlash(__('El usuario ha sido ' . $nestado . ' con éxito'),'default',array('class'=>'success'));
            	$this->redirect(array('action' => 'user_index'));
        	}
        
		
        $this->Session->setFlash(__('El Estado del Usuario no fué cambiado'));
        $this->redirect(array('action' => 'user_index'));
    }
	
	public function delete($id = null) {
        if (!$this->request->is('post')) {
            throw new MethodNotAllowedException();
        }
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('Usuario eliminado'),'default',array('class'=>'success'));
            $this->redirect(array('action' => 'user_index'));
        }
        $this->Session->setFlash(__('Usuario no fué eliminado'));
        $this->redirect(array('action' => 'user_index'));
    }
	
	public function cambiarpass() {
		$this->layout = 'cyanspark';
		$this->set('usuario',$this->User->findById($this->Session->read('User.id')));
		if ($this->request->is('post')) {
			$this->User->create();
			$id = $this->request->data['User']['idusuario'];
			$this->User->read(null, $id);
			$this->User->set('password', $this->request->data['User']['newpassword']);
			$this->User->set('userm', $this->Session->read('User.username'));
			$this->User->set('modified', date("Y-m-d H:i:s"));
			$this->User->set('oldpass', $this->request->data['User']['password']);
            if ($this->User->save($id, array(
										'fieldList'=>array('password','userm','modified')))) 
			
            {
                $this->Session->setFlash('Contraseña actualizada con exito','default',array('class'=>'success'));
                $this->redirect(array('controller'=>'mains', 'action' => 'index'));
            } 
            else 
            {
               // $this->Session->setFlash('Ha ocurrido un error.');
            }
		} 
	} 
}