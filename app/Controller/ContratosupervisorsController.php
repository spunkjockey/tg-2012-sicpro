<?php
    class ContratosupervisorsController extends AppController 
    {
	    public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona','Contratosupervisor');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			
			/*
			//Contratos del primer proyecto listado
			
								
			$this->set('contratos', Set::combine($con_cons, "{n}.Contratoconstructor.idcontrato","{n}.Contratoconstructor.codigocontrato"));
			*/
			if($this->request->is('post'))
			{
				//Registro de contrato
				$this->Contrato->create();
				$this->Contrato->set('idproyecto', $this->request->data['Contratosupervisor']['proys']);
				$this->Contrato->set('idpersona', $this->request->data['Contratosupervisor']['administradores']);
				$this->Contrato->set('idempresa', $this->request->data['Contratosupervisor']['empresas']);
				$this->Contrato->set('codigocontrato', $this->request->data['Contratosupervisor']['codigocontrato']);
				$this->Contrato->set('nombrecontrato', $this->request->data['Contratosupervisor']['nombrecontrato']);
				$this->Contrato->set('plazoejecucion', $this->request->data['Contratosupervisor']['plazoejecucion']);
				$this->Contrato->set('montooriginal', $this->request->data['Contratosupervisor']['montocon']);
				$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratosupervisor']['fechainicontrato']);
				$this->Contrato->set('fechafincontrato', $this->request->data['Contratosupervisor']['fechafincontrato']);
				$this->Contrato->set('detalleobras', $this->request->data['Contratosupervisor']['obras']);
				$this->Contrato->set('tipocontrato', 'Supervisión de obras');
				$this->Contrato->set('userc', $this->Session->read('User.username'));
				
				if ($this->Contrato->save()) 
				{
					//Registro en contratosupervisor
					$this->Contratosupervisor->set('idcontrato',$this->Contrato->id);
					$this->Contratosupervisor->set('idproyecto',$this->request->data['Contratosupervisor']['proys']);
					$this->Contratosupervisor->set('idpersona', $this->request->data['Contratosupervisor']['administradores']);
					$this->Contratosupervisor->set('idempresa', $this->request->data['Contratosupervisor']['empresas']);
					$this->Contratosupervisor->set('codigocontrato', $this->request->data['Contratosupervisor']['codigocontrato']);
					$this->Contratosupervisor->set('nombrecontrato', $this->request->data['Contratosupervisor']['nombrecontrato']);
					$this->Contratosupervisor->set('montooriginal', $this->request->data['Contratosupervisor']['montocon']);
					$this->Contratosupervisor->set('tipocontrato', 'Supervisión de obras');
					$this->Contratosupervisor->set('plazoejecucion', $this->request->data['Contratosupervisor']['plazoejecucion']);
					$this->Contratosupervisor->set('fechainiciocontrato', $this->request->data['Contratosupervisor']['fechainicontrato']);
					$this->Contratosupervisor->set('fechafincontrato', $this->request->data['Contratosupervisor']['fechafincontrato']);
					$this->Contratosupervisor->set('detalleobras', $this->request->data['Contratosupervisor']['obras']);
					$this->Contratosupervisor->set('cantidadinformes', $this->request->data['Contratosupervisor']['cantinf']);
					$this->Contratosupervisor->set('userc', $this->Session->read('User.username'));
	                
					if (is_numeric($this->request->data['Contratosupervisor']['contratos'])) 
					{
						$this->Contratosupervisor->set('con_idcontrato', $this->request->data['Contratosupervisor']['contratos']);
					} 
					else 
					{
						$contratoid = $this->Contratoconstructor->findByCodigocontrato($this->request->data['Contratosupervisor']['contratos']);
						$this->Contratosupervisor->set('con_idcontrato', $contratoid['Contratoconstructor']['idcontrato']);
					}	
					if($this->Contratosupervisor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato supervisor ha sido registrado.','default',array('class'=>'success'));	
						$this->redirect(array('controller'=>'mains', 'action' => 'index'));
					}
					else 
					{
						$this->Session->setFlash('Ha ocurrido un error');
	                }
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error');
                }
			}
			
		}

		public function proyectojson() 
		{
			$proyectos = $this->Proyecto->find('all', array(
											'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
											'conditions'=>array( "OR" => array(
															'Proyecto.estadoproyecto' => array('Licitacion','Adjudicacion','Ejecucion')))));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsondata');
		}
		
		public function contratojson() 
		{
			$contratos = $this->Contratoconstructor->find('all',array(
				'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
				'conditions'=>array('Contratoconstructor.idcontrato NOT IN (SELECT con_idcontrato FROM sicpro2012.contratosupervisor)'),
				'order' => array('Contratoconstructor.codigocontrato')
			));
			
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
		}
		
		public function empresajson()
	{
		$empresas = $this->Empresa->find('all',array(
										'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa')));
		$this->set('empresas', Hash::extract($empresas, "{n}.Empresa"));
		$this->set('_serialize', 'empresas');
		$this->render('/json/jsonempresa');								
	}
	
	public function adminjson()
	{
		$admin = $this->Persona->query("SELECT personas.idpersona, (nombrespersona||' '||apellidospersona) AS nomcompleto FROM sicpro2012.persona AS personas;");
		$this->set('admin', Hash::extract($admin,'{n}.0'));
		$this->set('_serialize', 'admin');
		$this->render('/json/jsonadmin');	
		
	}

		
	}
?>