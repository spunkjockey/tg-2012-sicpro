<?php
class FacturasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Factura','Contrato','Informesupervisor','Estimacion');

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
<<<<<<< HEAD
			$this->factura->set('idcontrato', $id);
			
            $this->factura->set('idproyecto', $this->request->data['factura'] ['proyectos']);
			
            $this->factura->set('tituloestimacion', $this->request->data['factura'] ['tituloestimacion']);
			$this->factura->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->factura->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->factura->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->factura->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->factura->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->factura->set('userc', $this->Session->read('User.username'));
			
			if($this->Estimacion->save()) 	{
            	
       	
            	$this->Session->setFlash('La Estimación de Avance ha sido registrada.', 'default', array('class'=>'success'));
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
=======
	
			}
	
>>>>>>> a6f80131f44e6a432fc108b8e60ed7c4979ecee0
		}
        //$this->set('facturas', $this->Factura->find('all'));
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
<<<<<<< HEAD
		function update_selectContrato1()
        {
                if (!empty($this->data['factura']['proyectos']))
                {
                        $proyecto_id = $this->data['factura']['proyectos'];
                        $contratos= $this->Contrato->find('all', array(
	                        'fields'=>array('Contrato.idcontrato','Contrato.codigocontrato'),
	                        'order'=>'Contrato.codigocontrato ASC',
	                        'conditions'=>array('Contrato.idproyecto'=>$proyecto_id)));
                }
                $this->set('options', Set::combine($contratos, "{n}.Contrato.idcontrato","{n}.Contrato.codigocontrato"));
                $this->render('/elements/update_selectContrato1', 'ajax');
        }
=======
>>>>>>> a6f80131f44e6a432fc108b8e60ed7c4979ecee0
		
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

<<<<<<< HEAD

	function Modificarfactura($id = null)  {
	    $this->layout = 'cyanspark';
        //preguntar si es post
        $this->factura->id = $id;
		if ($this->request->is('get')) {
		   	$this->request->data=$this->factura->read();
		 }
        else {
        	$this->factura->set('tituloestimacion', $this->request->data['factura'] ['tituloestimacion']);
			$this->factura->set('fechainicioestimacion', $this->request->data['factura'] ['fechainicioestimacion']);
			$this->factura->set('fechafinestimacion', $this->request->data['factura'] ['fechafinestimacion']);
			$this->factura->set('montoestimado', $this->request->data['factura'] ['montoestimado']);
			$this->factura->set('porcentajeestimadoavance', $this->request->data['factura'] ['porcentajeestimadoavance']);	
            $this->factura->set('fechaestimacion', $this->request->data['factura'] ['fechaestimacion']);	
			$this->factura->set('userc', $this->Session->read('User.username'));
			  
		if ($this->Estimacion->save()) {
		            $this->Session->setFlash('La Estimación de Avance ha sido actualizada.', 'default', array('class'=>'success'));
		            $this->redirect(array('action' => 'index'));
	        	} else {
		            	$this->Session->setFlash('Imposible editar Estimación de Avance');
        		}
	    }
	}


	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Estimacion->delete($id)) {
	        $this->Session->setFlash('La Estimación de Avance ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
=======
>>>>>>> a6f80131f44e6a432fc108b8e60ed7c4979ecee0
}