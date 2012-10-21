<?php
class FacturasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Factura','Contrato','Informesupervisor','Estimacion','Facturaxcontrato');

    public function index($idproyecto=null,$idcontrato=null) {
    	$this->layout = 'cyanspark';
		if ($this->request->is('get')) {
			
		
			if(isset($idcontrato) && !empty($idcontrato)) {
				$this->set('idproyecto', $idproyecto);
				$this->set('idcontrato', $idcontrato);
				$contrato = $this->Contrato->findByIdcontrato($idcontrato);
				$this->set('contrato',$contrato);
				//Debugger::dump($contrato['Contrato']['tipocontrato']);
				switch ($contrato['Contrato']['tipocontrato']) {
					case 'Construcción de obras':
				        $estimacion = $this->Estimacion->findAllByIdcontrato($idcontrato,array(),array('Estimacion.idestimacion' => 'asc'));
						//Debugger::dump($estimacion);
						$this->set('estimacion',$estimacion);
				        break;
				    case 'Supervisión de obras':
				        $supervisor = $this->Informesupervisor->findAllByIdcontrato($idcontrato,array(),array('Informesupervisor.idinformesupervision' => 'asc'));
						//Debugger::dump($supervisor);
						$this->set('supervisor',$supervisor);
				        break;		
				}

		}
        //$this->set('facturas', $this->Factura->find('all'));
    }
  }
    public function proyectojson() {
		$proyectos = $this->Contrato->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'order' => array('Proyecto.numeroproyecto'),
			'conditions' => array('Contrato.idpersona' => $this->Session->read('User.idpersona'))
		));
		
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
		
	}

	public function contratojson() {
		$contratos = $this->Contrato->find('all',array(
			'fields' => array('Contrato.idproyecto','Contrato.idcontrato', 'Contrato.codigocontrato'),
			'order' => array('Contrato.codigocontrato'),
			'conditions' => array('Contrato.idpersona' => $this->Session->read('User.idpersona'))
		));
		
		//$this->set('contratos', $contratos);
		$this->set('contratos', Hash::extract($contratos, "{n}.Contrato"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}

	public function update_facturas() {
		if(isset($this->request->data['Facturas']['contratos']) && !empty($this->request->data['Facturas']['contratos'])) {
			$idcontrato = $this->request->data['Facturas']['contratos'];
			$contrato = $this->Contrato->findByIdcontrato($idcontrato);
			$this->set('contrato',$contrato);
			//Debugger::dump($contrato['Contrato']['tipocontrato']);
			switch ($contrato['Contrato']['tipocontrato']) {
				case 'Construcción de obras':
			        $estimacion = $this->Estimacion->findAllByIdcontrato($idcontrato,array(),array('Estimacion.idestimacion' => 'asc'));
					//Debugger::dump($estimacion);
					$this->set('estimacion',$estimacion);
			        break;
			    case 'Supervisión de obras':
			        $supervisor = $this->Informesupervisor->findAllByIdcontrato($idcontrato,array(),array('Informesupervisor.idinformesupervision' => 'asc'));
					//Debugger::dump($supervisor);
					$this->set('supervisor',$supervisor);
			        break;		
			}

		}
		$this->render('/Elements/update_facturas', 'ajax');
	}

	public function consultarporproyecto() {
		$this->layout = 'cyanspark';
	} 


	public function proyectosfactjson() {
		$proyectos = $this->Facturaxcontrato->find('all',array(
			'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'),
			'order' => array('Facturaxcontrato.numeroproyecto'),
			'conditions' => array('Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona'))
		));
		
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Facturaxcontrato"));
		//$this->set('proyectos', $proyectos);
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
		
	}	

	public function update_facturasxproyecto() {
		//Debugger::dump($this->request->data);
		if(isset($this->request->data['proyectos'])&&!empty($this->request->data['proyectos']))
		{
			$facturas = $this->Facturaxcontrato->find('all',array(
					//'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'),
					'order' => array('Facturaxcontrato.numeroproyecto'),
					'conditions' => array(
						'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos'],
						'Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona'))
				));
			$this->set('facturas',$facturas);
			
			$proyectos = $this->Facturaxcontrato->find('all',array(
				'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'
						, 'Facturaxcontrato.nombreproyecto'
						, 'Facturaxcontrato.montoplaneado'
						, 'Facturaxcontrato.estadoproyecto'),
				'order' => array('Facturaxcontrato.numeroproyecto'),
				'conditions' => array(
						'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos'],
						'Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona'))
			));
			
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Facturaxcontrato"));
			
						
			//Debugger::dump($facturas);
		}
		
			
		$this->render('/Elements/update_facturasxproyecto', 'ajax');
	}

}