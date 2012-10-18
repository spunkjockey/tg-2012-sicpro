<?php
class Meta extends AppModel {
public $useTable = 'meta';
public $primaryKey = 'idmeta';

public $belongsTo = array(
			'Componente' => array(
				'className'    => 'Componente',
				'foreignKey'   => 'idcomponente'
			)
		); 
}
