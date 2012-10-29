<?php
    class ContratosupervisorsController extends AppController 
    {
	    public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona','Contratosupervisor','Contdisponibles');
		
		
		public function contratosupervisor_listar(){
			$this->layout = 'cyanspark';
			$this->set('contratoss',$this->Contratosupervisor->find('all',
			array('conditions'=> array(
										'Proyecto.estadoproyecto <>' => 'Finalizado'
										)
				  )
			)); 
		}
		
		public function contratosupervisor_registrar()
		{
			$this->layout = 'cyanspark';
			
			if($this->request->is('post'))
			{
				//Registro de contrato
				
				$this->Contrato->create();
				$this->Contrato->set('idproyecto', $this->request->data['Contratosupervisor']['proyectos']);
				$this->Contrato->set('idpersona', $this->request->data['Contratosupervisor']['admin']);
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
				if (is_numeric($this->request->data['Contratosupervisor']['contratos'])) 
					{
						$this->Contrato->set('con_idcontrato', $this->request->data['Contratosupervisor']['contratos']);
					} 
					else 
					{
						$contratoid = $this->Contratoconstructor->findByCodigocontrato($this->request->data['Contratosupervisor']['contratos']);
						$this->Contrato->set('con_idcontrato', $contratoid['Contratoconstructor']['idcontrato']);
					}
				//Guardar contrato
				if ($this->Contrato->save()) 
				{
					//Registro en contratosupervisor
					$this->Contratosupervisor->set('idcontrato',$this->Contrato->id);
					$this->Contratosupervisor->set('idproyecto',$this->request->data['Contratosupervisor']['proyectos']);
					$this->Contratosupervisor->set('idpersona', $this->request->data['Contratosupervisor']['admin']);
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
					//Guardar contratosupervisor	
					if($this->Contratosupervisor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato supervisor '.$this->request->data['Contratosupervisor']['codigocontrato'] .'ha sido registrado.',
												 'default',array('class'=>'success'));	
						$this->redirect(array('controller'=>'Contratosupervisors', 'action' => 'contratosupervisor_listar'));
					}
					else 
					{
						$this->Session->setFlash('Ha ocurrido un error');
	                }
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error. No se puede guardar el contrato');
                }
			}
			
		}

		function update_nomproyecto()
		{
			if (!empty($this->data['Contratosupervisor']['proyectos']))
				{	
					$proy_id = $this->request->data['Contratosupervisor']['proyectos'];
					$info = $this->Proyecto->find('first',array(
								'fields'=>array('Proyecto.nombreproyecto'),
								'conditions'=>array('Proyecto.idproyecto'=>$proy_id)));
					$this->set('info',$info);
				}
				$this->render('/Elements/update_nomproyecto', 'ajax');
		}
		
		
		function update_infoconstructor()
		{
			if (!empty($this->data['Contratosupervisor']['contratos']))
			{	
				$cont_id = $this->request->data['Contratosupervisor']['contratos'];
				$info = $this->Contratoconstructor->find('first',array(
							'fields'=>array('Contratoconstructor.nombrecontrato','Contratoconstructor.plazoejecucion',
											'Contratoconstructor.fechainiciocontrato','Contratoconstructor.fechafincontrato'),
							'conditions'=>array('Contratoconstructor.idcontrato'=>$cont_id)));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_infoconstructor', 'ajax');	
		}
		
		public function proyectojson() 
		{
			$proyectos = $this->Contdisponibles->find('all');
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Contdisponibles"));
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
		$admin = $this->Persona->query("SELECT personas.idpersona, (nombre||' '||apellidos) AS nomcompleto FROM sicpro2012.users AS personas WHERE estado = true and idrol=3;");
		$this->set('admin', Hash::extract($admin,'{n}.0'));
		$this->set('_serialize', 'admin');
		$this->render('/json/jsonadmin');	
		
	}

	/*Funciones para modificacion de contrato de supervision*
	 * 
	 */
	
	function contratosupervisor_modificar($id=null)
	{
		$this->layout = 'cyanspark';
		$this->Contratoconstructor->id = $id;
		$idcontrato = $id;
		$info = $this->Contratosupervisor->find('all',
			array('conditions'=>array('Contratosupervisor.idcontrato'=>$id)));
		$this->set('infoc',$info);
		$contratos = $this->Contratoconstructor->query('select idcontrato, codigocontrato
				FROM sicpro2012.contratoconstructor
				WHERE 
					idcontrato NOT IN (SELECT con_idcontrato 
							FROM sicpro2012.contratosupervisor)
					OR
					idcontrato IN (SELECT con_idcontrato 
							FROM sicpro2012.contratosupervisor 
							WHERE contratosupervisor.idcontrato = '.$id.');');
		$this->set('con_idcontrato',$contratos);
		
		
		if ($this->request->is('post')) 
		{
			$this->Contrato->create();
			//$id = $this->request->data['Contratosupervisor']['contratos'];
			
			$this->Contrato->set('idcontrato', $id);
			$this->Contrato->set('con_idcontrato',$this->request->data['Contratosupervisor']['con_idcontrato']);
			$this->Contrato->set('idpersona', $this->request->data['Contratosupervisor']['admin']);
			$this->Contrato->set('idempresa', $this->request->data['Contratosupervisor']['empresas']);
			$this->Contrato->set('codigocontrato', $this->request->data['Contratosupervisor']['codigocontrato']);
			$this->Contrato->set('nombrecontrato', $this->request->data['Contratosupervisor']['nombrecontrato']);
			$this->Contrato->set('montooriginal', $this->request->data['Contratosupervisor']['montooriginal']);
			$this->Contrato->set('plazoejecucion', $this->request->data['Contratosupervisor']['plazoejecucion']);
			$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratosupervisor']['fechainiciocontrato']);
			$this->Contrato->set('fechafincontrato', $this->request->data['Contratosupervisor']['fechafincontrato']);
			$this->Contrato->set('detalleobras', $this->request->data['Contratosupervisor']['detalleobras']);
			$this->Contrato->set('userm', $this->Session->read('User.username'));
			$this->Contrato->set('modificacion', date('Y-m-d h:i:s'));
			if ($this->Contrato->save($id, array(
										'fieldList'=>array('idpersona','idempresa','codigocontrato','nombrecontrato',
														   'montooriginal','plazoejecucion','fechainiciocontrato',
														   'fechafincontrato','detalleobras','userm','modificacion',
														   'con_idcontrato')))) 
				
				{
					//Registro en tabla contrato supervisor
					$this->Contratosupervisor->create();
					
					$this->Contratosupervisor->set('idcontrato', $idcontrato);
					$this->Contratosupervisor->set('idpersona', $this->request->data['Contratosupervisor']['admin']);
					$this->Contratosupervisor->set('idempresa', $this->request->data['Contratosupervisor']['empresas']);
					$this->Contratosupervisor->set('codigocontrato', $this->request->data['Contratosupervisor']['codigocontrato']);
					$this->Contratosupervisor->set('nombrecontrato', $this->request->data['Contratosupervisor']['nombrecontrato']);
					$this->Contratosupervisor->set('montooriginal', $this->request->data['Contratosupervisor']['montooriginal']);
					$this->Contratosupervisor->set('plazoejecucion', $this->request->data['Contratosupervisor']['plazoejecucion']);
					$this->Contratosupervisor->set('fechainiciocontrato', $this->request->data['Contratosupervisor']['fechainiciocontrato']);
					$this->Contratosupervisor->set('fechafincontrato', $this->request->data['Contratosupervisor']['fechafincontrato']);
					$this->Contratosupervisor->set('detalleobras', $this->request->data['Contratosupervisor']['detalleobras']);
					$this->Contratosupervisor->set('con_idcontrato', $this->request->data['Contratosupervisor']['con_idcontrato']);
					$this->Contratosupervisor->set('cantidadinformes', $this->request->data['Contratosupervisor']['cantidadinformes']);
					$this->Contratosupervisor->set('userm', $this->Session->read('User.username'));
					$this->Contratosupervisor->set('modificacion', date('Y-m-d h:i:s'));
	                
	                if($this->Contratosupervisor->save($id, array(
										'fieldList'=>array('idpersona','idempresa','codigocontrato','nombrecontrato',
														   'montooriginal','plazoejecucion','fechainiciocontrato',
														   'fechafincontrato','detalleobras','con_idcontrato','cantidadinformes',
														   'userm','modificacion'))))
					{
						$this->Session->setFlash('El contrato '.$this->request->data['Contratosupervisor']['codigocontrato'].' ha sido actualizado.',
												 'default',array('class'=>'success'));	
						$this->redirect(array('controller'=>'Contratosupervisors', 'action' => 'contratosupervisor_listar'));
						
					}
					else 
					{
						$this->Session->setFlash('Ha ocurrido un error cc');
	                }
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error c');
					debug($this->Contrato->validationErrors);
                }
		}
		else 
		{
	        $this->request->data = $this->Contratosupervisor->read(null, $id);
		}
	}
	
	function proyectoconjson()
	{
		$proyectos = $this->Proyecto->find('all',array(
				'fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
				'conditions'=>array('Proyecto.idproyecto IN 
										(SELECT idproyecto FROM sicpro2012.contratosupervisor)')
				));
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
	}
	
	function contratossuperjson()
	{
		$contratos = $this->Contratosupervisor->find('all',array(
				'fields'=>array('idproyecto','idcontrato','codigocontrato'),
				'conditions'=>array('estadocontrato is null')
			));
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratosupervisor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
	}
	
	function conidcontratojson()
	{
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
			'conditions'=>array("OR"=>array(
								'Contratoconstructor.idcontrato NOT IN (SELECT con_idcontrato 
																	 	  FROM sicpro2012.contratosupervisor)'),
								'Contratoconstructor.idcontrato IN (SELECT con_idcontrato 
																	 	  FROM sicpro2012.contratosupervisor) 
																	 	  WHERE contratosupervisor.idcontrato')
		));
		$this->set('construccion', Hash::extract($contratos, "{n}.Contdisponibles"));
		$this->set('_serialize', 'construccion');	
		
		/*$construccion = $this->Contdisponibles->find('all',array(
			'fields' => array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
		));
		
		$this->set('construccion', Hash::extract($construccion, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'construccion');*/
		$this->render('/json/jsonconidcontrato');
		
	}
	
	function update_infoconsupervisor()
	{
		if (!empty($this->data['Contratosupervisor']['contratos']))
		{
			$cont_id = $this->request->data['Contratosupervisor']['contratos'];
			$info = $this->Contratosupervisor->find('first',array(
						'fields'=>array('codigocontrato','nombrecontrato','con_idcontrato',
										'montooriginal','plazoejecucion','fechainiciocontrato',
										'fechafincontrato','detalleobras','cantidadinformes',
										'idpersona','idempresa'),
						'conditions'=>array('idcontrato'=>$cont_id)));
			$this->set('info',$info);
		}
		$this->render('/Elements/update_infoconsupervisor', 'ajax');
	}
	
	function contratosupervisor_eliminar($idcontrato=null) {
		$contra = $this->Contratosupervisor->findByIdcontrato($idcontrato);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contratosupervisor->delete($idcontrato)) {
	        $this->Session->setFlash('El contrato de supervisión "'. $contra['Contratosupervisor']['codigocontrato'] .'" ha sido eliminado.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'contratosupervisor_listar'));
	    } else {
	    	$this->Session->setFlash('El contrato supervisión "'. $contra['Contratosupervisor']['codigocontrato'] .'" no ha sido eliminado, esto se debe a que tiene relaciones con otros elementos');
			$this->redirect(array('action' => 'contratosupervisor_listar'));
	    }
	}
		
	}
?>