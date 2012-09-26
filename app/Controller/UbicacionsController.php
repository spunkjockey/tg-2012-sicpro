<?php
class UbicacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	public $uses = array('Departamento','Municipio','Ubicacion');
	
	public function add($id=null) {
		$this->layout = 'cyanspark';
		
		$this->set('idfct',$id);
		$this->set('departamentos',$this->Ubicacion->Departamento->find('list', 
		array('fields'=>array('Departamento.iddepartamento','Departamento.departamento'),
			  'order'=>'Departamento.departamento ASC')));
		
		$primer_depto = $this->Departamento->find('first',
		array('fields'=>'Departamento.iddepartamento','order'=>'Departamento.departamento ASC')/*null,null,'Departamento.departamento ASC'*/);
		
		
		$this->set('municipios', $this->Ubicacion->Municipio->find('list',
		array('fields'=>array('Municipio.idmunicipio','Municipio.municipio'),'order'=>'Municipio.municipio ASC',
		'conditions'=>'Municipio.iddepartamento='.$primer_depto['Departamento']['iddepartamento'])
		));
		
        if ($this->request->is('post')) {
				    // it validated logic
				    Debugger::dump($this->request->data);
				    $this->Ubicacion->set('iddepartamento', $this->request->data['Ubicacion']['departamentos']);
					
					if (is_numeric($this->request->data['Ubicacion']['municipios'])) {
					$this->Ubicacion->set('idmunicipio', $this->request->data['Ubicacion']['municipios']);
					} else {
						$municipioid = $this->Municipio->findByMunicipio($this->request->data['Ubicacion']['municipios']);
						
						$this->Ubicacion->set('idmunicipio', $municipioid['Municipio']['idmunicipio']);
					}	
					
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
                $this->render('/elements/update_select', 'ajax');
        }
}