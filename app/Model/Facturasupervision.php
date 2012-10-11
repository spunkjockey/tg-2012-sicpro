<?php
class Facturasupervision extends AppModel {
	public $name = 'Facturasupervision';
	public $useTable = 'facturasupervision';
    public $primaryKey = 'idfacturasupervision';
	
	public $virtualFields = array(
		'facturacion' => "to_char(fechafactura, 'DD/MM/YYYY')"
	);
}