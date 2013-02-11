<?php
class Facturasupervision extends AppModel {
	public $name = 'Facturasupervision';
	public $useTable = 'facturasupervision';
    public $primaryKey = 'idfacturasupervision';
	
	public $virtualFields = array(
		'facturacion' => "to_char(fechafactura, 'DD/MM/YYYY')"
	);
	
	public $belongsTo = array(  
       	'Informesupervisor' => array(
    	        'className'    => 'Informesupervisor',
	            'foreignKey'   => 'idinformesupervision'
	        )
	);
	
	public $validate = array(
	    'montofactura' => array(
	        'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'El monto a facturar sobrepasa el monto del contrato'
        	)
		),
	    'fechafactura' => array(
	        'date' => array(
            	'rule' => array('date', 'dmy'),
        		'message'    => 'Digite una fecha valida en formato DD/MM/AAAA.',
        		'allowEmpty' => true
        	)
		)
	);
	
	public function montocorrecto($check) {
		
		$monto_total = $this->Informesupervisor->find('first',array(
			//'fields' => array('Contratosupervisor.montototal'),
			'conditions' => array('Informesupervisor.idinformesupervision' => $this->data['Facturasupervision']['idinformesupervision'])
		));
		  
		 
		 /*$monto_total = $this->Informesupervisor->find('first',array(
			'fields' => array('Contratosupervisor.montototal'),
			'conditions' => array('Informesupervisor.idinformesupervision' => $this->data['Facturasupervision']['idinformesupervision'])
		));*/
				
		$monto_facturado = $this->query('SELECT 
				  idcontrato, SUM(montofactura) as totalmonto 
				FROM 
				  sicpro2012.facturasupervision, sicpro2012.informesupervision 
				WHERE 
				  informesupervision.idinformesupervision = facturasupervision.idinformesupervision AND 
				  informesupervision.idcontrato = ' . $monto_total['Contratosupervisor']['idcontrato'] .'
				GROUP BY 
				  idcontrato;');
		
		
		//Debugger::dump($this->data);
		//Debugger::dump($monto_total['Contratosupervisor']['montototal']);
		//Debugger::dump($this->data['Facturasupervision']['idinformesupervision'] . ' ' .Hash::get($monto_facturado, '0.0.totalmonto'));
		
		$monto = $monto_total['Contratosupervisor']['montototal'] - Hash::get($monto_facturado, '0.0.totalmonto');
		
		//Debugger::dump(round($monto,2) . ' >= ' .$check['montofactura']);
		
		
        return (float) round($monto,2) >= (float) $check['montofactura'];
        //return false;
    }


	public function beforeSave($options = array()) {
		   if (!empty($this->data['Facturasupervision']['fechafactura'])) {
		        $this->data['Facturasupervision']['fechafactura'] = $this->dateFormatBeforeSave($this->data['Facturasupervision']['fechafactura']);
		   }
		return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
}