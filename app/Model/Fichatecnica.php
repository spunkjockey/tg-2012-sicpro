<?php
class Fichatecnica extends AppModel {
	public $name = 'Fichatecnica';
	public $useTable = 'fichatecnica';
	public $primaryKey = 'idfichatecnica';
	public $recursive =2;
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
	
	public $validate = array(
		    'fechainicio' => array(
		        'formatofecha'=>array(
						'rule'       => array('date', 'dmy'),
				        'message'    => 'Ingrese fecha de inicio con el siguiente formato DD/MM/AAAA.',
				        'allowEmpty' => true,
						'required'=>false
						)
				),
			'fechafin' => array(
				'formatofecha'=>array(
						'rule'       => array('date', 'dmy'),
				        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
				        'allowEmpty' => true,
						'required'=>false
						)
					),
			'idproyecto'=>array(
			'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Ya existe ficha para el proyecto seleccionado anteriormente.'
					))
				);
	
	
}