<?php
    class InformetecnicosController extends AppController{
    	public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Informetecnico','Contratotecproy');
		
	    public function informetecnico_registrar()
	    {
	    	$this->layout = 'cyanspark';
			$idpersona = $this->Contratotecproy->field('idpersona',
													   array('username'=>$this->Session->read('User.username')));
			if($this->request->is('post'))
			{
				$this->Informetecnico->set('antecedentes', $this->request->data['Informetecnico']['antecedentes']);
				$this->Informetecnico->set('fechavisita', $this->request->data['Informetecnico']['fechavisita']);
				$this->Informetecnico->set('fechaelaboracion', $this->request->data['Informetecnico']['fechaelab']);
				$this->Informetecnico->set('anotacion', $this->request->data['Informetecnico']['anotaciones']);
				$this->Informetecnico->set('idcontrato', $this->request->data['Informetecnico']['contratos']);
				$this->Informetecnico->set('idpersona',$idpersona);
				$this->Informetecnico->set('userc', $this->Session->read('User.username'));
				if ($this->Informetecnico->save()) 
				{
	            	$this->Session->setFlash('El informe técnico ha sido agregado.','default',array('class'=>'success'));
	            	$this->redirect(array('controller'=>'mains', 'action' => 'index'));
        		}
        		else 
        		{
            		$this->Session->setFlash('No se pudo realizar el registro');
        		}
			}
			
				
	    }
		
		public function contratojson() 
		{
			$contratos = $this->Contratotecproy->find('all', array(
								'fields'=> array('idcontrato','codigocontrato'),
								'conditions'=>array('AND'=>array(
													'estadocontrato' => array('a tiempo','atrasado'),
													'estadoproyecto'=>'Ejecucion',
													'username'=>$this->Session->read('User.username')))
										));
										
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratotecproy"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsoncontratotecproy');
			
		}
	}
?>