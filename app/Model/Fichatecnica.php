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
	
}