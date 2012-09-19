<?php
class ComponentesController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session');


	
	public function add($id=null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$id);
        if ($this->request->is('post')) {
        			Debugger::dump($this->request->data);
				    if ($this->Componente->saveAssociated($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('El componente han sido registrado.');
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function agregarmetas(){
		$this->set('helptext', 'Oh, this text is very helpful. ' . date("d-m-Y H:i:s"));
		$this->render('/elements/helpbox', 'ajax');
		
	}
}