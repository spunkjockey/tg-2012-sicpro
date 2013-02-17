<?php
App::uses('CakeEmail', 'Network/Email');

class ContratosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
   public $components = array('Session','AjaxMultiUpload.Upload','RequestHandler','Email');
	public $uses = array('Empresa','Contrato','Contratoconstructor','Contratosupervisor','Proyecto','Avanceprogramado','Estimacion','Informesupervisor','Ordendecambio','Persona','CakeEmail','Network/Email');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('contratos', $this->Contrato->find('all'));
    }
	
	 
	 
	 public function addordeninicio($id=null) {
		$this->layout = 'cyanspark';
		if ($this->request->is('post')) 
        {
        	//Debugger::dump($this->request->data);	
        	$id = $this->request->data['Contrato']['contratos'];
			$this->Contrato->create();
			$tipo = $this->Contrato->field('tipocontrato',array('idcontrato'=>$id));
			
			$this->Contrato->create();
			if($tipo=='Construcción de obras') {
				$data = array(
					'idcontrato' => $this->request->data['Contrato']['contratos'],
					'ordeninicio'=> $this->request->data['Contrato']['ordeninicio'],
					'userm'=> $this->Session->read('User.username'),
					'modificacion' => date('Y-m-d h:i:s'),
					'estadocontrato' => 'en marcha');
			} else {
				$data = array(
					'idcontrato' => $this->request->data['Contrato']['contratos'],
					'ordeninicio'=> $this->request->data['Contrato']['ordeninicio'],
					'userm'=> $this->Session->read('User.username'),
					'modificacion' => date('Y-m-d h:i:s'));
			}
			
			//Deterinar el idproyecto y verificar si alguno de posee orden de inicio, para comprobar que es el primer ingreso
			$proy=$this->Contrato->findByIdcontrato($id);
			$cantidad=$this->Contrato->find('count', array('conditions'=> array('Contrato.idproyecto'=> $proy['Contrato']['idproyecto'],'Contrato.ordeninicio !='=>null)));
			
				
			if($this->Contrato->save($data)) 
			{
			       	if($tipo=='Construcción de obras')
					{
							$this->Contratoconstructor->set('idcontrato', $this->request->data['Contrato']['contratos']);
				            $this->Contratoconstructor->set('ordeninicio', $this->request->data['Contrato']['ordeninicio']);
							$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));
							$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
							$this->Contratoconstructor->set('estadocontrato','en marcha');
							if($this->Contratoconstructor->save($id, array('fieldList'=>array('estadocontrato','ordeninicio','userm','modificacion'))))
							{
								$this->Session->setFlash('La Orden de Inicio ha sido registrada en el Contrato Constructor.','default',array('class'=>'success'));
		            			
								//si ninguno de los contratos tiene orden de inicio para es proyecto, es decir es el primer contrato que inicia
								//el proyecto pasa a estado de ejecucion
								if($cantidad == 0){
									$mensaje = 'El proyecto "'. $proy['Proyecto']['nombreproyecto'].'" pasa a estado de Ejecución';
									$to=Hash::extract($this->Persona->User->query('SELECT
									persona.idpersona,
									persona.correoelectronico
									FROM
									sicpro2012.users,
									sicpro2012.persona
									WHERE
									persona.idpersona = users.idpersona AND
									users.idrol = 1 AND
									users.estado = true;'),'{n}.0');					
								
									$subject = 'Notificacion SICPRO';
									foreach ($to as $key => $value) {
										$this->enviar_correo($to[$key]['correoelectronico'],$subject,$mensaje);
									}
								}
		            			$this->redirect(array('controller'=>'mains', 'action' => 'index'));	
							}
							else 
							{
								$this->Session->setFlash('NNo se pudo agregar la orden de inicio al Contrato Constructor');
							}
					}
					//Si no es de construccion se asume es de supervision
					else 
					{
							$this->Contratosupervisor->set('idcontrato', $this->request->data['Contrato']['contratos']);
				            $this->Contratosupervisor->set('ordeninicio', $this->request->data['Contrato']['ordeninicio']);
							$this->Contratosupervisor->set('userm', $this->Session->read('User.username'));
							$this->Contratosupervisor->set('modificacion', date('Y-m-d h:i:s'));
							//$this->Contratosupervisor->set('estadocontrato','en marcha');
							if($this->Contratosupervisor->save($id, array('fieldList'=>array('estadocontrato','ordeninicio','userm','modificacion'))))
							{
									
								$this->Session->setFlash('La Orden de Inicio ha sido registrada en el Contrato Supervisor.','default',array('class'=>'success'));
		            			$this->redirect(array('controller'=>'mains', 'action' => 'index'));	
							}
							else 
							{
								$this->Session->setFlash('No se pudo agregar la orden de inicio al Contrato Supervisor');
							}
			
					}	

			}
			else
			{
				$this->Session->setFlash('No se pudo agregar la orden de inicio al Contrato');	
			}
			//Debugger::dump($tipo);
           	//Verifica el tipo de contrato para actualizar en la tabla correspondiente
           	//Primero se verifica si es de construccion
    
		}
  	

	}
    
	public function contratojson() {
		$contratos = $this->Contrato->find('all',array(
			'fields' => array('Contrato.idproyecto','Contrato.idcontrato', 'Contrato.codigocontrato'),
			'conditions'=> array(
			'OR' => array('Contrato.ordeninicio' => null, 'Contrato.ordeninicio >= now()'),
			'Contrato.idpersona' => $this->Session->read('User.idpersona')),
			
			'order' => array('Contrato.codigocontrato')
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contrato"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}

	public function proyectojson() {
		$proyectos = $this->Proyecto->find('all',array(
					'fields' => array('Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
					'conditions' => array('Proyecto.estadoproyecto' => array('Ejecucion','Adjudicacion')),
					'order'=>'Proyecto.numeroproyecto'
		 ));
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
		
	}
	
	public function proyectoordenjson() {
		$proyectos = $this->Contrato->find('all',array(
					'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
					'conditions' => array(
							'Proyecto.estadoproyecto' => array('Ejecucion','Adjudicacion'),
							'Contrato.idpersona' => $this->Session->read('User.idpersona'),
							'OR' => array('Contrato.ordeninicio' => null, 'Contrato.ordeninicio >= now()')
							),
					'order'=>'Proyecto.numeroproyecto')
		 );
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
		
	}

	public function edit() {
	    $this->layout = 'cyanspark';

				
		//llenar el array
	    	$this->set('contratos', $this->Contrato->find('list',
		array ('fields'=> array ('idcontrato', 'codigocontrato') ) ));
	        
	        //preguntar si es post
		if ($this->request->is('post')) {
			$id = $this->request->data['Contrato']['contratos'];
			$this->Contrato->read(null, $id);	    	
			$this->Contrato->set('ordeninicio', $this->request->data['Contrato'] ['ordeninicio']);
			//aqui no se si deberias de poner la modificacion del usuario y la fecha
			
	        	if ($this->Contrato->save($id)) {
		            $this->Session->setFlash('La Orden de Inicio ha sido actualizada.');
		            $this->redirect(array('action' => 'index'));
	        	} else {
		            	$this->Session->setFlash('Imposible editar Orden de Inicio');
        		}
	    }
	}
	
	
	public function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Contrato->delete($id)) {
	        $this->Session->setFlash('La Orden de Inicio ha sido eliminada.');
	        $this->redirect(array('controller'=>'mains', 'action' => 'index'));
	    }
	}
	
		function update_infoinicio(){
				 if (isset($this->data['Contrato']['contratos']) && !empty($this->data['Contrato']['contratos']))
		                {
		                        //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
								$contrato_id = $this->data['Contrato']['contratos'];
		                        $contrato= $this->Contrato->find('first', array(
			                        'fields'=>array(
			                        'Contrato.nombrecontrato','Contrato.fechainiciocontrato','Contrato.fechafincontrato','Contrato.ordeninicio'),
			                        'conditions'=>array('Contrato.idcontrato'=>$contrato_id)));
						$this->set('informacion',$contrato);
		                }
				
				 	
				//Debugger::dump($contrato);
				
				/*$this->set('informacion', Set::combine($contrato,
				"{s}.Contratoconstructor.nombrecontrato",
				"{s}.Contratoconstructor.estadocontrato"
				));*/		
				$this->render('/Elements/update_infoinicio', 'ajax');
	}	
		
	public function avancecontrato() {
		$this->layout = 'cyanspark';

	} 

	public function contratosjson() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato','Contratoconstructor.nombrecontrato'),
			'order' => array('Contratoconstructor.idcontrato')//,
			//'conditions' => array('Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona'))
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		//$this->set('contratos', $contratos);
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsoncontratotecproy');
		
	}
	
	public function contratosavjson() {
	$contratos = $this->Contratoconstructor->query('SELECT 
		  DISTINCT contratoconstructor.idcontrato, 
		  contratoconstructor.codigocontrato, 
		  contratoconstructor.nombrecontrato
		FROM 
		  sicpro2012.contratosupervisor, 
		  sicpro2012.contratoconstructor, 
		  sicpro2012.informesupervision
		WHERE 
		  contratoconstructor.idcontrato = contratosupervisor.con_idcontrato AND
		  informesupervision.idcontrato = contratosupervisor.idcontrato
		ORDER BY contratoconstructor.idcontrato;');
	
	$this->set('contratos', Hash::extract($contratos, "{n}.0"));
	//$this->set('contratos', $contratos);
	$this->set('_serialize', 'contratos');
	$this->render('/json/jsoncontratotecproy');
		
	}
	
	public function update_avancecontrato() {
		//Debugger::dump($this->request->data);
		if(isset($this->request->data['contratos'])&&!empty($this->request->data['contratos']))
		{
			$contrato = $this->Contratoconstructor->findByNombrecontrato($this->request->data['contratos']);
			//Debugger::dump($contrato);
			if(isset($contrato)&&!empty($contrato)) {
				$avance = $this->Avanceprogramado->findAllByIdcontrato($contrato['Contratoconstructor']['idcontrato'],
					array(),
					array('Avanceprogramado.fechaavance' => 'ASC'),
					null,
					null,
					0 
				);
				//Debugger::dump($avance);
				$estimacion = $this->Estimacion->findAllByIdcontrato($contrato['Contratoconstructor']['idcontrato'],
					array(),
					array('Estimacion.fechafinestimacion' => 'ASC'),
					null,
					null,
					0 
				);
				//Debugger::dump($estimacion);
				$scontrato = $this->Contratosupervisor->findByCon_idcontrato($contrato['Contratoconstructor']['idcontrato'],array('recursive'=>0 ));
				//Debugger::dump($scontrato);
				$supervision = $this->Informesupervisor->findAllByIdcontrato($scontrato['Contratosupervisor']['idcontrato'],
					array(),
					array('Informesupervisor.fechafinsupervision' => 'ASC'),
					null,
					null,
					0
				);
		
				$avancesupervision = $this->Informesupervisor->query('select * 
					from
						(select * from sicpro2012.avanceprogramado where avanceprogramado.idcontrato = '. $contrato['Contratoconstructor']['idcontrato'] .') avance 
					LEFT JOIN 
						(select * from sicpro2012.informesupervision where informesupervision.idcontrato = '. $scontrato['Contratosupervisor']['idcontrato'] .') informe 
							ON avance.fechaavance = informe.fechafinsupervision 
					order by avance.fechaavance');
				//Debugger::dump($avancesupervision);
				//Debugger::dump(Hash::extract($avance,'{n}.Avanceprogramado'));
				$this->set('contrato',$contrato);
				$this->set('avances',$avance);
				$this->set('estimaciones',$estimacion);
				$this->set('scontrato',$scontrato);
				$this->set('supervisiones',$supervision); 
				$this->set('avancesupervision',$avancesupervision);
			}
		}
		
			
		$this->render('/Elements/update_avancecontrato', 'ajax');
	}

	public function avancecontrato_pdf($idcontrato=null){
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		
		if(isset($idcontrato)&&!empty($idcontrato))
		{
			$contrato = $this->Contratoconstructor->findByIdcontrato($idcontrato);
			//Debugger::dump($contrato);
			
			
			if(isset($contrato)&&!empty($contrato)) {
				
				$avance = $this->Avanceprogramado->findAllByIdcontrato($idcontrato,
					array(),
					array('Avanceprogramado.fechaavance' => 'ASC'),
					null,
					null,
					0 
				);
				//Debugger::dump($avance);
				
				$estimacion = $this->Estimacion->findAllByIdcontrato($idcontrato,
					array(),
					array('Estimacion.fechafinestimacion' => 'ASC'),
					null,
					null,
					0 
				);
			
				//Debugger::dump($estimacion);
				
				$scontrato = $this->Contratosupervisor->findByCon_idcontrato($idcontrato,array('recursive'=>0 ));
				//Debugger::dump($scontrato);
				
				$supervision = $this->Informesupervisor->findAllByIdcontrato($scontrato['Contratosupervisor']['idcontrato'],
					array(),
					array('Informesupervisor.fechafinsupervision' => 'ASC'),
					null,
					null,
					0
				);
				
				
				$avancesupervision = $this->Informesupervisor->query('select * 
					from 
					sicpro2012.avanceprogramado LEFT JOIN sicpro2012.informesupervision ON avanceprogramado.fechaavance = informesupervision.fechafinsupervision 
					where avanceprogramado.idcontrato = '. $idcontrato .'
					order by avanceprogramado.fechaavance');
				
				//Debugger::dump($avancesupervision);
				//Debugger::dump(Hash::extract($avance,'{n}.Avanceprogramado'));
				
				
				$this->set('contrato',$contrato);
				$this->set('avances',$avance);
				$this->set('estimaciones',$estimacion);
				$this->set('scontrato',$scontrato);
				$this->set('supervisiones',$supervision); 
				$this->set('avancesupervision',$avancesupervision);
				
				}
		}
		
		
		$this->render();
	} 
	
	public function contrato_consultar(){
		$this->layout = 'cyanspark';
			$this->set('contratos',$this->Contrato->find('all',array(
				'order' => array('Contrato.idproyecto DESC','Contrato.codigocontrato ASC')))); 
	}

	public function contrato_detalle($idcontrato=null){
		$this->layout = 'cyanspark';
		if (!$this->Contrato->exists($idcontrato)) {
        	throw new NotFoundException('No se puede encontrar el contrato', 404);
    	} 
    	else {
	        $contratos = $this->Contrato->findByIdcontrato($idcontrato);
			$this->set('contratos',$contratos);
			
			if($contratos['Contrato']['tipocontrato']=='Supervisión de obras') {
				$contratoss = $this->Contratosupervisor->findByIdcontrato($idcontrato);
				$this->set('contratoss',$contratoss);
				$this->set('codigocon', $this->Contratoconstructor->field('codigocontrato',array('idcontrato'=>$contratoss['Contratosupervisor']['con_idcontrato'])));
				$idempresa = $this->Contratoconstructor->field('idempresa',array('idcontrato'=>$contratoss['Contratosupervisor']['con_idcontrato']));	
				$this->set('nombreempresa', $this->Empresa->field('nombreempresa',array('idempresa'=>$idempresa)));               			
			} else {
				$contratosc = $this->Contratoconstructor->findByIdcontrato($idcontrato);
				$this->set('contratosc',$contratosc);
				
				$ordenes =$this->Ordendecambio->find('all',
				array('conditions'=> array('Ordendecambio.idcontrato'=>$idcontrato)));
				$this->set('ordenes',$ordenes);
			}
		}
	}
	
	function estadojson() {
		$contratos = $this->Contrato->find('all', array(
			'fields'=>array('DISTINCT Contrato.estadocontrato'),
			'recursive' => 0,
			'order' => 'Contrato.estadocontrato'
			));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contrato"));
		//$this->set('contratos', $contratos);
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsoncontratotecproy');
	}
	
	function tipojson() {
		$contratos = $this->Contrato->find('all', array(
			'fields'=>array('DISTINCT Proyecto.numeroproyecto'),
			//'recursive' => 0,
			'order' => 'Proyecto.numeroproyecto'
			));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Proyecto"));
		//$this->set('contratos', $contratos);
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsoncontratotecproy');
	}

	//funcion para enviar correo
	public function enviar_correo($to=null,$subject=null,$mensaje=null)
	{
		if(isset( $to) || isset($mensaje)){
		 try {
		$email = new CakeEmail('gmail');
		$email->emailFormat('text')
				->to($to)
				->from('noreplysicpro@gmail.com')
				->subject($subject)
				->send($mensaje);
				 	return true;
	    } catch (Exception $e) {
	        return false;
	    }
		}
    }

}


	