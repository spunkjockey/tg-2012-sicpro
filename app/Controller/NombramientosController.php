<?php
class NombramientosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','Javascript','Js');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contrato','Persona','Nombramiento','Proyecto','Contratoconstructor');
	
	public function Nombramiento_asignartecnico(){
		$this->layout = 'cyanspark';
				
		$per = $this->Persona->query("SELECT personas.idpersona, (nombrespersona||' '||apellidospersona) AS nombrepersona FROM sicpro2012.persona AS personas
		where personas.idcargofuncional= 5;");
		$this->set('tecnicos', Hash::combine($per, "{n}.0.idpersona","{n}.0.nombrepersona"));
		
		if ($this->request->is('post')) {
				    // it validated logic
				    
				    
					Debugger::dump($this->request->data);
					/*$this->Nombramiento->set('idpersona', $this->request->data['myselect']['0']);
					$this->Nombramiento->set('idcontrato', $this->request->data['Nombramiento']['contratos']);
					$this->Nombramiento->set('fechanombramiento', $this->request->data['Nombramiento']['fechanombramiento']);
					$this->Nombramiento->set('userc', $this->Session->read('User.username'));*/				
				    if ($this->Nombramiento->save()) {
		            	$this->Session->setFlash('Tecnicos Asignados Correctamente.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'mains','action' => 'index'
						));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
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
				
				 	
				Debugger::dump($contrato);
				
				/*$this->set('informacion', Set::combine($contrato,
				"{s}.Contratoconstructor.nombrecontrato",
				"{s}.Contratoconstructor.estadocontrato"
				));*/		
				$this->render('/elements/update_multic', 'ajax');
	}
}