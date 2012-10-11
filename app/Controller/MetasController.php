<?php
class MetasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


	
	public function meta_registrar() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    if ($this->Meta->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Meta ha sido registrada.');
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$id = $this->Fichatecnica->id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function meta_modificar($idcomponente = null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idcomponente',$idcomponente);
		$this->set('idfichatecnica',$idfichatecnica);
		$this->set('metas',$this->Meta->find('all',array(
		'conditions'=> array('Meta.idcomponente'=> $idcomponente
		))));

        if ($this->request->is('post')) {
				    if ($this->Meta->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Meta ha sido registrada.');
		            	$this->redirect(array('controller' => 'Componentes','action' => 'componente_listar',$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function meta_registrarmod($idcomponente=null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$idfichatecnica);
        if ($this->request->is('post')) {
        			$this->Meta->set('idcomponente',$idcomponente);
        			$this->Meta->set('userc', $this->Session->read('User.username'));
					$this->Meta->set('descripcionmeta',$this->request->data['Metas']['descripcionmeta']);
					
				    if ($this->Meta->save()) {
		            	$this->Session->setFlash('La Meta ha sido registrada.','default',array('class' => 'success'));
		            	$this->redirect(array('controller' => 'Metas','action' => 'meta_modificar',$idcomponente,$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	function meta_eliminar( $idmeta = null,$idcomponente = null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Meta->delete($idmeta)) {
	        $this->Session->setFlash('La Meta ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Metas','action' => 'meta_modificar',$idcomponente));
	    }
	}
	
	public function index() {
    	$this->layout = 'cyanspark';
        $this->set('metas', $this->Meta->find('all'));
    }
}