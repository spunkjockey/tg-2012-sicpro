<?php
    class Fuentefinanciamiento extends AppModel {
        public $name = 'Fuentefinanciamiento';
		public $useTable = 'fuentefinanciamiento';
		public $primaryKey = 'idfuentefinanciamiento';
		
		 public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
        'Tipofuente' => array(
            'className'    => 'Tipofuente',
            'foreignKey'   => 'idtipofuente'
        )
    );
	

	public $validate = array(
	    'nombrefuente' => array(
	        'isUnique' => array(
	            'rule'    => 'isUnique',
	            'required' => true,
	            'allowEmpty' => false,
	            'message' => 'El nombre de la fuente ya existe')
	        ),
	    'montoinicial' => array(
	    	'regla1' => array(
		        'rule'    => 'notEmpty',
		        'message' => 'Debe ingresa el Monto Inicial'
		    	)
			)
		  
		
		
	);
}