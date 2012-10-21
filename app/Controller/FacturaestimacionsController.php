<?php
class FacturaestimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Facturaestimacion','Contrato','Estimacion');

    public function facturaestimacion_registrar($id=null) {
    	$this->layout = 'cyanspark';
		//$this->set('facturas', $this->Factura->find('all'));
        if ($this->request->is('post')) {
			$this->Facturaestimacion->set('idestimacion', $this->request->data['Facturaestimacion']['idestimacion']);
			$this->Facturaestimacion->set('numerofactura', $this->request->data['Facturaestimacion']['numerofactura']);
			$this->Facturaestimacion->set('montofactura', $this->request->data['Facturaestimacion']['montofactura']);
			$this->Facturaestimacion->set('descripcionfactura', $this->request->data['Facturaestimacion']['descripcionfactura']);
			$this->Facturaestimacion->set('fechafactura', $this->request->data['Facturaestimacion']['fechafactura']);
			$this->Facturaestimacion->set('userc', $this->Session->read('User.username'));
		    if ($this->Facturaestimacion->save()) {
            	$this->Session->setFlash('La Factura Número ' . $this->request->data['Facturaestimacion']['numerofactura'] . ' ha sido agregado exitosamente.','default',array('class'=>'success'));
            	$estimacion = $this->Estimacion->findByIdestimacion($this->request->data['Facturaestimacion']['idestimacion']);
            	$this->redirect(array('controller' => 'Facturas','action' => 'index', $estimacion['Contratoconstructor']['idproyecto'],$estimacion['Contratoconstructor']['idcontrato']));
        	} else {
            	$this->Session->setFlash('Ha ocurrido un error. No se pudo registrar la factura');
				
        	}
			
		} else {
			$this->request->data['Facturaestimacion']['idestimacion'] = $id;
			$estimacion = $this->Estimacion->findByIdestimacion($id);
			$this->request->data['Contratoconstructor']['codigocontrato'] = $estimacion['Contratoconstructor']['codigocontrato'];
			$this->request->data['Estimacion']['tituloestimacion'] = $estimacion['Estimacion']['tituloestimacion'];
			$this->request->data['Estimacion']['montoestimado'] = $estimacion['Estimacion']['montoestimado'];
			
		}
        
    }

	function facturaestimacion_eliminar($id) {
		$factura = $this->Facturaestimacion->findByIdfacturaestimacion($id);
		$estimacion = $this->Estimacion->findByIdestimacion($factura['Facturaestimacion']['idestimacion']);
        
		/*if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }*/
	    if ($this->Facturaestimacion->delete($id)) {
	        $this->Session->setFlash('La Factura Número '. $factura['Facturaestimacion']['idfacturaestimacion'] .' ha sido eliminada satisfactoriamente.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Facturas','action' => 'index', $estimacion['Contratoconstructor']['idproyecto'],$estimacion['Contratoconstructor']['idcontrato']));
	    }
	}
	

}