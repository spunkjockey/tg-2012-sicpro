<?php
    class ContratoconstructorsController extends AppController 
    {
	    public $helpers = array('Html', 'Form', 'Session');
	    public $components = array('Session');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona','Contratosupervisor');
	}
?>