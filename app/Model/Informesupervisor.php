<?php
    class Informesupervisor extends AppModel
    {
    	public $name = 'Informesupervisor';
		public $useTable = 'informesupervision';
		public $primaryKey = 'idinformesupervision';
    	
		public $belongsTo = array( 
        'Contratosupervisor' => array(
            'className'    => 'Contratosupervisor',
            'foreignKey'   => 'idcontrato'
        	)
    	);
		public $virtualFields = array(
			 'fechainicio' => "to_char(Informesupervisor.fechainiciosupervision, 'DD/MM/YYYY')",
			 'fechafin' => "to_char(Informesupervisor.fechafinsupervision, 'DD/MM/YYYY')"
			 );
		
		public $validate = array(
	    'fechafinsupervision' => array(
	        'finmayorinicio' => array(
            	'rule'    => array('finmayorinicio'),
            	'message' => 'El valor de fecha fin debe que ser mayor que la fecha de inicio'
        		),
        	'formatofecha'=>array(
				'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false
				)
			),
		'fechainiciosupervision' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha inicio con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false)
		
		);
	
	public function finmayorinicio($check) 
		{
			
			return date_create_from_format('d/m/Y', $this->data['Informesupervisor']['fechafinsupervision']) > date_create_from_format('d/m/Y', $this->data['Informesupervisor']['fechainiciosupervision']);
    	
		}
    }
?>