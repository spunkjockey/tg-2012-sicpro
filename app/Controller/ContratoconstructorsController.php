<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session');
	    public $components = array('Session');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			$this->set('proys',$this->Proyecto->find('list', array(
												 'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
												 'conditions'=>array('Proyecto.estadoproyecto' => 'Licitacion'))));
			$this->set('empresas',$this->Empresa->find('list',array(
												 'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa'))));
			
			$this->set('admincon',$this->Persona->find('list',array(
												 'fields' => array('Persona.idpersona', 'Persona.nombrespersona'))));
			
			$adm = $this->Persona->query("SELECT idpersona, (nombrespersona||' '||apellidospersona) AS nomcompleto FROM sicpro2012.persona;");
			$this->set('admincon', Set::combine($adm, "{n}.0.idpersona","{n}.0.nomcompleto"));
			
			
		}
		
	}
?>