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
		
		//Cargar el primero Combobox con los Proyectos
		$this->set('proyectos',$this->Proyecto->find('list', 
		array('fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
			  'order'=>'Proyecto.numeroproyecto ASC',
			  'conditions' => array('Proyecto.estadoproyecto' => 'Ejecucion'))));
			  
		$primer_proyecto = $this->Proyecto->find('first',
		array('fields'=>'Proyecto.idproyecto','order'=>'Proyecto.numeroproyecto ASC'));
		
		//Cargar el Segundo Combobox con los Contratos del primer proyecto
		$this->set('contratos', $this->Contratoconstructor->find('list',
		array('fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),'order'=>'Contratoconstructor.codigocontrato ASC',
		'conditions'=>'Contratoconstructor.idproyecto='.$primer_proyecto['Proyecto']['idproyecto'])
		));
		
		
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
	 
	
		function update_selectContrato1()
        {
                if (!empty($this->data['Estimacion']['proyectos']))
                {
                        $proyecto_id = $this->data['Estimacion']['proyectos'];
                        $contratos= $this->Contrato->find('all', array(
	                        'fields'=>array('Contrato.idcontrato','Contrato.codigocontrato'),
	                        'order'=>'Contrato.codigocontrato ASC',
	                        'conditions'=>array('Contrato.idproyecto'=>$proyecto_id)));
                }
                $this->set('options', Set::combine($contratos, "{n}.Contrato.idcontrato","{n}.Contrato.codigocontrato"));
                $this->render('/elements/update_selectContrato1', 'ajax');
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