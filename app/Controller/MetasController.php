<?php
class MetasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
	public $uses = array('Meta','Componente','Proyecto','Proycomponentes');

	
	public function meta_registrar() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    if ($this->Meta->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Meta ha sido registrada.');
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$id = $this->Fichatecnica->id));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function meta_modificar($idcomponente = null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idcomponente',$idcomponente);
		$this->set('idfichatecnica',$idfichatecnica);
		$this->set('metas',$this->Meta->find('all',array(
		'conditions'=> array('Meta.idcomponente'=> $idcomponente
		))));

        if ($this->request->is('post')) {
				    if ($this->Meta->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Meta ha sido registrada.');
		            	$this->redirect(array('controller' => 'Componentes','action' => 'componente_listar',$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }

	public function meta_listar($idcomponente = null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idcomponente',$idcomponente);
		$this->set('idfichatecnica',$idfichatecnica);
		$this->set('metas',$this->Meta->find('all',array(
		'conditions'=> array('Meta.idcomponente'=> $idcomponente
		))));

        if ($this->request->is('post')) {
				    if ($this->Meta->save($this->request->data, array('validate' => true, 'callbacks' => true))) {
		            	$this->Session->setFlash('La Meta ha sido registrada.');
		            	$this->redirect(array('controller' => 'Componentes','action' => 'componente_listar_r',$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }

	
	public function meta_registrarmod($idcomponente=null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$idfichatecnica);
		$this->set('idcomponente',$idcomponente);
        if ($this->request->is('post')) {
        			$this->Meta->set('idcomponente',$idcomponente);
        			$this->Meta->set('userc', $this->Session->read('User.username'));
					$this->Meta->set('descripcionmeta',$this->request->data['Metas']['descripcionmeta']);
					
				    if ($this->Meta->save()) {
		            	$this->Session->setFlash('La Meta ha sido registrada.','default',array('class' => 'success'));
		            	$this->redirect(array('controller' => 'Metas','action' => 'meta_modificar',$idcomponente,$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	public function meta_registrar_r($idcomponente=null,$idfichatecnica = null) {
		$this->layout = 'cyanspark';
		$this->set('idfichatecnica',$idfichatecnica);
		$this->set('idcomponente',$idcomponente);
        if ($this->request->is('post')) {
        			$this->Meta->set('idcomponente',$idcomponente);
        			$this->Meta->set('userc', $this->Session->read('User.username'));
					$this->Meta->set('descripcionmeta',$this->request->data['Metas']['descripcionmeta']);
					
				    if ($this->Meta->save()) {
		            	$this->Session->setFlash('La Meta ha sido registrada.','default',array('class' => 'success'));
		            	$this->redirect(array('controller' => 'Metas','action' => 'meta_listar',$idcomponente,$idfichatecnica));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro');
		        	}		
			
		}
    }
	
	function meta_eliminar( $idmeta = null,$idcomponente = null,$idfichatecnica = null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Meta->delete($idmeta)) {
	        $this->Session->setFlash('La Meta ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Metas','action' => 'meta_modificar',$idcomponente,$idfichatecnica));
	    }
	}
	
	function meta_eliminar_r( $idmeta = null,$idcomponente = null,$idfichatecnica = null) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Meta->delete($idmeta)) {
	        $this->Session->setFlash('La Meta ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Metas','action' => 'meta_listar',$idcomponente,$idfichatecnica));
	    }
	}
	public function index() {
    	$this->layout = 'cyanspark';
        $this->set('metas', $this->Meta->find('all'));
    }
	
	/* Las siguientes funciones permitiran el filtrado de metas para poder realizar la actualizacion
	 * de sus porcentajes 
	 * 
	 * meta_actualizarporcentaje()
	 * Esta funcion realiza la actualizacion*/
	
	function meta_actualizarporcentaje()
	{
		$this->layout = 'cyanspark';
	}
	
	function meta_actualizarpje($id=null)
	{
		$this->layout = 'cyanspark';
		$this->Meta->id = $id;
		if ($this->request->is('post')) 
		{
			$this->Meta->set('porcestimado', $this->request->data['Meta']['porcestimado']);
			$this->Meta->set('userm', $this->Session->read('User.username'));
			$this->Meta->set('modificacion', date('Y-m-d h:i:s'));
			if ($this->Meta->save())
			{
				$this->Session->setFlash('Meta ha sido actualizado.',
										 'default',array('class'=>'success'));
				$this->redirect(array('action' => 'meta_actualizarporcentaje'));
			}
			else 
			{
				$this->Session->setFlash('Imposible editar proyecto');
			}
		}
		else
		{
			$this->data = $this->Meta->read();
		}
	}
	
	function proyectosjson()
	{
		$proys = $this->Proyecto->find('all', array(
					'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
					'conditions'=>array("AND"=>array(
										'Proyecto.estadoproyecto' => array('Ejecucion'),
										'Proyecto.idproyecto IN (SELECT idproyecto from sicpro2012.fichatecnica)')),
					
					'order'=> array('Proyecto.numeroproyecto ASC')));
		$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');
	}
	
	function componentesjson()
	{
		$comps = $this->Proycomponentes->find('all', array(
			'fields'=> array('idproyecto','idcomponente','nombrecomponente')));
		$this->set('comps', Hash::extract($comps, "{n}.Proycomponentes"));
		$this->set('_serialize', 'comps');
		$this->render('/json/jsoncomps');	
	}
	
	function update_tablametas()
	{
		if (!empty($this->data['Meta']['comps']))
			{
				$comid = $this->request->data['Meta']['comps'];
				$info = $this->Meta->find('all',array(
					'fields'=>array('idmeta','descripcionmeta','porcestimado'),
					'conditions'=>array('Meta.idcomponente'=>$comid),
					'order'=>'idmeta'
					));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_tablametas', 'ajax');
	}
}