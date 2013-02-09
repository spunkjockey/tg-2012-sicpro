<?php
    class Informetecnico extends AppModel
    {
    	public $name = 'Informetecnico';
		public $useTable = 'informetecnico';
	    public $primaryKey = 'idinformetecnico';
		public $belongsTo = array(
	        'Contratoconstructor' => array(
	            'className'    => 'Contratoconstructor',
	            'foreignKey'   => 'idcontrato'
	        ),
	        'Persona'=> array(
				'className' => 'Persona',
				'foreignKey' => 'idpersona'
			)
	    );
		
		public $virtualFields = array(
			 'fechav' => "to_char(Informetecnico.fechavisita, 'DD/MM/YYYY')",
			 'fechaelab' => "to_char(Informetecnico.fechaelaboracion, 'DD/MM/YYYY')"
			 
			 );
		 
		public $validate=array(
			'fechavisita'=>array(
				'visitamenorigual'=>array(
					'rule'=>array('visitamenorigual'),
            		'message' => 'La fecha de visita debe ser menor o igual a la fecha de elaboración del informe'),
				'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha de visita con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
				)
			),
			'fechaelaboracion'=>array(
				'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha de elaboración con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
				)
			)
		);
		
		
    	
		
		public function visitamenorigual($check) 
		{
			
			return date_create_from_format('d/m/Y', $this->data['Informetecnico']['fechavisita']) <= date_create_from_format('d/m/Y', $this->data['Informetecnico']['fechaelaboracion']);
    	
		}
		
		
		public function beforeSave($options = array()) {
			if(!empty($this->data['Informetecnico']['fechavisita'] )){
				$this->data['Informetecnico']['fechavisita'] = $this->dateFormatBeforeSave($this->data['Informetecnico']['fechavisita']);
			}

			if(!empty($this->data['Informetecnico']['fechaelaboracion'] )){
				$this->data['Informetecnico']['fechaelaboracion'] = $this->dateFormatBeforeSave($this->data['Informetecnico']['fechaelaboracion']);
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
?>