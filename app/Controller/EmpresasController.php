<?php
class EmpresasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','Javascript','Js');
    public $components = array('Session');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('empresas', $this->Empresa->find('all'));
    }
	
	public function view($id = null) {
		$this->layout = 'cyanspark';
        $this->Empresa->id = $id;
		if (!$this->Empresa->read()) {
        	throw new NotFoundException('No se puede encontrar la Empresa', 404);
    	} else {
        	$this->set('empresas', $this->Empresa->read());
		}
    }
	
	public function view_w($id = null) {
		//$this->layout = 'cyanspark';
        $this->Empresa->id = $id;
		if (!$this->Empresa->read()) {
        	throw new NotFoundException('No se puede encontrar la Empresa', 404);
    	} else {
        	$this->set('empresas', $this->Empresa->read());
		}
		$this->render('view_w','ajax');
    }

	
	public function empresa_registrar() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    if ($this->Empresa->save($this->request->data, array('validate' => true, 'callbacks' => true))) {


		            	$this->Session->setFlash('La Empresa '. $this->request->data['Empresa']['nombreempresa'] .' ha sido registrada.','default',array('class' => 'success'));

		            	$this->redirect(array('action' => 'index'));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' );
		        	}			
		}
    }

	function empresa_modificar($id = null) {
		$this->layout = 'cyanspark';
	    $this->Empresa->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Empresa->read();
	    } else {
	        if ($this->Empresa->save($this->request->data)) {
	            $this->Session->setFlash('La Empresa '. $this->request->data['Empresa']['nombreempresa'] .' ha sido registrada.','default',array('class' => 'success'));
	            $this->redirect(array('action' => 'index'));
	        } else {
            	$this->Session->setFlash('Imposible editar Empresa');
        	}
	    }
	}
	
	function delete($id) {
		$empresa = $this->Empresa->findByIdempresa($id);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Empresa->delete($id)) {
	        $this->Session->setFlash('La Empresa '. $empresa['Empresa']['nombreempresa'] .' ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'index'));
	    }
	}
}