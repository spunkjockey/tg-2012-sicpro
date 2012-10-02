<?php
class ContratosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contrato','Contratoconstructor','Contratosupervisor');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('contratos', $this->Contrato->find('all'));
    }
	
	 public function addordeninicio() {
		$this->layout = 'cyanspark';
		
		
        if ($this->request->is('post')) 
        {
        	$id = $this->request->data['Contrato']['contratos'];
			$this->Contrato->read(null, $id);
            $this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			$this->Contrato->set('userm', $this->Session->read('User.username'));
			$this->Contrato->set('modificacion', date('Y-m-d h:i:s'));
			if($this->Contrato->save($id))
			{
            	$this->Session->setFlash('La Orden de Inicio ha sido registrada.','default',array('class'=>'success'));
            	$this->redirect(array('action' => 'index'));
        	} 
        	else 
        	{
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}

		}

        }
    
	public function contratojson() {
		$contratos = $this->Contrato->find('all',array(
			'fields' => array('Contrato.idproyecto','Contrato.idcontrato', 'Contrato.codigocontrato'),
			'conditions'=>array('Contrato.ordeninicio is null'),
			'order' => array('Contrato.codigocontrato')
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contrato"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
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
	        $this->redirect(array('controller'=>'mains', 'action' => 'index'));
	    }
	}
	
		function update_infoinicio(){
				 if (!empty($this->data['Contrato']['contratos']))
		                {
		                        //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
								$contrato_id = $this->data['Contrato']['contratos'];
		                        $contrato= $this->Contrato->find('first', array(
			                        'fields'=>array(
			                        'Contrato.nombrecontrato','Contrato.fechainiciocontrato','Contrato.fechafincontrato'),
			                        'conditions'=>array('Contrato.idcontrato'=>$contrato_id)));
						$this->set('informacion',$contrato);
		                }
				
				 	
				//Debugger::dump($contrato);
				
				/*$this->set('informacion', Set::combine($contrato,
				"{s}.Contratoconstructor.nombrecontrato",
				"{s}.Contratoconstructor.estadocontrato"
				));*/		
				$this->render('/elements/update_infoinicio', 'ajax');
	}	
}


	