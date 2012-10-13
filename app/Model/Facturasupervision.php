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
            	'message' => 'EL monto a facturar no es igual al monto de la supervision'
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
			'fields' => array('Informesupervisor.valoravancefinanciero'),
			'conditions' => array('Informesupervisor.idinformesupervision' => $this->data['Facturasupervision']['idinformesupervision'])
		));
		//Debugger::dump($msupervision);
		$monto = Hash::extract($msupervision, '0.Informesupervisor');
		//Debugger::dump($monto['valoravancefinanciero']);        
        return (float) $check['montofactura'] == (float) $monto['valoravancefinanciero'];
    }
}