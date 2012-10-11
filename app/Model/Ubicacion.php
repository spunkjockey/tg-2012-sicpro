<?php
class Ubicacion extends AppModel {
public $name = 'Ubicacion';
public $useTable= 'ubicacion';
public $primaryKey = 'idubicacion';


public $belongsTo = array(
        'Departamento' => array(
            'className'    => 'Departamento',
            'foreignKey'   => 'iddepartamento'
        ),
    	'Municipio' => array(
            'className'    => 'Municipio',
            'foreignKey'   => 'idmunicipio'
        )
    );
	
	public $validate = array(
		'idmunicipio' => array(
			'llave' => array(
            	'rule'    => array('veryubicacion'),
            	'message' => 'EL municpio ya fue seleccionado para esta ficha tecnica'
        	)
		)
	);
	
	public function veryubicacion($check) {
        $muni_ficha = $this->find('count', array(
            'conditions' => array('Ubicacion.idmunicipio ' => $this->data['Ubicacion']['idmunicipio'],
            'Ubicacion.idfichatecnica' => $this->data['Ubicacion']['idfichatecnica'])   
			
        ));
        return $muni_ficha == 0;
    }
}
?>