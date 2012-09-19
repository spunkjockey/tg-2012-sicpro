<?php
class MetasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');


	
	public function add() {
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
	
	public function index() {
    	$this->layout = 'cyanspark';
        $this->set('metas', $this->Meta->find('all'));
    }
}