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

	/*las siguientes funciones permiten realizar el reporte de beneficiarios
	 * y empleos generados por proyectos.
	 * fichatecnica_rep_empbene
	 * Invoca el formulario para toma de parametros
	 * */
	function fichatecnica_rep_empbene() 
	{
		$this->layout = 'cyanspark';
		
	}
	/* update_rep_empbene
	 * Genera los resultados en la página web y permite invocar la funcion para convertir en pdf
	 * */
	function update_rep_empbene()
	{
		if(isset($this->request->data['Proyembe']['divisiones']) && !empty($this->request->data['Proyembe']['divisiones']))
		{
			$iddiv = $this->request->data['Proyembe']['divisiones'];
			$fechai= $this->request->data['Proyembe']['fechainicio'];
			$fechainicio=substr($fechai,6,4).'-'.substr($fechai,3,2).'-'.substr($fechai,0,2);
			$fechaf= $this->request->data['Proyembe']['fechafin'];
			$fechafin=substr($fechaf,6,4).'-'.substr($fechaf,3,2).'-'.substr($fechaf,0,2);
			$this->set('nomdiv',$this->Division->field('Division.divison',array('iddivision'=>$iddiv)));
			$this->set('inicio',$this->request->data['Proyembe']['fechainicio']);
			$this->set('fin',$this->request->data['Proyembe']['fechafin']);
			$this->set('proys',$this->Proyembe->find('all',array(
				'fields'=>array('Proyembe.nombreproyecto','Proyembe.numeroproyecto',
								'Proyembe.empleosgenerados','Proyembe.beneficiarios',
								'Proyembe.iddivision'),
				'conditions'=>array("AND"=>array('Proyembe.iddivision'=>$iddiv,
												 'Proyembe.fechainicio >'=>$fechainicio,
												 'Proyembe.fechafin <'=>$fechafin)))));
		}
		$this->render('/Elements/update_rep_empbene', 'ajax');
		
	}
	
	/*fichatecnica_rep_empbene_pdf
	 * realiza el reporte en formato pdf
	 * */
	function fichatecnica_rep_empbene_pdf($iddiv=null, $inicio=null, $fin=null)
	{
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		$fechai = substr($inicio,4,4).'-'.substr($inicio,2,2).'-'.substr($inicio,0,2);
		$fechaf = substr($fin,4,4).'-'.substr($fin,2,2).'-'.substr($fin,0,2);
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
		
	function fichatecnica_consultarficha()
	{
		$this->layout = 'cyanspark';
	}
	
	function proyectosfichajson()
	{
		$proys = $this->Proyecto->find('all', array(
			'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
			'conditions'=>array('Proyecto.idproyecto IN (SELECT idproyecto 
														 FROM sicpro2012.fichatecnica)'),
			'order'=> array('Proyecto.nombreproyecto ASC')));
		$this->set('proys', Hash::extract($proys, "{n}.Proyecto"));
		$this->set('_serialize', 'proys');
		$this->render('/json/jsonproys');	
	}

	function update_res_ficha()
	{
		if(isset($this->request->data['proyectos']) && !empty($this->request->data['proyectos']))
		{
			$nomproy= $this->request->data['proyectos'];
			$idproy = $this->Proyecto->field('idproyecto',array('nombreproyecto' => $nomproy));
			$this->set('numproy',$this->Proyecto->field('numeroproyecto',array('nombreproyecto' => $nomproy)));
			$idficha = $this->Fichatecnica->field('idfichatecnica',array('idproyecto' => $idproy));
			$this->set('nomproy',$nomproy);
			$this->set('fichatec',$this->Fichatecnica->find('all',array(
				'conditions'=>array('Fichatecnica.idproyecto'=>$idproy)
				)));
			
			$this->set('component',$this->Componente->find('all',array(
				'fields'=>array('Componente.nombrecomponente','Componente.descripcioncomponente',
								'Componente.idcomponente'),
				'conditions'=>array('Componente.idfichatecnica'=>$idficha),
				'order'=>'Componente.idcomponente'
				)));
				
			$this->set('metas',$this->Meta->find('all',array(
			 	'fields'=>array('Componente.idcomponente','Meta.descripcionmeta'),
				'conditions'=>array('Componente.idfichatecnica'=>$idficha),
				'order'=>'Meta.idmeta'
				)));
			
			$this->set('ubicaciones',$this->Ubicacion->find('all',array(
				'fields'=>array('Ubicacion.direccion','Departamento.departamento','Municipio.municipio'),
				'conditions'=>array('Ubicacion.idfichatecnica'=>$idficha)
				)));
		}
		$this->render('/Elements/update_res_ficha', 'ajax');
	}
} 