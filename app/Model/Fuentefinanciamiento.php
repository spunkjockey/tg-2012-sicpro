<?php
    class Fuentefinanciamiento extends AppModel {
        public $name = 'Fuentefinanciamiento';
		public $useTable = 'fuentefinanciamiento';
		public $primaryKey = 'idfuentefinanciamiento';
		
		 public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
        'Tipofuente' => array(
            'className'    => 'Tipofuente',
            'foreignKey'   => 'idtipofuente'
        )
    );
	

	/*public $validate = array(
	    'nombrefuente' => array(
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El nombre de la fuente ya existe'),
			'maxLength' => array(
	        	'rule'    => array('maxLength', 150),
	        	'message' => 'El nombre de la fuente debe ser maximo 150 caracteres.'
	        	)
	        ),
	    'Montoinicial' => array(
	    	'regla1' => array(
		        'rule'    => 'notEmpty',
		        'required' => true,
		        'message' => 'Debe ingresa el Monto Inicial'
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
	);*/
}