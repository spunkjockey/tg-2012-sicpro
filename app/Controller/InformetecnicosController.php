<?php
    class InformetecnicosController extends AppController{
    	public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
	    public $components = array('Session','RequestHandler','AjaxMultiUpload.Upload');
		public $uses = array('Informetecnico','Contratotecproy','Proyecto','Fichatecnica','Contratoconstructor','User','Observacion','Proyinfotec');
		
	    public function informetecnico_index()
	    {
	    	$this->layout = 'cyanspark';
 			$this->set('informes', $this->Informetecnico->find('all',array(
				'order' => array('Informetecnico.idinformetecnico'),
				'conditions' => array('Informetecnico.idpersona' => $this->Session->read('User.idpersona'))
			)));
	    }
		
		public function contratoinforjson() {
		$contratos = $this->Contratoconstructor->find('all',array(
			'fields' => array('Contratoconstructor.idcontrato', 'Contratoconstructor.codigocontrato'),
			'order' => array('Contratoconstructor.codigocontrato'),
			'conditions' => array("Contratoconstructor.idcontrato IN (SELECT idcontrato FROM sicpro2012.informetecnico)",
								  "Contratoconstructor.estadocontrato IN ('a tiempo','en marcha','atrasado','en pausa')")
		));
		$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
		$this->set('_serialize', 'contratos');
		$this->render('/json/jsondatad');
	}
	    
	    public function informetecnico_registrar()
	    {
	    	$this->layout = 'cyanspark';
			$idpersona = $this->Contratotecproy->field('idpersona',
													   array('username'=>$this->Session->read('User.username')));
			if($this->request->is('post'))
			{
				$this->Informetecnico->set('antecedentes', $this->request->data['Informetecnico']['antecedentes']);
				$this->Informetecnico->set('fechavisita', $this->request->data['Informetecnico']['fechavisita']);
				$this->Informetecnico->set('fechaelaboracion', $this->request->data['Informetecnico']['fechaelaboracion']);
				$this->Informetecnico->set('anotacion', $this->request->data['Informetecnico']['anotaciones']);
				$this->Informetecnico->set('idcontrato', $this->request->data['Informetecnico']['contratos']);
				$this->Informetecnico->set('idpersona',$idpersona);
				$this->Informetecnico->set('userc', $this->Session->read('User.username'));
				if ($this->Informetecnico->save()) 
				{
	            	$this->Session->setFlash('El informe técnico ha sido agregado.','default',array('class'=>'success'));
	            	$this->redirect(array('controller'=>'Informetecnicos', 'action' => 'informetecnico_index'));
        		}
        		
			}
			
				
	    }
		/*contratojson()
		 * Esta función permite extraer los contratos en los cuales destaca un técnico como apoyo 
		 * para actividades de control. Se muestran los contratos que se encuentren atrasados, a tiempo
		 * o en marcha. Así mismo solo se muestran contratos de proyectos cuyo estado es Ejecucion
		 * */
		public function contratojson() 
		{
			$contratos = $this->Contratotecproy->find('all', array(
								'fields'=> array('idcontrato','codigocontrato'),
								'conditions'=>array('AND'=>array(
													'estadocontrato' => array('a tiempo','atrasado','en marcha','en pausa'),
													'estadoproyecto'=>'Ejecucion',
													'username'=>$this->Session->read('User.username')))
										));
										
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratotecproy"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsoncontratotecproy');
		}
		
		function update_infoproy_inftec()
		{
			if (!empty($this->data['Informetecnico']['contratos']))
			{
				$cont_id = $this->request->data['Informetecnico']['contratos'];
				
				$proy_id= $this->Contratoconstructor->field('Contratoconstructor.idproyecto',
							array('Contratoconstructor.idcontrato'=>$cont_id));
				
				$nomproy = $this->Proyecto->field('nombreproyecto',
							array('idproyecto'=>$proy_id));
				$this->set('nombreproy',$nomproy);
				
				$desc = $this->Fichatecnica->field('Fichatecnica.descripcionproyecto',
							array('Fichatecnica.idproyecto'=>$proy_id));
				$this->set('descripcion',$desc);
			}
			$this->render('/Elements/update_infoproy_inftec', 'ajax');
		}

		/*Las siguientes funciones permiten consultar informes técnicos y
		 * registrar observaciones si el usuario se encuentra habilitado para dicha función.
		 * */
		 function informetecnico_consultar()
		 {
		 	$this->layout = 'cyanspark';
			if($this->request->is('post')) {
				$this->redirect(array('action' => 'informetecnico_observacion',$this->request->data['Informetecnico']['fechas']));
			}
				
		 }
		 
		
		function informetecnico_observacion($idinfo=null)
		{
			$this->layout = 'cyanspark';
			$info = $this->Informetecnico->find('first',array(
				'fields'=>array('antecedentes','anotacion'),
				'conditions'=>array('idinformetecnico'=>$idinfo)
				));
			$this->set('info',$info);
			//otras
			$otros = $this->Observacion->find('all',array(
				'fields'=>array('observacioninforme','fechaingresoobservacion','userc',
				'Persona.nombrespersona','Persona.apellidospersona'),
				'conditions'=>array('Observacion.idinformetecnico'=>$idinfo),
				'order'=>'fechaingresoobservacion ASC'
				));
			$this->set('otros',$otros);
			//agregar obs
			$datos = $this->User->find('first',array(
				'fields'=>array('User.idpersona', 'Rol.rol'),
				'conditions'=>array('username'=>$this->Session->read('User.username'))
				));	
			$this->set('datos',$datos);
			$this->set('idinfo',$idinfo);
			
			if($this->request->is('post'))
			{
				$this->Observacion->set('idinformetecnico', $this->request->data['Informetecnico']['idinformetecnico']);
				$this->Observacion->set('idpersona', $this->request->data['Informetecnico']['idpersona']);
				$this->Observacion->set('observacioninforme', $this->request->data['Informetecnico']['observ']);
				$this->Observacion->set('userc', $this->Session->read('User.username'));
				if ($this->Observacion->save()) 
				{
	            	$this->Session->setFlash('Ha agregado una observación al informe.','default',array('class'=>'success'));
	            	$this->redirect(array('controller'=>'Informetecnicos', 'action' => 'informetecnico_consultar'));
        		}
        		else 
        		{
            		$this->Session->setFlash('No se pudo agregar la observación');
        		}
			}
		}
		 
		 /*
		  * proyectojson()
		  * Esta funicón permite cargar los informes de los proyectos que se encuentran
		  * en estado de ejecucion*/
		 function proyectojson() 
		{
			$proyectos = $this->Proyinfotec->find('all', array(
											'fields'=> array('Proyinfotec.idproyecto','Proyinfotec.numeroproyecto')
											));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyinfotec"));
			$this->set('_serialize', 'proyectos');
			$this->render('/json/jsondata');
		}
		
		/*contratosconstructorjson()
		 * Esta funcion permite cargar los contratos de construccion de los proyectos
		 * El listado de contratos se filtra de acuerdo al rol del usuario en uso*/
		function contratosconstructorjson()
		{
			$roluser = $this->User->find('first',array(
				'fields'=>array('User.idpersona', 'Rol.rol'),
				'conditions'=>array('username'=>$this->Session->read('User.username'))
				));
			$contratos = '';
			$rol = $roluser['Rol']['rol'];
			$idpersona = $roluser['User']['idpersona'];
			switch ($rol) {
				case 'Tecproy':
					$contratos = $this->Contratoconstructor->find('all',array(
						'fields'=>array('idproyecto','idcontrato','codigocontrato'),
						'conditions'=>array("AND"=>array(
									'Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado","en pausa"),
									'Contratoconstructor.idcontrato IN 
										(select nombramiento.idcontrato from sicpro2012.nombramiento where idpersona='.$idpersona.')')),
						'order'=>'codigocontrato'
						));
					break;
				case 'Director':
				case 'Adminproy':
					$contratos = $this->Contratoconstructor->find('all',array(
						'fields'=>array('idproyecto','idcontrato','codigocontrato'),
						'conditions'=>array('Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado","en pausa")),
						'order'=>'codigocontrato'
						));
					break;
				case 'Admincon':
					$contratos = $this->Contratoconstructor->find('all',array(
						'fields'=>array('idproyecto','idcontrato','codigocontrato'),
						'conditions'=>array("AND"=>array(
											'Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado","en pausa"),
											'Contratoconstructor.idpersona'=>$idpersona)),
						'order'=>'codigocontrato'
						));
					break;
				default:
					break;
			}
			$this->set('contratos', Hash::extract($contratos, "{n}.Contratoconstructor"));
			$this->set('_serialize', 'contratos');
			$this->render('/json/jsondatad');
		}
		
		/*
		 * fechasvisitasjson()
		 * Esta función permite cargar las fechas de visita correspondiente al informe*/
		function fechasvisitasjson()
		{
			$fechas = $this->Informetecnico->find('all',array(
				'fields'=>array('idcontrato','idinformetecnico',"fechav"),
				'order'=>'fechavisita'
				));
			$this->set('fechas', Hash::extract($fechas, "{n}.Informetecnico"));
			$this->set('_serialize', 'fechas');
			$this->render('/json/jsonfechas');
		}
		
		function informetecnico_modificar($id=null)
		{
			$this->layout = 'cyanspark';
			$info=$this->Informetecnico->findByIdinformetecnico($id);
			$this->set('info',$info);
			$this->Informetecnico->id = $id;
			if ($this->request->is('get')) 
			{
			   	$this->request->data=$this->Informetecnico->read();
			} 
			else 
			{
				$this->Informetecnico->set('idcontrato', $info['Contratoconstructor']['idcontrato']);
				$this->Informetecnico->set('idinformetecnico', $this->request->data['Informetecnico'] ['idinformetecnico']);
				$this->Informetecnico->set('fechavisita', $this->request->data['Informetecnico'] ['fechavisita']);
				$this->Informetecnico->set('fechaelaboracion', $this->request->data['Informetecnico'] ['fechaelaboracion']);
				$this->Informetecnico->set('antecedentes', $this->request->data['Informetecnico'] ['antecedentes']);
				$this->Informetecnico->set('anotacion', $this->request->data['Informetecnico'] ['anotacion']);
				$this->Informetecnico->set('userm', $this->Session->read('User.username'));
				$this->Informetecnico->set('modificacion', date('Y-m-d h:i:s')); 
				if ($this->Informetecnico->save($id)) 
				{
		            $this->Session->setFlash('El informe tecnico ha sido actualizada.', 'default', array('class'=>'success'));
		            $this->redirect(array('action' => 'informetecnico_index'));
	        	} 
			}
		}

		function informetecnico_subirfotos($id=null)
		{
			$this->layout = 'cyanspark';
        	$this->set ('idinformetecnico', $id); 
		}

		function informetecnico_eliminar($id) {
			if (!$this->request->is('post')) {
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Informetecnico->delete($id)) {
		        $this->Session->setFlash('El informe técnico ha sido eliminada.','default', array('class'=>'success'));
		        $this->redirect(array('action' => 'informetecnico_index'));
		    } else {
		    	$this->Session->setFlash('No se puede eliminar la informe seleccionado');
		        $this->redirect(array('action' => 'informetecnico_index'));
		    }
		}
		
	}
?>