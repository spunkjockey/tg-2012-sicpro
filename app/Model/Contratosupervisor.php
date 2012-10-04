<?php
    class Contratosupervisor extends AppModel {
        public $name = 'Contratosupervisor';
		public $useTable = 'contratosupervisor';
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
	            	'message' => 'Este código ya existe'
	        		)
				),
				
				'montocon'=>array(
					'rule' => array('decimal', 2),
					'allowEmpty' => false,
					'message' => 'Solo son permitidos números'
				),
				'fechainicontrato' => array(
					'rule'       => array('date', 'dmy'),
				        'message'    => 'Enter a valid date in YY-MM-DD format.',
				        'allowEmpty' => false
				),
				'fechafincontrato' => array(
				        'rule'       => array('date', 'dmy'),
				        'message'    => 'Enter a valid date in YY-MM-DD format.',
				        'allowEmpty' => false
				),
				'plazoejecucion' => array(
					'rule' => 'numeric',
					'allowEmpty' => false,
					'message' => 'Ingrese plazo de ejecución'
				),
				'cantinf' => array(
					'rule' => 'numeric',
					'allowEmpty' => false,
					'message' => 'Ingrese plazo de ejecución'
				)
			);
			
		
    public $virtualFields = array('nomcompleto' => 'Persona.nombrespersona ||\' \'||Persona.apellidospersona');
		
	};
?>