<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session');
	    public $components = array('Session');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			$this->set('proys',$this->Proyecto->find('list', array(
												 'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
												 'conditions'=>array( "OR" => array('Proyecto.estadoproyecto' => array('Licitacion','Adjudicacion'))))));
			
			$this->set('empresas',$this->Empresa->find('list',array(
												 'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa'))));
			
			
			$adm = $this->Persona->query("SELECT personas.idpersona, (nombrespersona||' '||apellidospersona) AS nomcompleto FROM sicpro2012.persona AS personas;");
			$this->set('administradores', Set::combine($adm, "{n}.0.idpersona","{n}.0.nomcompleto"));
			if($this->request->is('post'))
			{
				//Registro en contrato
				$this->Contrato->create();
				$this->Contrato->set('idproyecto', $this->request->data['Contratoconstructor']['proys']);
				$this->Contrato->set('idpersona', $this->request->data['Contratoconstructor']['administradores']);
				$this->Contrato->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
				$this->Contrato->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
				$this->Contrato->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
				$monto = $this->Contrato->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
				$this->Contrato->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
				$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
				$this->Contrato->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
				$this->Contrato->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
				$this->Contrato->set('tipocontrato', 'Construcción de obras');
				$this->Contrato->set('userc', $this->Session->read('User.username'));
				$montoori = (float)$monto*0.05;
				if ($this->Contrato->save()) 
				{
					//Registro en contrato constructor
					$this->Contratoconstructor->set('idcontrato',$this->Contrato->id);
					$this->Contratoconstructor->set('idproyecto',$this->request->data['Contratoconstructor']['proys']);
					$this->Contratoconstructor->set('idpersona', $this->request->data['Contratoconstructor']['administradores']);
					$this->Contratoconstructor->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
					$this->Contratoconstructor->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
					$this->Contratoconstructor->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
					$this->Contratoconstructor->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
					$this->Contratoconstructor->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
					$this->Contratoconstructor->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
					$this->Contratoconstructor->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
					$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
					$this->Contratoconstructor->set('tipocontrato', 'Construcción de obras');
					$this->Contratoconstructor->set('retencion',$montoori);
					$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
					$this->Contratoconstructor->set('userc', $this->Session->read('User.username'));
	                
					if($this->Contratoconstructor->save($this->Contrato->id))
					{
						$this->Session->setFlash('El contrato ha sido registrado');	
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
		
	}
?>