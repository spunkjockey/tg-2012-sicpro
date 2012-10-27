<?php
    class Depmuni extends AppModel 
    {
		public $name = 'Depmuni';
		public $useTable = 'vi_depmuni';
	
		public $virtualFields = array(
	    	'cantmuni' => 'Depmuni.count(distinct municipio)'
			);

	}