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
            	'message' => 'El monto a facturar sobrepasa el mondo del contrato'
        	)
		),
	    'fechafactura' => array(
	        'date' => array(
            	'rule' => array('date', 'dmy'),
        		'message'    => 'Digite una fecha valida en formato DD/MM/YYYY.',
        		'allowEmpty' => true
        	)
		)
	);
	
	public function montocorrecto($check) {
		//Debugger::dump($check['montofactura']);
		//Debugger::dump($this->data['Facturaestimacion']['idestimacion']);
		//$mestimacion = $this->findByIdestimacion($this->data['Facturaestimacion']['idestimacion']);
		$msupervision = $this->Informesupervisor->find('all',array(
			//'fields' => array('Contratosupervisor.montooriginal, Contratosupervisor.variacion'),
			'conditions' => array('Informesupervisor.idinformesupervision' => $this->data['Facturasupervision']['idinformesupervision'])
		));
		
		/*$mfactura = $this->find('all',array(
			'fields' => array('SUM(Facturasupervision.montofactura) AS sumamonto'),
			'conditions' => array('Facturasupervision.idinformesupervision' => $this->data['Facturasupervision']['idinformesupervision'])
		));*/
		//Debugger::dump($msupervision);
		$monto = Hash::extract($msupervision, '0.Contratosupervisor');
		//$mmonto = Hash::extract($mfactura, '0.0');
		//$mmonto = Hash::extract($mfactura, '0.Informesupervisor');
		
		$mmonto = $this->query("SELECT SUM(montofactura) as 
			TotalFactura FROM facturasupervision AS Facturasupervision 
			WHERE idinformesupervision = " . 
			$this->data['Facturasupervision']['idinformesupervision'] . ";");
		
		//Debugger::dump($monto);
		//Debugger::dump($mmonto);
		        
        
        return (float) $check['montofactura'] <= ( (float) $monto['montooriginal']+(float) $monto['variacion']);
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