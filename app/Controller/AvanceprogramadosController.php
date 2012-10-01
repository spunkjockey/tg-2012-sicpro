<?php
class AvanceprogramadosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contratoconstructor','Proyecto','Avanceprogramado');
	
	public function index() {
	    $this->layout = 'cyanspark';
		
		if ($this->request->is('post')) {
				
			Debugger::dump($this->request->data);

			$this->Avanceprogramado->set('plazoejecuciondias', $this->request->data['Avanceprogramado']['plazoejecuciondias']);
			$this->Avanceprogramado->set('porcentajeavfisicoprog', $this->request->data['Avanceprogramado']['porcentajeavfisicoprog']);
			$this->Avanceprogramado->set('montoavfinancieroprog', $this->request->data['Avanceprogramado']['montoavfinancieroprog']);
			$this->Avanceprogramado->set('fechaavance', $this->request->data['Avanceprogramado']['fechaavance']);
			$this->Avanceprogramado->set('idcontrato', $this->request->data['Avanceprogramado']['idcontrato']);
			$this->Avanceprogramado->set('userc', $this->Session->read('User.username'));
		    if ($this->Avanceprogramado->save()) {
            	$this->Session->setFlash('El Avance Programado ha sido agregado.','default',array('class'=>'success'));
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
			
		}	
    }
	
	public function proyectojson() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
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

	
}