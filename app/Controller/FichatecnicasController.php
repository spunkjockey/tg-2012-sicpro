<?php
class FichatecnicasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	public $uses = array('Proyecto','Fichatecnica','Ubicacion');
	
	
    public function index() {
    	$this->layout = 'cyanspark';

    }	
	
	public function add() {
		$this->layout = 'cyanspark';
		$this->set('proyectos', $this->Fichatecnica->Proyecto->find('list',
			array('fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'conditions' => 'Proyecto.idproyecto NOT IN (SELECT idproyecto FROM sicpro2012.fichatecnica);'
		)));
        if ($this->request->is('post')) {
				    // it validated logic
				    
				    $this->Fichatecnica->set('idproyecto', $this->request->data['Fichatecnica']['proyectos']);
					$this->Fichatecnica->set('problematica', $this->request->data['Fichatecnica']['problematica']);
					$this->Fichatecnica->set('objgeneral', $this->request->data['Fichatecnica']['objgeneral']);
					$this->Fichatecnica->set('objespecifico', $this->request->data['Fichatecnica']['objespecifico']);
					$this->Fichatecnica->set('descripcionproyecto', $this->request->data['Fichatecnica']['descripcionproyecto']);
					$this->Fichatecnica->set('empleosgenerados', $this->request->data['Fichatecnica']['empleosgenerados']);
					$this->Fichatecnica->set('beneficiarios', $this->request->data['Fichatecnica']['beneficiarios']);
					$this->Fichatecnica->set('resultadosesperadors', $this->request->data['Fichatecnica']['resultadosesperadors']);
					$this->Fichatecnica->set('userc', $this->request->data['Fichatecnica']['userc']);					
				    if ($this->Fichatecnica->save()) {
		            	$this->Session->setFlash('La Ficha Tecnica ha sido registrada.');
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view', 
		            	$this->Fichatecnica->query("select max(idfichatecnica) from sicpro2012.fichatecnica limit 1;")
						));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    	}	
	
	}

	public function view($id = null) {
		$this->layout = 'cyanspark';
        $this->Fichatecnica->id = $id;
        //$this->set('empresas', $this->Fichatecnica->read());
		//$this->Ubicacion->id = $id;
		//$this->set('ubicacion', $this->Ubicacion->read());
		$this->set('datos',array('ficha', $this->Fichatecnica->read(),'ubicacion', $this->Ubicacion->read()));
    }
}