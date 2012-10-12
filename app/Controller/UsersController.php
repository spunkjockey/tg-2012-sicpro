<?php
// app/Controller/UsersController.php
class UsersController extends AppController {
		public $helpers = array('Html', 'Form', 'Session', 'Js');
    	public $components = array('Session','RequestHandler');
		public $uses = array('User','Rol');
	
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
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	$someone = $this->User->findByUsername($this->data['User']['username']);
				$this->Session->write('User.username',$someone['User']['username']);
				$this->Session->write('User.idpersona',$someone['User']['idpersona']);
				$this->Session->write('User.idrol',$someone['User']['idrol']);
				$this->Session->write('User.useragent',$this->request->header('User-Agent'));
				$this->Session->write('User.userip',$this->request->clientIp());
				$this->Session->write('User.nombre',$someone['User']['nombre']);
	             $this->redirect($this->Auth->redirect());
	            //$this->redirect(array('controller'=>'mains'));
	        } else {
	            $this->Session->setFlash(__('Usuario o Contraseña Incorrecta, intente otra vez', 'default', array('class' => 'errorlogin')));
	        }
    	}
	}
	
	public function logout() {
    	$this->Session->destroy();
    	$this->redirect($this->Auth->logout());
		
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
										'fields' => array('User.id','User.nombre','User.apellidos','User.username',
														  'User.estado','Rol.rol'))));
	}

    public function add() {
        $this->layout = 'cyanspark';
		$this->set('roles', $this->User->Rol->find('list',
												array('fields' => array('Rol.idrol', 'Rol.rol'))));
        if ($this->request->is('post')) 
        {
            $this->User->create();
			$this->User->set('username', $this->request->data['User']['username']);
			$this->User->set('password', $this->request->data['User']['password']);
			$this->User->set('nombre', $this->request->data['User']['nombrespersona']);
			$this->User->set('apellidos', $this->request->data['User']['apellidospersona']);
			$this->User->set('estado', $this->request->data['User']['estado']);
			$this->User->set('idrol', $this->request->data['User']['roles']);
            if ($this->User->save()) 
            {
                $this->Session->setFlash(('Usuario registrado'));
                $this->redirect(array('controller'=>'mains', 'action' => 'index'));
            } 
            else 
            {
                $this->Session->setFlash('Ha ocurrido un error');
            }
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Usuario invalido'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('El usuario ha sido actualizado'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('El usuario no puede ser registrado. Intente otra vez.'));
            }
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
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
            $this->Session->setFlash(__('Usuario eliminado'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('Usuario no fué eliminado'));
        $this->redirect(array('action' => 'index'));
    }
}