<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona');
		
		public function contratoconstructor_listar(){
			$this->layout = 'cyanspark';
			$this->set('contratosc',$this->Contratoconstructor->find('all',
			array('conditions'=> array(
										'Proyecto.estadoproyecto <>' => 'Finalizado'
										)
				  )
			)); 
						
		}
		
		
		/* Funcion para agregar contratos de construcción al sistema*/
		public function contratoconstructor_registrar()
		{
			$this->layout = 'cyanspark';
			if($this->request->is('post'))
			{
				 //Registro en tabla contrato
				$this->Contrato->create();
				//Debugger::dump($this->request->data);
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
					$this->Contratoconstructor->set('fechainiciocontrato',  $this->request->data['Contratoconstructor']['fechainicontrato']);
					$this->Contratoconstructor->set('fechafincontrato',  $this->request->data['Contratoconstructor']['fechafincontrato']);
					$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
					$this->Contratoconstructor->set('tipocontrato', 'Construcción de obras');
					$this->Contratoconstructor->set('retencion', $this->request->data['Contratoconstructor']['montocon']*0.05);
					$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
					$this->Contratoconstructor->set('userc', $this->Session->read('User.username'));
	                if($this->Contratoconstructor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato constructor '.$this->request->data['Contratoconstructor']['codigocontrato'].' ha sido registrado.',
												'default',array('class'=>'success'));	
						$this->redirect(array('controller'=>'mains', 'action' => 'index'));
						
					}
					else 
					{
						$this->Session->setFlash('Ha ocurrido un error verifique que los datos sean correctos');
						
	                }
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error verifique que los datos sean correctos');
                }
			}
		}

	function update_nomproyecto()
	{
		if (!empty($this->data['Contratoconstructor']['proyectos']))
			{	
				$proy_id = $this->request->data['Contratoconstructor']['proyectos'];
				$info = $this->Proyecto->find('first',array(
							'fields'=>array('Proyecto.nombreproyecto'),
							'conditions'=>array('Proyecto.idproyecto'=>$proy_id)));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_nomproyecto', 'ajax');
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
		$admin = $this->Persona->query("SELECT personas.idpersona, (nombre||' '||apellidos) AS nomcompleto FROM sicpro2012.users AS personas WHERE estado = true and idrol=3;");
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

	/*proycontratosjson()
	 * Esta función extrae los proyectos que tienen registrados contratos, 
	 * siempre que el proyecto se encuentre en los siguientes estados:
	 * Adjudicación o Ejecución
	 * */
	function proycontratosjson()
	{
		$proyectos = $this->Proyecto->find('all',array(
			'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
			'conditions'=>array( "AND" => array('Proyecto.estadoproyecto' => array('Adjudicacion','Ejecucion'),
										  array('Proyecto.idproyecto IN (SELECT idproyecto FROM sicpro2012.contratoconstructor)'))),
			'order'=>array('Proyecto.numeroproyecto')
			));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsonproyecto');
	}
	
	/*conconstructorjson()
	 * Esta función extrae los contratos de construcción que se encuentren
	 * en los siguientes estados: en marcha, a tiempo y atrasado,
	 * en base a los proyectos de la función proycontratosjson() 
	 * */
	function conconstructorjson()
	{
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'conditions'=>array('OR'=>array('Contratoconstructor.estadocontrato'=>array('a tiempo','atrasado','en marcha'),
									  array('Contratoconstructor.estadocontrato is null'))),
			'order' => array('Contratoconstructor.codigocontrato')
			));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	/*update_infoconstructor()
	 * Esta funcion se encarga de actualizar los datos en los campos del formulario
	 * en cuanto se seleccione un proyecto y luego un contrato
	 * */
	 function update_infoconconstructor()
	 {
	 	if (!empty($this->data['Contratoconstructor']['contratos']))
		{
			$cont_id = $this->request->data['Contratoconstructor']['contratos'];
			$info = $this->Contratoconstructor->find('first',array(
						'fields'=>array('Contratoconstructor.codigocontrato','Contratoconstructor.nombrecontrato',
										'Contratoconstructor.montooriginal','Contratoconstructor.anticipo',
										'Contratoconstructor.plazoejecucion','Contratoconstructor.fechainiciocontrato',
										'Contratoconstructor.fechafincontrato','Contratoconstructor.detalleobras',
										'Contratoconstructor.idpersona','Contratoconstructor.idempresa'),
						'conditions'=>array('Contratoconstructor.idcontrato'=>$cont_id)));
			$this->set('info',$info);
		}
		$this->render('/Elements/update_infoconconstructor', 'ajax');
	 }
	 
	/*contratoconstructor_modificar()
	 * Esta función permite modificar la información de un contrato de construcción
	 * se auxilia de las funciones conconstructorjson(), conconstructorjson() y
	 * update_infoconstructor() esta ultima implementa ajax a los campos
	 * */
	function contratoconstructor_modificar($id=null)
	{
		$this->layout = 'cyanspark';
		$this->Contratoconstructor->id = $id;
		
		$info = $this->Contratoconstructor->find('all',
			array('conditions'=>array('Contratoconstructor.idcontrato'=>$id)));
		$this->set('infoc',$info);
		if ($this->request->is('post')) 
		{

			$this->Contratoconstructor->create();
			
			$this->Contratoconstructor->set('idcontrato', $id);
			$this->Contratoconstructor->set('idpersona', $this->request->data['Contratoconstructor']['admin']);
			$this->Contratoconstructor->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
			$this->Contratoconstructor->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
			$this->Contratoconstructor->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
			$this->Contratoconstructor->set('montooriginal', $this->request->data['Contratoconstructor']['montooriginal']);
			$this->Contratoconstructor->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
			$this->Contratoconstructor->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainiciocontrato']);
			$this->Contratoconstructor->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
			$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['detalleobras']);
			$this->Contratoconstructor->set('tipocontrato', 'Construcción de obras');
			$this->Contratoconstructor->set('retencion', $this->request->data['Contratoconstructor']['montooriginal']*0.05);
			$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
			$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));
			$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
            if($this->Contratoconstructor->save($id,array(
					'fieldList'=>array('idcontrato','idpersona','idempresa','codigocontrato','nombrecontrato',
									   'montooriginal','plazoejecucion','fechainiciocontrato',
									   'fechafincontrato','detalleobras','userm','modificacion',
									   'retencion','anticipo'))))
			{
				//Debugger::dump($this->request->data);
				echo "supuestamente ya guarde en constructor";
				$this->Session->setFlash('El contrato '.$this->request->data['Contratoconstructor']['codigocontrato'].' ha sido actualizado.',
										 'default',array('class'=>'success'));	
				$this->redirect(array('controller'=>'Contratoconstructors', 'action' => 'contratoconstructor_listar'));
				
			}
			else 
			{
				$this->Session->setFlash('Ha ocurrido un error verifique que los datos sean correctos');
            }
        }
	else
		{
			$this->request->data = $this->Contratoconstructor->read(null, $id);	
	    } 
    }


	function contratoconstructor_eliminar($idcontrato=null) {
		$contra = $this->Contratoconstructor->findByIdcontrato($idcontrato);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contratoconstructor->delete($idcontrato)) {
	        $this->Session->setFlash('El Contrato Constructor "'. $contra['Contratoconstructor']['codigocontrato'] .'" ha sido eliminado.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'contratoconstructor_listar'));
	    } else {
	    	$this->Session->setFlash('El Contrato Constructor "'. $contra['Contratoconstructor']['codigocontrato'] .'" no ha sido eliminado, esto se debe a que tiene relaciones con otros elementos');
			$this->redirect(array('action' => 'contratoconstructor_listar'));
	    }
	}
	
	public function contrato_actualizarestado(){
		$this->layout = 'cyanspark';
		if($this->request->is('post'))
			{
			$idc=$this->request->data['Estado']['contratos'];
			$this->Contrato->set('idcontrato', $this->request->data['Estado']['contratos']);
			$this->Contrato->set('estadocontrato', $this->request->data['Estados']);
			$this->Contrato->set('userm', $this->Session->read('User.username'));		
			$this->Contrato->set('modificacion', date('Y-m-d h:i:s'));
			if($this->Contrato->save($idc, array('fieldList'=>array('estadocontrato','userm','modificacion'))))
				{
					$id=$this->request->data['Estado']['contratos'];	
					$this->Contratoconstructor->read(null, $id);
					$this->Contratoconstructor->set('estadocontrato', $this->request->data['Estados']);	
					$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));		
					$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
					if ($this->Contratoconstructor->save($id, array('fieldList'=>array('estadocontrato','userm','modificacion'))))  
					{
						$contraselected=$this->Contratoconstructor->findByIdcontrato($this->request->data['Estado']['contratos']);
			            $this->Session->setFlash('El Contrato constructor "'. $contraselected['Contratoconstructor']['codigocontrato'] .'" ha sido actualizado al estado "'. $this->request->data['Estados'] .'" .','default',array('class'=>'success'));
			            $this->redirect(array('action' => 'contrato_actualizarestado'));
				    } else 
				        	{
			            		$this->Session->setFlash('Imposible actualizar el estado del contrato constructor');
		        			}
				}
				else 
					{
			          $this->Session->setFlash('Imposible actualizar el estado del contrato');
					}
		}
	}
		
	function update_infocontrato(){
				 if (!empty($this->data['Estado']['contratos']))
		                {
								$contrato_id = $this->request->data['Estado']['contratos'];
		                        $contrato= $this->Contratoconstructor->find('all', array(
		                        	'recursive' => 0,
			                        'fields'=>array(
			                        'Contratoconstructor.nombrecontrato','Contratoconstructor.estadocontrato'),
			                        'group' => array('Contratoconstructor.idcontrato'),
			                        'conditions'=>array('Contratoconstructor.idcontrato'=>$contrato_id)));
						$this->set('informacion', Hash::extract($contrato, "{n}.Contratoconstructor"));			
						//$this->set('informacion',$contrato);	
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
						
						$this->set('informacion',Hash::extract($contrato,"Contratoconstructor"));	
					}
				$this->render('/Elements/update_opcionesactualizar', 'ajax');
	}

}
