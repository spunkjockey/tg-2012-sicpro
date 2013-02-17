<?php
class AvanceprogramadosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Contratoconstructor','Proyecto','Avanceprogramado');
	
	public function index($idproyecto=null,$idcontrato=null) {
		$this->layout = 'cyanspark';
		
		if(isset($idcontrato) && !empty($idcontrato)) {	
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
			$this->set('idproyecto',$idproyecto);
			$this->set('idcontrato',$idcontrato);
		}
    }
	
	public function Avanceprogramado_agregaravance($id=null) {
		$this->layout = 'cyanspark';
		if ($this->request->is('post')) {
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
            	//$this->Session->setFlash('No se pudo realizar el registro');
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

	public function Avanceprogramado_editaravance($id=null,$idcontrato=null) {
		$this->layout = 'cyanspark';

			$avances = $this->Avanceprogramado->find('all', array(
				'conditions' => array('Avanceprogramado.idavanceprogramado' => $id),
				'order' => 'Avanceprogramado.plazoejecuciondias ASC')
			);
			
			$this->set('avances',$avances);
			$this->set('contrato',Hash::extract($avances,'0.Contratoconstructor'));

	    
	    $this->Avanceprogramado->id = $id;

			
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Avanceprogramado->read();
			
			
	    } else {
	    	$this->Avanceprogramado->set('plazoejecuciondias', $this->request->data['Avanceprogramado']['plazoejecuciondias']);
			$this->Avanceprogramado->set('porcentajeavfisicoprog', $this->request->data['Avanceprogramado']['porcentajeavfisicoprog']);
			$this->Avanceprogramado->set('montoavfinancieroprog', $this->request->data['Avanceprogramado']['montoavfinancieroprog']);
			$this->Avanceprogramado->set('fechaavance', $this->request->data['Avanceprogramado']['avance']);
			$this->Avanceprogramado->set('idcontrato', $idcontrato);
			$this->Avanceprogramado->set('userm', $this->Session->read('User.username'));
			$this->Avanceprogramado->set('modificacion', date("Y-m-d H:i:s"));
		    if ($this->Avanceprogramado->save()) {
	            $this->Session->setFlash('El Avance ha sido actualizado exitosamente.','default',array('class'=>'success'));
				$contratoc = $this->Contratoconstructor->findByIdcontrato($idcontrato);
	            $this->redirect(array('action' => 'index',
	            	$contratoc['Contratoconstructor']['idproyecto'],
					$contratoc['Contratoconstructor']['idcontrato']));
	        } else {
            	//$this->Session->setFlash('Ha ocurrido un error. No se pudo realizar el registro');

        	}
	    }
	}
	
	public function Avanceprogramado_eliminaravance($id=null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
		$avance = $this->Avanceprogramado->findByIdavanceprogramado($id);
	    if ($this->Avanceprogramado->delete($id)) {
	        $this->Session->setFlash('El Avance seleccionado ha sido eliminado.','default',array('class'=>'success'));
	        $this->redirect(array('action' => 'index',
	        	$avance['Contratoconstructor']['idproyecto'],
				$avance['Contratoconstructor']['idcontrato']));
	    } else {
	    	$this->Session->setFlash('Imposible eliminar el Avance seleccionado. Verifique que no existan Informes de Supervisión asociados a dicho avance');
	        $this->redirect(array('action' => 'index',
	        	$avance['Contratoconstructor']['idproyecto'],
				$avance['Contratoconstructor']['idcontrato']));
	    }
	}
	
	public function proyectojson() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'order' => array('Proyecto.numeroproyecto'),
			'conditions' => array(
				'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'),
				'NOT' => array('Contratoconstructor.estadocontrato' => array("cancelado","en pausa", "finalizado"))
				)
			
		));
		
		//$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('proyectos', $this->eliminarduplicados(Hash::extract($proyectos, "{n}.Proyecto")));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
		
	}
	
	public function eliminarduplicados($array=null) {
		$count = 0;
		$value = ""; 
    	foreach($array as $array_key => $array_value) 
    	{	 
        	if ( $count >= 1 ) {
        		if($value != $array_value['idproyecto']) {
        			$count = 0; 
        		}
        	}
        	if ( $count == 0 ) 
        	{
            	$value = $array_value['idproyecto']; 
            	$count++;
        	} else {
        		if($array_value['idproyecto'] == $value) {
        			unset($array[$array_key]);
					$count++;
				} else {
					$count = 0;
				}
        	}
        	
    	} 
        return array_values($array);
	}
	
	
	public function contratojson() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'order' => array('Contratoconstructor.codigocontrato'),
			'conditions' => array('Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'))
		));
		
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}

	public function update_avanceprog() {
		if(isset($this->request->data['Avanceprogramado']['contratos']) && !empty($this->request->data['Avanceprogramado']['contratos'])) {	
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
			$this->set('variacion',$contrato['Contratoconstructor']['variacion']);
			$this->set('idcontrato',$idcontrato);
		}	
		
		$this->render('/Elements/update_avanceprog', 'ajax');
	}
	
}