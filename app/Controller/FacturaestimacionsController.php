<?php
class FacturaestimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Factura','Contrato','Informesupervisor','Estimacion');

    public function facturaestimacion_registrar() {
    	$this->layout = 'cyanspark';
        //$this->set('facturas', $this->Factura->find('all'));
    }
	

}