<?php
class Avanceprogramado extends AppModel {
	public $name = 'Avanceprogramado';
	public $useTable = 'avanceprogramado';
    public $primaryKey = 'idavanceprogramado';
	public $belongsTo = array(
        'Contratoconstructor' => array(
            'className'    => 'Contratoconstructor',
            'foreignKey'   => 'idcontrato'
        )
    );
	public $validate = array(
		'plazoejecuciondias' => array(
	    	'naturalNumber' => array(
	        	'rule'    => 'naturalNumber',
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Ingrese el plazo de ejecución en días'
	         )
	    ),
	    'porcentajeavfisicoprog' => array(
	        'range' => array(
        		'rule'    => array('range', -1, 101),
        		'required' => true,
	        	'allowEmpty' => false,
        		'message' => 'Ingrese un porcentaje entre 0% y 100%'
    		)
		),
		'montoavfinancieroprog' => array(
	    	'decimal' => array(
	        	'rule'    => array('decimal',2),
	        	'required' => true,
	        	'allowEmpty' => false,
	            'message' => 'Ingrese un monto de avance'
	        ),
			'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'El monto del avance supera el monto del proyecto'
        	)
		),
		'fechaavance' => array(
        	'date' => array(
        		'rule'       => array('date', 'dmy'),
	        	'required' => true,
	        	'allowEmpty' => false,
        		'message'    => 'Ingrese una fecha valida en formato DD/MM/AAAA'
			)
        )
		
		
    );
	
	public $virtualFields = array(
		'avance' => "to_char(fechaavance, 'DD/MM/YYYY')"
	);
	
	public function montocorrecto($check) {
		$mavance = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.montototal'),
			'conditions' => array('Contratoconstructor.idcontrato' => $this->data['Avanceprogramado']['idcontrato'])
		));
		
		$mavances = $this->find('all',array(
			'fields' => array('SUM(Avanceprogramado.montoavfinancieroprog) AS avance'),
			'conditions' => array('Avanceprogramado.idcontrato' => $this->data['Avanceprogramado']['idcontrato'])
		));
		
		$montototal = Hash::extract($mavance, '0.Contratoconstructor');
		$montoavances = Hash::extract($mavances, '0.0');	
		$monto = $montototal['montototal'] - $montoavances['avance'];  
        return (float) $check['montoavfinancieroprog'] <= (float) $monto;

    }
}