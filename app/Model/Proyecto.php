<?php

class Proyecto extends AppModel {
        public $name = 'Proyecto';
		public $useTable = 'proyecto';
		public $primaryKey = 'idproyecto';
		public $belongsTo = array(
			'Division' => array(
				'className'    => 'Division',
				'foreignKey'   => 'iddivision'
			)
		);
		
		public $validate = array(
			'nombreproyecto' => array(
				'isUnique' => array(
		            'rule'    => 'isUnique',
		            'required' => true,
	            	'allowEmpty' => false,
	            	'on' => 'create',
	            	'message' => 'Nombre de proyecto ya existe'
	        		)
				
				),
			'numeroproyecto'=>array(
				'numeric' => array(
		        	'rule'    => 'numeric',
		        	'allowEmpty' => false,
		            'message' => 'Solo números son permitidos',
		            'last'    => true
		         	),
		        'isUnique' => array(
	            	'rule'    => 'isUnique',
	            	'message' => 'Este número de proyecto ya ha sido asignado'
	        		),
				'maxlength' => array(
					'rule' => array('maxLength', '6'),
					'message' => 'Largo máximo de 6 dígitos'
					)
				),
			'proys' => array(
	        	'allowEmpty' => false,
	        	'message' => 'Seleccione un proyecto'
	        	
			),
			
			);
}

?>