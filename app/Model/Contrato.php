<?php
    class Contrato extends AppModel {
        public $name = 'Contrato';
		public $useTable = 'contrato';
		public $primaryKey = 'idcontrato';
		
		public $validate = array(

			'codigocontrato' => array(
				'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Este código de contrato ya existe'
					)),

		    'ordeninicio' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese el formato de la manera siguiente DD/MM/AAAA.',
		        'allowEmpty' => true
		    )
		);
		

		
	};