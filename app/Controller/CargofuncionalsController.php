<?php
    class CargofuncionalsController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session');
		
		function index()
		{
			$this->layout = 'cyanspark';
			$this->set('cargofuncional',$this->Cargofuncional->find('all'));
		}
		
		public function add() 
		{
			$this->layout = 'cyanspark';
	        if ($this->request->is('post')) 
	        	{
		        if ($this->Cargofuncional->save($this->request->data)) 
		          	{
		           	$this->Session->setFlash('El cargo ha sido registrado con exito.');
		           	$this->redirect(array('action' => 'index'));
		          	} 
		        else 
	            	{
	               	$this->Session->setFlash('Imposible registrar cargo funcional.');
	            	}
	        	}
    	}
		
		function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Cargofuncional->id = $id;
	    if ($this->request->is('get')) 
	    	{
	        $this->request->data = $this->Cargofuncional->read();
	    	} 
	    else 
	    	{
		        if ($this->Cargofuncional->save($this->request->data)) 
		        {
		            $this->Session->setFlash('División ha sido actualizada.');
		            $this->redirect(array('action' => 'index'));
		        } 
		        else 
		        {
	            	$this->Session->setFlash('Imposible editar División');
	        	}
	    	}
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Cargofuncional->delete($id)) {
	        $this->Session->setFlash('La división ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
    }
?>