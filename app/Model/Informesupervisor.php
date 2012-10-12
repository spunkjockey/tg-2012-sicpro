<?php
    class Informesupervisor extends AppModel
    {
    	public $name = 'Informesupervisor';
		public $useTable = 'informesupervision';
		public $primaryKey = 'idinformesupervision';
    	
		public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
	        'Contratosupervisor' => array(
	            'className'    => 'Contratosupervisor',
	            'foreignKey'   => 'idcontrato'
	        )
	    );
		
		public $hasOne = array(
	        'Facturasupervision' => array(
	            'className' => 'Facturasupervision',
	            'foreignKey' => 'idinformesupervision',
	            //'conditions'   => array('Profile.published' => '1'),
	            'dependent'    => true
			)
	    );
	


    }
