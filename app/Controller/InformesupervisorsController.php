<?php
    class InformesupervisorsController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Informesupervisor','Proyecto','Contrato','User','Contratosupervisor');
		
		public function informesupervisor_index()
		{
			$this->layout = 'cyanspark';
			//Falta filtrar en base a la necesidad...
			$this->set('informes',$this->Informesupervisor->find('all',array(
									'fields'=>array('Informesupervisor.idinformesupervision','Informesupervisor.tituloinformesup',
													'Informesupervisor.plazoejecuciondias','Informesupervisor.fechainiciosupervision'),
									'conditions'=>array(),
									'order'=>array()
									)));
		}
		
		/*informesupervisor_registrar()
		 * Esta funcion permitirá registrar un informe de supervision a un usuario bajo el rol de admincon
		 * siemrpe que este sea designado como administrador del contrato en el registro del mismo.
		 * Solo se podrán ingresar informes a los proyectos en estado de ejecución, y
		 * que el estado del contrato sea: atrasado, en marcha, a tiempo*/
		public function informesupervisor_registrar()
		{
			$this->layout = 'cyanspark';
			
		}
		
		function proyectosjson()
		{
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			
			$proyectos = $this->Proyecto->find('all',array(
					'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
					'conditions'=>array( "AND" => array('Proyecto.estadoproyecto' => array('Ejecucion'),
												  array('Proyecto.idproyecto IN (SELECT idproyecto 
												  								FROM sicpro2012.contratoconstructor 
												  								WHERE contratoconstructor.idpersona='.$idpersona.')'))),
					'order'=>array('Proyecto.numeroproyecto')
					));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsonproyecto');
		}
		
		function contratosjson()
		{
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			$contratos = $this->Contratosupervisor->find('all',array(
				'fields' => array('Contratosupervisor.idproyecto','Contratosupervisor.idcontrato', 'Contratosupervisor.codigocontrato'),
				'conditions'=>array('Contratosupervisor.idpersona='.$idpersona),
				'order' => array('Contratosupervisor.codigocontrato')
			));
			
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
		}
		
		
    }
?>