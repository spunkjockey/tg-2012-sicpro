<?php

class Proyecto extends AppModel {
        public $name = 'Proyecto';
		public $useTable = 'proyecto';
		public $primaryKey = 'idproyecto';
		public $belongsTo = array(
			'Division' => array(
				'className'    => 'Division',
				'foreignKey'   => 'iddivision'
			)
		);
		public $validate = array(
			'nombreproyecto' => array(
				'alphaNumeric' => array(
					'required'	=> true,
					'message'	=> 'Alphabets and numbers only'
					),
			
			)
		);
}

?>