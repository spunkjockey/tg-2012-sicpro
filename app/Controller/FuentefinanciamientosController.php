<?php
class FuentefinanciamientosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	/*public $components = array(
    'Session',
    'Auth' => array(
        'loginRedirect' => array('controller' => 'posts', 'action' => 'index'),
        'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
        'authorize' => array('Controller') // Added this line
		)
	);
*/
    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('fuentefinanciamientos', $this->Fuentefinanciamiento->find('all'));
    }
	
	 public function add() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
			if ($this->Fuentefinanciamiento->save($this->request->data)) {
            	$this->Session->setFlash('La Fuente de Financiamiento ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
    }

	function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Fuentefinanciamiento->id = $id;
				
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Fuentefinanciamiento->read();
	    } else {
	    	
	        if ($this->Fuentefinanciamiento->save($this->request->data)) {
	            $this->Session->setFlash('La Fuente ha sido actualizada.');
	            $this->redirect(array('action' => 'index'));
	        } else {
            	$this->Session->setFlash('Imposible editar Fuente de Financiamiento');
        	}
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Fuentefinanciamiento->delete($id)) {
	        $this->Session->setFlash('La Fuente de Financiamiento ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}		