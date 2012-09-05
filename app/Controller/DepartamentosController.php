<?php
class DepartamentosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('departamentos', $this->Departamento->find('all'));
    }
	
	public function add() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
            if ($this->Departamento->save($this->request->data)) {
                $this->Session->setFlash('El Departamento ha sido registrado con exito.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Imposible registrar el Departamento.');
            }
        }
    }
	
	function edit($id = null) {
		$this->layout = 'minimalism';
	    $this->Empresa->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Empresa->read();
	    } else {
	        if ($this->Empresa->save($this->request->data)) {
	            $this->Session->setFlash('Empresa ha sido actualizada.');
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}
	
	function delete($id) {
		$this->layout = 'minimalism';
	    if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Empresa->delete($id)) {
	        $this->Session->setFlash('La empresa con id: ' . $id . ' ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
	
}