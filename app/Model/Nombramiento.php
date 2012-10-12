<?php
class Nombramiento extends AppModel {
	public $name = 'Nombramiento';
	public $useTable = 'nombramiento';
	public $primaryKey = 'idnombramiento';
	
	
	public $belongsTo = array(
   		'Persona' => array(
        	'className'    => 'Persona',
            'foreignKey'   => 'idpersona'
        ),
        'Contrato' => array(
        	'className'    => 'Contrato',
            'foreignKey'   => 'idcontrato'
        )
    );
	
	
	
	public $validate = array(
		'idpersona' => array(
			'llave' => array(
            	'rule'    => array('verydispo'),
            	'message' => 'El Tecnico ya fue seleccionado para ese contrato'
        	)
		)
	);
	
	public function verydispo($check) {
		//Debugger::dump($this->data);
        $cantidad = $this->find('count', array(
            'conditions' => array('Nombramiento.idcontrato ' => $this->data['Nombramiento']['idcontrato'],
            'Nombramiento.idpersona' => $this->data['Nombramiento']['idpersona'])   
			
        ));
        return $cantidad == 0;
    }
	
}