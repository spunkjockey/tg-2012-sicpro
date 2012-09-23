<?php
    class Persona extends AppModel 
    {
	    public $name = 'Persona';
		public $useTable = 'persona';
		public $primaryKey = 'idpersona';
		public $belongsTo = array(
				'Plaza' => array(
					'className'    => 'Plaza',
					'foreignKey'   => 'idplaza'
					),
				'Cargofuncional' => array(
					'className'=> 'Cargofuncional',
					'foreignKey' => 'idcargofuncional'
					) 
				);
		
	public $validate = array(
		'nombrespersona' => array(
		    'soloLetras' => array(
				'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
	        	'message' => 'Solo Letras'
	        	)),
			
		'apellidospersona'=> array(
			'soloLetras' => array(
				'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
	        	'message' => 'Solo Letras'
	        	)),
	        	
	    'correoelectronico' => array(    
	    	'email' => array(        
	    		'rule' => array('email', true),
	    		'message' => 'Por favor indique una dirección de correo electrónico válida.'
				)),
		'username' => array(
			'between' => array(
	        	'rule'    => array('between', 5, 15),
	            'message' => 'Nombre de usuario entre 5 y 20 caracteres',
				'required' => true
			)),
		'password'=> array(
			'between' => array(
	        	'rule'    => array('between', 6, 20),
	            'message' => 'Contrasena entre 6 y 20 caracteres',
				'required' => true
			)),
		'plazas' => array(
				'message' => 'Seleccione una plaza',
				'required' => true
			),
		'cargos' => array(
				'message' => 'Seleccione un cargo',
				'required' => true
			),
		'roles' => array(
				'message' => 'Seleccione un rol',
				'required' => true
			),
		'estado'=>array(
				'message' => 'Seleccione estado del usuario',
				'required' => true
			)
	);
	
	public function beforeValidate($options = array()) {
		parent::beforeValidate(); 
	    if (!empty($this->data['Persona']['telefonocontacto'])) {
	        $this->data['Persona']['telefonocontacto'] = $this->numberFormatBeforeSave($this->data['Persona']['telefonocontacto']);
	    }
	    return true;
	}
	
	public function numberFormatBeforeSave($numberString) {
	    return str_replace("-", "", $numberString);
	}
	
	
	}
?>