<?php
    class InformetecnicosController extends AppController{
    	public $helpers = array('Html', 'Form', 'Session','Ajax');
	    public $components = array('Session','RequestHandler');
		public $uses = array('Informetecnico','Contratotecproy','Proyecto','Fichatecnica','Contratoconstructor','User','Observacion');
		
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
	            	$this->redirect(array('controller'=>'mains', 'action' => 'index'));
        		}
        		else 
        		{
            		$this->Session->setFlash('No se pudo realizar el registro');
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
				$proy_id = $this->Contratoconstructor->find('first',array(
							'fields'=>array('Contratoconstructor.idproyecto'),
							'conditions'=>array('Contratoconstructor.idcontrato'=>$cont_id)));
							
				$info = $this->Fichatecnica->find('first',array(
							'fields'=>array('Proyecto.nombreproyecto','Fichatecnica.descripcionproyecto'),
							'conditions'=>array('Proyecto.idproyecto'=>$proy_id['Contratoconstructor']['idproyecto'])));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_infoproy_inftec', 'ajax');
		}

		/*Las siguientes funciones permiten consultar informes técnicos y
		 * registrar observaciones si el usuario se encuentra habilitado para dicha función.
		 * */
		 function informetecnico_observaciones()
		 {
		 	$this->layout = 'cyanspark';
			if($this->request->is('post'))
			{
				$this->Observacion->set('idinformetecnico', $this->request->data['Informetecnico']['fechas']);
				$this->Observacion->set('idpersona', $this->request->data['Informetecnico']['idpersona']);
				$this->Observacion->set('observacioninforme', $this->request->data['Informetecnico']['observ']);
				$this->Observacion->set('userc', $this->Session->read('User.username'));
				if ($this->Observacion->save()) 
				{
	            	$this->Session->setFlash('Ha agregado una observación al informe.','default',array('class'=>'success'));
	            	$this->redirect(array('controller'=>'Informetecnicos', 'action' => 'informetecnico_observaciones'));
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
			$proyectos = $this->Proyecto->find('all', array(
											'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
											'conditions'=>array('Proyecto.estadoproyecto' => 'Ejecucion')));
			$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
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
									'Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado"),
									'Contratoconstructor.idcontrato IN 
										(select nombramiento.idcontrato from sicpro2012.nombramiento where idpersona='.$idpersona.')')),
						'order'=>'codigocontrato'
						));
					break;
				case 'Director':
				case 'Adminproy':
					$contratos = $this->Contratoconstructor->find('all',array(
						'fields'=>array('idproyecto','idcontrato','codigocontrato'),
						'conditions'=>array('Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado")),
						'order'=>'codigocontrato'
						));
					break;
				case 'Admincon':
					$contratos = $this->Contratoconstructor->find('all',array(
						'fields'=>array('idproyecto','idcontrato','codigocontrato'),
						'conditions'=>array("AND"=>array(
											'Contratoconstructor.estadocontrato'=>array("en marcha","a tiempo","atrasado"),
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
		
		/*
		 * update_datainfotec()
		 * Esta funcion permite cargar la informacion de un informe tecnico en especifico*/
		function update_datainfotec()
		{
			if (!empty($this->data['Informetecnico']['fechas']))
			{
				$inf_id = $this->request->data['Informetecnico']['fechas'];
				$info = $this->Informetecnico->find('first',array(
					'fields'=>array('antecedentes','anotacion'),
					'conditions'=>array('idinformetecnico'=>$inf_id)
					));
				$this->set('info',$info);
			}
			$this->render('/Elements/update_datainfotec', 'ajax');
		}
		
		function otras_observaciones() 
		{
			if (!empty($this->data['Informetecnico']['fechas']))
			{
				$inf_id = $this->request->data['Informetecnico']['fechas'];
				$otros = $this->Observacion->find('all',array(
					'fields'=>array('observacioninforme','fechaingresoobservacion','userc',
					'Persona.nombrespersona','Persona.apellidospersona'),
					'conditions'=>array('Observacion.idinformetecnico'=>$inf_id),
					'order'=>'fechaingresoobservacion ASC'
					));
				$this->set('otros',$otros);
			}
			$this->render('/Elements/otras_observaciones', 'ajax');
		}
		
		/*
		 * agregar_observaciones()
		 * Carga el formulario para el ingreso de observaciones, o muestra un mensaje que no puede realizar esta función*/
		function agregar_observaciones()
		{
			if (!empty($this->data['Informetecnico']['fechas']))
			{
				$datos = $this->User->find('first',array(
					'fields'=>array('User.idpersona', 'Rol.rol'),
					'conditions'=>array('username'=>$this->Session->read('User.username'))
					));	
				$this->set('datos',$datos);
			}
			$this->render('/Elements/agregar_observaciones', 'ajax');
		}
		
	}
?>