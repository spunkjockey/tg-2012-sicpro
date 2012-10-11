<?php
class Fichatecnica extends AppModel {
	public $name = 'Fichatecnica';
	public $useTable = 'fichatecnica';
	public $primaryKey = 'idfichatecnica';
	public $recursive =2;
    public $belongsTo = array(
        'Proyecto' => array(
            'className'    => 'Proyecto',
            'foreignKey'   => 'idproyecto'
        )
    );
	
	public $hasMany	= array(
	'Ubicacion'	=> array(
		'className'	=>	'Ubicacion',
		'foreignKey'	=>	'idfichatecnica',
        'dependent'     => true
	),
	'Componente' => array(
		'className'	=>	'Componente',
		'foreignKey'	=>	'idfichatecnica',
        'dependent'     => true
	)
	);	
	
	
	public $validate = array(
		'objgeneral' => array(
			'maxLength' => array(
	        	'rule'    => array('maxLength', 300),
	        	'message' => 'El Objetivo general no debe ser mayor a 300 caracteres.'
	    	),
	    	'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
	    ),
	    'objespecifico' => array(
			'maxLength' => array(
	        	'rule'    => array('maxLength', 200),
	        	'message' => 'El Objetivo especifico no debe ser mayor a 200 caracteres.'
	    	)
	    ),
		'empleosgenerados' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         ),
	        'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
		),
		'beneficiarios' => array(
	    	'numeric' => array(
	        	'rule'    => 'numeric',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Solo números son permitidos',
	            'last'    => true
	         ),
	        'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
		),
		'problematica' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
		),
		'descripcionproyecto' => array(
			'notEmpty' => array(
				'rule' => 'notEmpty',
    			'required' => 'create',
    			'message' => 'El campo no debe estar vacío'
			)
		),
	);
}