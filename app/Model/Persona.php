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
	        	),
	        'vacio' => array(
				'allowEmpty' => false,
				'message' => 'No puede ser vacío'
				)
			),
			
		'apellidos persona'=> array(
			'soloLetras' => array(
				'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
	        	'message' => 'Solo Letras'
	        	),
	        'vacio' => array(
				'allowEmpty' => false,
				'message' => 'No puede ser vacío'
				)
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