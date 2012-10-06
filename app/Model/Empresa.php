<?php
class Empresa extends AppModel {
public $useTable = 'empresa';
public $primaryKey = 'idempresa';



	public $validate = array(
		
		'nitempresa' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
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
	            'message' => 'La Empresa ya existe'
			),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 150),
	        	'message' => 'El nombre de la Empresa debe ser maximo 150 caracteres.'
	        ),
			'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
	   	),
	    
	    
	    'representantelegal' => array(
	    	'regla1' => array(
		        'rule'    => 'notEmpty',
		        'required' => 'create',
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
	        	'message' => 'Solo números son permitidos',
	         ),
	        'minLenght' => array(
	            'rule'    => array('minLength', 8),
        		'message' => 'El numero de telefono debe ser de 8 numeros.'
	        ),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 8),
	        	'message' => 'El numero de telefono debe ser de 8 numeros.'
	    	),
	    	'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
		),
		
		
		'correorepresentante' => array(
			'email' => array(
		        'rule'    => array('email'),
		        'required' => false,
		        'allowEmpty' => true,
		        'message' => 'Ingrese una direccion de correo electronica valida.'
    		),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 50),
	        	'message' => 'El correo electronico debe ser maximo 50 caracteres.'
	    	)
		),
	);
	
	
		
	public function beforeValidate($options = array()) {
		parent::beforeValidate(); 
	    if (!empty($this->data['Empresa']['nitempresa'])) {
	        $this->data['Empresa']['nitempresa'] = $this->numberFormatBeforeSave($this->data['Empresa']['nitempresa']);
	    }
		if (!empty($this->data['Empresa']['telefonoempresa'])) {
	        $this->data['Empresa']['telefonoempresa'] = $this->numberFormatBeforeSave($this->data['Empresa']['telefonoempresa']);
	    }
	    return true;
	}
	
	public function numberFormatBeforeSave($numberString) {
	    return str_replace("-", "", $numberString);
	}
	
	
}