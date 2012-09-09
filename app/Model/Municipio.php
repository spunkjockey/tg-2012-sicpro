<?php
class Municipio extends AppModel {
	public $name = 'Municipio';
	public $useTable = 'municipio';
	public $primaryKey = 'idmunicipio';
    public $belongsTo = array(
        'Departamento' => array(
            'className'    => 'Departamento',
            'foreignKey'   => 'iddepartamento'
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
	        'minLenght' => array(
	            'rule'    => array('minLength', 2),
        		'message' => 'Codigo Municipio debe de tener al menos 2 caracteres.'
	        ),
	      	'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El Codigo de Municipio ya existe'
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
			'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
        	'message' => 'Solo Letras'
			)
		),
		'iddepartamento' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         )
		)
	);
}