<?php
class FinanciasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto','Fuentefinanciamiento','Financia','Division','Contratoconstructor','User');
	
	public function index($idproyecto=null) {
		$this->layout = 'cyanspark';
		$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
		//Logica de inserción
		if ($this->request->is('post')) {
			
			$this->Financia->set('idproyecto', $this->request->data['Financia']['proyectos']);
			$this->Financia->set('montoparcial', $this->request->data['Financia']['montoparcial']);
			$this->Financia->set('idfuentefinanciamiento', $this->request->data['Financia']['fuentes']);	
			$this->Financia->set('userc', $this->Session->read('User.username'));
		    if ($this->Financia->save()) {
            	$proyecto = $this->Financia->findByIdproyecto($this->request->data['Financia']['proyectos']);	
            	//Debugger::dump($proyecto);
            	$this->Session->setFlash('Se han asignado $' . 
            		$this->request->data['Financia']['montoparcial'] . 
            		' al proyecto ' . $proyecto['Proyecto']['nombreproyecto'] . 
            		' satisfactoriamente','default',
            		array('class'=>'success'));
            	
            	$this->redirect(array('action' => 'index',$proyecto['Proyecto']['idproyecto']));
        	} else {
            	//$this->Session->setFlash('Ha ocurrido un eror. No se pudo realizar el registro');
        	}
		} else {
				
			if (isset($idproyecto) && !empty($idproyecto)) {
				$this->set('proyecto', $this->Proyecto->query("SELECT * FROM sicpro2012.proyecto AS Proyecto WHERE Proyecto.idproyecto=$idproyecto;"));
				$this->set('proyectos', $this->Financia->findAllByIdproyecto($idproyecto));
				$this->set('idproyecto', $idproyecto);
			}
		} 
			
		
	}

	function financia_modificar($id = null) {
		$this->layout = 'cyanspark';
	    $this->Financia->id = $id;
		$idproyecto = $this->Financia->findByFuente_proyecto($id);
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Financia->read();
	    } else {
	        if ($this->Financia->save($this->request->data)) {
	        	$financia = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($this->request->data['Financia']['idfuentefinanciamiento']);
	            
	            $this->Session->setFlash('El monto de la fuente de financiamiento: "'. $financia['Fuentefinanciamiento']['nombrefuente'] .'", asignado a este proyecto ha sido modificado correctamente.','default',array('class' => 'success'));
	            $this->redirect(array('action' => 'index',$idproyecto['Proyecto']['idproyecto']));
	        } else {
	        	//$this->request->data = $this->Financia->read();
	        	$financia = $this->Financia->findByFuente_proyecto($id);
	        	$this->request->data['Proyecto']['nombreproyecto'] = $financia['Proyecto']['nombreproyecto'];
				$this->request->data['Proyecto']['montoplaneado'] = $financia['Proyecto']['montoplaneado'];
				$this->request->data['Fuentefinanciamiento']['nombrefuente'] = $financia['Fuentefinanciamiento']['nombrefuente'];
				$this->request->data['Fuentefinanciamiento']['montodisponible'] = $financia['Fuentefinanciamiento']['montodisponible'];
            	//$this->Session->setFlash('Ha ocurrido un error. Imposible modificar el financiamiento');
        	}
	    }
	}

	function financia_eliminar($id) {
		$financia = $this->Financia->findByFuente_proyecto($id);
		$financiaa = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($financia['Financia']['idfuentefinanciamiento']);
		if (!$this->request->is('POST')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Financia->delete($id)) {
	    	$this->Session->setFlash('El monto de la fuente de financiamiento: '. $financiaa['Fuentefinanciamiento']['nombrefuente'] .' asignado a este proyecto ha sido eliminado correctamente.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'index',$financia['Financia']['idproyecto']));
	    } else {
	    	$this->Session->setFlash('No se puede eliminar la Fuente de Financiamiento, el valor del financiamiento total no debe ser menor al valor de los montos de los contratos de este proyecto');
	        $this->redirect(array('action' => 'index',$financia['Financia']['idproyecto']));
	    }
	}

	function update_tablafinancia() {
			//Debugger::dump($this->data);
		if (isset($this->data['Financia']['proyectos']) && !empty($this->data['Financia']['proyectos'])) {
			
			$proyectos_id = $this->data['Financia']['proyectos'];
        	
			$this->set('proyecto', $this->Proyecto->query("SELECT * FROM sicpro2012.proyecto AS Proyecto WHERE Proyecto.idproyecto=$proyectos_id;"));
			$this->set('proyectos', $this->Financia->findAllByIdproyecto($proyectos_id));
		}
		
		if (isset($this->data['Financia']['fuentes']) && !empty($this->data['Financia']['fuentes'])) {
			$idff = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($this->data['Financia']['fuentes']);	
			$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
			$this->set('titulo',$idff['Fuentefinanciamiento']['nombrefuente']);
		}
		
		$this->render('/Elements/update_tablafinancia', 'ajax');

	}


	function update_disponible() {
		$idff = $this->Fuentefinanciamiento->findByIdfuentefinanciamiento($this->data['Financia']['fuentes']);	
		$this->set('disponible',$idff['Fuentefinanciamiento']['montodisponible']);
		$this->set('titulo',$idff['Fuentefinanciamiento']['nombrefuente']);
		$this->render('/Elements/update_disponible', 'ajax');
	}
	
	
	function pruebacombo() {
		$this->layout = 'cyanspark';
	}
	
	function proyectojson() {
		$proyectos = $this->Financia->query("SELECT 
			  DISTINCT proyecto.idproyecto, 
			  proyecto.nombreproyecto
			FROM
			  sicpro2012.proyecto, 
			  sicpro2012.fuentefinanciamiento
			WHERE 
			  proyecto.estadoproyecto != 'Finalizado';"
		);
				
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
			      fuentefinanciamiento.idfuentefinanciamiento = financia.idfuentefinanciamiento) AND
				  fuentefinanciamiento.montodisponible != 0;');
							
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