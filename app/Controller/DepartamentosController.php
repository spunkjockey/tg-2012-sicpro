<?php
class DepartamentosController extends AppController {
    public $helpers = array('Html', 'Form', 'Time', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload');
	public $uses = array('Departamento','Notificacion');
    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('departamentos', $this->Departamento->find('all'));
    }
	

	
	public function add() {
		$this->layout = 'cyanspark';

        if ($this->request->is('post')) {
            if ($this->Departamento->save($this->request->data)) {
                $this->Session->setFlash('El Departamento ha sido registrado con exito.');
				
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('Imposible registrar el Departamento.');
            }
        }
    }
	
	function edit($id = null) {
		$this->layout = 'cyanspark';
	    $this->Departamento->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Departamento->read();
	    } else {
	        if ($this->Departamento->save($this->request->data)) {
	            $this->Session->setFlash('Departamento ha sido actualizado.');
	            $this->redirect(array('action' => 'index'));
	        }
	    }
	}
	
	function delete($id) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Departamento->delete($id)) {
	        $this->Session->setFlash('El Departamento ha sido eliminado.');
	        $this->redirect(array('action' => 'index'));
	    }
	}

	function pruebaajax() {
			
		$this->set('helptext', 'Oh, this text is very helpful. ' . date("d-m-Y H:i:s"));
		$this->render('/elements/helpbox', 'ajax');
	}
	
	function notificaciones() {
		$this->set('notificaciones',$this->Notificacion->find('all',array(
			'conditions' => array("Notificacion.creacion >= now() - interval '3601 second'"),
			'order' => array('Notificacion.creacion DESC'))));	
		//$this->set('helptext', 'Oh, this text is very helpful. ' . date("d-m-Y H:i:s"));
		$this->render('/Elements/notificaciones', 'ajax');
	}
	
	
	function notificacionesjson() {
		$notificaciones = $this->set('notificaciones',$this->Notificacion->find('all',array(
			//'conditions' => array("Notificacion.creacion >= now() - interval '60 second'"),
			'order' => array('Notificacion.creacion DESC'))));
	
		$this->set('notificaciones', $notificaciones);
		//$this->set('notificaciones', Hash::extract($notificaciones, "{n}.Notificacion"));
		$this->set('_serialize', 'notificaciones');
		$this->render('/json/jsonnotificacion');
	}
	
	

	

}