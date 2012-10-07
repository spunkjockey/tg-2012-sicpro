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
	
	public $validate = array(
	    'fechafinestimacion' => array(
	        'finmayorinicio' => array(
            	'rule'    => array('finmayorinicio'),
            	'message' => 'El valor de fecha fin estimacion tiene que se mayor que la fecha de inicio'
        	)
			)
		  
		
	);
	
	public function finmayorinicio($check) {
			
        return date_create_from_format('d/m/Y', $this->data['Estimacion']['fechafinestimacion']) > date_create_from_format('d/m/Y', $this->data['Estimacion']['fechainicioestimacion']);
    }
	
}