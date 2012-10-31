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
		/*$proyectos = $this->Contrato->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'order' => array('Proyecto.numeroproyecto'),
			'conditions' => array('Contrato.idpersona' => $this->Session->read('User.idpersona'))
		));*/
		
		$proyectos=$this->Contrato->query('(SELECT 
  proyecto.idproyecto, 
  proyecto.numeroproyecto, 
  --contratoconstructor.idcontrato, 
  --contratoconstructor.codigocontrato, 
  contratoconstructor.idpersona
FROM 
  sicpro2012.proyecto, 
  sicpro2012.contratoconstructor, 
  sicpro2012.estimacion
WHERE 
  proyecto.idproyecto = contratoconstructor.idproyecto AND
  contratoconstructor.idcontrato = estimacion.idcontrato AND 
  contratoconstructor.idpersona = '. $this->Session->read('User.idpersona') .')
UNION
(SELECT 
  proyecto.idproyecto, 
  proyecto.numeroproyecto, 
  --contratosupervisor.idcontrato, 
  --contratosupervisor.codigocontrato, 
  contratosupervisor.idpersona
FROM 
  sicpro2012.proyecto, 
  sicpro2012.contratosupervisor, 
  sicpro2012.informesupervision
WHERE 
  proyecto.idproyecto = contratosupervisor.idproyecto AND
  contratosupervisor.idcontrato = informesupervision.idcontrato AND 
  contratosupervisor.idpersona = '. $this->Session->read('User.idpersona') .');');
		
		$this->set('proyectos', Hash::extract($proyectos, "{n}.0"));
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
		
		$conditions = array();
		switch ($this->Session->read('User.idrol')) {
			case 3:
		        $conditions =
					array('Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona'));
		        break;
		    case 2:
			case 1:
		        $conditions = array();
		        break;
		}	
			
		$proyectos = $this->Facturaxcontrato->find('all',array(
			'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'),
			'order' => array('Facturaxcontrato.numeroproyecto'),
			'conditions' => $conditions
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
			$conditions = array();
			switch ($this->Session->read('User.idrol')) {
				case 3:
			        $conditions =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos'],
							'Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona')
							);
			        break;
			    case 2:
				case 1:
			        $conditions =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos']
							);
			        break;
			}
			
			$facturas = $this->Facturaxcontrato->find('all',array(
					//'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'),
					'order' => array('Facturaxcontrato.numeroproyecto','Facturaxcontrato.numerofactura'),
					'conditions' => $conditions
				));
			
			$this->set('facturas',$facturas);
			
			$conditionss = array();
			switch ($this->Session->read('User.idrol')) {
				case 3:
			        $conditionss =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos'],
							'Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona')
							);
			        break;
			    case 2:
				case 1:
			        $conditionss =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos']
							);
			        break;
			}
			
			
			$proyectos = $this->Facturaxcontrato->find('all',array(
				'fields' => array('DISTINCT Facturaxcontrato.idproyecto', 'Facturaxcontrato.numeroproyecto'
						, 'Facturaxcontrato.nombreproyecto'
						, 'Facturaxcontrato.montoplaneado'
						, 'Facturaxcontrato.estadoproyecto'),
				'order' => array('Facturaxcontrato.numeroproyecto'),
				'conditions' => $conditionss
			));
			
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Facturaxcontrato"));
			
			$conditionsss = array();
			switch ($this->Session->read('User.idrol')) {
				case 3:
			        $conditionsss =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos'],
							'Facturaxcontrato.idpersona' => $this->Session->read('User.idpersona')
							);
			        break;
			    case 2:
				case 1:
			        $conditionsss =
						array(
							'Facturaxcontrato.numeroproyecto' => $this->request->data['proyectos']
							);
			        break;
			}
			
			
			$facturasa = $this->Facturaxcontrato->find('all',array(
				'fields' => array('DISTINCT Facturaxcontrato.codigocontrato', 'Facturaxcontrato.nombrecontrato'
						, 'Facturaxcontrato.tipocontrato'
						, 'Facturaxcontrato.montooriginal'
						, 'Facturaxcontrato.idcontrato'
						, 'Facturaxcontrato.con_idcontrato'
						, 'Facturaxcontrato.estadocontrato'),
				'order' => array('Facturaxcontrato.codigocontrato'),
				'conditions' => $conditionsss
			));
			
			$this->set('facturasa', $facturasa);
			
				
			
		}
		
			
		$this->render('/Elements/update_facturasxproyecto', 'ajax');
	}

}