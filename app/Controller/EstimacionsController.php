<?php
class EstimacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload','RequestHandler');
	public $uses = array('Proyecto','Contrato','Contratoconstructor','Estimacion');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('estimacions', $this->Estimacion->find('all'));
    }
	
	
	 public function registrarestimacion() {
		$this->layout = 'cyanspark';
	
		
		
        if ($this->request->is('post')) {
        	if (is_numeric($this->request->data['Estimacion']['contratos'])) {
				$id=$this->request->data['Estimacion']['contratos'];	
				} else {
					$contrato = $this->Contratoconstructor->findByCodigocontrato($this->request->data['Estimacion']['contratos']);
					$id=$contrato['Contratoconstructor']['idcontrato']; 
				}
			$this->Estimacion->set('idcontrato', $id);
			
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
	 
public function proyectojson() {
		$proyectos = $this->Contratoconstructor->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'conditions' => array('Proyecto.estadoproyecto' => 'Ejecucion'),
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
                $this->render('/Elements/update_selectContrato1', 'ajax');
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

public function agregar_archivo($id = null) {
		$this->layout = 'cyanspark';
        $this->set ('idestimacion', $id);
        
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