<?php
class FichatecnicasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	
	
    public function index() {
    	$this->layout = 'cyanspark';

    }	
	
	public function add() {
		$this->layout = 'cyanspark';
		$this->set('proyectos', $this->Fichatecnica->Proyecto->find('list',
			array('fields' => array('Proyecto.idproyecto', 'Proyecto.numeroproyecto')
		)));
        if ($this->request->is('post')) {
        	//$this->Empresa->set($this->request->data);
        	//if ($this->Empresa->validates()) {
				    // it validated logic
				    if ($this->Empresa->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Empresa ha sido registrada.');
		            	$this->redirect(array('action' => 'index'));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' . $this->data['Empresa']['nitempresa'] );
		        	}
		}
		//$this->render('/Componentes/add');
    }
		
	
}