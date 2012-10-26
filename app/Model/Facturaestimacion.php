<?php
class Facturaestimacion extends AppModel {
	public $name = 'Facturaestimacion';
	public $useTable = 'facturaestimacion';
    public $primaryKey = 'idfacturaestimacion';
	
	public $virtualFields = array(
		'facturacion' => "to_char(fechafactura, 'DD/MM/YYYY')"
	);
	
	public $belongsTo = array(  
       	'Estimacion' => array(
    	        'className'    => 'Estimacion',
	            'foreignKey'   => 'idestimacion'
	        )
	);
	
	public $validate = array(
	    'montofactura' => array(
	        'montocorrecto' => array(
            	'rule'    => array('montocorrecto'),
            	'message' => 'EL monto a facturar debe ser menor o igual al monto de la estimacion'
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
		$mestimacion = $this->Estimacion->find('all',array(
			'fields' => array('Estimacion.montoestimado'),
			'conditions' => array('Estimacion.idestimacion' => $this->data['Facturaestimacion']['idestimacion'])
		));
		
		$monto = Hash::extract($mestimacion, '0.Estimacion');
		//Debugger::dump($monto['montoestimado']);        
        return (float) $check['montofactura'] <= (float) $monto['montoestimado'];
    }


	public function beforeSave($options = array()) {
		   if (!empty($this->data['Facturaestimacion']['fechafactura'])) {
		        $this->data['Facturaestimacion']['fechafactura'] = $this->dateFormatBeforeSave($this->data['Facturaestimacion']['fechafactura']);
		   }
		return true;
		}
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
}