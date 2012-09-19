<?php
// app/Controller/UsersController.php
class UsersController extends AppController {

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
	    if ($this->request->is('post')) {
	        if ($this->Auth->login()) {
	        	$someone = $this->User->findByUsername($this->data['User']['username']);
				$this->Session->write('User.username',$someone['User']['username']);
				$this->Session->write('User.idrol',$someone['User']['idrol']);
				$this->Session->write('User.useragent',$this->request->header('User-Agent'));
				$this->Session->write('User.userip',$this->request->clientIp());
				$this->Session->write('User.nombre',$someone['User']['nombre']);
	            $this->redirect(array('controller'=>'mains'));
	        } else {
	            $this->Session->setFlash(__('Usuario o Contraseña Incorrecta, intente otra vez'));
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
            throw new NotFoundException(__('Invalid user'));
        }
        $this->set('user', $this->User->read(null, $id));
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
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
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
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        $this->redirect(array('action' => 'index'));
    }
}