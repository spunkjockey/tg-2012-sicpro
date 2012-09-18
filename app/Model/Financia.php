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
			'decimal' => array(
				'rule' => array('decimal', 2),
				'required'=> true,
				'allowEmpty' => false,
				'message' => 'Solo son permitidos números'
			),
			'mayorquepermitido' => array(
            	'rule'    => array('limitarMonto'),
            	'message' => 'El valor sobrepasa el monto disponible'
        	)
		)
	);
	
	public function limitarMonto($check) {
		
        $monto_disponible = $this->find('first', array(
            'fields' => 'Fuentefinanciamiento.montodisponible',
            'conditions' => array('Fuentefinanciamiento.idfuentefinanciamiento ' => $this->data['Financia']['idfuentefinanciamiento'])   
			
        ));
        return $monto_disponible['Fuentefinanciamiento']['montodisponible'] >= $check['montoparcial'];
    }
	
	public function beforeValidate($options = array()) {
		parent::beforeValidate(); 
	    if (!empty($this->data['Financia']['montoparcial'])) {
	        $this->data['Financia']['montoparcial'] = number_format($this->data['Financia']['montoparcial'], 2, '.', '');
	    }
	    return true;
	}
	
}