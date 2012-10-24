<?php
class NombramientosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','Javascript','Js');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contrato','Persona','Nombramiento','Proyecto',
						 'Contratoconstructor','Nombratecnico','Contratosupervisor');
	
	public function nombramiento_asignartecnico($idproyecto=null,$idcontrato=null){
		$this->layout = 'cyanspark';
		//$selected = $this->Nombramiento->find('all',array('conditions' => array('Nombramiento.idcontrato' => '1')));
		//$d = Hash::extract($selected,'{n}.Nombramiento.idpersona');
		$this->set('idcontrato',$idcontrato);
		$this->set('idproyecto',$idproyecto);
		
		 if (!empty($idcontrato))
		 {
		                        //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
								$contrato_id = $idcontrato;
								
								$per= $this->Persona->find('all', array(
									                        'fields'=>array(
									                        'Persona.idpersona','Persona.nombrespersona', 'Persona.apellidospersona'),
						
									'conditions' => array('Persona.idpersona NOT IN (SELECT idpersona FROM sicpro2012.nombramiento where nombramiento.idcontrato = '.$contrato_id.' AND nombramiento.estado = TRUE)',
															'Persona.idcargofuncional'=> '5')
																	));
								$perx = $this->Persona->find('all');
								//Tenicos disponibles para ser asignados al contrato seleccinoado
								$this->set('disponibles',$per);
								
								$per2= $this->Nombramiento->find('all', array(
									                        'fields'=>array(
									                        'Nombramiento.idnombramiento','Persona.nombrespersona', 'Persona.apellidospersona'),
									'conditions' => array('Nombramiento.idcontrato' => $contrato_id,'Nombramiento.estado' =>TRUE)
																	));
								//Tecnicos que estan asignados al contrato seleccinado
								$this->set('seleccionados',$per2);
		}
		
		
		
		
		//Asignar un tecnico y darlo de ALTA
		if(isset($this->request->data['boton_1'])){
			if ($this->request->is('post')) {
					    // it validated logic
					    $presente = $this->Nombramiento->find('count',array('conditions' => array(
						'Nombramiento.idpersona' => $this->request->data['disponibles'],
						'Nombramiento.idcontrato' =>$this->request->data['Nombramiento']['contratos'])));
						if($presente==0)
							{
								$this->Nombramiento->set('idpersona', $this->request->data['disponibles']);
								$this->Nombramiento->set('idcontrato', $this->request->data['Nombramiento']['contratos']);
								$this->Nombramiento->set('estado', TRUE);
								$this->Nombramiento->set('userc', $this->Session->read('User.username'));			
							    if ($this->Nombramiento->save()) {
							    	$tecnico=$this->Persona->findByIdpersona($this->request->data['disponibles']);
									$contrato=$this->Contratoconstructor->findByIdcontrato($this->request->data['Nombramiento']['contratos']);
					            	$this->Session->setFlash('Tecnico "'. $tecnico['Persona']['nombrespersona'] .' '. $tecnico['Persona']['apellidospersona'] .'" Asignado al contrato "'. $contrato['Contratoconstructor']['codigocontrato'] .'".','default',array('class'=>'success'));
					            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
					            	$this->redirect(array('controller' => 'Nombramientos','action' => 'nombramiento_asignartecnico',
					            	$this->request->data['Nombramiento']['proyectos'],
					            	$this->request->data['Nombramiento']['contratos']));
					        	} else {
					            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
					        	}
				        	}
						//Si la persona ya existe en la tabla nombramiento para ese contrato,solo se modifica su estado y respectiva fecha de alta
						if($presente==1){
							$idnombramiento=$this->Nombramiento->findByIdpersona($this->request->data['disponibles']);
							$this->Nombramiento->id = $idnombramiento['Nombramiento']['idnombramiento'];
							
							$this->Nombramiento->set('userm', $this->Session->read('User.username'));
							$this->Nombramiento->set('fechanombramiento', date('Y-m-d h:i:s'));
							$this->Nombramiento->set('estado', TRUE);
							if ($this->Nombramiento->save($this->request->data)) {
							    	$tecnico=$this->Persona->findByIdpersona($this->request->data['disponibles']);
									$contrato=$this->Contratoconstructor->findByIdcontrato($this->request->data['Nombramiento']['contratos']);
					            	$this->Session->setFlash('Tecnico "'. $tecnico['Persona']['nombrespersona'] .' '. $tecnico['Persona']['apellidospersona'] .'" Asignado al contrato "'. $contrato['Contratoconstructor']['codigocontrato'] .'".','default',array('class'=>'success'));
					            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
					            	$this->redirect(array('controller' => 'Nombramientos','action' => 'nombramiento_asignartecnico',
					            	$this->request->data['Nombramiento']['proyectos'],
					            	$this->request->data['Nombramiento']['contratos']));
					        	} else {
					            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
					        	}
						}
	    	}
		}
		
		//asignar un tecnico y darlo de baja
		/*$this->request->data['seleccionados']}*/
		if(isset($this->request->data['boton_2'])){
			$valor = $this->request->data['seleccionados'];
			$this->Nombramiento->set('idcontrato', $this->request->data['Nombramiento']['contratos']);
			$this->Nombramiento->id = $this->request->data['seleccionados'];
			//$this->Nombramiento->read(null,$this->request->data['seleccionados']);
			$this->Nombramiento->set('userm', $this->Session->read('User.username'));
			$this->Nombramiento->set('fechadebaja', date('Y-m-d h:i:s'));
			$this->Nombramiento->set('estado', FALSE);
			$tmp = $this->Nombramiento->findByIdnombramiento($valor);
			if ($this->Nombramiento->save($this->request->data)) {	
		        $this->Session->setFlash('Tecnico "'. $tmp['Persona']['nombrespersona'] .' '. $tmp['Persona']['apellidospersona'] .'" Desasignado al contrato "'. $tmp['Contrato']['codigocontrato'] .'".','default',array('class'=>'success'));
		        $this->redirect(array('controller' => 'Nombramientos','action' => 'nombramiento_asignartecnico',
					  $this->request->data['Nombramiento']['proyectos'],
					  $this->request->data['Nombramiento']['contratos']));
		    }
		}
	}
	
	
	public function proyectojson() {
		$conditions =
		array(
		    'OR' => array(
		        array('Proyecto.estadoproyecto' => 'Ejecucion'),
		        array('Proyecto.estadoproyecto' => 'Adjudicacion')
				)
			);
		$proyectos = $this->Proyecto->find('all',array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.numeroproyecto'), 
			'conditions' => $conditions,
			'order' => array('Proyecto.numeroproyecto')
		));
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
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
	
	
	function update_multic(){
				 if (!empty($this->data['Nombramiento']['contratos']))
		                {
		                        //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
								$contrato_id = $this->data['Nombramiento']['contratos'];
								
		                        $contrato= $this->Nombramiento->find('all', array(
			                        'fields'=>array(
			                        'Persona.idpersona','Persona.nombrespersona' || 'Persona.apellidospersona'),
			                        'conditions'=>array('Nombramiento.idcontrato'=>$contrato_id)));
						$this->set('informacion',$contrato);
		                }
				$this->render('/Elements/update_multic', 'ajax');
	}

	function update_tecdispo(){
				 if (!empty($this->data['Nombramiento']['contratos']))
		                {
		                        //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
								$contrato_id = $this->data['Nombramiento']['contratos'];
		
		$per= $this->Persona->find('all', array(
			                        'fields'=>array(
			                        'Persona.idpersona','Persona.nombrespersona', 'Persona.apellidospersona'),

			'conditions' => array('Persona.idpersona NOT IN (SELECT idpersona FROM sicpro2012.nombramiento where nombramiento.idcontrato = '.$contrato_id.' AND nombramiento.estado = TRUE)',
									'Persona.idcargofuncional'=> '5')
											));
		$perx = $this->Persona->find('all');
		//Tenicos disponibles para ser asignados al contrato seleccinoado
		$this->set('disponibles',$per);
		
		$per2= $this->Nombramiento->find('all', array(
			                        'fields'=>array(
			                        'Nombramiento.idnombramiento','Persona.nombrespersona', 'Persona.apellidospersona'),
			'conditions' => array('Nombramiento.idcontrato' => $contrato_id,'Nombramiento.estado' =>TRUE)
											));
		//Tecnicos que estan asignados al contrato seleccinado
		$this->set('seleccionados',$per2);

		                }
				$this->render('/Elements/update_multic', 'ajax');
	}

	function nombramiento_reporte_asignados()
	{
		$this->layout = 'cyanspark';
		
	}

	function update_rep_asignados()
	{
		if(isset($this->request->data['proyectos']) && !empty($this->request->data['proyectos']))
		{
			$numproyecto = $this->request->data['proyectos'];
			$idproy = $this->Proyecto->field('idproyecto',array('numeroproyecto' => $numproyecto));
			$nomproy = $this->Proyecto->field('nombreproyecto',array('numeroproyecto' => $numproyecto));
			$this->set('nombre',$nomproy);
			$this->set('idproyecto',$idproy);
			$this->set('construc', $this->Contratoconstructor->find('all',array(
					'fields'=>array('Contratoconstructor.codigocontrato','Contratoconstructor.nombrecontrato',
									'Contratoconstructor.idcontrato',
									'Persona.nombrespersona','Persona.apellidospersona'),
					'conditions'=>array('Contratoconstructor.idproyecto'=>$idproy),
					'order'=>'Contratoconstructor.idcontrato'
					)));
					
			$this->set('tecnicos',$this->Nombratecnico->find('all',array(
					'fields'=>array('Nombratecnico.idcontrato','Nombratecnico.nomcompleto'),
					'conditions'=>array('Nombratecnico.idproyecto'=>$idproy),
					'order'=>'Nombratecnico.idcontrato'
				)));
				
			$this->set('supervi',$this->Contratosupervisor->find('all',array(
					'fields'=>array('Contratosupervisor.codigocontrato','Contratosupervisor.nombrecontrato',
									'Contratosupervisor.idcontrato','Contratosupervisor.con_idcontrato',
									'Persona.nombrespersona', 'Persona.apellidospersona'),
					'conditions'=>array('Contratosupervisor.idproyecto'=>$idproy),
					'order'=>'Contratosupervisor.idcontrato'
				)));
		}
		$this->render('/Elements/update_rep_asignados', 'ajax');
	}

	function nombramiento_reporte_asignados_pdf($idproy=null)
	{
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		$numproyecto = $this->Proyecto->field('numeroproyecto',array('idproyecto' => $idproy));
		$nomproy = $this->Proyecto->field('nombreproyecto',array('idproyecto' => $idproy));
		$this->set('nombre',$nomproy);
		$this->set('numproy',$numproyecto);
		$this->set('idproyecto',$idproy);
		$this->set('construc', $this->Contratoconstructor->find('all',array(
				'fields'=>array('Contratoconstructor.codigocontrato','Contratoconstructor.nombrecontrato',
								'Contratoconstructor.idcontrato',
								'Persona.nombrespersona','Persona.apellidospersona'),
				'conditions'=>array('Contratoconstructor.idproyecto'=>$idproy),
				'order'=>'Contratoconstructor.idcontrato'
				)));
				
		$this->set('tecnicos',$this->Nombratecnico->find('all',array(
				'fields'=>array('Nombratecnico.idcontrato','Nombratecnico.nomcompleto'),
				'conditions'=>array('Nombratecnico.idproyecto'=>$idproy),
				'order'=>'Nombratecnico.idcontrato'
			)));
			
		$this->set('supervi',$this->Contratosupervisor->find('all',array(
				'fields'=>array('Contratosupervisor.codigocontrato','Contratosupervisor.nombrecontrato',
								'Contratosupervisor.idcontrato','Contratosupervisor.con_idcontrato',
								'Persona.nombrespersona', 'Persona.apellidospersona'),
				'conditions'=>array('Contratosupervisor.idproyecto'=>$idproy),
				'order'=>'Contratosupervisor.idcontrato'
			)));
		
		$this->render();
	}

	function proyectosrepjson()
	{
		$proys = $this->Proyecto->find('all', array(
				'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
				'conditions'=>array('Proyecto.estadoproyecto' => array('Adjudicacion','Ejecucion','Finalizado'))));
		$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');
	}

}