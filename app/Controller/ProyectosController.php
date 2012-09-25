<?php class ProyectosController extends AppController {
    public $name = 'Proyectos';
    public $components = array('Session');
	
	public function add() {
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
	
	public function edit($id=null)
	{
			$this->layout = 'cyanspark';
			$this->set('divisions', $this->Proyecto->Division->find('list',	array('fields' => array('Division.iddivision', 'Division.divison'))));
			$this->set('proys',$this->Proyecto->find('list',array('fields'=>array('Proyecto.idproyecto','Proyecto.nombreproyecto'))));
			
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
	
	public function add_num($id=null)
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