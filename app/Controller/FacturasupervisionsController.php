<?php
class FacturasupervisionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Facturasupervision','Contrato','Informesupervisor','Estimacion');

    public function facturasupervision_registrar($id=null) {
    	$this->layout = 'cyanspark';
		//$this->set('facturas', $this->Factura->find('all'));
        if ($this->request->is('post')) {
			$this->Facturasupervision->set('idinformesupervision', $this->request->data['Facturasupervision']['idinformesupervision']);
			$this->Facturasupervision->set('numerofactura', $this->request->data['Facturasupervision']['numerofactura']);
			$this->Facturasupervision->set('montofactura', $this->request->data['Facturasupervision']['montofactura']);
			$this->Facturasupervision->set('descripcionfactura', $this->request->data['Facturasupervision']['descripcionfactura']);
			$this->Facturasupervision->set('fechafactura', $this->request->data['Facturasupervision']['fechafactura']);
			$this->Facturasupervision->set('userc', $this->Session->read('User.username'));
		    if ($this->Facturasupervision->save()) {
            	$this->Session->setFlash('La Factura Número ' . $this->request->data['Facturasupervision']['numerofactura'] . ' ha sido agregado exitosamente.','default',array('class'=>'success'));
            	$supervision = $this->Informesupervisor->findByIdinformesupervision($this->request->data['Facturasupervision']['idinformesupervision']);
            	$this->redirect(array('controller' => 'Facturas','action' => 'index', $supervision['Contratosupervisor']['idproyecto'],$supervision['Contratosupervisor']['idcontrato']));
        	} else {
            	$this->Session->setFlash('Ha ocurrido un error. No se pudo registrar la factura');
				
        	}
			
		} else {
			$this->request->data['Facturasupervision']['idinformesupervision'] = $id;
			$supervision = $this->Informesupervisor->findByIdinformesupervision($id);
			$this->request->data['Contratosupervisor']['codigocontrato'] = $supervision['Contratosupervisor']['codigocontrato'];
			$this->request->data['Informesupervisor']['tituloinformesup'] = $supervision['Informesupervisor']['tituloinformesup'];
			$this->request->data['Informesupervisor']['valoravancefinanciero'] = $supervision['Informesupervisor']['valoravancefinanciero'];
			
		}
        
    }

	function facturasupervision_eliminar($id) {
		$factura = $this->Facturasupervision->findByIdfacturasupervision($id);
		$supervision = $this->Informesupervisor->findByIdinformesupervision($factura['Facturasupervision']['idinformesupervision']);

		/*if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }*/
	    if ($this->Facturasupervision->delete($id)) {
	        $this->Session->setFlash('La Factura Número '. $factura['Facturasupervision']['numerofactura'] .' ha sido eliminada satisfactoriamente.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Facturas','action' => 'index', $supervision['Contratosupervisor']['idproyecto'],$supervision['Contratosupervisor']['idcontrato']));
	    }
	}
	

}