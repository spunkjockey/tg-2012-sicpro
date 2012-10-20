<?php
    class Contratoconstructor extends AppModel {
        public $name = 'Contratoconstructor';
		public $useTable = 'contratoconstructor';
		public $primaryKey = 'idcontrato';
		
		public $belongsTo = array(
			'Empresa'=> array(
				'className'    => 'Empresa',
				'foreignKey'   => 'idempresa'
				),
			'Persona'=> array(
				'className'    => 'Persona',
				'foreignKey'   => 'idpersona'
				),
			'Proyecto' => array(
				'className'    => 'Proyecto',
				'foreignKey'   => 'idproyecto'
				)
			);
		
		public $hasMany= array(
			'Nombramiento'=>array(
				'className'=> 'Nombramiento',
				'foreignKey'=>'idcontrato'
				)
		);
		
		public $validate = array(
			'codigocontrato' => array(
				'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Este código de contrato ya existe'
					))
			);
			
	public $virtualFields = array(
		'montototal' => "montooriginal + variacion"
	);
		
}	
	
	
