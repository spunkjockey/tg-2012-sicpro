<?php
class MunicipiosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	public $uses = array('Municipio','Departamento');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('municipios', $this->Municipio->find('all',
        	array('order' => array('Municipio.iddepartamento', 'Municipio.codigomunicipio'))));
    }
	
	public function add() {
		$this->layout = 'cyanspark';
		$this->set('departamentos', $this->Municipio->Departamento->find('list',
			array('fields' => array('Departamento.iddepartamento', 'Departamento.departamento')
		)));
        if ($this->request->is('post')) {
        	$this->Municipio->set('iddepartamento', $this->request->data['Municipio']['departamentos']);
			$this->Municipio->set('codigomunicipio', $this->request->data['Municipio']['codigomunicipio']);
			$this->Municipio->set('municipio', $this->request->data['Municipio']['municipio']);
			//$departamentoid = $this->Departamento->findBycodigodepartamento($this->request->data['Municipio']['departamentos']);
			//$this->Municipio->set('iddepartamento_id', $departamentoid['Departamento']['id']);
            if ($this->Municipio->save()) {
                $this->Session->setFlash('El Municipio ha sido registrado con exito.');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Imposible registrar el Municipio.');
            }
        }
    }
	
	function edit($id = null) {
		$this->layout = 'cyanspark';
		$this->Municipio->id = $id;
		if ($this->request->is('get')) {
	        $this->request->data = $this->Municipio->read();
	    } else {
	    	if ($this->Municipio->save($this->request->data)) {
	            $this->Session->setFlash('EL Municipio ha sido actualizado.');
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Municipio->delete($id)) {
	        $this->Session->setFlash('El Municipio ha sido eliminado.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
	
}