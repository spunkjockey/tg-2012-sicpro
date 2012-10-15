<?php class ProyectosController extends AppController {
    public $name = 'Proyectos';
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto','Division','Contrato');
	
	public function proyecto_registrar() {
        $this->layout = 'cyanspark';
		
		if ($this->request->is('post')) 
			{
                $this->Proyecto->set('nombreproyecto', $this->request->data['Proyecto']['nombreproyecto']);
				$this->Proyecto->set('iddivision', $this->request->data['Proyecto']['divisiones']);
				$this->Proyecto->set('montoplaneado', $this->request->data['Proyecto']['montoplaneado']);
				$this->Proyecto->set('userc', $this->Session->read('User.username'));
				$this->Proyecto->set('estadoproyecto', 'Formulacion');
			if ($this->Proyecto->save()) {
					$this->Session->setFlash('El proyecto '. $this->request->data['Proyecto']['nombreproyecto'].' ha sido registrado',
											 'default',array('class'=>'success'));
	                $this->redirect(array('action' => 'proyecto_listado'));
	            }
				else {
				
					$this->Session->setFlash('Ha ocurrido un error');
	                         }
        }
    }
	
	public function proyecto_listado()
	{
		$this->layout = 'cyanspark';
		$this->set('proyectos', $this->Proyecto->find('all', array(
									'fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto',
													'Proyecto.estadoproyecto'),
									'order'=> array('Proyecto.nombreproyecto'))));
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
				$this->Session->setFlash('Proyecto '. $this->request->data['Proyecto']['nombreproyecto'].' ha sido actualizado.',
										 'default',array('class'=>'success'));
				$this->redirect(array('action' => 'proyecto_listado'));
			}
			else 
			{
				$this->Session->setFlash('Imposible editar proyecto');
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
		//primer proyecto
		$proys = $this->Proyecto->find('first', array(
										'fields'=> array('Proyecto.idproyecto'),
										'conditions'=>array('Proyecto.estadoproyecto' => array('Licitacion','Formulacion')),
										'order'=> array('Proyecto.nombreproyecto ASC')));
		//numero proyecto del primer elemento
		$this->set('num',$this->Proyecto->find('first',array(
										'fields'=>array('Proyecto.numeroproyecto'),
										'conditions'=>array('Proyecto.idproyecto='.$proys['Proyecto']['idproyecto']))));
		
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
												 ' al proyecto '.$this->request->data['Proyecto']['nombreproyecto'],
												 'default',array('class'=>'success'));
						$this->redirect(array('action' => 'proyecto_listado'));
		            }
					else 
						{
							$this->Session->setFlash('Ha ocurrido un error');
		                 }
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
			'fields'=>array('DISTINCT Proyecto.estadoproyecto')));
		
		$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');
	}
		
			
		
		
	public function proyecto_reportecontratos() {
		$this->layout = 'cyanspark';
		
		
	}	
	
	public function update_reportecontratos() {
			
		$this->set('proyectos',$this->data['Proyecto']['proyectos']);
		
		$this->render('/Elements/reportes/update_reportecontratos', 'ajax');
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
	
}