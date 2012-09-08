<?php
class DepartamentosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
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
		$this->layout = 'cyanspark';
	    $this->Departamento->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Departamento->read();
	    } else {
	        if ($this->Departamento->save($this->request->data)) {
	            $this->Session->setFlash('Departamento ha sido actualizado.');
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Departamento->delete($id)) {
	        $this->Session->setFlash('El Departamento ha sido eliminado.');
	        $this->redirect(array('action' => 'index'));
	    }
	}

	function pruebaajax() {
		 $this->set('helptext', 'Oh, this text is very helpful.');
		$this->render('/elements/helpbox', 'ajax');
	}
	
}