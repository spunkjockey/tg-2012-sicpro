<?php
class FinanciasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session');
	public $uses = array('Proyecto','Fuentefinanciamiento','Financia','Division');
	
	public function index() {
		$this->layout = 'cyanspark';
		$this->set('proyectos', $this->Financia->Proyecto->find('list',array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Proyecto.nombreproyecto')
		)));
		
		
		$id = $this->Proyecto->find("first",array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Proyecto.nombreproyecto')
		));
		
		
		$listadoFuentes = $this->Fuentefinanciamiento->find('all', array(
			'fields'=>array('Fuentefinanciamiento.idfuentefinanciamiento','Fuentefinanciamiento.nombrefuente'),
			'order'=>'nombrefuente ASC',
			'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id['Proyecto']['idproyecto'].')'
		));
        $this->set('fuentes', Set::combine($listadoFuentes, "{n}.Fuentefinanciamiento.idfuentefinanciamiento","{n}.Fuentefinanciamiento.nombrefuente"));	
			
		/*$this->set('fuentes', $this->Financia->Fuentefinanciamiento->find('list',array(
			'fields' => array('Fuentefinanciamiento.idfuentefinanciamiento', 'Fuentefinanciamiento.nombrefuente'),
			'order' => array('Fuentefinanciamiento.nombrefuente'),
			'conditions' => array('Financia.idproyecto'=>2)
		)));*/
		
		$this->set('proyecto', $this->Proyecto->findByIdproyecto($id['Proyecto']['idproyecto']));
	    $this->set('dproyectos', $this->Financia->findAllByIdproyecto($id['Proyecto']['idproyecto']));
		
		
		if ($this->request->is('post')) {
			$this->Financia->set('idproyecto', $this->request->data['Financia']['proyectos']);
			$this->Financia->set('idfuentefinanciamiento', $this->request->data['Financia']['fuentes']);
			$this->Financia->set('montoparcial', $this->request->data['Financia']['montoparcial']);
			$this->Financia->set('userc', $this->Session->read('User.username'));
		    if ($this->Financia->save()) {
            	$this->Session->setFlash('La Fuente ha sido asignada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
		
	}

	function update_fuentefinanciamiento() {
		if(!empty($this->data['Financia']['proyectos'])) {
        		
        	$id = $this->data['Financia']['proyectos'];
			$listadoFuentes = $this->Fuentefinanciamiento->find('all', array(
				'fields'=>array('Fuentefinanciamiento.idfuentefinanciamiento','Fuentefinanciamiento.nombrefuente'),
				'order'=>'nombrefuente ASC',
				'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id.')'
			));
        	
		}
		$this->set('fuentes', Set::combine($listadoFuentes, "{n}.Fuentefinanciamiento.idfuentefinanciamiento","{n}.Fuentefinanciamiento.nombrefuente"));
		$this->render('/elements/update_fuentefinanciamiento', 'ajax');
	}


	function update_tablafinancia() {
		if (!empty($this->data['Financia']['proyectos'])) {
        	$proyectos_id = $this->data['Financia']['proyectos'];
			$this->set('proyecto', $this->Proyecto->query("SELECT * FROM sicpro2012.proyecto AS Proyecto WHERE Proyecto.idproyecto=$proyectos_id;"));
			$this->set('proyectos', $this->Financia->findAllByIdproyecto($proyectos_id));
		}
		
		$this->render('/elements/update_tablafinancia', 'ajax');
	}

	
	
}