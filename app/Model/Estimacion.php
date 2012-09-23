<?php
    class Estimacion extends AppModel {
        public $name = 'Estimacion';
		public $useTable = 'estimacion';
		public $primaryKey = 'idestimacion';
		
		 public $belongsTo = array(  /*Relacion con las dos tablas Fuente financiamiento y tipo fuente*/
        'Contratoconstructor' => array(
            'className'    => 'Contratoconstructor',
            'foreignKey'   => 'idcontrato'
        )
    );
}