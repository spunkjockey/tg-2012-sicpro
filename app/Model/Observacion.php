<?php
    class Observacion extends AppModel
    {
		public $name = 'Observacion';
		public $useTable = 'observacion';
	    public $primaryKey = 'idobservacion';
		
		public $belongsTo = array(
			'Informetecnico' => array(
				'className'    => 'informetecnico',
				'foreignKey'   => 'idinformetecnico'
			),
			'Persona'=>array(
				'className'    => 'persona',
				'foreignKey'   => 'idpersona'
				)
		);
	}
?>