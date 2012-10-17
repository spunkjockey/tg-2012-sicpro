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
		'fechadisponible' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese fecha bajo el siguiente formato DD/MM/AAAA.',
		        'required'=>true) 
		 
		);
	
}