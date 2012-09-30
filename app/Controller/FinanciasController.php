<?php
class FinanciasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto','Fuentefinanciamiento','Financia','Division','Contratoconstructor');
	
	public function index() {
		$this->layout = 'cyanspark';
		//Llenando el combobox de proyectos
		$this->set('proyectos', $this->Financia->Proyecto->find('list',array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Proyecto.nombreproyecto')
		)));
		
		//Obteniendo el ID del primer proyecto
		$id = $this->Proyecto->find("first",array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Proyecto.nombreproyecto')
		));
		
		//Llenando el segundo combobox en base al primero
		$listadoFuentes = $this->Fuentefinanciamiento->find('all', array(
			'fields'=>array('Fuentefinanciamiento.idfuentefinanciamiento','Fuentefinanciamiento.nombrefuente'),
			'order'=>'nombrefuente ASC',
			'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id['Proyecto']['idproyecto'].') 
				AND Fuentefinanciamiento.montodisponible <> 0'
		));
        $this->set('fuentes', Set::combine($listadoFuentes, "{n}.Fuentefinanciamiento.idfuentefinanciamiento","{n}.Fuentefinanciamiento.nombrefuente"));	
			
		//recuperando primer id de las fuentes
		$idff = $this->Fuentefinanciamiento->find("first",array(
			//'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Fuentefinanciamiento.nombrefuente ASC'),
			'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id['Proyecto']['idproyecto'].')'
		));
		
		//Llenado de tablas de la parte detalle de proyecto
		$this->set('proyecto', $this->Proyecto->findByIdproyecto($id['Proyecto']['idproyecto']));
	    $this->set('dproyectos', $this->Financia->findAllByIdproyecto($id['Proyecto']['idproyecto']));
	    
		//Seteando Monto Disponible
		$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
		
		//Logica de inserción
		if ($this->request->is('post')) {
			$this->Financia->set('idproyecto', $this->request->data['Financia']['proyectos']);
			$this->Financia->set('montoparcial', $this->request->data['Financia']['montoparcial']);
			if (is_numeric($this->request->data['Financia']['fuentes'])) {
				$this->Financia->set('idfuentefinanciamiento', $this->request->data['Financia']['fuentes']);	
			} else {
				$fuenteid = $this->Fuentefinanciamiento->findByNombrefuente($this->request->data['Financia']['fuentes']);
				$this->Financia->set('idfuentefinanciamiento', $fuenteid['Fuentefinanciamiento']['idfuentefinanciamiento']);
			}
			
			
			$this->Financia->set('userc', $this->Session->read('User.username'));
		    if ($this->Financia->save()) {
            	$this->Session->setFlash('La Fuente ha sido asignada.','default',array('class'=>'success'));
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
				'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id.') AND Fuentefinanciamiento.montodisponible <> 0'
			));
        	
		}
		
		$this->set('fuentes', Set::combine($listadoFuentes, "{n}.Fuentefinanciamiento.idfuentefinanciamiento","{n}.Fuentefinanciamiento.nombrefuente"));
		$this->render('/elements/update_fuentefinanciamiento', 'ajax');
	}


	function update_tablafinancia() {
		if (!empty($this->data['Financia']['proyectos'])) {
			
			$proyectos_id = $this->data['Financia']['proyectos'];
				
			$idff = $this->Fuentefinanciamiento->find('first', array(
				'order'=>'nombrefuente ASC',
				'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$proyectos_id.') AND Fuentefinanciamiento.montodisponible <> 0'
			));
			$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
		
        	
			$this->set('proyecto', $this->Proyecto->query("SELECT * FROM sicpro2012.proyecto AS Proyecto WHERE Proyecto.idproyecto=$proyectos_id;"));
			$this->set('proyectos', $this->Financia->findAllByIdproyecto($proyectos_id));
		}
		
		$this->render('/elements/update_tablafinancia', 'ajax');
		
		
		
	}


	function update_disponible() {
		
		if (is_numeric($this->request->data['Financia']['fuentes'])) {
			$idff = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($this->data['Financia']['fuentes']);	
		} else {
			$idff = $this->Fuentefinanciamiento->findByNombrefuente($this->request->data['Financia']['fuentes']);
		}
			
		$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
		$this->render('/elements/update_disponible', 'ajax');
	}
	
	
	function pruebacombo() {
		$this->layout = 'cyanspark';
	}
	
	function jsondata() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'order' => array('Proyecto.nombreproyecto')
		));
		
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
	}
	
	function jsondatad() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.nombrecontrato'),
			'order' => array('Contratoconstructor.nombrecontrato')
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
	}
	
	
	
}