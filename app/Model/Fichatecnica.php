<?php
class Fichatecnica extends AppModel {
	public $name = 'Fichatecnica';
	public $useTable = 'fichatecnica';
	public $primaryKey = 'idfichatecnica';
    public $belongsTo = array(
        'Proyecto' => array(
            'className'    => 'Proyecto',
            'foreignKey'   => 'idproyecto'
        )
    );
	
	public $hasMany	= array(
	'Ubicacion'	=> array(
		'className'	=>	'Ubicacion',
		'foreignKey'	=>	'idfichatecnica',
        'dependent'     => true
	),
	'Componente' => array(
		'className'	=>	'Componente',
		'foreignKey'	=>	'idfichatecnica',
        'dependent'     => true
	)
	);	
}