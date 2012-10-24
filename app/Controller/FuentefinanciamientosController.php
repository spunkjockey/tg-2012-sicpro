<?php
class FuentefinanciamientosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Fuentefinanciamiento','Tipofuente');
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
	
	 public function fuentefinanciamiento_registrarfuente() {
		$this->layout = 'cyanspark';
	
        if ($this->request->is('post')) {
        	
			$this->Fuentefinanciamiento->set('nombrefuente', $this->request->data['Fuentefinanciamiento'] ['nombrefuente']);
			$this->Fuentefinanciamiento->set('montoinicial', $this->request->data['Fuentefinanciamiento'] ['montoinicial']);
			$this->Fuentefinanciamiento->set('fechadisponible', $this->request->data['Fuentefinanciamiento'] ['fechadisponible']);
			$this->Fuentefinanciamiento->set('userc', $this->request->data['Fuentefinanciamiento'] ['userc']);
			$this->Fuentefinanciamiento->set('idtipofuente', $this->request->data['Fuentefinanciamiento'] ['tipofuentes']);
			if ($this->Fuentefinanciamiento->save()) {
            	$this->Session->setFlash('La Fuente de Financiamiento ha sido registrada.', 'default', array('class'=>'success'));
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
    }

	function fuentefinanciamiento_modificarfuente($id = null) {
		$this->layout = 'cyanspark';
	    $this->Fuentefinanciamiento->id = $id;
				
	    if ($this->request->is('get')) {
	    	
	        $this->request->data = $this->Fuentefinanciamiento->read();
	    } else {
	    	$this->Fuentefinanciamiento->set('nombrefuente', $this->request->data['Fuentefinanciamiento'] ['nombrefuente']);
			$this->Fuentefinanciamiento->set('montodisponible', $this->request->data['Fuentefinanciamiento'] ['montodisponible']);
			$this->Fuentefinanciamiento->set('fechadisponible', $this->request->data['Fuentefinanciamiento'] ['fechadisponible']);
			$this->Fuentefinanciamiento->set('userm', $this->request->data['Fuentefinanciamiento'] ['userm']);
			$this->Fuentefinanciamiento->set('idtipofuente', $this->request->data['Fuentefinanciamiento'] ['tipofuentes']);
			
			$this->Fuentefinanciamiento->set('modificacion', date("Y-m-d H:i:s"));
	        if ($this->Fuentefinanciamiento->save()) {
	            $this->Session->setFlash('La Fuente ha sido actualizada.', 'default', array('class'=>'success'));
	            $this->redirect(array('action' => 'index'));
	        } else {
            	$this->Session->setFlash('Imposible editar Fuente de Financiamiento');
        	}
	    }
	}
	
	public function fuentejson() {
		$fuentes = $this->Tipofuente->find('all',array(
			'fields' => array('Tipofuente.idtipofuente', 'Tipofuente.tipofuente'),
			'order' => array('Tipofuente.tipofuente')
		));
		
		$this->set('tipofuentes', Hash::extract($fuentes, "{n}.Tipofuente"));
		$this->set('_serialize', 'tipofuentes');
		$this->render('/json/jsondatafuente');
		
	}
	
	function delete($id = null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Fuentefinanciamiento->delete($id)) {
	        $this->Session->setFlash('La Fuente de Financiamiento ha sido eliminada.', 'default', array('class'=>'success'));
	        $this->redirect(array('action' => 'index'));
	    } else {
	    	$this->Session->setFlash('Ha ocurrido un error. No se puede eliminar la Fuente de Financiamiento seleccionada');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}		