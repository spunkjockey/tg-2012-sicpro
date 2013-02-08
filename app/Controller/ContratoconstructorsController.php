<?php

App::uses('CakeEmail', 'Network/Email');

    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler','Email');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona','Realproyecto','CakeEmail','Network/Email');
		
		public function contratoconstructor_listar(){
			$this->layout = 'cyanspark';
			$this->set('contratosc',$this->Contratoconstructor->find('all',
			array('conditions'=> array(
										'Proyecto.estadoproyecto <>' => 'Finalizado'
										),
				'order' => 'Proyecto.numeroproyecto DESC'
										
				  )
			)); 
						
		}
		
		
		/* Funcion para agregar contratos de construcción al sistema*/
		public function contratoconstructor_registrar()
		{
			$this->layout = 'cyanspark';
			if($this->request->is('post'))
			{
				//comprobando que es el primer contrato
				$estadoproyanterior=$this->Proyecto->find('all', array('conditions'=>array('Proyecto.idproyecto' => $this->request->data['Contratoconstructor']['proyectos'])));			
	
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
				$this->Contrato->set('estadocontrato', 'sin estado');
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
					$this->Contratoconstructor->set('estadocontrato', 'sin estado');
					$this->Contratoconstructor->set('userc', $this->Session->read('User.username'));
	                if($this->Contratoconstructor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato constructor '.$this->request->data['Contratoconstructor']['codigocontrato'].' ha sido registrado.',
												'default',array('class'=>'success'));
						
					if($estadoproyanterior[0]['Proyecto']['estadoproyecto']=="Licitacion"){
							$mensaje = 'El proyecto "'.$estadoproyanterior[0]['Proyecto']['nombreproyecto'] .'" pasa a estado de Adjudicacion';
							$to = $this->Persona->find('all',array('conditions'=> array('Persona.idplaza' => 7)));
							$subject = 'Notificacion SICRO';
							$this->enviar_correo($to[0]['Persona']['correoelectronico'],$subject,$mensaje);
						}
						$this->redirect(array('controller'=>'Contratoconstructors', 'action' => 'contratoconstructor_listar'));
						
					}
					else 
					{
						//$this->Session->setFlash('Ha ocurrido un error verifique que los datos sean correctos');
						
	                }
				}
				else 
				{
					//$this->Session->setFlash('Ha ocurrido un error verifique que los datos sean correctos');
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
			$proyectos = $this->Realproyecto->find('all', array(
											'fields'=> array('Realproyecto.idproyecto','Realproyecto.numeroproyecto'),
											'conditions'=>array( 
												
												"OR" => array(
															'Realproyecto.estadoproyecto' => array('Licitacion','Adjudicacion','Ejecucion')))));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Realproyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsondata');
		}

	public function proyectoejecjson() 
		{
			$conditions = array();
				switch ($this->Session->read('User.idrol')) {
					case 3:
				        $conditions =
							array(
								'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'),
								'Proyecto.estadoproyecto' => 'Ejecucion'
								);
				        break;
				    case 2:
				        $conditions = array('Proyecto.estadoproyecto' => 'Ejecucion');
				        break;
				}
			$proyectos = $this->Contratoconstructor->find('all', array(
											'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
											'conditions' => $conditions,
											'order' => 'Proyecto.numeroproyecto DESC'
											));
			//$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('proyectos', $this->eliminarduplicados(Hash::extract($proyectos, "{n}.Proyecto")));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsondata');
		}
		
		
		public function eliminarduplicados($array=null) {
		$count = 0;
		$value = ""; 
    	foreach($array as $array_key => $array_value) 
    	{	 
        	if ( $count >= 1 ) {
        		if($value != $array_value['idproyecto']) {
        			$count = 0; 
        		}
        	}
        	if ( $count == 0 ) 
        	{
            	$value = $array_value['idproyecto']; 
            	$count++;
        	} else {
        		if($array_value['idproyecto'] == $value) {
        			unset($array[$array_key]);
					$count++;
				} else {
					$count = 0;
				}
        	}
        	
    	} 
        return array_values($array);
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
		$conditions = array();
		switch ($this->Session->read('User.idrol')) {
			case 3:
		        $conditions =
					array(
						'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona')
						);
		        break;
		    case 2:
		        $conditions = array();
		        break;
		}
			
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'conditions' => $conditions,
			
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
	function contratoconstructor_modificar($idcontrato=null)
	{
		$this->layout = 'cyanspark';
		$this->Contratoconstructor->id = $idcontrato;
		$this->set('idcontratoconstructor',$idcontrato);
		$idproyecto = $this->Contratoconstructor->field('idproyecto',array('idcontrato'=>$idcontrato));
		//$this->set('idproyecto',$idproyecto);
		$nomproy = $this->Proyecto->field('nombreproyecto',array('idproyecto'=>$idproyecto));
		$this->set('nproy',$nomproy);
		
		
		if ($this->request->is('post')) 
		{
			//$contrato = $this->Contrato->findByCodigocontrato($this->request->data['Contratoconstructor']['codigocontrato']);	
			//$id = $contrato['Contrato']['idcontrato'];
			$this->Contrato->create();
			
			$this->Contrato->set('idcontrato', $idcontrato);
			$this->Contrato->set('idproyecto', $this->request->data['Contratoconstructor']['idproyecto']);
			
			$this->Contrato->set('idpersona', $this->request->data['Contratoconstructor']['idpersona']);
			$this->Contrato->set('idempresa', $this->request->data['Contratoconstructor']['idempresa']);
			$this->Contrato->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
			$this->Contrato->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
			$this->Contrato->set('montooriginal', $this->request->data['Contratoconstructor']['montooriginal']);
			$this->Contrato->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
			$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainiciocontrato']);
			$this->Contrato->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
			$this->Contrato->set('detalleobras', $this->request->data['Contratoconstructor']['detalleobras']);
			$this->Contrato->set('userm', $this->Session->read('User.username'));
			$this->Contrato->set('modificacion', date('Y-m-d h:i:s'));
			
			if ($this->Contrato->save($idcontrato, array(
										'fieldList'=>array('idpersona','idempresa','codigocontrato','nombrecontrato',
														   'montooriginal','plazoejecucion','fechainiciocontrato',
														   'fechafincontrato','detalleobras','userm','modificacion'))))
			{
				$this->Contratoconstructor->create();
				
				$this->Contratoconstructor->set('idcontrato', $idcontrato);
					$this->Contratoconstructor->set('idpersona', $this->request->data['Contratoconstructor']['idpersona']);
					$this->Contratoconstructor->set('idempresa', $this->request->data['Contratoconstructor']['idempresa']);
					$this->Contratoconstructor->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
					$this->Contratoconstructor->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
					$this->Contratoconstructor->set('montooriginal', $this->request->data['Contratoconstructor']['montooriginal']);
					$this->Contratoconstructor->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
					$this->Contratoconstructor->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainiciocontrato']);
					$this->Contratoconstructor->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
					$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['detalleobras']);
					$this->Contratoconstructor->set('retencion', $this->request->data['Contratoconstructor']['montooriginal']*0.05);
					$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
					$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));
					$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
	                
	                if($this->Contratoconstructor->save($idcontrato, array(
										'fieldList'=>array('idpersona','idempresa','codigocontrato','nombrecontrato',
														   'montooriginal','plazoejecucion','fechainiciocontrato',
														   'fechafincontrato','detalleobras','anticipo','retencion',
														   'userm','modificacion'))))
				{
					$this->Session->setFlash('El Contrato de tipo Constructor '.$this->request->data['Contratoconstructor']['codigocontrato'].' ha sido actualizado.',
											 'default',array('class'=>'success'));	
					$this->redirect(array('controller'=>'Contratoconstructors', 'action' => 'contratoconstructor_listar'));
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error Contrato constructor');
	            }
				
			}
			else 
			{
				$this->Session->setFlash('Ha ocurrido un error Contrato');
				//$this->set('error',$this->Contrato->invalidFields());
            }
			
        }
	else
		{
			$this->request->data = $this->Contratoconstructor->read(null, $idcontrato);	
	    } 
    }


	function contratoconstructor_eliminar($idcontrato=null) {
		$contra = $this->Contratoconstructor->findByIdcontrato($idcontrato);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contratoconstructor->delete($idcontrato) && $this->Contrato->delete($idcontrato)) {
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
			$this->Contrato->create();
			$datac = array(
				'idcontrato' => $this->request->data['Estado']['contratos'],
				'estadocontrato' => $this->request->data['Estados'],
				'userm' => $this->Session->read('User.username'),		
				'modificacion' => date('Y-m-d h:i:s'));
				
			if($this->Contrato->save($datac))
				{
					$this->Contratoconstructor->create();
					if ($this->Contratoconstructor->save($datac))  
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
		if (!empty($this->data['Estado']['contratos'])) {
				
			$contrato_id = $this->request->data['Estado']['contratos'];
		    $contrato= $this->Contratoconstructor->find('first', array(
				'fields'=>array('Contratoconstructor.estadocontrato','Contratoconstructor.nombrecontrato'),
			    'conditions'=>array('Contratoconstructor.idcontrato'=>$contrato_id)));
			$this->set('informacion',Hash::extract($contrato,"Contratoconstructor"));	
		
		}
		
		$this->render('/Elements/update_opcionesactualizar', 'ajax');
	}

	public function enviar_correo($to=null,$subject=null,$mensaje=null)
	{
		$email = new CakeEmail('gmail');
		$email->emailFormat('text')
				->to($to)
				->from('noreplysicpro@gmail.com')
				->subject($subject)
				->send($mensaje);
	}

}
