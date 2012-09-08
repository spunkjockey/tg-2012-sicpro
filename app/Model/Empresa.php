<?php
class Empresa extends AppModel {
public $useTable = 'empresa';
//public $primaryKey = 'nitempresa';


	public $validate = array(
		'nitempresa' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         ),
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'message' => 'El NIT Empresa ya ha sido ingresado'
	        ),
	        'minLenght' => array(
	            'rule'    => array('minLength', 14),
        		'message' => 'El NIT empresa debe ser de 14 numeros.'
	        ),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 14),
	        	'message' => 'El NIT empresa debe ser de 14 numeros.'
	    	)
	    ),
	    'nombreempresa' => array(
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El Departamento ya existe'),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 150),
	        	'message' => 'El nombre del presentante debe ser maximo 150 caracteres.'
	        	)
	        ),
	    'representantelegal' => array(
	    	'regla1' => array(
		        'rule'    => 'notEmpty',
		        'required' => true,
		        'message' => 'Debe ingresa el Nombre del  Representante'
		    	),
	        'maxLength' => array(
	        	'rule'    => array('maxLength', 75),
	        	'message' => 'El nombre del presentante debe ser maximo 75 caracteres.'
	    		)
			),
		'direccionoficina'=> array(
	        'maxLength' => array(
	        	'rule'    => array('maxLength', 100),
	        	'message' => 'La direccion debe ser maximo 100 caracteres.'
	    		)
	    ),
		'telefonoempresa' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         ),
	        'minLenght' => array(
	            'rule'    => array('minLength', 8),
        		'message' => 'El numero de telefono debe ser de 8 numeros.'
	        ),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 8),
	        	'message' => 'El numero de telefono debe ser de 8 numeros.'
	    	)
		),
		'correorepresentante' => array(
			'email' => array(
		        'rule'    => array('email', true),
		        'message' => 'Ingrese una direccion de correo electronica valida.'
    		),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 50),
	        	'message' => 'El correo electronico debe ser menor a 50 caracteres.'
	    	)
		),
	);
}