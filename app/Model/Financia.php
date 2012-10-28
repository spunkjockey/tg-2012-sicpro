<?php
class Financia extends AppModel {
	public $name = 'Financia';
	public $useTable = 'financia';
	public $primaryKey = 'fuente_proyecto';
	public $belongsTo = array(
        'Proyecto' => array(
            'className'    => 'Proyecto',
            'foreignKey'   => 'idproyecto'
        ),
        'Fuentefinanciamiento' => array(
            'className'    => 'Fuentefinanciamiento',
            'foreignKey'   => 'idfuentefinanciamiento'
        )
    );
	public $validate = array(
		'montoparcial' => array(
			'mayorquepermitido' => array(
            	'rule'    => array('limitarMonto'),
            	'allowEmpty' => true,
            	'message' => 'El valor sobrepasa el monto disponible'
        	),
			'mayorqueproyecto' => array(
            	'rule'    => array('limitarMontoProyecto'),
            	'allowEmpty' => true,
            	'message' => 'El valor sobrepasa el monto del proyecto'
        	)
		)
		
	);
	
	public function limitarMonto($check) {
        $monto_disponible = $this->Fuentefinanciamiento->find('first', array(
            'fields' => 'Fuentefinanciamiento.montodisponible',
            'conditions' => array('Fuentefinanciamiento.idfuentefinanciamiento ' => $this->data['Financia']['idfuentefinanciamiento'])   
			
        ));
		
		//Debugger::dump($this->data['Financia']['idfuentefinanciamiento']);
		//Debugger::dump($monto_disponible);
		//Debugger::dump($check['montoparcial']);
        return $monto_disponible['Fuentefinanciamiento']['montodisponible'] >= $check['montoparcial'];
    }
	
	public function limitarMontoProyecto($check) {
        $monto_disponible = $this->Proyecto->find('first', array(
            'fields' => 'Proyecto.montoplaneado',
            'conditions' => array('Proyecto.idproyecto ' => $this->data['Financia']['idproyecto'])   
			
        ));
		
		$monto_utilizado = $this->query('SELECT 
				   idproyecto, SUM(montoparcial) as totalmonto 
				FROM 
				  sicpro2012.financia
				WHERE 
				  idproyecto = ' . $this->data['Financia']['idproyecto'] .'
				GROUP BY
				  idproyecto;');
		
		
		//Debugger::dump($monto_disponible['Proyecto']['montoplaneado']);
		//Debugger::dump(Hash::get($monto_utilizado, '0.0.totalmonto'));
		
		$montototal = $monto_disponible['Proyecto']['montoplaneado'] - Hash::get($monto_utilizado, '0.0.totalmonto');
		
		//Debugger::dump(round($montototal,2) . ' >= ' .$check['montoparcial']);
		
		
        return (float) round($montototal,2) >= (float) $check['montoparcial'];
    }
	
	public function beforeValidate($options = array()) {
		parent::beforeValidate(); 
	    if (!empty($this->data['Financia']['montoparcial'])) {
	        $this->data['Financia']['montoparcial'] = number_format($this->data['Financia']['montoparcial'], 2, '.', '');
	    }
		
	    return true;
	}
	
}