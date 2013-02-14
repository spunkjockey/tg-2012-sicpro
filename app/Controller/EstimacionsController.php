<?php
class EstimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload','RequestHandler');
	public $uses = array('Proyecto','Contrato','Contratoconstructor','Estimacion');

    public function index() {
    	$this->layout = 'cyanspark';
 
		$this->set('estimacions', $this->Estimacion->find('all',array(
			'order' => array('Estimacion.idestimacion'),
			'conditions' => array('Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'))
		)));
		
    }
	
	public function indexjson() {
		$estimacion = $this->Estimacion->find('all',array(
			'order' => array('Estimacion.idestimacion'),
			'conditions' => array('Contratoconstructor.idpersona' => $this->Session->read('User.idpersona'))
		));
	
		
		$this->set('estimacion', Hash::extract($estimacion, "{n}.Estimacion"));
		$this->set('_serialize', 'estimacion');
		$this->render('/json/jsonestimacion');
	}
	
	
	 public function estimacion_registrar() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
			$this->Estimacion->set('idcontrato', $this->request->data['Estimacion']['idcontrato']);
            $this->Estimacion->set('idproyecto', $this->request->data['Estimacion'] ['proyectos']);
            $this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->Estimacion->set('userc', $this->Session->read('User.username'));
			if($this->Estimacion->save()) 	{
            	$this->Session->setFlash('La Estimación de Avance ha sido registrada.','default', array('class'=>'success'));
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
	}
	 
	public function proyectojson() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'conditions' => array('Proyecto.estadoproyecto' => 'Ejecucion', 'Contratoconstructor.idpersona' => $this->Session->read('User.idpersona')),
			'order' => array('Proyecto.numeroproyecto')
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
        	if ( $count > 1 ) {
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
			'conditions' => array('Contratoconstructor.idpersona' => $this->Session->read('User.idpersona')),
		));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	public function contratoestjson() {
		$contratos = $this->Estimacion->find('all',array(
			'fields' => array('DISTINCT Contratoconstructor.idproyecto','Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'order' => array('Contratoconstructor.codigocontrato'),
			'conditions' => array('Contratoconstructor.idpersona' => $this->Session->read('User.idpersona')),
		));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	function update_selectContrato1() {
        	if (!empty($this->data['Estimacion']['proyectos']))
                {
                        $proyecto_id = $this->data['Estimacion']['proyectos'];
                        $contratos= $this->Contrato->find('all', array(
	                        'fields'=>array('Contrato.idcontrato','Contrato.codigocontrato'),
	                        'order'=>'Contrato.codigocontrato ASC',
	                        'conditions'=>array('Contrato.idproyecto'=>$proyecto_id)));
                }
          	$this->set('options', Set::combine($contratos, "{n}.Contrato.idcontrato","{n}.Contrato.codigocontrato"));
            $this->render('/Elements/update_selectContrato1', 'ajax');
	}

	function estimacion_modificar($id = null)  {
	    $this->layout = 'cyanspark';
		if (!$this->Estimacion->read()) {
        	throw new NotFoundException('No se puede encontrar la estimación', 404);
    	} 
		else {
			$info=$this->Estimacion->findByIdestimacion($id);
			$this->set('info',$info);
	        //preguntar si es post
	        $this->Estimacion->id = $id;
			if ($this->request->is('get')) {
			   	$this->request->data=$this->Estimacion->read();
			} else {
				$this->Estimacion->set('idcontrato', $info['Contratoconstructor']['idcontrato']);
				$this->Estimacion->set('idestimacion', $this->request->data['Estimacion'] ['idestimacion']);
	        	$this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
				$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
				$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
				$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
				$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
	            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
				$this->Estimacion->set('userm', $this->Session->read('User.username'));
				$this->Estimacion->set('modificacion', date('Y-m-d h:i:s'));  
				if ($this->Estimacion->save()) {
		            $this->Session->setFlash('La Estimación de Avance ha sido actualizada.', 'default', array('class'=>'success'));
		            $this->redirect(array('action' => 'index'));
		        } 
		    }
		   }
	}

	public function agregar_archivo($id = null) {
		$this->layout = 'cyanspark';
		if (!$this->Estimacion->read()) {
        	throw new NotFoundException('No se puede encontrar la estimación', 404);
    	}
		else
		{ 
        	$this->set ('idestimacion', $id);
		}    
    }

	function estimacion_eliminar($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Estimacion->delete($id)) {
	        $this->Session->setFlash('La Estimación de Avance ha sido eliminada.','default', array('class'=>'success'));
	        $this->redirect(array('action' => 'index'));
	    } else {
	    	$this->Session->setFlash('No se puede eliminar la Estimacion seleccionada, se han encontrado referencias');
	        $this->redirect(array('action' => 'index'));
	    }
	}
	
	function estimacion_consultar()
	{
		$this->layout = 'cyanspark';
		if($this->request->is('post')) {
				$this->redirect(array('action' => 'estimacion_detalles',$this->request->data['Estimacion']['informeestima']));
			}
		
	}

	function estimacion_detalles($idinfo=null)
	{
		$this->layout = 'cyanspark';
		if (!$this->Estimacion->read()) {
        	throw new NotFoundException('No se puede encontrar la estimación', 404);
    	}
		else {
			$this->set ('idestimacion', $idinfo);
			$info = $this->Estimacion->find('all',array(
				'fields'=>array('Estimacion.tituloestimacion','Estimacion.fechainicioestimacion',
								'Estimacion.fechafinestimacion','Estimacion.fechaestimacion',
								'Estimacion.montoestimado','Estimacion.porcentajeestimadoavance'),
				'conditions'=>array('Estimacion.idestimacion'=>$idinfo)
			)); 
			$this->set('estima',$info);
		}
	}

	public function contrato_est_json() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'order' => array('Contratoconstructor.codigocontrato'),
			'conditions' => array("Contratoconstructor.idcontrato IN (SELECT idcontrato FROM sicpro2012.estimacion)",
								  "Contratoconstructor.estadocontrato IN ('a tiempo','en marcha','atrasado','en pausa')")
		));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	
	public function estimacion_cons_json()
	{
		$estimaciones = $this->Estimacion->find('all',array(
			'fields'=>array('Estimacion.idcontrato','Estimacion.idestimacion','Estimacion.tituloestimacion'),
			'order'=>'Estimacion.fechaestimacion'
		));
		$this->set('estimacion', Hash::extract($estimaciones, "{n}.Estimacion"));
		$this->set('_serialize', 'estimacion');
		$this->render('/json/jsonestimacion');
	}
	

}