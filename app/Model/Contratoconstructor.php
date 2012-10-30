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
		
	public function beforeDelete($cascade = false) {
	    $count = $this->query('SELECT idcontrato, sum(count)
				FROM
				(SELECT 
				  contratoconstructor.idcontrato, count(contratoconstructor.idcontrato)
				FROM 
				  sicpro2012.contratoconstructor, 
				  sicpro2012.contratosupervisor 
				WHERE 
				  contratoconstructor.idcontrato = contratosupervisor.con_idcontrato
				GROUP BY 
				 contratoconstructor.idcontrato
				
				UNION
				
				 SELECT 
				  contratoconstructor.idcontrato, count(contratoconstructor.idcontrato)
				FROM 
				  sicpro2012.contratoconstructor,
				  sicpro2012.informetecnico
				WHERE 
				  contratoconstructor.idcontrato = informetecnico.idcontrato
				GROUP BY 
				 contratoconstructor.idcontrato
				
				UNION
				
				 SELECT 
				  contratoconstructor.idcontrato, count(contratoconstructor.idcontrato)
				FROM 
				  sicpro2012.contratoconstructor, 
				  sicpro2012.estimacion
				WHERE 
				  contratoconstructor.idcontrato = estimacion.idcontrato
				GROUP BY 
				 contratoconstructor.idcontrato
				
				UNION
				
				SELECT 
				  contratoconstructor.idcontrato, 0 as count
				FROM 
				  sicpro2012.contratoconstructor
				GROUP BY 
				 contratoconstructor.idcontrato
				
				UNION
				
				SELECT 
				  contratoconstructor.idcontrato, count(contratoconstructor.idcontrato)
				FROM 
				  sicpro2012.contratoconstructor, 
				  sicpro2012.nombramiento
				WHERE 
				  contratoconstructor.idcontrato = nombramiento.idcontrato
				GROUP BY 
				 contratoconstructor.idcontrato
				 
				 UNION
				
				 SELECT 
				  contratoconstructor.idcontrato, count(contratoconstructor.idcontrato)
				FROM 
				  sicpro2012.contratoconstructor, 
				  sicpro2012.avanceprogramado
				WHERE 
				  contratoconstructor.idcontrato = avanceprogramado.idcontrato
				GROUP BY 
				 contratoconstructor.idcontrato) as tabla
				WHERE idcontrato = '. $this->id .'
				 GROUP BY 
				 idcontrato;');
	    
		//Debugger::dump(Hash::get($count, '0.0.sum'));
	    if (Hash::get($count, '0.0.sum') == 0) {
	        return true;
	    } else {
	        return false;
	    }
	    
	}
}	
	
	
