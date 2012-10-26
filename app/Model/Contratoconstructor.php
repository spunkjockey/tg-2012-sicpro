<?php
    class Contratoconstructor extends AppModel {
        public $name = 'Contratoconstructor';
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
		
		public $hasMany= array(
			'Nombramiento'=>array(
				'className'=> 'Nombramiento',
				'foreignKey'=>'idcontrato'
				)
		);
		
		public $validate = array(
			'codigocontrato' => array(
				'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Este código de contrato ya existe'
					))
			);
			
	public $virtualFields = array(
		'montototal' => "montooriginal + variacion"
	);
		
		
			public function beforeSave($options = array()) {
		    if (!empty($this->data['Contratoconstructor']['fechainiciocontrato']) && !empty($this->data['Contratoconstructor']['fechafincontrato'])) {
		        $this->data['Contratoconstructor']['fechainiciocontrato'] = $this->dateFormatBeforeSave($this->data['Contratoconstructor']['fechainiciocontrato']);
		        $this->data['Contratoconstructor']['fechafincontrato'] = $this->dateFormatBeforeSave($this->data['Contratoconstructor']['fechafincontrato']);
		    }
			if(!empty($this->data['Contratoconstructor']['ordeninicio'] )){
				$this->data['Contratoconstructor']['ordeninicio'] = $this->dateFormatBeforeSave($this->data['Contratoconstructor']['ordeninicio']);
			}
		    return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
				
				
		    //return date('Y-m-d', strtotime($dateString));
		}
}	
	
	
