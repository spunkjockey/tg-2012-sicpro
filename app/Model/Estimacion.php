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
				),
		'montoestimado' => array(
			'mayorqueproyecto' => array(
            	'rule'    => array('limitarMontoContrato'),
            	'allowEmpty' => true,
            	'message' => 'El valor  estimado sobrepasa el monto del contrato'
        	)
		)
		  
		
	);
	
	
	public function beforeSave($options = array()) {
		    if (!empty($this->data['Estimacion']['fechainicioestimacion']) && !empty($this->data['Estimacion']['fechafinestimacion'])) 
		    {
		        $this->data['Estimacion']['fechainicioestimacion'] = $this->dateFormatBeforeSave($this->data['Estimacion']['fechainicioestimacion']);
		        $this->data['Estimacion']['fechafinestimacion'] = $this->dateFormatBeforeSave($this->data['Estimacion']['fechafinestimacion']);
	   		}

			if (!empty($this->data['Estimacion']['fechaestimacion'])) {
				$this->data['Estimacion']['fechaestimacion'] = $this->dateFormatBeforeSave($this->data['Estimacion']['fechaestimacion']);
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
	
	
	public function limitarMontoContrato($check) {
        $monto_disponible = $this->Contratoconstructor->find('first',array(
			'fields' => array('Contratoconstructor.montototal'),
			'conditions' => array('Contratoconstructor.idcontrato' => $this->data['Estimacion']['idcontrato'])
		));
		
		$monto_utilizado = $this->query('SELECT 
				   idcontrato, SUM(montoestimado) as totalmonto 
				FROM 
				  sicpro2012.estimacion
				WHERE 
				  idcontrato = ' . $this->data['Estimacion']['idcontrato'] .'
				GROUP BY
				  idcontrato;');
		
		//Debugger::dump($monto_disponible['Contratoconstructor']['montototal']);
		//Debugger::dump(Hash::get($monto_utilizado, '0.0.totalmonto'));
		
		$montototal = $monto_disponible['Contratoconstructor']['montototal'] - Hash::get($monto_utilizado, '0.0.totalmonto');
		
		//Debugger::dump(round($montototal,2) . ' >= ' .$check['montoestimado']);
		
		
        return (float) round($montototal,2) >= (float) $check['montoestimado'];
    }
}