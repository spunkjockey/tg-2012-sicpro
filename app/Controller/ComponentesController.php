<?php
class ComponentesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session');
	public $uses = array('Fichatecnica','Ubicacion','Componente','Meta');

	
	public function componente_registrar($id=null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$id);
        if ($this->request->is('post')) {
        			foreach ($this->request->data['Meta'] as $key => $value) {
						if(!isset($value['descripcionmeta'])){
							unset($this->request->data['Meta'][$key]);
						}
					}
				    if ($this->Componente->saveAssociated($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('El componente ha sido registrado.','default',array('class' => 'success'));
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
		}
    }
	
	public function componente_registrarmod($id=null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$id);
        if ($this->request->is('post')) {			
				    if ($this->Componente->saveAssociated($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('El componente "'.$this->request->data['Componente']['nombrecomponente'].'" ha sido registrado.','default',array('class' => 'success'));
						Debugger::dump($this->request->data);
		            	$this->redirect(array('controller' => 'Componentes','action' => 'componente_listar',$id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function componente_listar($id = null) {
		$this->layout = 'cyanspark';	
		$this->set('idfichatecnica',$id);
	    $this->set('componentesficha', $this->Componente->find('all',
				array('conditions' => array('Componente.idfichatecnica' => $id))
				));
	}
	
	public function componente_modificar($idcomponente = null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';	
		$this->set('idcomponente',$idcomponente);
		$this->set('idfichatecnica',$idfichatecnica);
	  	$this->set('componentesficha', Hash::extract($this->Componente->find('all',
				array('conditions' => array('Componente.idfichatecnica' => $idfichatecnica,'Componente.idcomponente'=>$idcomponente))
				),'{n}.Componente'));
		
		$this->Componente->idcomponente = $idcomponente;
	    if ($this->request->is('post'))
		    {
		        if ($this->Componente->save($this->request->data)) {
		            $this->Session->setFlash('EL Componente "'. $this->request->data['Componente']['nombrecomponente'] .'" ha sido modificado.','default',array('class' => 'success'));
		            $this->redirect(array('action' => 'componente_listar',$idfichatecnica));
		        } else 
			        {
		            	$this->Session->setFlash('Imposible editar El Componente');
		        	}
		    }
		
	}
	public function agregarmetas(){
		$this->set('helptext', 'Oh, this text is very helpful. ' . date("d-m-Y H:i:s"));
		$this->render('/Elements/helpbox', 'ajax');
		
	}

	function componente_eliminar($idcomponente = null,$idfichatecnica = null) {
		$compo = $this->Componente->findByIdcomponente($idcomponente);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Componente->delete($idcomponente)) {
	        $this->Session->setFlash('El Componente "'. $compo['Componente']['nombrecomponente'] .'" ha sido eliminado.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Componentes','action' => 'componente_listar',$idfichatecnica));
	    }
	}


}