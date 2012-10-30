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

		'valoravancefinanciero' => array(
			'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'El monto del informe supervisor supera el monto del contrato'
        	)
		)
		
		);
	
	public function montocorrecto($check) {
	

		$mtotal = $this->query("SELECT 
  contratoconstructor.idcontrato, 
  contratoconstructor.montooriginal + contratoconstructor.variacion montototal
FROM 
  sicpro2012.contratoconstructor 
WHERE
  contratoconstructor.idcontrato = (SELECT contratosupervisor.con_idcontrato
FROM sicpro2012.contratosupervisor
WHERE contratosupervisor.idcontrato = ". $this->data['Informesupervisor']['idcontrato']." );");
		
		//Debugger::dump($mtotal); 
		$monto = Hash::get($mtotal, '0.0.montototal');
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
