<?php
    class Contrato extends AppModel {
        public $name = 'Contrato';
		public $useTable = 'contrato';
		public $primaryKey = 'idcontrato';
		
		public $belongsTo = array(
			'Persona'=> array(
				'className'    => 'Persona',
				'foreignKey'   => 'idpersona'
				),
			'Proyecto' => array(
				'className'    => 'Proyecto',
				'foreignKey'   => 'idproyecto'
				),
			'Empresa' => array(
				'className'    => 'Empresa',
				'foreignKey'   => 'idempresa'
				)
			);
		
		public $validate = array(

			'ordeninicio' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese el formato de la manera siguiente DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false),
					
			'codigocontrato' => array(
				'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Este código de contrato ya existe'
					)),
			
			'fechafincontrato' => array(
		        'finmayorinicio_con' => array(
	            	'rule'    => array('finmayorinicio_con'),
	            	'message' => 'El valor de fecha fin debe ser mayor que la fecha de inicio',
	            	'allowEmpty' => true,
	            	'required'=>false
	        		),
	        	'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
				),
				
	        'fechainiciocontrato' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha inicio con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false) 
		 
		);
		
		public function finmayorinicio_con($check) 
		{
				Debugger::dump($check);
			return date_create_from_format('d/m/Y', $this->data['Contrato']['fechainiciocontrato']) < date_create_from_format('d/m/Y', $this->data['Contrato']['fechafincontrato']);
    	
		}
		
	};