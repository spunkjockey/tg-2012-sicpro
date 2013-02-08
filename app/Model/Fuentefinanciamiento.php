<?php
    class Fuentefinanciamiento extends AppModel {
        public $name = 'Fuentefinanciamiento';
		public $useTable = 'fuentefinanciamiento';
		public $primaryKey = 'idfuentefinanciamiento';
		
		 public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
        'Tipofuente' => array(
            'className'    => 'Tipofuente',
            'foreignKey'   => 'idtipofuente'
        )
		
    );

	public $hasMany = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
        'Financia' => array(
            'className'    => 'Financia',
            'foreignKey'   => 'idfuentefinanciamiento'
        )
		
    );	

	public $validate = array(
	    'nombrefuente' => array(
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El nombre de la fuente ya existe')
	        ),
		'fechadisponible'=>array(
				'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha de inicio de disponibilidad con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
				)
			) 
		 
		);
	
	public function beforeDelete($cascade = false) {
	    $count = $this->Financia->find("count", array(
	        "conditions" => array("Financia.idfuentefinanciamiento" => $this->id)
	    ));
	    if ($count == 0) {
	        return true;
	    } else {
	        return false;
	    }
	}
	
	public function beforeSave($options = array()) {
			if(!empty($this->data['Fuentefinanciamiento']['fechadisponible'] )){
				$this->data['Fuentefinanciamiento']['fechadisponible'] = $this->dateFormatBeforeSave($this->data['Fuentefinanciamiento']['fechadisponible']);
			}

			//Debugger::dump($this->data);
		    return true;
		}
		
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
	
	
}