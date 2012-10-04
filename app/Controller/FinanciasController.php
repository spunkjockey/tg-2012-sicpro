<?php
class FinanciasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto','Fuentefinanciamiento','Financia','Division','Contratoconstructor');
	
	public function index() {
		$this->layout = 'cyanspark';
		
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


	function update_tablafinancia() {
		if (!empty($this->data['Financia']['proyectos'])) {
			
			$proyectos_id = $this->data['Financia']['proyectos'];
        	
			$this->set('proyecto', $this->Proyecto->query("SELECT * FROM sicpro2012.proyecto AS Proyecto WHERE Proyecto.idproyecto=$proyectos_id;"));
			$this->set('proyectos', $this->Financia->findAllByIdproyecto($proyectos_id));
		}
		
		$this->render('/Elements/update_tablafinancia', 'ajax');

	}


	function update_disponible() {
		
		if (is_numeric($this->request->data['Financia']['fuentes'])) {
			$idff = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($this->data['Financia']['fuentes']);	
		} else {
			$idff = $this->Fuentefinanciamiento->findByNombrefuente($this->request->data['Financia']['fuentes']);
		}
			
		$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
		$this->render('/Elements/update_disponible', 'ajax');
	}
	
	
	function pruebacombo() {
		$this->layout = 'cyanspark';
	}
	
	function proyectojson() {
		$proyectos = $this->Financia->query('SELECT 
  DISTINCT proyecto.idproyecto, 
  proyecto.nombreproyecto
FROM
  sicpro2012.proyecto, 
  sicpro2012.fuentefinanciamiento
WHERE 
  (proyecto.idproyecto, fuentefinanciamiento.idfuentefinanciamiento) NOT IN (
    SELECT 
      financia.idproyecto, 
      financia.idfuentefinanciamiento
    FROM 
      sicpro2012.financia, 
      sicpro2012.proyecto, 
      sicpro2012.fuentefinanciamiento
    WHERE 
      proyecto.idproyecto = financia.idproyecto AND
      fuentefinanciamiento.idfuentefinanciamiento = financia.idfuentefinanciamiento);');
				
		$this->set('proyectos', Hash::extract($proyectos, "{n}.0"));
		$this->set('_serialize', 'proyectos');
			
		$this->render('/json/jsonproyecto');
	}
	
	function fuentejson() {
		$fuentes = $this->Financia->query('SELECT 
  proyecto.idproyecto, 
  fuentefinanciamiento.idfuentefinanciamiento, 
  fuentefinanciamiento.nombrefuente
FROM
  sicpro2012.proyecto, 
  sicpro2012.fuentefinanciamiento
WHERE 
  (proyecto.idproyecto, fuentefinanciamiento.idfuentefinanciamiento) NOT IN (
    SELECT 
      financia.idproyecto, 
      financia.idfuentefinanciamiento
    FROM 
      sicpro2012.financia, 
      sicpro2012.proyecto, 
      sicpro2012.fuentefinanciamiento
    WHERE 
      proyecto.idproyecto = financia.idproyecto AND
      fuentefinanciamiento.idfuentefinanciamiento = financia.idfuentefinanciamiento);');
				
		$this->set('fuentes', Hash::extract($fuentes, "{n}.0"));
		$this->set('_serialize', 'fuentes');
		
		$this->render('/json/jsonfinancia');
	}
	
	function jsondata() {
		$proyectos = $this->Proyecto->find('all',array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
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