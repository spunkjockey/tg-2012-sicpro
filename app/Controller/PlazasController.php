<?php
    class PlazasController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session');
		
		function index()
		{
			$this->layout = 'cyanspark';
			$this->set('plaza',$this->Plaza->find('all'));
		}
		
		public function add() 
		{
			$this->layout = 'cyanspark';
	        if ($this->request->is('post')) 
	        	{
			        if ($this->Plaza->save($this->request->data)) 
			          	{
			           		$this->Session->setFlash('La plaza ha sido registrada con exito.');
			           		$this->redirect(array('action' => 'index'));
			          	} 
			        else 
		            	{
		               		$this->Session->setFlash('Imposible registrar plaza.');
		            	}
	        	}
    	}
		
		function edit($id = null) 
		{
			$this->layout = 'cyanspark';
		    $this->Plaza->id = $id;
		    if ($this->request->is('get')) 
		    	{
		        	$this->request->data = $this->Plaza->read();
		    	} 
		    else 
		    	{
			        if ($this->Plaza->save($this->request->data)) 
			        	{
				            $this->Session->setFlash('Plaza ha sido actualizada.');
				            $this->redirect(array('action' => 'index'));
			        	} 
			        else 
				        {
			            	$this->Session->setFlash('Imposible editar plaza');
			        	}
		    	}
		}
		
		function delete($id) 
		{
			if (!$this->request->is('post')) 
			{
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Plaza->delete($id)) 
		    {
		        $this->Session->setFlash('La plaza ha sido eliminada.');
		        $this->redirect(array('action' => 'index'));
		    }
		}
		
		
		
    } 
?>