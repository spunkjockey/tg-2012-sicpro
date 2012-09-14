<?php
class Ubicacion extends AppModel {
public $name = 'Ubicacion';
public $useTable= 'Ubicacion';
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

}
?>