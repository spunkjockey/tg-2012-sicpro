<?php
class Avanceprogramado extends AppModel {
	public $name = 'Avanceprogramado';
	public $useTable = 'avanceprogramado';
    public $primaryKey = 'idavanceprogramado';
	public $belongsTo = array(
        'Contratoconstructor' => array(
            'className'    => 'Contratoconstructor',
            'foreignKey'   => 'idcontrato'
        )
    );
	public $validate = array(
		'plazoejecuciondias' => array(
	    	'naturalNumber' => array(
	        	'rule'    => 'naturalNumber',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Ingrese el plazo de ejecución en días'
	         )
	    ),
	    'porcentajeavfisicoprog' => array(
	        'range' => array(
        		'rule'    => array('range', -1, 101),
        		'required' => true,
	        	'allowEmpty' => false,
        		'message' => 'Ingrese un porcentaje entre 0% y 100%'
    		)
		),
		'montoavfinancieroprog' => array(
	    	'decimal' => array(
	        	'rule'    => array('decimal',2),
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Ingrese un monto de avance'
	        )
		)
	);
}