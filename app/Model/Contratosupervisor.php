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
	            	'message' => 'Este código de contrato ya ha sido asignado'
	        		)
				)
			);
			
		
		
	};
?>