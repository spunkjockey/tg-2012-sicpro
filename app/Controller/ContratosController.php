<?php
class ContratosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('contratos', $this->Contrato->find('all'));
    }
	
	 public function addordeninicio() {
		$this->layout = 'cyanspark';
		$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'codigocontrato') ) ));
		
        if ($this->request->is('post')) {
        	
			$this->Contrato->set('idcontrato', $this->request->data['Contrato'] ['idcontrato']);
			$this->Contrato->set('codigocontrato', $this->request->data['Contrato'] ['codigocontrato']);
            $this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			
            	$this->Session->setFlash('La Orden de Inicio ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
    
	
	function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Contrato->id = $id;
				
	    if ($this->request->is('get')) {
	    	$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'codigocontrato') ) ));
	        $this->request->data = $this->Contrato->read();
	    } else {
	    	$this->Contrato->set('idcontrato', $this->request->data['Contrato'] ['idcontrato']);
			$this->Contrato->set('codigocontrato', $this->request->data['Contrato'] ['codigocontrato']);
			$this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			
			$this->Fuentefinanciamiento->set('ordeninicio', date("Y-m-d H:i:s"));
	        if ($this->Fuentefinanciamiento->save()) {
	            $this->Session->setFlash('La Orden de Inicio ha sido actualizada.');
	            $this->redirect(array('action' => 'index'));
	        } else {
            	$this->Session->setFlash('Imposible editar Orden de Inicio');
        	}
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contrato->delete($id)) {
	        $this->Session->setFlash('La Orden de Inicio ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}

	