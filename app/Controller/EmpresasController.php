<?php
class EmpresasController extends AppController {
    public $helpers = array('Html', 'Form');
	
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
/*	
	public function view($id = null) {
        $this->Post->id = $id;
        $this->set('post', $this->Post->read());
    }
*/

	
	public function add() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
            if ($this->Empresa->save($this->request->data)) {
                $this->Session->setFlash('La Empresa ha sido registrada.');
                $this->redirect(array('action' => 'add'));
            } else {
                $this->Session->setFlash('No se pudo realizar el registro');
            }
        }
    }

	function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Empresa->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Empresa->read();
	    } else {
	        if ($this->Empresa->save($this->request->data)) {
	            $this->Session->setFlash('Empresa ha sido actualizado.');
	            $this->redirect(array('action' => 'index'));
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