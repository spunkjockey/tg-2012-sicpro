<?php
    class Division extends AppModel {
    	public $name = 'Division';
    	public $useTable = 'division';
		public $primaryKey = 'iddivision';
    
		public $validate = array(
			'divison' => array(
				'isUnique' => array(
		            'rule'    => 'isUnique',
		            'required' => true,
	            	'allowEmpty' => false,
	            	'message' => 'Nombre de división'
	        		),
	        	'soloLetras' => array(
					'rule'    => '/^[a-zA-Z][a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
        			'message' => 'Solo Letras'
					)
				)
			);
	}

?>