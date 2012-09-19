<?php
class Componente extends AppModel {
public $useTable = 'componente';
public $primaryKey = 'idcomponente';


public $hasMany	= array(
	'Meta'	=> array(
		'className'	=>	'Meta',
		'foreignKey'	=>	'idcomponente',
        'dependent'     => true
	)
);

}
