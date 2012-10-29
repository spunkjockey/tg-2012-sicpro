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
		
		
		public $hasOne = array(
	        'Facturasupervision' => array(
	            'className' => 'Facturasupervision',
	            'foreignKey' => 'idinformesupervision',
	            'dependent'    => true
			)
	    );
		/*
		public $virtualFields = array(
			 'fechainicio' => "to_char(Informesupervisor.fechainiciosupervision, 'DD/MM/YYYY')",
			 'fechafin' => "to_char(Informesupervisor.fechafinsupervision, 'DD/MM/YYYY')"
			 );
		*/
		
		public $validate = array(
	    'fechafinsupervision' => array(
				'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false
		),
		'fechainiciosupervision' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha inicio con el siguiente formato DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false
		),
		'valoravancefinanciero' => array(
			'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'El monto del informe supervisor supera el monto del contrato'
        	)
		)
		
		);
	
	public function montocorrecto($check) {
		$mavance = $this->Contratosupervisor->find('all',array(
			'fields' => array('Contratosupervisor.montototal'),
			'conditions' => array('Contratosupervisor.idcontrato' => $this->data['Informesupervisor']['idcontrato'])
		));

		
		$montototal = Hash::extract($mavance, '0.Contratosupervisor');

		$monto = $montototal['montototal'] /*- $montoavances['avance']*/;  
        //Debugger::dump($monto);
		//Debugger::dump($check['valoravancefinanciero']);
		//Debugger::dump($check['valoravancefinanciero'] <= (float) $monto );
        return (float) $check['valoravancefinanciero'] <= (float) $monto;

    }
	
	public function beforeDelete($cascade = false) {
	    $count = $this->Facturasupervision->find("count", array(
	        "conditions" => array("Facturasupervision.idinformesupervision" => $this->id)
	    ));
	    if ($count == 0) {
	        return true;
	    } else {
	        return false;
	    }
	}


    }
