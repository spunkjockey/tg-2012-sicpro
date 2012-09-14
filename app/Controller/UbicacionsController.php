<?php
class UbicacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	public $uses = array('Departamento','Municipio','Ubicacion');
	
	public function add() {
		$this->layout = 'cyanspark';
		
		$this->set('departamentos',$this->Ubicacion->Departamento->find('list', 
		array('fields'=>array('Departamento.iddepartamento','Departamento.departamento'),
			  'order'=>'Departamento.departamento ASC')));
		
		$primer_depto = $this->Departamento->find('first',
		array('fields'=>'Departamento.iddepartamento','order'=>'Departamento.departamento ASC')/*null,null,'Departamento.departamento ASC'*/);
		
		
		$this->set('municipios', $this->Ubicacion->Municipio->find('list',
		array('fields'=>array('Municipio.idmunicipio','Municipio.municipio'),'order'=>'Municipio.municipio ASC',
		'conditions'=>'Municipio.iddepartamento='.$primer_depto['Departamento']['iddepartamento'])
		));
	
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