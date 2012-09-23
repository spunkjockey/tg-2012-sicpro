<?php
class EstimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('estimacions', $this->Estimacion->find('all'));
    }
	
	 public function RegistarEstimacion() {
		$this->layout = 'cyanspark';
		$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'nombrecontrato') ) ));
		$this->set('proyectos', $this->Proyecto->find('list',
		array ('fields'=> array ('idproyecto', 'nombreproyecto') ) ));
		
        if ($this->request->is('post')) {
        	
			$this->Contrato->set('idcontrato', $this->request->data['Contrato'] ['idcontrato']);
			$this->Contrato->set('nombrecontrato', $this->request->data['Contrato'] ['nombrecontrato']);
            $this->Proyecto->set('idproyecto', $this->request->data['Proyecto'] ['idproyecto']);
			$this->Proyecto->set('nombreproyecto', $this->request->data['Proyecto'] ['nombreproyecto']);
            $this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('documentoestimacion', $this->request->data['Estimacion'] ['documentoestimacion']);		
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
            	
            	
            	
            	
            	
            	$this->Session->setFlash('La Estimación de Avance ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
	
	function edit() {
	    $this->layout = 'cyanspark';

				
		//llenar el array
	    	$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'codigocontrato') ) ));
	        $this->set('proyectos', $this->Proyecto->find('list',
		array ('fields'=> array ('idproyecto', 'nombreproyecto') ) ));
		
	        //preguntar si es post
		if ($this->request->is('post')) {
			$id = $this->request->data['Estimacion']['Estimacions'];
			$this->Contrato->read(null, $id);	    	
			$this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			
			
	        	if ($this->Estimacion->save($id)) {
		            $this->Session->setFlash('La Estimación de Avance ha sido actualizada.');
		            $this->redirect(array('action' => 'index'));
	        	} else {
		            	$this->Session->setFlash('Imposible editar Estimación de Avance');
        		}
	    }
	}
	
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Estimacion->delete($id)) {
	        $this->Session->setFlash('La Estimación de Avance ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}

	