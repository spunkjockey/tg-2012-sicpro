<?php
class EstimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload');
	public $uses = array('Proyecto','Contrato','Contratoconstructor','Estimacion');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('estimacions', $this->Estimacion->find('all'));
    }
	
	
	 public function registrarestimacion() {
		$this->layout = 'cyanspark';
	//Recuperar el numero de proyecto
		$this->set('proyectos', $this->Proyecto->find('list', array(
			'fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
			'conditions'=>array('Proyecto.estadoproyecto' =>'Ejecucion'),
			'order'=>'Proyecto.idproyecto ASC')
			
		));
		//Debugger::dump($lProyectos);
    	//$this->set('proyectos', Set::combine($lProyectos, "{n}.Proyecto.idproyecto","{n}.Proyecto.numeroproyecto"));
		
		//Primer Id
		$id = $this->Proyecto->find('first',array(
			'fields' => array('Proyecto.idproyecto'),
			'conditions'=>array('Proyecto.estadoproyecto' =>'Ejecucion'),
			'order'=>'Proyecto.idproyecto ASC'
		));
	
		//Recuperar los contratos asociados a dicho proyecto
		$this->set('contratos',$this->Contratoconstructor->find('list', array(
			'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
			'order'=>'Contratoconstructor.codigocontrato ASC',
			'conditions'=>array('Contratoconstructor.idproyecto'=>$id['Proyecto']['idproyecto'])
			)
		));
		 
		//$this->set('contratos', Set::combine($lContratos, "{n}.Contratoconstructor.idcontrato","{n}.Contratoconstructor.codigocontrato"));
        
		
        if ($this->request->is('post')) {
        	
			$this->Estimacion->set('idcontrato', $this->request->data['Estimacion'] ['contratos']);
			
            $this->Estimacion->set('idproyecto', $this->request->data['Estimacion'] ['proyectos']);
			
            $this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->Estimacion->set('userc', $this->Session->read('User.username'));
			
			if($this->Estimacion->save()) 	{
            	
       	
            	$this->Session->setFlash('La Estimación de Avance ha sido registrada.');
            	$this->redirect(array('action' => 'index'));
        	} else {
            	$this->Session->setFlash('No se pudo realizar el registro');
        	}
		}
	}

    function update_contratos(){
    	if (!empty($this->request->data['Estimacion']['proyectos'])) 
		{
		$proy_id=$this->request->data['Estimacion']['proyectos'];
		
		$con1 = $this->Contratoconstructor->find('all', array(
			'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
			'order'=>'Contratoconstructor.codigocontrato ASC',
			'conditions'=>array('Contratoconstructor.idproyecto' => $proy_id)
		
		));
		}
		
		$this->set('options', Set::combine($con1, "{n}.Contratoconstructor.idcontrato","{n}.{Contratoconstructor.codigocontrato}")); 
		$this->render('/elements/update_contratos','ajax');
    } 

	function ModificarEstimacion($id = null)  {
	    $this->layout = 'cyanspark';
        //preguntar si es post
        $this->Estimacion->id = $id;
		if ($this->request->is('get')) {
		   	$this->request->data=$this->Estimacion->read();
		 }
        else {
        	$this->Estimacion->set('tituloestimacion', $this->request->data['Estimacion'] ['tituloestimacion']);
			$this->Estimacion->set('fechainicioestimacion', $this->request->data['Estimacion'] ['fechainicioestimacion']);
			$this->Estimacion->set('fechafinestimacion', $this->request->data['Estimacion'] ['fechafinestimacion']);
			$this->Estimacion->set('montoestimado', $this->request->data['Estimacion'] ['montoestimado']);
			$this->Estimacion->set('porcentajeestimadoavance', $this->request->data['Estimacion'] ['porcentajeestimadoavance']);	
            $this->Estimacion->set('fechaestimacion', $this->request->data['Estimacion'] ['fechaestimacion']);	
			$this->Estimacion->set('userc', $this->Session->read('User.username'));
			  
		if ($this->Estimacion->save()) {
		            $this->Session->setFlash('La Estimación de Avance ha sido actualizada.', 'default', array('class'=>'success'));
		            $this->redirect(array('action' => 'index'));
	        	} else {
		            	$this->Session->setFlash('Imposible editar Estimación de Avance');
        		}
	    }
	}




	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Estimacion->delete($id)) {
	        $this->Session->setFlash('La Estimación de Avance ha sido eliminada.');
	        $this->redirect(array('action' => 'index'));
	    }
	}
}