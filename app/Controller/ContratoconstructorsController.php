<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session');
	    public $components = array('Session');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			
		}
		
	}
?>