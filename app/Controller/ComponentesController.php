<?php
class ComponentesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


	
	public function add() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    if ($this->Componente->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('El componente han sido registrado.');
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$id = $this->Fichatecnica->id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
}