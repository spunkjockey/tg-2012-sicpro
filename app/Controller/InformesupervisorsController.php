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
													'Informesupervisor.fechafinsupervision','Informesupervisor.fechainiciosupervision'),
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
			
			if ($this->request->is('post'))
			{
				$this->Informesupervisor->set('idcontrato',$this->request->data['Informesupervisor']['contratos']);
				$this->Informesupervisor->set('tituloinformesup',$this->request->data['Informesupervisor']['tituloinforme']);
				$this->Informesupervisor->set('fechainiciosupervision',$this->request->data['Informesupervisor']['fechainicio']);
				$this->Informesupervisor->set('fechafinsupervision',$this->request->data['Informesupervisor']['fechafin']);
				$this->Informesupervisor->set('plazoejecuciondias',$this->request->data['Informesupervisor']['plazoejecucion']);
				$this->Informesupervisor->set('valoravancefinanciero',$this->request->data['Informesupervisor']['avfinanciero']);
				$this->Informesupervisor->set('porcentajeavancefisico',$this->request->data['Informesupervisor']['avfisico']);
				$this->Informesupervisor->set('userc',$this->Session->read('User.username'));
				if ($this->Informesupervisor->save()) 
				{
					$this->Session->setFlash('El informe '. $this->request->data['Informesupervisor']['tituloinforme'].' ha sido registrado',
											 'default',array('class'=>'success'));
	                $this->redirect(array('action' => 'informesupervisor_index'));
	            }
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error');
	            }
			}
		}
		
		/*proyectosjson()
		 * Esta funcion permite extraer el listado de proyectos en los cuales interactua
		 * el usuario como administrador de algún contrato de supervisión
		 * */
		function proyectosjson()
		{
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			
			$proyectos = $this->Proyecto->find('all',array(
					'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
					'conditions'=>array( "AND" => array('Proyecto.estadoproyecto' => array('Ejecucion'),
												  array('Proyecto.idproyecto IN (SELECT idproyecto 
												  								FROM sicpro2012.contratosupervisor 
												  								WHERE contratosupervisor.idpersona='.$idpersona.')'))),
					'order'=>array('Proyecto.numeroproyecto')
					));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsonproyecto');
		}
		function update_nomproyecto()
		{
			if (!empty($this->data['Informesupervisor']['proyectos']))
				{	
					$proy_id = $this->request->data['Informesupervisor']['proyectos'];
					$info = $this->Proyecto->find('first',array(
								'fields'=>array('Proyecto.nombreproyecto'),
								'conditions'=>array('Proyecto.idproyecto'=>$proy_id)));
					$this->set('info',$info);
				}
				$this->render('/Elements/update_nomproyecto', 'ajax');
		}
		
		/*contratosjson()
		 * Esta funcion permite extraer los contratos de supervision de los cuales
		 * el usuario es administrador
		 * */
		function contratosjson()
		{
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			$contratos = $this->Contratosupervisor->find('all',array(
				'fields' => array('Contratosupervisor.idproyecto','Contratosupervisor.idcontrato', 'Contratosupervisor.codigocontrato'),
				'conditions'=>array('Contratosupervisor.idpersona='.$idpersona),
				'order' => array('Contratosupervisor.codigocontrato')
			));
			
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratosupervisor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
		}
		
		function update_infocontrato()
		{
			if (!empty($this->data['Informesupervisor']['contratos']))
			{	
				$cont_id = $this->request->data['Informesupervisor']['contratos'];
				$info = $this->Contratosupervisor->find('first',array(
							'fields'=>array('Contratosupervisor.nombrecontrato','Contratosupervisor.plazoejecucion',
											'Contratosupervisor.ordeninicio'),
							'conditions'=>array('Contratosupervisor.idcontrato'=>$cont_id)));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_nomcontrato', 'ajax');	
		}
		
		
    }
?>