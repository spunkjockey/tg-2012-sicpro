<?php
class OrdendecambiosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','Javascript','Js');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contrato','Proyecto','Contratoconstructor','Ordendecambio');

	public function ordendecambio_listar(){
		$this->layout = 'cyanspark';
		
	}	
	
	public function ordendecambio_registrar($idcontrato=null){
		$this->layout = 'cyanspark';
		$this->set('anterior',$this->Ordendecambio->find('first',
				array('conditions'=>array('Ordendecambio.idcontrato'=>$idcontrato),
					'order'=>'fecharegistroorden DESC')));
		$this->set('contrato',$this->Contratoconstructor->find('first'));			
		$this->Ordendecambio->set('idcontrato',$idcontrato);
		$this->Ordendecambio->set('userc', $this->Session->read('User.username'));
		$this->Ordendecambio->set('creacion', date('Y-m-d h:i:s'));
		 if ($this->request->is('post')) {
		 	$this->Ordendecambio->set('tituloordendecambio',$this->request->data['Ordenc']['tituloordendecambio']);
			$this->Ordendecambio->set('montoordencambio',$this->request->data['Ordenc']['montoordencambio']);
			$this->Ordendecambio->set('descripcionordencambio',$this->request->data['Ordenc']['descripcionordencambio']);
			$this->Ordendecambio->set('fecharegistroorden',$this->request->data['Ordenc']['fecharegistroorden']);
				    if ($this->Ordendecambio->save()) {
				    	$contraselected=$this->Contratoconstructor->findByIdcontrato($idcontrato);
		            	$this->Session->setFlash('La Orden de Cambio "'.$this->request->data['Ordenc']['tituloordendecambio'].'" ha sido registrada al Contrato "'.$contraselected['Contratoconstructor']['codigocontrato'].'".','default',array('class' => 'success'));
		            	$this->redirect(array('action' => 'ordendecambio_listar'));
		        	} 			
		}
		
	}

	public function ordendecambio_modificar($idordencambio=null){
		$this->layout = 'cyanspark';
		if (!$this->Ordendecambio->exists($idordencambio)) {
        	throw new NotFoundException('No se ha encontrado la orden de cambio a modificar', 404);
    	} else {
		$this->set('anterior',$this->Ordendecambio->find('first',
				array('conditions'=>array('Ordendecambio.idordencambio !='. $idordencambio),
					'order'=>'fecharegistroorden DESC')));
		$this->Ordendecambio->id =  $idordencambio;
		$contrato = $this->Ordendecambio->findByIdordencambio($idordencambio);
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Ordendecambio->read();
	    } else {
	        if ($this->Ordendecambio->save($this->request->data)) {
	        	$contraselected=$this->Contratoconstructor->findByIdcontrato($contrato['Ordendecambio']['idcontrato']);
				//Debugger::dump($contraselected);
	            $this->Session->setFlash('La Orden de Cambio "'.$contrato['Ordendecambio']['tituloordendecambio'] .'" del Contrato "'. $contraselected['Contratoconstructor']['codigocontrato'].'" ha sido modificada.','default',array('class' => 'success'));
	            $this->redirect(array('action' => 'ordendecambio_listar'));
	        } else {
            	$this->Session->setFlash('Imposible editar Orden de Cambio');
        	}
	    }
	    }
		
	}
	
	public function ordendecambio_eliminar($idordencambio=null)
	{
		$contrato = $this->Ordendecambio->findByIdordencambio($idordencambio);
		$contraselected=$this->Contratoconstructor->findByIdcontrato($contrato['Ordendecambio']['idcontrato']);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
		if (!$this->Ordendecambio->exists($idordencambio)) {
        	throw new NotFoundException('No se ha encontrado la orden de cambio que desea eliminar', 404);
    	} else {
	    if ($this->Ordendecambio->delete($idordencambio)) {
	        $this->Session->setFlash('La Orden de Cambio "'.$contrato['Ordendecambio']['tituloordendecambio'] .'" del contrato "'. $contraselected['Contratoconstructor']['codigocontrato'].'" ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'ordendecambio_listar'));
	    }
		}
	}

	public function proyectojson() {
		/*$proyectos = $this->Ordendecambio->query("SELECT DISTINCT Proyecto.idproyecto AS Proyecto__idproyecto, 
		Proyecto.numeroproyecto AS Proyecto__numeroproyecto
			FROM sicpro2012.contratoconstructor AS Contratoconstructor 
			LEFT JOIN sicpro2012.empresa AS Empresa 
				ON (Contratoconstructor.idempresa = Empresa.idempresa) 
			LEFT JOIN sicpro2012.persona AS Persona 
				ON (Contratoconstructor.idpersona = Persona.idpersona) 
			LEFT JOIN sicpro2012.proyecto AS Proyecto 
				ON (Contratoconstructor.idproyecto = Proyecto.idproyecto) 
			WHERE Proyecto.estadoproyecto = 'Ejecucion' 
				AND Contratoconstructor.estadocontrato 
				IN ('en marcha', 'en pausa', 'a tiempo', 'atrasado') 
			ORDER BY Proyecto.numeroproyecto ASC");*/
			
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.numeroproyecto'), 
			'conditions' => array('Proyecto.estadoproyecto'=>'Ejecucion',
			'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'),
			'OR' => array('Contratoconstructor.estadocontrato'=> array('en marcha','en pausa','a tiempo','atrasado'))),
			'order' => array('Proyecto.numeroproyecto')
		));
		//$this->set('proyectos', $proyectos);
		$this->set('proyectos', $this->eliminarduplicados(Hash::extract($proyectos, "{n}.Proyecto")));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
	}
	
	public function contratojson() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'conditions' => array(
			'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'),
			'OR' => array('Contratoconstructor.estadocontrato'=> array('en marcha','en pausa','a tiempo','atrasado'))),
			'order' => array('Contratoconstructor.codigocontrato')
		));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	function update_ordenesc()
	{
	 	if (!empty($this->data['ordenc']['contratos']))
		{
			$cont_id = $this->request->data['ordenc']['contratos'];
			$ordenes = $this->Ordendecambio->find('all',array(
						'conditions'=>array('Ordendecambio.idcontrato'=>$cont_id),
						'order'=>'fecharegistroorden ASC'));
			$this->set('ordenes',$ordenes);
			
			$this->set('ultimo',$this->Ordendecambio->find('first',
				array('conditions'=>array('Ordendecambio.idcontrato'=>$cont_id),
					'order'=>'fecharegistroorden DESC')));
		}
		$this->render('/Elements/update_listaorden', 'ajax');
	 }



	public function eliminarduplicados($array=null) {
		$count = 0;
		$value = "";
		foreach($array as $array_key => $array_value)
		{
			if ( $count > 1 ) 
			{
				if($value != $array_value['idproyecto']) 
				{
					$count = 0;
				}
			}
			if ( $count == 0 )
			{
				$value = $array_value['idproyecto'];
				$count++;
			} else 
				{
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
	
}?>