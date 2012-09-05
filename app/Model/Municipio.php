<?php
class Municipio extends AppModel {
	public $name = 'Municipio';
	public $useTable = 'municipio';
    public $belongsTo = array(
        'Departamento' => array(
            'className'    => 'Departamento',
            'foreignKey'   => 'departamento_id'
        )
    );
    public $validate = array(
		'codigomunicipio' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         ),
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'message' => 'El Codigo Municipio ya ha sido ingresado'
	        ),
	        'minLenght' => array(
	            'rule'    => array('minLength', 2),
        		'message' => 'Codigo Municipio debe de tener al menos 2 caracteres.'
	        )
	    ),
	    'municipio' => array(
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El Municipio ya existe'
	        ),
	    'soloLetras' => array(
			'rule'    => '/^[a-zA-Z][a-zA-Z\s]{2,}$/i',
        	'message' => 'Solo Letras'
			)
		),
	);
}