<?php
class FichatecnicasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto','Fichatecnica','Ubicacion','Departamento',
						 'Municipio','Meta','Componente','Proyembe','Division');
	
	
    public function index() {
    	$this->layout = 'cyanspark';
    }	
	
	public function fichatecnica_registrarficha() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    // it validated logic	    
				    $this->Fichatecnica->set('idproyecto', $this->request->data['Fichatecnica']['proyectos']);
					$this->Fichatecnica->set('problematica', $this->request->data['Fichatecnica']['problematica']);
					$this->Fichatecnica->set('objgeneral', $this->request->data['Fichatecnica']['objgeneral']);
					$this->Fichatecnica->set('objespecifico', $this->request->data['Fichatecnica']['objespecifico']);
					$this->Fichatecnica->set('descripcionproyecto', $this->request->data['Fichatecnica']['descripcionproyecto']);
					$this->Fichatecnica->set('empleosgenerados', $this->request->data['Fichatecnica']['empleosgenerados']);
					$this->Fichatecnica->set('beneficiarios', $this->request->data['Fichatecnica']['beneficiarios']);
					$this->Fichatecnica->set('resultadosesperados', $this->request->data['Fichatecnica']['resultadosesperados']);
					$this->Fichatecnica->set('userc', $this->request->data['Fichatecnica']['userc']);					
				    if ($this->Fichatecnica->save()) {
		            	$this->Session->setFlash('La Ficha Tecnica ha sido registrada.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'fichatecnicas','action' => 'view',$this->Fichatecnica->id
						));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    		}	
	}

	public function fichatecnica_modificarficha($id = null){
		$this->layout = 'cyanspark';	
		$this->Fichatecnica->id = $id;
	    if ($this->request->is('get')) {
	        $this->request->data = $this->Fichatecnica->read();
	    } else {
	    	$this->Fichatecnica->set('userm', $this->Session->read('User.username'));
			$this->Fichatecnica->set('modificacion', date('Y-m-d h:i:s'));
	        if ($this->Fichatecnica->save($this->request->data)) {
	        	
	            $this->Session->setFlash('Los Datos Generales de la Ficha tecnica del proyecto "'.$this->request->data['Fichatecnica']['nombreproyecto'] .'" ha sido modificada.','default',array('class' => 'success'));
	            $this->redirect(array('action' => 'fichatecnica_listarficha'));
				
	        } else {
            	$this->Session->setFlash('Imposible editar Ficha Tecnica');
        	}
	    }
	}
	
	public function fichatecnica_modificarubicacion($id = null){
		$this->layout = 'cyanspark';	
		$this->set('idfichatecnica',$id);
	    $this->set('ubicaciones', $this->Fichatecnica->Ubicacion->find('all',
				array('fields' => array('Ubicacion.idubicacion','Ubicacion.direccion','Departamento.departamento','Municipio.municipio'),
				'conditions' => array('Ubicacion.idfichatecnica' => $id))
				));
		$this->set('idfichatecnica',$id);
	}
	
	public function fichatecnica_listarficha(){
		$this->layout = 'cyanspark';	
		$this->set('fichas', $this->Fichatecnica->find('all',
		array(
		'conditions'=>array( "OR" => 
							array('Proyecto.estadoproyecto' => 
							array('Formulacion','Licitacion','Adjudicacion')
		)))));
	}
	public function view($id = null) {
		$this->layout = 'cyanspark';   		
        $this->Fichatecnica->id = $id;
		if (!$this->Fichatecnica->find('all')) {
        	throw new NotFoundException('No se puede encontrar la Empresa', 404);
    	} else {
        	$this->set('fichatecnicas', $this->Fichatecnica->read());
			$this->set('ubicaciones', $this->Fichatecnica->Ubicacion->find('all',
				array('fields' => array('Ubicacion.direccion','Departamento.departamento','Municipio.municipio'),
				'conditions' => array('Ubicacion.idfichatecnica' => $id))
			));			
		}
    }
	
	public function proyectojson() {		
		$proyectos = $this->Proyecto->find('all',array(
			'fields' => array('DISTINCT Proyecto.idproyecto', 'Proyecto.nombreproyecto'),
			'conditions' => 'Proyecto.idproyecto NOT IN (SELECT idproyecto FROM sicpro2012.fichatecnica)',
			'order' => array('Proyecto.nombreproyecto')
		));
		$this->set('proyectos', Hash::extract($proyectos, "{n}.Proyecto"));
		$this->set('_serialize', 'proyectos');
		$this->render('/json/jsondata');
	}

	function fichatecnica_rep_empbene() 
	{
		$this->layout = 'cyanspark';
		
	}
	
	function update_rep_empbene()
	{
		if(isset($this->request->data['Fichatecnica']['divisiones']) && !empty($this->request->data['Fichatecnica']['divisiones']))
		{
			$iddiv = $this->request->data['Fichatecnica']['divisiones'];
			$fechai= $this->request->data['Fichatecnica']['fechainicio'];
			$fechaf= $this->request->data['Fichatecnica']['fechafin'];
			$this->set('nomdiv',$this->Division->field('Division.divison',array('iddivision'=>$iddiv)));
			$this->set('inicio',$this->request->data['Fichatecnica']['fechainicio']);
			$this->set('fin',$this->request->data['Fichatecnica']['fechafin']);
			$this->set('proys',$this->Proyembe->find('all',array(
				'fields'=>array('Proyembe.nombreproyecto','Proyembe.numeroproyecto',
								'Proyembe.empleosgenerados','Proyembe.beneficiarios',
								'Proyembe.iddivision'),
				'conditions'=>array("AND"=>array('Proyembe.iddivision'=>$iddiv,
												 'Proyembe.fechainicio >'=>$fechai,
												 'Proyembe.fechafin <'=>$fechaf)))));
		}
		$this->render('/Elements/update_rep_empbene', 'ajax');
		
	}
	
	function fichatecnica_rep_empbene_pdf($iddiv=null, $inicio=null, $fin=null)
	{
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		$fechai = substr($inicio,0,2).'/'.substr($inicio,2,2).'/'.substr($inicio,4,4);
		$fechaf = substr($fin,0,2).'/'.substr($fin,2,2).'/'.substr($fin,4,4);
		$this->set('proys',$this->Proyembe->find('all',array(
							'fields'=>array('Proyembe.nombreproyecto','Proyembe.numeroproyecto',
											'Proyembe.empleosgenerados','Proyembe.beneficiarios',
											'Proyembe.iddivision'),
							'conditions'=>array("AND"=>array('Proyembe.iddivision'=>$iddiv,
															 'Proyembe.fechainicio >'=>$fechai,
															 'Proyembe.fechafin <'=>$fechaf)))));
		$this->set('nomdiv',$this->Division->field('Division.divison',array('iddivision'=>$iddiv)));
		$this->set('inicio',$fechai);
		$this->set('fin',$fechaf);
		$this->render();
	}
	
	public function divisionjson() 
		{
			$divisiones = $this->Division->find('all',array(
											'fields' => array('iddivision', 'divison')));
			$this->set('divisiones', Hash::extract($divisiones, "{n}.Division"));
			$this->set('_serialize', 'divisiones');
			$this->render('/json/jsondivision');
			
		}
}