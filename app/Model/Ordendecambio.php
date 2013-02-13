<?php
class Ordendecambio extends AppModel {
public $useTable = 'ordendecambio';
public $primaryKey = 'idordencambio';
public $belongsTo = array(
        'Contratoconstructor' => array(
            'className'    => 'Contratoconstructor',
            'foreignKey'   => 'idcontrato'
        ));

		public $validate=array(
			'fecharegistroorden'=>array(
				'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
				)
			),
			'montoordencambio' => array(
				'montocorrecto' => array(
	            	'rule'    => array('montocorrecto'),
	            	'message' => 'El nuevo monto del contrato supera el monto disponible del proyecto'
	        	)
			)
		);

		public function beforeSave($options = array()) {
			if(!empty($this->data['Ordendecambio']['fecharegistroorden'] )){
				$this->data['Ordendecambio']['fecharegistroorden'] = $this->dateFormatBeforeSave($this->data['Ordendecambio']['fecharegistroorden']);
			}

			//Debugger::dump($this->data);
		    return true;
		}
		
		
		public function montocorrecto($check) {
			$mavance = $this->Contratoconstructor->find('all',array(
				'fields' => array('Contratoconstructor.montototal'),
				'conditions' => array('Contratoconstructor.idcontrato' => $this->data['Ordendecambio']['idcontrato'])
			));
	
			
			$montototal = Hash::extract($mavance, '0.Contratoconstructor');
	
			$monto = $montototal['montototal'] /*- $montoavances['avance']*/;  
	        return (float) $check['montoordencambio'] <= (float) $monto;
	
	    }
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
}
?>
