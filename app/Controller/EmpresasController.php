<?php
class EmpresasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	/*public $components = array(
    'Session',
    'Auth' => array(
        'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
        'authorize' => array('Controller') // Added this line
		)
	);
*/
    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('empresas', $this->Empresa->find('all'));
    }
	
	public function view($id = null) {
		$this->layout = 'cyanspark';
        $this->Empresa->id = $id;
        $this->set('empresas', $this->Empresa->read());
    }

	
	public function add() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
        	//$this->Empresa->set($this->request->data);
        	//if ($this->Empresa->validates()) {
				    // it validated logic
				    if ($this->Empresa->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Empresa ha sido registrada.');
		            	$this->redirect(array('action' => 'index'));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' . $this->data['Empresa']['nitempresa'] );
		        	}
				/*} else {
				    // didn't validate logic
				    $errors = $this->Empresa->validationErrors;
				}*/
				
			
		}
    }

	function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Empresa->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Empresa->read();
	    } else {
	        if ($this->Empresa->save($this->request->data)) {
	            $this->Session->setFlash('Empresa ha sido actualizada.');
	            $this->redirect(array('action' => 'index'));
	        } else {
            	$this->Session->setFlash('Imposible editar Empresa');
        	}
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Empresa->delete($id)) {
	        $this->Session->setFlash('La Empresa ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}