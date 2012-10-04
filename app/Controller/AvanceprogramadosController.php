<?php
class AvanceprogramadosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contratoconstructor','Proyecto','Avanceprogramado');
	
	public function index() {
		$this->layout = 'cyanspark';
	
    }
	
	public function Avanceprogramado_agregaravance($id=null) {
		$this->layout = 'cyanspark';
		
		if ($this->request->is('post')) {
				
			//Debugger::dump($this->request->data);

			$this->Avanceprogramado->set('plazoejecuciondias', $this->request->data['Avanceprogramado']['plazoejecuciondias']);
			$this->Avanceprogramado->set('porcentajeavfisicoprog', $this->request->data['Avanceprogramado']['porcentajeavfisicoprog']);
			$this->Avanceprogramado->set('montoavfinancieroprog', $this->request->data['Avanceprogramado']['montoavfinancieroprog']);
			$this->Avanceprogramado->set('fechaavance', $this->request->data['Avanceprogramado']['fechaavance']);
			$this->Avanceprogramado->set('idcontrato', $id);
			$this->Avanceprogramado->set('userc', $this->Session->read('User.username'));
		    if ($this->Avanceprogramado->save()) {
            	$this->Session->setFlash('El Avance ha sido agregado exitosamente.','default',array('class'=>'success'));
            	$this->redirect(array('action' => 'Avanceprogramado_agregaravance', $id));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
				$contrato = $this->Avanceprogramado->Contratoconstructor->findByIdcontrato($id);
				$this->set('contrato',$contrato);
				$avances = $this->Avanceprogramado->find('all', array(
					'conditions' => array('Avanceprogramado.idcontrato' => $id),
					'order' => 'Avanceprogramado.plazoejecuciondias ASC')
				);
				$this->set('avances',$avances);
        	}
			
		} else {
			$contrato = $this->Avanceprogramado->Contratoconstructor->findByIdcontrato($id);
			$this->set('contrato',$contrato);
			$avances = $this->Avanceprogramado->find('all', array(
				'conditions' => array('Avanceprogramado.idcontrato' => $id),
				'order' => 'Avanceprogramado.plazoejecuciondias ASC')
			);
			$this->set('avances',$avances);
		}
	}

	public function Avanceprogramado_editaravance($id=null) {
		$this->layout = 'cyanspark';
	    $this->Avanceprogramado->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Avanceprogramado->read();
	    } else {
	        if ($this->Avanceprogramado->save($this->request->data)) {
	            $this->Session->setFlash('El Avance ha sido actualizado exitosamente.','default',array('class'=>'success'));
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}
	
	public function Avanceprogramado_eliminaravance($id=null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Avanceprogramado->delete($id)) {
	        $this->Session->setFlash('El Avance seleccionado ha sido eliminado.','default',array('class'=>'success'));
	        $this->redirect(array('action' => 'index'));
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

	public function update_avanceprog() {
		$idcontrato = $this->request->data['Avanceprogramado']['contratos'];
		
		$avances = $this->Avanceprogramado->find('all', array(
			'conditions' => array('Avanceprogramado.idcontrato' => $idcontrato),
			'order' => 'Avanceprogramado.plazoejecuciondias ASC')
		);
		
		$contrato = $this->Avanceprogramado->Contratoconstructor->findByIdcontrato($idcontrato);
		
		$this->set('avances',$avances);
		$this->set('nombrecontrato',$contrato['Contratoconstructor']['nombrecontrato']);
		$this->set('ordeninicio',$contrato['Contratoconstructor']['ordeninicio']);
		$this->set('montooriginal',$contrato['Contratoconstructor']['montooriginal']);
		$this->set('plazoejecucion',$contrato['Contratoconstructor']['plazoejecucion']);
		$this->set('idcontrato',$idcontrato);
		
		
		
		$this->render('/Elements/update_avanceprog', 'ajax');
	}
	
}