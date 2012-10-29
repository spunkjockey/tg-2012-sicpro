<?php
    class InformesupervisorsController extends AppController
    {
    	public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
	    public $components = array('Session','RequestHandler','AjaxMultiUpload.Upload');
		public $uses = array('Informesupervisor','Proyecto','Contrato','User','Contratosupervisor','Avancedisponible','Avancetodos','Proyinforsup');
		
		public function informesupervisor_index()
		{
			$this->layout = 'cyanspark';
			//Falta filtrar en base a la necesidad...
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			$this->set('informes',$this->Informesupervisor->find('all',array(
						'conditions'=>array(
							'Contratosupervisor.idpersona'=>$idpersona),
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
				$this->Informesupervisor->set('fechafinsupervision',$this->request->data['Informesupervisor']['fechas']);
				$this->Informesupervisor->set('plazoejecuciondias',$this->request->data['Informesupervisor']['plazoejecucion']);
				$this->Informesupervisor->set('valoravancefinanciero',$this->request->data['Informesupervisor']['valoravancefinanciero']);
				$this->Informesupervisor->set('porcentajeavancefisico',$this->request->data['Informesupervisor']['avfisico']);
				$this->Informesupervisor->set('userc',$this->Session->read('User.username'));
				if ($this->Informesupervisor->save()) 
				{
					$this->Session->setFlash('El informe "'. $this->request->data['Informesupervisor']['tituloinforme'].'" ha sido registrado',
											 'default',array('class'=>'success'));
	                $this->redirect(array('action' => 'informesupervisor_index'));
	            }
				else 
				{
					//$this->Session->setFlash('Ha ocurrido un error');
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
					'conditions'=>array( "AND" => array('Proyecto.estadoproyecto' => array('Ejecucion')),
												  array('Proyecto.idproyecto IN (SELECT idproyecto 
												  								FROM sicpro2012.contratosupervisor 
												  								WHERE contratosupervisor.idpersona='.$idpersona.')')),
					'order'=>array('Proyecto.numeroproyecto')
					));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsonproyecto');
		}

		/*update_nomproyecto()
		 * Recupera el nombre del proyecto seleccionado*/
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
		/*update_infocontrato()
		 * Recupera información del contrato de supervision
		 * */
		function update_infocontrato()
		{
			if (!empty($this->data['Informesupervisor']['contratos']))
			{	
				$cont_id = $this->request->data['Informesupervisor']['contratos'];
				$info = $this->Contratosupervisor->find('first',array(
							'fields'=>array('Contratosupervisor.nombrecontrato','Contratosupervisor.plazoejecucion',
											'Contratosupervisor.ordeninicio','Contratosupervisor.con_idcontrato'),
							'conditions'=>array('Contratosupervisor.idcontrato'=>$cont_id)));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_nomcontrato', 'ajax');	
		}
		
		function fechasjson()
		{
			
			$fechas = $this->Avancedisponible->find('all',array(
				'fields'=>array('Avancedisponible.idcontrato','Avancedisponible.fechaavance','Avancedisponible.fechafin'),
				
				'order'=>array('Avancedisponible.fechaavance')
				));
			$this->set('fechas', Hash::extract($fechas, "{n}.Avancedisponible"));
			$this->set('_serialize', 'fechas');
			$this->render('/json/jsonfechas');
			
		}
		
		/*informesupervisor_cargar_archivo($id=null)
		 * Permite agregar archivos sobre el informe de supervision*/
		function informesupervisor_cargar_archivo($id=null)
		{
			$this->layout = 'cyanspark';
        	$this->set('idinformesupervision', $id);
		}
		
		/*informesupervisor_modificar($id=null)
		 * Permite modificar un informe de supervision existente
		 * */
		function informesupervisor_modificar($id=null)
		{
			$this->layout = 'cyanspark';
			$this->Informesupervisor->id = $id;
			
										
			if ($this->request->is('get')) 
			{
					
				//Debugger::dump($id);
				$this->request->data=$this->Informesupervisor->read();
				$contratoid = $this->Informesupervisor->field('idcontrato',array('idinformesupervision'=>$id));
				$this->set('fechas',$this->Avancetodos->find('list',array(
						'fields'=>array('Avancetodos.fechaavance','Avancetodos.fechafin'),
						'conditions'=>array('Avancetodos.idcontrato'=>$contratoid),
						'order'=>array('Avancetodos.fechaavance')
						)));
				//Debugger::dump($contratoid);
				
			}
			else 
			{
				$this->Informesupervisor->set('tituloinformesup',$this->request->data['Informesupervisor']['tituloinformesup']);
				$this->Informesupervisor->set('fechafinsupervision',$this->request->data['Informesupervisor']['fechas']);
				$this->Informesupervisor->set('plazoejecuciondias',$this->request->data['Informesupervisor']['plazoejecuciondias']);
				$this->Informesupervisor->set('valoravancefinanciero',$this->request->data['Informesupervisor']['valoravancefinanciero']);
				$this->Informesupervisor->set('porcentajeavancefisico',$this->request->data['Informesupervisor']['porcentajeavancefisico']);
				$this->Informesupervisor->set('userm',$this->Session->read('User.username'));
				$this->Informesupervisor->set('modificacion', date('Y-m-d h:i:s'));
				if ($this->Informesupervisor->save()) 
				{
		            $this->Session->setFlash('El informe "'.$this->request->data['Informesupervisor']['tituloinformesup'].'" ha sido actualizado.', 
		            						 'default', array('class'=>'success'));
		            $this->redirect(array('action' => 'informesupervisor_index'));
	        	} 
	        	else 
	        	{
		           	$this->Session->setFlash('Ha ocurrido un error');
				
					
        		} 
			}
		}
		
		/*informesupervisor_eliminar($id=null)
		 * Esta funcion permite eliminar un informe de supervision*/
		function informesupervisor_eliminar($id=null)
		{
			$informesupervisor = $this->Informesupervisor->find('first',array(
									'fields'=>array('Informesupervisor.tituloinformesup'),
									'conditions'=>array('Informesupervisor.idinformesupervision'=>$id)));
			if (!$this->request->is('post')) 
			{
	        	throw new MethodNotAllowedException();
	    	}
		    if ($this->Informesupervisor->delete($id)) 
		    {
		        $this->Session->setFlash('El informe "'.$informesupervisor['Informesupervisor']['tituloinformesup'] .'" ha sido eliminado.',
		        						 'default', array('class'=>'success'));
		        $this->redirect(array('action' => 'informesupervisor_index'));
		 	} else {
	    		$this->Session->setFlash('No se puede eliminar el Informe de Supervisión seleccionado, se han encontrado referencias');
	        	$this->redirect(array('action' => 'informesupervisor_index'));
	    	}
		}
		
		
		function contratosinfjson()
		{
			$idpersona = $this->User->field('idpersona',array('username'=>$this->Session->read('User.username')));
			$contratos = $this->Informesupervisor->find('all',array(
				'fields' => array('DISTINCT Contratosupervisor.idproyecto','Contratosupervisor.idcontrato', 'Contratosupervisor.codigocontrato'),
				'conditions'=>array('Contratosupervisor.idpersona='.$idpersona),
				'order' => array('Contratosupervisor.codigocontrato')
			));
			
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratosupervisor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
		}
		
		public function informesupervisor_consultar(){
			$this->layout = 'cyanspark';
		} 
		
		public function informesupervisor_resultado(){
			$this->layout = 'cyanspark';
		}

		function proyinforsup(){
			// hacer consulta con vi_proyinforsup
			$proyectos = $this->Proyinforsup->find('all');
			$this->set('proyectos',$proyectos);
			$this->set('_serialize', 'proyectos');
			$this->render('/json/proyinforsup');
		}
		
    }
?>