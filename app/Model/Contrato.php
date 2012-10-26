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
				
		public function beforeSave($options = array()) {
		    if (!empty($this->data['Contrato']['fechainiciocontrato']) && !empty($this->data['Contrato']['fechafincontrato'])) {
		        $this->data['Contrato']['fechainiciocontrato'] = $this->dateFormatBeforeSave($this->data['Contrato']['fechainiciocontrato']);
		        $this->data['Contrato']['fechafincontrato'] = $this->dateFormatBeforeSave($this->data['Contrato']['fechafincontrato']);
	   
			}
			if(!empty($this->data['Contrato']['ordeninicio'] )){
				$this->data['Contrato']['ordeninicio'] = $this->dateFormatBeforeSave($this->data['Contrato']['ordeninicio']);
			}
		    return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
		
	};