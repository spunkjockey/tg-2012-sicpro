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
			'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'El monto del avance supera el monto del contrato'
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

		
		$montototal = Hash::extract($mavance, '0.Contratoconstructor');

		$monto = $montototal['montototal'] /*- $montoavances['avance']*/;  
        return (float) $check['montoavfinancieroprog'] <= (float) $monto;

    }
	
	public function beforeSave($options = array()) {
		    if (!empty($this->data['Avanceprogramado']['fechaavance'])) {
		        $this->data['Avanceprogramado']['fechaavance'] = $this->dateFormatBeforeSave($this->data['Avanceprogramado']['fechaavance']);
		     	    
			}
		    return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
		
		
		
		public function beforeDelete($cascade = false) {
	    	
			
		    $count = $this->query('SELECT 
				  avanceprogramado.idavanceprogramado, 
				  contratosupervisor.con_idcontrato,
				  avanceprogramado.fechaavance,
				  count(*)
				FROM 
				  sicpro2012.avanceprogramado, 
				  sicpro2012.informesupervision, 
				  sicpro2012.contratosupervisor
				WHERE 
				  avanceprogramado.fechaavance = informesupervision.fechafinsupervision AND
				  informesupervision.idcontrato = contratosupervisor.idcontrato AND
				  contratosupervisor.con_idcontrato = avanceprogramado.idcontrato AND
				  avanceprogramado.idavanceprogramado = '. $this->id .'
				GROUP BY
				  avanceprogramado.idavanceprogramado, 
				  contratosupervisor.con_idcontrato;');
		    
			//Debugger::dump(Hash::get($count, '0.0.sum'));
		    if (Hash::get($count, '0.0.count') == 0) {
		        return true;
		    } else {
		        return false;
		    }
	    
	}
}