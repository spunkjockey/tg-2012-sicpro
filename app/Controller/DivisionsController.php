<?php
    class DivisionsController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session');
		
		function index()
		{
			$this->layout = 'cyanspark';
			$this->set('division',$this->Division->find('all'));
		}
		
		public function add() 
		{
			$this->layout = 'cyanspark';
	        if ($this->request->is('post')) 
	        	{
		        if ($this->Division->save($this->request->data)) 
		          	{
		           	$this->Session->setFlash('La división ha sido registrada con exito.');
		           	$this->redirect(array('action' => 'index'));
		          	} 
		        else 
	            	{
	               	$this->Session->setFlash('Imposible registrar la división.');
	            	}
	        	}
    	}
		
		function edit($IdDivision = null) 
		{
			$this->layout = 'cyanspark';
		    $this->Division->id = $IdDivision;
		    if ($this->request->is('get')) 
		    	{
		        	$this->request->data = $this->Division->read();
		    	} 
		    else 
		    	{
		        	if ($this->Division->save($this->request->data)) 
		        	{
		            	$this->Session->setFlash('División ha sido actualizado.');
		            	$this->redirect(array('action' => 'index'));
		        	}
		    	}
		}
	
	function delete($IdDivision) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Division->delete($IdDivision)) {
	        $this->Session->setFlash('La división ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
    }
?>