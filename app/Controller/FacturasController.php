<?php
class FacturasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload','RequestHandler');
	public $uses = array('Proyecto','Contrato','Contratosupervisor','Facturasupervision');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('facturas', $this->Facturasupervision->find('all'));
    }
	
	
	 public function registrarfactura() {
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
		}
		
		
	}
	 
public function proyectojson() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'conditions' => array('Proyecto.estadoproyecto' => 'Ejecucion'),
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
}