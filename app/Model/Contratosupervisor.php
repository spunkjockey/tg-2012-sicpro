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
				),
			'fechafincontrato' => array(
		        'finmayorinicio_sup' => array(
	            	'rule'    => array('finmayorinicio_con'),
	            	'message' => 'El valor de fecha fin debe ser mayor que la fecha de inicio'
	        		),
	        	'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
				),
	        'fechainicontrato' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha inicio con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false) 
			);
			
		public function finmayorinicio_sup($check) 
		{
			
			return date_create_from_format('d/m/Y', $this->data['Contratosupervisor']['fechainicontrato']) < date_create_from_format('d/m/Y', $this->data['Contratosupervisor']['fechafincontrato']);
    	
		}
		
	};
?>