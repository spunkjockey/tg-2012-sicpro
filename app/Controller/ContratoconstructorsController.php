<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona');
		
		/* Funcion para agregar contratos de construcción al sistema*/
		public function add()
		{
			$this->layout = 'cyanspark';
			if($this->request->is('post'))
			{
				//Registro en tabla contrato
				$this->Contrato->create();
				$this->Contrato->set('idproyecto', $this->request->data['Contratoconstructor']['proyectos']);
				$this->Contrato->set('idpersona', $this->request->data['Contratoconstructor']['admin']);
				$this->Contrato->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
				$this->Contrato->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
				$this->Contrato->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
				$this->Contrato->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
				$this->Contrato->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
				$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
				$this->Contrato->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
				$this->Contrato->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
				$this->Contrato->set('tipocontrato', 'Construcción de obras');
				$this->Contrato->set('userc', $this->Session->read('User.username'));
				if ($this->Contrato->save()) 
				{
					//Registro en tabla contrato constructor
					$this->Contratoconstructor->set('idcontrato',$this->Contrato->id);
					$this->Contratoconstructor->set('idproyecto',$this->request->data['Contratoconstructor']['proyectos']);
					$this->Contratoconstructor->set('idpersona', $this->request->data['Contratoconstructor']['admin']);
					$this->Contratoconstructor->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
					$this->Contratoconstructor->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
					$this->Contratoconstructor->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
					$this->Contratoconstructor->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
					$this->Contratoconstructor->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
					$this->Contratoconstructor->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
					$this->Contratoconstructor->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
					$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
					$this->Contratoconstructor->set('tipocontrato', 'Construcción de obras');
					$this->Contratoconstructor->set('retencion', $this->request->data['Contratoconstructor']['montocon']*0.05);
					$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
					$this->Contratoconstructor->set('userc', $this->Session->read('User.username'));
	                if($this->Contratoconstructor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato constructor ha sido registrado.','default',array('class'=>'success'));	
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

	/*funcion para recuperar listado de proyectos*/
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

	public function proyectoejecjson() 
		{
			$proyectos = $this->Proyecto->find('all', array(
											'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
											'conditions'=>array( 
															'Proyecto.estadoproyecto' => 'Ejecucion')));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsondata');
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

	public function contratojson() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'order' => array('Contratoconstructor.codigocontrato')
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	function contratoconstructor_modificar()
	{
		$this->layout = 'cyanspark';
	}
	
	public function contrato_actualizarestado(){
		$this->layout = 'cyanspark';
		if($this->request->is('post'))
			{
				$id=$this->request->data['Estado']['contratos'];	
				$this->Contratoconstructor->read(null, $id);
				$this->Contratoconstructor->set('estadocontrato', $this->request->data['Estados']);	
				$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));		
				$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
				Debugger::dump($this->request->data);
				if ($this->Contratoconstructor->save($id)) {
					$contraselected=$this->Contratoconstructor->findByIdcontrato($this->request->data['Estado']['contratos']);
		            $this->Session->setFlash('El Contrato constructor '. $contraselected['Contratoconstructor']['codigocontrato'] .' ha sido actualizado al estado "'. $this->request->data['Estados'] .'" .','default',array('class'=>'success'));
		            $this->redirect(array('action' => 'contrato_actualizarestado'));
			        } else {
		            	$this->Session->setFlash('Imposible actualizar el estado del contrato constructor');
	        	}
			}
	}
		
	function update_infocontrato(){
				 if (!empty($this->data['Estado']['contratos']))
		                {
								$contrato_id = $this->request->data['Estado']['contratos'];
		                        $contrato= $this->Contratoconstructor->find('first', array(
			                        'fields'=>array(
			                        'Contratoconstructor.nombrecontrato','Contratoconstructor.estadocontrato'),
			                        'conditions'=>array('Contratoconstructor.idcontrato'=>$contrato_id)));
						$this->set('informacion',$contrato);	
		                }

				$this->render('/Elements/update_infocontrato', 'ajax');
	}	

	function update_opcionesactualizar(){
				 if (!empty($this->data['Estado']['contratos']))
		                {
								$contrato_id = $this->request->data['Estado']['contratos'];
		                        $contrato= $this->Contratoconstructor->find('first', array(
			                        'fields'=>array('Contratoconstructor.estadocontrato'),
			                        'conditions'=>array('Contratoconstructor.idcontrato'=>$contrato_id)));
						$this->set('informacion',$contrato);	
					}
				$this->render('/Elements/update_opcionesactualizar', 'ajax');
	}

}
