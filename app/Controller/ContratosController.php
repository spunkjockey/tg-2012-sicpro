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
		
        if ($this->request->is('post')) 
        {
        	$id = $this->request->data['Contrato']['contratos'];
			$this->Contrato->read(null, $id);
            $this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			if($this->Contrato->save($id))
			{
            	$this->Session->setFlash('La Orden de Inicio ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} 
        	else 
        	{
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}

		}

        }
    

	
	public function edit() {
	    $this->layout = 'cyanspark';

				
		//llenar el array
	    	$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'codigocontrato') ) ));
	        
	        //preguntar si es post
		if ($this->request->is('post')) {
			$id = $this->request->data['Contrato']['contratos'];
			$this->Contrato->read(null, $id);	    	
			$this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			//aqui no se si deberias de poner la modificacion del usuario y la fecha
			
	        	if ($this->Contrato->save($id)) {
		            $this->Session->setFlash('La Orden de Inicio ha sido actualizada.');
		            $this->redirect(array('action' => 'index'));
	        	} else {
		            	$this->Session->setFlash('Imposible editar Orden de Inicio');
        		}
	    }
	}
	
	
	public function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contrato->delete($id)) {
	        $this->Session->setFlash('La Orden de Inicio ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}

	