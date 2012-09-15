<?php
    class PersonasController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session');
    	public $components = array('Session');
		
		public function add() 
		{
	        $this->layout = 'cyanspark';
			$this->set('plazas', $this->Persona->Plaza->find('list',
												array('fields' => array('Plaza.idplaza', 'Plaza.plaza'))));
			$this->set('cargos', $this->Persona->Cargofuncional->find('list',
												array('fields' => array('Cargofuncional.idcargofuncional', 'Cargofuncional.cargofuncional'))));
			if ($this->request->is('post')) {
	                $this->Persona->set('nombrespersona', $this->request->data['Persona']['nombrespersona']);
					$this->Persona->set('apellidospersona', $this->request->data['Persona']['apellidospersona']);
					$this->Persona->set('idplaza', $this->request->data['Persona']['plazas']);
					$this->Persona->set('idcargofuncional', $this->request->data['Persona']['cargos']);
					$this->Persona->set('telefonocontacto', $this->request->data['Persona']['telefonocontacto']);
					$this->Persona->set('correoelectronico', $this->request->data['Persona']['correoelectronico']);
			if ($this->Persona->save()) {
					$this->Session->setFlash('La persona ha sido registrada');
	                $this->redirect(array('controller'=>'mains', 'action' => 'index'));
	            }
				else {
				
					$this->Session->setFlash('Ha ocurrido un error'. print_r($this->Persona->data));
	                         }
        }
    }	
		
    }
?>