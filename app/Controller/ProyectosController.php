<?php class ProyectosController extends AppController {
    public $name = 'Proyectos';
    public $components = array('Session');
	public $uses = array('Proyecto','Division');
	
	public function proyecto_registrar() {
        $this->layout = 'cyanspark';
		$this->set('divisions', $this->Proyecto->Division->find('list',
			array('fields' => array('Division.iddivision', 'Division.divison')
		)));
		if ($this->request->is('post')) {
                $this->Proyecto->set('nombreproyecto', $this->request->data['Proyecto']['nombreproyecto']);
				$this->Proyecto->set('iddivision', $this->request->data['Proyecto']['divisions']);
				$this->Proyecto->set('montoplaneado', $this->request->data['Proyecto']['montoplaneado']);
				$this->Proyecto->set('userc', $this->Session->read('User.username'));
				$this->Proyecto->set('estadoproyecto', 'Formulacion');
		if ($this->Proyecto->save()) {
				$this->Session->setFlash('El proyecto ha sido registrado');
                $this->redirect(array('controller'=>'mains', 'action' => 'index'));
            }
			else {
			
				$this->Session->setFlash('Ha ocurrido un error');
                         }
        }
    }
	
	public function proyecto_listado(){
		$this->layout = 'cyanspark';
		$this->set('proyectos',$this->Proyecto->find('list', array(
									'fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto','Proyecto.montoplaneado'),
									'conditions'=>array('Proyecto.estadoproyecto' => 'Formulacion' )
									)));
	}
	
	public function proyecto_modificar($id=null)
	{
			//$this->layout = 'cyanspark';
			//Recuperamos los proyectos
			$this->set('proyectos',$this->Proyecto->find('list',array(
											'fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
											'conditions'=> array('Proyecto.estadoproyecto' => 'Formulacion'),
											'order' => array('Proyecto.idproyecto')
											)));
			//primer proyecto
			$primerproy = $this->Proyecto->find('list',array(
											'fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
											'conditions'=> array('Proyecto.estadoproyecto' => 'Formulacion'),
											'order' => array('Proyecto.idproyecto')
											));
			//Recuperando información del primer proyecto
			$info_proy = $this->Proyecto->find('list', array(
											'fields'=>array('Proyecto.nombreproyecto','Proyecto.montoplaneado'),
											'order' => array('Proyecto.idproyecto'),
											'conditions'=> array('Proyecto.estadoproyecto' => 'Licitacion')
											));
			$this->set('nombreproyecto', Hash::combine($info_proy, "{0}.Proyecto.nombreproyecto"));
			
			$this->set('divisions', $this->Division->find('list',	array(
											'fields' => array('Division.iddivision', 'Division.divison'))));
			
	}
	
	
	/* function add_num 
	 * Con esta función agregamos el número de proyecto 
	 * Se realiza una consulta a los proyectos que aun no poseen asignado su numero de proyecto */
	
	 /* metodo read($fields,$id)
	  * $fields indica los campos que se van a leer (se pueden especificar en un array)
	  * $id indica el id del elemento que será modificado */
	  
	 /* metodo save($id) 
	  * $id indica el id del elemento que será guardado, si es uno que ya existe actualizará
	  * sino existe lo creará */
	
	public function proyecto_asignar_num($id=null)
	{
		$this->layout = 'cyanspark';
		$this->set('proys',$this->Proyecto->find('list', array(
												 'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
												 'conditions'=>array('Proyecto.numeroproyecto is null'))));
		
		if ($this->request->is('post')) 
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
						$this->Session->setFlash('El número de proyecto ha sido asignado');
						$this->redirect(array('controller'=>'mains', 'action' => 'index'));
		            }
					else 
						{
							$this->Session->setFlash('Ha ocurrido un error');
		                 }
        	}
	}
}