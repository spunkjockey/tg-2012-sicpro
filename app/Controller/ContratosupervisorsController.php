<?php
    class ContratosupervisorsController extends AppController 
    {
	    public $helpers = array('Html', 'Form', 'Session');
	    public $components = array('Session');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona','Contratosupervisor');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			
			//Recuperamos catalogos
			//Empresa
			$this->set('empresas',$this->Empresa->find('list',array(
										'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa'))));
			//Personas									 
			$adm = $this->Persona->query("SELECT personas.idpersona, (nombrespersona||' '||apellidospersona) AS nomcompleto FROM sicpro2012.persona AS personas;");
			$this->set('administradores', Set::combine($adm, "{n}.0.idpersona","{n}.0.nomcompleto"));
			
			//Recuperamos proyectos
			$this->set('proys',$this->Proyecto->find('list', array(
										'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
										'conditions'=>array( "OR" => array('Proyecto.estadoproyecto' => array('Licitacion','Adjudicacion'))),
										 'order' => array('Proyecto.nombreproyecto'))));
			//id del primer proyecto									 
			$primerproy = $this->Proyecto->find("first",array(
										'fields' => array('Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
										'conditions'=>array( "OR" => array('Proyecto.estadoproyecto' => array('Licitacion','Adjudicacion'))),
										'order' => array('Proyecto.nombreproyecto')));
			
			$this->set('contratos',$this->Contratoconstructor->find('list',array(
										'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
										'conditions'=>array(('Contratoconstructor.con_idcontrato is null'),
														   ('Contratoconstructor.idproyecto='.$primerproy['Proyecto']['idproyecto']))
										)));
			
			
			
		}

		public function sselect_update()
		{
			if (!empty($this->data['Contratosupervisor']['proys']))
                {
                        $proy_id = $this->data['Contratosupervisor']['proys'];
                        $contratos= $this->Contratoconstructor->find('all', array(
	                        			'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
										'conditions'=>array(('Contratoconstructor.con_idcontrato is null'),
														   ('Contratoconstructor.idproyecto='.$proy_id['Proyecto']['idproyecto']))));
                }
                $this->set('options', Set::combine($contratos, "{n}.Contratoconstructor.idcontrato","{n}.Contratoconstructor.codigocontrato"));
                $this->render('/elements/update_select', 'ajax');
		}
	}
?>