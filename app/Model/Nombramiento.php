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
	
}