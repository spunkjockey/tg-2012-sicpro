<?php
class UbicacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session');
	public $uses = array('Departamento','Municipio','Ubicacion');
	
	public function add() {
		$this->layout = 'cyanspark';
		
		$this->set('departamento',$this->Ubicacion->Departamento->find('list', 
		array('fields'=>array('Departamento.iddepartamento','Departamento.departamento'),
			  'order'=>'Departamento.departamento ASC')));
		
//		$primer_depto = $this->Departamento->find('first',
//		array('fields'=>'Departamento.iddepartamento','order'=>'Departamento.departamento ASC')/*null,null,'Departamento.departamento ASC'*/);
		
		
//		$this->set('municipio', $this->Ubicacion->Municipio->find('list',
//		array('fields'=>array('Municipio.idmunicipio','Municipio.municipio'),'order'=>'Municipio.municipio ASC',
//		'conditions'=>'Municipio.iddepartamento='.$primer_depto['Departamento']['iddepartamento'])
//		));
	
	}
	
/*
	function update_select()
        {
                if (!empty($this->data['Municipio']['iddepartamento']))
                {
                        $depto_id = $this->data['Municipio']['iddepartamento'];
                        $municipios= $this->Municipio->find('all', array('fields'=>array('Municipio.idmunicipio','Municipio.municipio'),'order'=>'Municipio.municipio ASC','conditions'=>array('Municipio.iddepartamento'=>$depto_id)));
                }
                else
                {
                        $municipios = $this->Municipio->find('list', array('fields'=>array('Municipio.idmunicipio','Municipio.municipio'),'order'=>'Municipio.municipio ASC'));
                }
                $this->set('options', Set::combine($municipios, "{n}.Municipio.idmunicipio","{n}.Municipio.Municipio"));
                $this->render('/elements/update_select', 'ajax');
        }
	*/
}