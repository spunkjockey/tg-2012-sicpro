<?php
class UbicacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
	public $uses = array('Departamento','Municipio','Ubicacion');
	
	public function ubicacion_registrar($id=null) {
		$this->layout = 'cyanspark';
		
		$this->set('idfct',$id);
	
        if ($this->request->is('post')) {
				    // it validated logic
				    $this->Ubicacion->set('iddepartamento', $this->request->data['Ubicacion']['departamentos']);
					
					$this->Ubicacion->set('idmunicipio', $this->request->data['Ubicacion']['municipios']);
					
					
					$this->Ubicacion->set('direccion', $this->request->data['Ubicacion']['direccion']);
					$this->Ubicacion->set('idfichatecnica',$id);
					
										
				    if ($this->Ubicacion->save()) {
		            	$this->Session->setFlash('La Ubicacion ha sido registrada.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'Fichatecnicas','action' => 'view',$id
						));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    	}
	}

	public function ubicacion_registrarmod($id=null) {
		$this->layout = 'cyanspark';
		
		$this->set('idfct',$id);
	
        if ($this->request->is('post')) {
				    // it validated logic
				    $this->Ubicacion->set('iddepartamento', $this->request->data['Ubicacion']['departamentos']);
					
					$this->Ubicacion->set('idmunicipio', $this->request->data['Ubicacion']['municipios']);
					
					
					$this->Ubicacion->set('direccion', $this->request->data['Ubicacion']['direccion']);
					$this->Ubicacion->set('idfichatecnica',$id);
					
										
				    if ($this->Ubicacion->save()) {
		            	$this->Session->setFlash('La Ubicacion ha sido registrada.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'Fichatecnicas','action' => 'fichatecnica_modificarubicacion',$id
						));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    	}
	}

	function ubicacion_eliminar($id,$idfichatecnica) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Ubicacion->delete($id)) {
	        $this->Session->setFlash('La Ubicacion ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Fichatecnicas','action' => 'fichatecnica_modificarubicacion',$idfichatecnica));
	    }
	}
	

	function update_select()
        {
                if (!empty($this->data['Ubicacion']['departamentos']))
                {
                        $depto_id = $this->data['Ubicacion']['departamentos'];
                        $municipios= $this->Municipio->find('all', array(
	                        'fields'=>array('Municipio.idmunicipio','Municipio.municipio'),
	                        'order'=>'Municipio.municipio ASC',
	                        'conditions'=>array('Municipio.iddepartamento'=>$depto_id)));
                }
                $this->set('options', Set::combine($municipios, "{n}.Municipio.idmunicipio","{n}.Municipio.municipio"));
                $this->render('/Elements/update_select', 'ajax');
        }
		
	/*funcion para recuperar listado de Departamentos*/
	public function departamentojson() 
		{
			$deptos = $this->Departamento->find('all', 
						array('fields'=>array('Departamento.iddepartamento','Departamento.departamento'),
			  				'order'=>'Departamento.departamento ASC'));	
			$this->set('departamentos', Hash::extract($deptos, "{n}.Departamento"));
			$this->set('_serialize', 'departamentos');
			$this->render('/json/jsondepto');
		}

	public function municipiojson() {
		$municipios = $this->Ubicacion->Municipio->find('all',
		array('fields'=>array('Municipio.idmunicipio','Municipio.municipio','Municipio.iddepartamento'),
		'order'=>'Municipio.municipio ASC',
		));
		$this->set('municipios', Hash::extract($municipios, "{n}.Municipio"));
		$this->set('_serialize', 'municipios');
		$this->render('/json/jsonmunicipio');
	}
}