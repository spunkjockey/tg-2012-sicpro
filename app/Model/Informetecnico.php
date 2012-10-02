<?php
    class Informetecnico extends AppModel
    {
    	public $name = 'Informetecnico';
		public $useTable = 'informetecnico';
	    public $primaryKey = 'idinformetecnico';
		public $belongsTo = array(
	        'Contratoconstructor' => array(
	            'className'    => 'Contratoconstructor',
	            'foreignKey'   => 'idcontrato'
	        ),
	        'Persona'=> array(
				'className' => 'Persona',
				'foreignKey' => 'idpersona'
			)
	    );
    	
    }
?>