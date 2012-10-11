<?php
class FacturasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Factura','Contrato','Informesupervisor','Estimacion'/*,'Facturaconstructor','Facturasupervision'*/);

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('facturas', $this->Factura->find('all'));
    }
	
	
	 public function factura_registrar() {
		$this->layout = 'cyanspark';
	
		
        if ($this->request->is('post')) {
        	if (is_numeric($this->request->data['factura']['contratos'])) {
				$id=$this->request->data['factura']['contratos'];	
				} else {
					$contrato = $this->Contratosupervisor->findByCodigocontrato($this->request->data['registrarfactura']['contratos']);
					$id=$contrato['Contratosupervisor']['idcontrato']; 
				}
			$this->factura->set('idcontrato', $id);
			
            $this->factura->set('idproyecto', $this->request->data['factura'] ['proyectos']);
			
            $this->factura->set('tituloestimacion', $this->request->data['factura'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->Estimacion->set('userc', $this->Session->read('User.username'));
			
			if($this->Estimacion->save()) 	{
            	
       	
            	$this->Session->setFlash('La Estimación de Avance ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
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
		if(isset($this->request->data['Facturas']['contratos'])) {
			$idcontrato = $this->request->data['Facturas']['contratos'];
			$contrato = $this->Contrato->findByIdcontrato($idcontrato);
			Debugger::dump($contrato['Contrato']['tipocontrato']);
			switch ($contrato['Contrato']['tipocontrato']) {
				case 'Construcción de obras':
			        $estimacion = $this->Estimacion->findAllByIdcontrato($idcontrato);
					Debugger::dump($estimacion['Estimacion']['idestimacion']);
			        break;
			    case 'Supervisión de obras':
			        $supervisor = $this->Informesupervisor->findAllByIdcontrato($idcontrato);
					Debugger::dump($supervisor['Informesupervisor']['idinformesupervision']);
			        break;		
			}

		}
		
		$this->render('/Elements/update_facturas', 'ajax');
	}	
	


	function ModificarEstimacion($id = null)  {
	    $this->layout = 'cyanspark';
        //preguntar si es post
        $this->Estimacion->id = $id;
		if ($this->request->is('get')) {
		   	$this->request->data=$this->Estimacion->read();
		 }
        else {
        	$this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->Estimacion->set('userc', $this->Session->read('User.username'));
			  
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
}