<?php
class Facturaestimacion extends AppModel {
	public $name = 'Facturaestimacion';
	public $useTable = 'facturaestimacion';
    public $primaryKey = 'idfacturaestimacion';
	
	public $virtualFields = array(
		'facturacion' => "to_char(fechafactura, 'DD/MM/YYYY')"
	);
	
}