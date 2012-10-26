<?php
    class Estimacion extends AppModel {
        public $name = 'Estimacion';
		public $useTable = 'estimacion';
		public $primaryKey = 'idestimacion';
		
		public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
	        'Contratoconstructor' => array(
	            'className'    => 'Contratoconstructor',
	            'foreignKey'   => 'idcontrato'
	        )
	    );
		
		public $hasOne = array(
	        'Facturaestimacion' => array(
	            'className' => 'Facturaestimacion',
	            'foreignKey' => 'idestimacion',
	            //'conditions'   => array('Profile.published' => '1'),
	            //'dependent'    => true
			)
	    );
	
	public $validate = array(
	    'fechainicioestimacion' => array(
	        'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha de inicio con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
			),
		'fechafinestimacion' => array(
			'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
				),
		'fechaestimacion' => array(
			'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha de estimación con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
				)
		  
		
	);
	
	
	public function beforeSave($options = array()) {
		    if (!empty($this->data['Estimacion']['fechainicioestimacion']) && !empty($this->data['Estimacion']['fechafinestimacion'])) 
		    {
		        $this->data['Estimacion']['fechainicioestimacion'] = $this->dateFormatBeforeSave($this->data['Estimacion']['fechainicioestimacion']);
		        $this->data['Estimacion']['fechafinestimacion'] = $this->dateFormatBeforeSave($this->data['Estimacion']['fechafinestimacion']);
	   		}
		    return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
	
	
	public function beforeDelete($cascade = false) {
	    $count = $this->Facturaestimacion->find("count", array(
	        "conditions" => array("Facturaestimacion.idestimacion" => $this->id)
	    ));
	    if ($count == 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
}