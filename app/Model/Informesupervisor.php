<?php
    class Informesupervisor extends AppModel
    {
    	public $name = 'Informesupervisor';
		public $useTable = 'informesupervision';
		public $primaryKey = 'idinformesupervision';
    	
		public $hasOne = array(
	        'Facturasupervision' => array(
	            'className' => 'Facturasupervision',
	            'foreignKey' => 'idinformesupervision',
	            //'conditions'   => array('Profile.published' => '1'),
	            'dependent'    => true
			)
	    );
	


    }
