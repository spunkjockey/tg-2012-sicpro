<?php
    class Contratoconstructor extends AppModel {
        public $name = 'Contrato';
		public $useTable = 'contratoconstructor';
		public $primaryKey = 'idcontrato';
		
		public $belongsTo = array(
			'Empresa'=> array(
				'className'    => 'Empresa',
				'foreignKey'   => 'idempresa'
				),
			'Persona'=> array(
				'className'    => 'Persona',
				'foreignKey'   => 'idpersona'
				),
			'Proyecto' => array(
				'className'    => 'Proyecto',
				'foreignKey'   => 'idproyecto'
				)
			);
		
		public $validate = array(
			'codigocontrato' => array(
				'isUnique' => array(
		        'rule'    => 'isUnique',
		            'allowEmpty' => false,
		            'on'         => 'create',
	            	'message' => 'Este código ya existe'
	        		)
				),
				
				'montocon'=>array(
					'rule' => array('decimal', 2),
					'allowEmpty' => false,
					'on'         => 'create',
					'message' => 'Solo son permitidos números'
				),
				'anticipo'=>array(
					'rule' => array('decimal', 2),
					'allowEmpty' => false,
					'on'         => 'create',
					'message' => 'Solo son permitidos números'
				),
				'fechainicontrato' => array(
					'rule'       => array('date', 'dmy'),
				        'message'    => 'Enter a valid date in YY-MM-DD format.',
				        'allowEmpty' => false,
				       'on'         => 'create'
				),
				'fechafincontrato' => array(
				        'rule'       => array('date', 'dmy'),
				        'message'    => 'Enter a valid date in YY-MM-DD format.',
				        'allowEmpty' => false,
				        'on'         => 'create'
				),
				'plazoejecucion' => array(
					'rule' => 'numeric',
					'allowEmpty' => false,
					'on'         => 'create',
					'message' => 'Ingrese plazo de ejecución'
				)
			);
			
		
	};
?>