<?php
    class Proyembe extends AppModel 
    {
		public $name = 'Proyembe';
		public $useTable = 'vi_proy_emp_bene';
	
		public $validate = array(
		    'fechainicio' => array(
		        'formatofecha'=>array(
						'rule'       => array('date', 'ymd'),
				        'message'    => 'Ingrese fecha de inicio con el siguiente formato DD/MM/AAAA.',
				        'allowEmpty' => true,
						'required'=>false
						)
				),
			'fechafin' => array(
				'formatofecha'=>array(
						'rule'       => array('date', 'ymd'),
				        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
				        'allowEmpty' => true,
						'required'=>false
						)
					)
				);
		
		
		
		
		
	}
?>