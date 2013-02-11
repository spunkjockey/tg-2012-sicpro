<?php 

App::uses('CakeEmail', 'Network/Email');

class ProyectosController extends AppController {
    public $name = 'Proyectos';
    public $components = array('Session','RequestHandler','Email');
	public $uses = array('Proyecto','Division','User','Contrato','Financia','Contratoconstructor','Proyembe','CakeEmail','Network/Email','Persona','User');
	public $helpers = array('Html', 'Form', 'Session','Ajax', 'Javascript');
	
	
	public function proyecto_registrar() {
        $this->layout = 'cyanspark';
		$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
		if ($this->request->is('post')) 
			{
                $this->Proyecto->set('nombreproyecto', $this->request->data['Proyecto']['nombreproyecto']);
				$this->Proyecto->set('iddivision', $this->request->data['Proyecto']['divisiones']);
				$this->Proyecto->set('montoplaneado', $this->request->data['Proyecto']['montoplaneado']);
				$this->Proyecto->set('userc', $this->Session->read('User.username'));
				$this->Proyecto->set('estadoproyecto', 'Formulacion');
			if ($this->Proyecto->save()) {
					$this->Session->setFlash('El proyecto "'. $this->request->data['Proyecto']['nombreproyecto'].'" ha sido registrado',
											 'default',array('class'=>'success'));
					
					//Notificacion con envio de correo. Nuevo proyecto registrado se notifica el Director
					$mensaje = 'El proyecto "'. $this->request->data['Proyecto']['nombreproyecto'].'" ha sido registrado con un monto de $'.$this->request->data['Proyecto']['montoplaneado'];

					$to=Hash::extract($this->Persona->User->query('SELECT
					persona.idpersona,
					persona.correoelectronico
					FROM
					sicpro2012.users,
					sicpro2012.persona
					WHERE
					persona.idpersona = users.idpersona AND
					users.idrol = 1 AND
					users.estado = true;'),'{n}.0');					
				
					$subject = 'Notificacion SICPRO';
					foreach ($to as $key => $value) {
						$this->enviar_correo($to[$key]['correoelectronico'],$subject,$mensaje);
					}

	                $this->redirect(array('action' => 'proyecto_listado'));
	            }
				else {
				
					//$this->Session->setFlash('Ha ocurrido un error');
	                         }
        }
    }
	
	public function proyecto_listado()
	{
		$this->layout = 'cyanspark';
		$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
		$this->set('proyectos', $this->Proyecto->find('all', array(
									'fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto','Proyecto.nombreproyecto',
													'Proyecto.estadoproyecto','Proyecto.montoplaneado','Fichatecnica.idfichatecnica'),
									'order'=> array('Proyecto.numeroproyecto DESC'))));
	}
	
	function proyecto_detalles($id = null)
	{
		$this->layout = 'cyanspark';
		$this->Proyecto->id = $id;
		if (!$this->Proyecto->read()) 
		{
        	throw new NotFoundException('No se puedo encontrar el proyecto', 404);
    	} 
    	else 
    	{
			$this->set('proyectos', $this->Proyecto->read());
		}
	}
	
	public function proyecto_modificar($id=null)
	{
		$this->layout = 'cyanspark';
		$this->Proyecto->id = $id;
		$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
		if ($this->request->is('post')) 
		{
			$this->Proyecto->set('nombreproyecto', $this->request->data['Proyecto']['nombreproyecto']);
			$this->Proyecto->set('iddivision', $this->request->data['Proyecto']['divisiones']);
			$this->Proyecto->set('idproyecto',$this->request->data['Proyecto']['idproyecto']);
			$this->Proyecto->set('montoplaneado', $this->request->data['Proyecto']['montoplaneado']);
			$this->Proyecto->set('userm', $this->Session->read('User.username'));
			$this->Proyecto->set('modificacion', date('Y-m-d h:i:s'));
			if ($this->Proyecto->save())
			{
				$this->Session->setFlash('El Proyecto "'. $this->request->data['Proyecto']['nombreproyecto'].'" ha sido actualizado.',
										 'default',array('class'=>'success'));
				$this->redirect(array('action' => 'proyecto_listado'));
			}
			else 
			{
				//$this->Session->setFlash('Imposible editar proyecto');
			}
		}
		else
		{
			$this->data = $this->Proyecto->read();
		}
			
	}
	
	function proyecto_eliminar($id=null) 
		{
		    $proy = $this->Proyecto->find('first',array(
									'fields'=>array('Proyecto.nombreproyecto'),
									'conditions'=>array('Proyecto.idproyecto'=>$id)));
		    if (!$this->request->is('post')) 
		    {
		        throw new MethodNotAllowedException();
		    }
		    if ($this->Proyecto->delete($id)) 
		    {
		        $this->Session->setFlash('El proyecto "'.$proy['Proyecto']['nombreproyecto'].'" ha sido eliminado'
		        						,'default',array('class'=>'success'));
		        $this->redirect(array('action' => 'proyecto_listado'));
		    } else {
		    	$this->Session->setFlash('El proyecto "'.$proy['Proyecto']['nombreproyecto'].'" no ha sido eliminado, este se debe a que existen referencias con otros elementos');
		    	$this->redirect(array('action' => 'proyecto_listado'));
		    }
		}
	
	public function divisionjson() 
		{
			$divisiones = $this->Division->find('all',array(
											'fields' => array('iddivision', 'divison')));
			
										
			$this->set('divisiones', Hash::extract($divisiones, "{n}.Division"));
			$this->set('_serialize', 'divisiones');
			$this->render('/json/jsondivision');
			
		}
	
	/* function proyecto_asignar_num 
	 * Con esta función agregamos el número de proyecto 
	 * Se realiza una consulta a los proyectos que aun no poseen asignado su numero de proyecto *
	 * metodo read($fields,$id)
	 * $fields indica los campos que se van a leer (se pueden especificar en un array)
	 * $id indica el id del elemento que será modificado *
	 * metodo save($id) 
	 * $id indica el id del elemento que será guardado, si es uno que ya existe actualizará
	 * sino existe lo creará */
	
	public function proyecto_asignar_num()
	{
		$this->layout = 'cyanspark';
		$rol = $this->User->field('idrol',array('username'=>$this->Session->read('User.username')));
		$this->set('idrol',$rol);
		//numero proyecto del primer elemento
		$this->set('num',$this->Proyecto->find('all',array(
						'fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto','Proyecto.nombreproyecto'),
						'conditions'=>array('Proyecto.estadoproyecto' => array('Licitacion','Formulacion')),
						'order' => array('Proyecto.nombreproyecto '=>'ASC')
						//'conditions'=>array('Proyecto.idproyecto='.$proys['Proyecto']['idproyecto'])
						)));
		
		if   ($this->request->is('post')) 
			{
                $this->Proyecto->create();
				$id = $this->request->data['Proyecto']['proys'];
				$this->Proyecto->read(null, $id);
				$this->Proyecto->set('numeroproyecto', $this->request->data['Proyecto']['numeroproyecto']);
                $this->Proyecto->set('userm', $this->Session->read('User.username'));
				$this->Proyecto->set('estadoproyecto', 'Licitacion');
				$this->Proyecto->set('modificacion', date('Y-m-d h:i:s'));
				
				if ($this->Proyecto->save($id)) 
					{
						$this->Session->setFlash('Se ha asignado el número '.$this->request->data['Proyecto']['numeroproyecto'].
												 ' al Proyecto "'.$this->Proyecto->field('nombreproyecto') .'"',
												 'default',array('class'=>'success'));
												 
						//Notificacion con envio de correo. Estado pasa a Licitacion
						$mensaje = 'El proyecto "'.$this->Proyecto->field('nombreproyecto') .'" pasa a estado de Licitación';

						$to=Hash::extract($this->Persona->User->query('SELECT
						persona.idpersona,
						persona.correoelectronico
						FROM
						sicpro2012.users,
						sicpro2012.persona
						WHERE
						persona.idpersona = users.idpersona AND
						users.idrol = 1 AND
						users.estado = true;'),'{n}.0');					
					
						$subject = 'Notificacion SICPRO';
						foreach ($to as $key => $value) {
							$this->enviar_correo($to[$key]['correoelectronico'],$subject,$mensaje);
						}
						$this->redirect(array('action' => 'proyecto_listado'));
		            }
					else 
						{
							//$this->Session->setFlash('Ha ocurrido un error');
		                 }
        	} else {
        		$this->request->data['Proyecto']['numeroproyecto'] = '';
        	}
	}

	function update_numeroproy()
	{
		if (!empty($this->data['Proyecto']['proys']))
		{
			$proy_id = $this->request->data['Proyecto']['proys'];
			$num = $this->Proyecto->find('first',array(
										'fields'=>array('Proyecto.numeroproyecto'),
										'conditions'=>array('Proyecto.idproyecto'=>$proy_id)));
			$this->set('num',$num);
		}
		$this->render('/Elements/update_numeroproy', 'ajax');
	}

	public function proyectosjson() 
		{
			$proys = $this->Proyecto->find('all', array(
										'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
										'conditions'=>array('Proyecto.estadoproyecto' => array('Licitacion','Formulacion')),
										'order'=> array('Proyecto.nombreproyecto ASC')));
			$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
			$this->set('_serialize', 'proys');
			$this->render('/json/jsonproys');
			
		}
		
	function estadojson() {
		$proys = $this->Proyecto->find('all', array(
			'fields'=>array('DISTINCT Proyecto.estadoproyecto'),
			'recursive' => 0,
			'order' => 'Proyecto.estadoproyecto'
			));
		
		$this->set('proys', $this->eliminarduplicados(Hash::extract($proys, "{n}.Proyecto")));
		//$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');
	}
	
	public function eliminarduplicados($array=null) {
		$count = 0;
		$value = ""; 
    	foreach($array as $array_key => $array_value) 
    	{
        	
				 
			
        	if ( $count >= 1 ) {
        		if($value !== $array_value['estadoproyecto']) {
        			$count = 0; 
        		}
        	}
        	if ( $count == 0 ) 
        	{
            	$value = $array_value['estadoproyecto']; 
            	$count++;
        	} else {
        		if($array_value['estadoproyecto'] === $value) {
        			
        			unset($array[$array_key]);
					$count++;
				} else {
					$count = 0;
				}
        	}
        	
    	} 
        return array_values($array);
	}	
			
		
		
	public function proyecto_reportecontratos() {
		$this->layout = 'cyanspark';
		if($this->request->is('post')) {
			$this->redirect(array('action' => 'proyecto_reportecontratos_pdf',$this->request->data['Proyecto']['proyectos']));
		}
		
	}	

	public function reportecontratosjson() 
	{
		$proys = $this->Contrato->find('all', array(
									'fields'=> array('DISTINCT Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.creacion'),
									'order'=> array('Proyecto.nombreproyecto ASC')));
		$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');
		
	}
	
	public function reportegridcontratosjson() 
	{
		$proys = $this->Contrato->find('all', array(
									//'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.creacion'),
									'order'=> array('Proyecto.numeroproyecto ASC', 'Contrato.codigocontrato ASC')));
		$this->set('proys', Hash::extract($proys, "{n}"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');

	}
	
	function proyecto_reportecontratos_pdf($idproyecto=null) {
			Configure::write('debug',0);
			$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
			
			$proys = $this->Contrato->find('all', array(
									//'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.creacion'),
									'conditions' => array('Proyecto.idproyecto' => $idproyecto), 
									'order'=> array('Proyecto.numeroproyecto ASC', 'Contrato.codigocontrato ASC')));
			$this->set('proyectos', Hash::extract($proys, "{n}"));
			$this->set('proyecto', Hash::extract($proys, "{n}.Proyecto"));
			// Operaciones que deseamos realizar y variables que pasaremos a la vista.
			$this->render();
	}

	/*Las siguiente funciones han sido utilizadas para llevar a cabo el reporte general de un proyecto
	 * proyecto_reportegeneral()
	 * Invoca una pantalla de selección de proyecto*/
	
	function proyecto_reportegeneral()
	{
		$this->layout = 'cyanspark';
		if($this->request->is('post')) {
			$this->redirect(array('action' => 'proyecto_resultados_repgen',$this->request->data['Proyecto']['proys']));
		}
	}
	
	/*proyecto_resultados_repgen()
	 * Habiendose seleccionado el proyecto se realiza la búsqueda de los elementos a desplegar en el reporte
	 * esta función realiza la búsqueda de aspectos generales del proyecto, fuentes de financiamiento y contratos*/
	
	function proyecto_resultados_repgen($idproy=null)
	{
		$this->layout = 'cyanspark';
		$this->set('dataproy', $this->Proyecto->find('all',array(
				'fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.numeroproyecto',
								'Proyecto.estadoproyecto','Division.divison'),
				'conditions'=>array('Proyecto.idproyecto'=>$idproy)
				)));
		
		$this->set('fuentes', $this->Financia->find('all',array(
				'fields'=>array('Fuentefinanciamiento.nombrefuente','Financia.montoparcial'),
				'conditions'=>array('Proyecto.idproyecto'=>$idproy))));
		
		$this->set('contratos',$this->Contrato->find('all',array(
				'fields'=>array('Contrato.codigocontrato','Contrato.nombrecontrato','Contrato.tipocontrato',
								'Contrato.montooriginal','Contrato.plazoejecucion','Contrato.ordeninicio',
								'Persona.nombrespersona','Persona.apellidospersona'),
				'conditions'=>array('Contrato.idproyecto'=>$idproy),
				'order'=>'Contrato.codigocontrato'
				)));
		
		if($this->request->is('post')) {
			$idproyecto = $idproy;
			$this->redirect(array('action' => 'proyecto_resultados_repgen_pdf',
								$this->request->data['Proyecto']['idproyecto']));
		}
		
	}
	
	function proyecto_resultados_repgen_pdf($idproy=null) {
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		
		$this->set('dataproy', $this->Proyecto->find('all',array(
			'fields'=>array('Proyecto.nombreproyecto','Proyecto.numeroproyecto',
							'Proyecto.estadoproyecto','Division.divison'),
			'conditions'=>array('Proyecto.idproyecto'=>$idproy)
			)));
		
		$this->set('fuentes', $this->Financia->find('all',array(
				'fields'=>array('Fuentefinanciamiento.nombrefuente','Financia.montoparcial'),
				'conditions'=>array('Proyecto.idproyecto'=>$idproy))));
		
		$this->set('contratos',$this->Contrato->find('all',array(
				'fields'=>array('Contrato.codigocontrato','Contrato.nombrecontrato','Contrato.tipocontrato',
								'Contrato.montooriginal','Contrato.plazoejecucion','Contrato.ordeninicio',
								'Persona.nombrespersona','Persona.apellidospersona'),
				'conditions'=>array('Contrato.idproyecto'=>$idproy),
				'order'=>'Contrato.codigocontrato'
				)));
			
			/*
			$proys = $this->Contrato->find('all', array(
									//'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.creacion'),
									'conditions' => array('Proyecto.idproyecto' => $idproyecto), 
									'order'=> array('Proyecto.numeroproyecto ASC', 'Contrato.codigocontrato ASC')));
			$this->set('proyectos', Hash::extract($proys, "{n}"));
			$this->set('proyecto', Hash::extract($proys, "{n}.Proyecto"));
			// Operaciones que deseamos realizar y variables que pasaremos a la vista.
			*/
			$this->render();
	}
	
	/* Esta función recupera los proyectos en estado de ejecucion y finalizado*/
	public function proyectotodosjson() 
		{
			$proys = $this->Proyecto->find('all', array(
										'fields'=> array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
										'conditions'=>array('Proyecto.estadoproyecto' => array('Ejecucion','Finalizado')),
										'order'=> array('Proyecto.numeroproyecto ASC')));
			$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
			$this->set('_serialize', 'proys');
			$this->render('/json/jsonproys');			
		}


	public function proyecto_consultaestados(){
		$this->layout = 'cyanspark';
	}
	
	public function proyecto_reporteestados_pdf($iddiv=null, $inicio=null, $fin=null){
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		$fechai = substr($inicio,4,4).'-'.substr($inicio,2,2).'-'.substr($inicio,0,2);
		$fechaf = substr($fin,4,4).'-'.substr($fin,2,2).'-'.substr($fin,0,2);
		
		$arraydiv=$this->Division->find('first',array('conditions'=>array('Division.iddivision' => $iddiv)));
		$this->set('nombredivision',$arraydiv);
		
		//Genear los datos para construir el PDF
		$tmp = $this->Proyembe->find('all',array(
					'conditions'=>array(
					'Proyembe.iddivision'=> $iddiv,
					'Proyembe.fechainicio >' => $fechai,
					'Proyembe.fechafin <'=> $fechaf)));
		$this->set('tmp',Hash::extract($tmp,'{n}'));
		
		$proyectos= $this->Financia->find('all', array(
			       	'fields'=>array(
			        'Proyecto.idproyecto','Proyecto.numeroproyecto','Proyecto.nombreproyecto','Proyecto.montoplaneado','Proyecto.iddivision',
			        'Proyecto.estadoproyecto','Fuentefinanciamiento.nombrefuente','Financia.montoparcial'),
			        'conditions'=>array('Proyecto.idproyecto'=>Hash::extract($tmp,'{n}.Proyembe.idproyecto'))));
		$this->set('proyectos',$proyectos);
		
		$contratos= $this->Contratoconstructor->find('all', array(
			                'conditions'=>array('Proyecto.iddivision'=>$iddiv,
							'Contratoconstructor.idproyecto' => Hash::extract($tmp,'{n}.Proyembe.idproyecto'))));
		$this->set('contratos',Hash::extract($contratos, '{n}.Contratoconstructor'));
		
		$this->render();
	} 
	

	public function update_consultaestados(){
		$fechaini=$this->request->data['Proyecto']['start'];
		$fechafin=$this->request->data['Proyecto']['end'];
		$fechainicio=substr($fechaini,6,4).'-'.substr($fechaini,3,2).'-'.substr($fechaini,0,2);
		$fechafinal=substr($fechafin,6,4).'-'.substr($fechafin,3,2).'-'.substr($fechafin,0,2);
			
		switch (substr($fechaini,3,2)) 
		{
			case '04': case '06': case '09': case '11':
				if(substr($fechaini,0,2) <= 30)	$pasai=1;
				else 							$pasai=0;
				break;
			case '01': case '03': case '05': case '07': 
			case '08': case '10': case '12':
				if(substr($fechaini,0,2) <= 31)	$pasai=1;
				else 							$pasai=0;
				break;
			case '02':
				if(substr($fechaini,0,2) <= 29)	$pasai=1;
				else 							$pasai=0;
				break;
			default:	$pasai=0;		
				break;
		}
		
		switch (substr($fechafin,3,2)) 
		{
			case '04': case '06': case '09': case '11':
				if(substr($fechafin,0,2) <= 30)	$pasaf=1;
				else 							$pasaf=0;
				break;
			case '01': case '03': case '05': case '07': 
			case '08': case '10': case '12':
				if(substr($fechafin,0,2) <=31)	$pasaf=1;
				else 							$pasaf=0;
				break;
			case '02':
				if(substr($fechafin,0,2) <=29)	$pasaf=1;
				else 							$pasaf=0;
				break;
			default: 							$pasaf=0;
				break;
		}
		if ($pasai==1 && $pasaf==1)
		{	
		
		if (!empty($this->data['Proyecto']['divisiones']))
		
			
			$this->set('iddiv', $this->data['Proyecto']['divisiones']);
			$this->set('fechai', $this->request->data['Proyecto']['start']);
			$this->set('fechaf',$this->request->data['Proyecto']['end']);
		   		{
		   			$tmp = $this->Proyembe->find('all',array(
					'conditions'=>array(
					'Proyembe.iddivision'=> $this->data['Proyecto']['divisiones'],
					'Proyembe.fechainicio >' => $fechainicio,
					'Proyembe.fechafin <'=> $fechafinal)));
					
					$this->set('tmp',Hash::extract($tmp,'{n}'));
                     //$contrato_id = $this->data['Estado']['contratos']['idcontrato'];
                    //Debugger::dump($this->request->data);
					$iddivision = $this->data['Proyecto']['divisiones'];	
					//$fechaini = $this->data['Division']['start'];	
					//$fechafin = $this->data['Division']['end'];				
		            $proyectos= $this->Financia->find('all', array(
			                'fields'=>array(
			                'Proyecto.idproyecto','Proyecto.numeroproyecto','Proyecto.nombreproyecto','Proyecto.montoplaneado','Proyecto.iddivision',
			                'Proyecto.estadoproyecto','Fuentefinanciamiento.nombrefuente','Financia.montoparcial'),
			                'conditions'=>array('Proyecto.idproyecto'=>Hash::extract($tmp,'{n}.Proyembe.idproyecto'))));
							
					$this->set('proyectos',$proyectos);
					
					$this->set('idproyectos', Hash::extract($proyectos,'{n}.Proyecto.idproyecto'));
					
					$contratos= $this->Contratoconstructor->find('all', array(
			                'conditions'=>array('Proyecto.iddivision'=>$iddivision,
							'Contratoconstructor.idproyecto' => Hash::extract($tmp,'{n}.Proyembe.idproyecto'))));
					$this->set('contratos',Hash::extract($contratos, '{n}.Contratoconstructor'));
					
		        }
		 }
		$this->render('/Elements/update_consultaestados', 'ajax');
	} 
		
	public function divisionesjson() 
	{
			$divs = $this->Division->find('all', array(
										'fields'=> array('Division.iddivision','Division.divison'),
										'order'=> array('Division.iddivision ASC'),
										'conditions'=> array(
										'Division.iddivision IN (SELECT iddivision from sicpro2012.proyecto)'
										)));
			//$this->set('divisiones',$divs);							
			$this->set('divisiones', Hash::extract($divs, "{n}.Division"));
			$this->set('_serialize', 'divisiones');
			$this->render('/json/jsondivision');			
	}
	
	
	//funcion para enviar correo
	public function enviar_correo($to=null,$subject=null,$mensaje=null)
	{
		if(isset( $to) || isset($mensaje)){
		 try {
		$email = new CakeEmail('gmail');
		$email->emailFormat('text')
				->to($to)
				->from('noreplysicpro@gmail.com')
				->subject($subject)
				->send($mensaje);
				 	return true;
	    } catch (Exception $e) {
	        return false;
	    }
		}
    }
	
	//metodo de prueba para el envio de correo.
	public function test_correo(){
		$this->enviar_correo('testcorreo@hotmail.com','prueba funcion','probando la implementacion de mensaje por correo');
	}

}