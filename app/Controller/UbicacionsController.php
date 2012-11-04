<?php
class UbicacionsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
	public $uses = array('Departamento','Municipio','Ubicacion','Depmuni');
	
	public function ubicacion_registrar($id=null) {
		$this->layout = 'cyanspark';
		
		$this->set('idfct',$id);
	
        if ($this->request->is('post')) {
				    // it validated logic
				    $this->Ubicacion->set('iddepartamento', $this->request->data['Ubicacion']['departamentos']);
					
					$this->Ubicacion->set('idmunicipio', $this->request->data['Ubicacion']['municipios']);
					
					
					$this->Ubicacion->set('direccion', $this->request->data['Ubicacion']['direccion']);
					$this->Ubicacion->set('idfichatecnica',$id);
					
										
				    if ($this->Ubicacion->save()) {
		            	$this->Session->setFlash('La Ubicacion ha sido registrada.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'Fichatecnicas','action' => 'view',$id
						));
		        	} else {
		            	//$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    	}
	}

	public function ubicacion_registrarmod($id=null) {
		$this->layout = 'cyanspark';
		
		$this->set('idfct',$id);
	
        if ($this->request->is('post')) {
				    // it validated logic
				    $this->Ubicacion->set('iddepartamento', $this->request->data['Ubicacion']['departamentos']);
					
					$this->Ubicacion->set('idmunicipio', $this->request->data['Ubicacion']['municipios']);
					
					
					$this->Ubicacion->set('direccion', $this->request->data['Ubicacion']['direccion']);
					$this->Ubicacion->set('idfichatecnica',$id);
					
										
				    if ($this->Ubicacion->save()) {
		            	$this->Session->setFlash('La Ubicacion ha sido registrada.','default',array('class'=>'success'));
		            	//$this->redirect(array('controller' => 'fichatecnicas','action' => 'add'));
		            	$this->redirect(array('controller' => 'Fichatecnicas','action' => 'fichatecnica_modificarubicacion',$id
						));
		        	} else {
		            	//$this->Session->setFlash('No se pudo realizar el registro' /*. $this->data['Fichatecnica']['idfichatenica'] */);
		        	}
    	}
	}

	function ubicacion_eliminar($id,$idfichatecnica) {
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Ubicacion->delete($id)) {
	        $this->Session->setFlash('La Ubicacion ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('controller' => 'Fichatecnicas','action' => 'fichatecnica_modificarubicacion',$idfichatecnica));
	    }
	}
	

	function update_select()
        {
                if (!empty($this->data['Ubicacion']['departamentos']))
                {
                        $depto_id = $this->data['Ubicacion']['departamentos'];
                        $municipios= $this->Municipio->find('all', array(
	                        'fields'=>array('Municipio.idmunicipio','Municipio.municipio'),
	                        'order'=>'Municipio.municipio ASC',
	                        'conditions'=>array('Municipio.iddepartamento'=>$depto_id)));
                }
                $this->set('options', Set::combine($municipios, "{n}.Municipio.idmunicipio","{n}.Municipio.municipio"));
                $this->render('/Elements/update_select', 'ajax');
        }
		
	/*funcion para recuperar listado de Departamentos*/
	public function departamentojson() 
		{
			$deptos = $this->Departamento->find('all', 
						array('fields'=>array('Departamento.iddepartamento','Departamento.departamento'),
			  				'order'=>'Departamento.departamento ASC'));	
			$this->set('departamentos', Hash::extract($deptos, "{n}.Departamento"));
			$this->set('_serialize', 'departamentos');
			$this->render('/json/jsondepto');
		}

	public function municipiojson() {
		$municipios = $this->Ubicacion->Municipio->find('all',
		array('fields'=>array('Municipio.idmunicipio','Municipio.municipio','Municipio.iddepartamento'),
		'order'=>'Municipio.municipio ASC',
		));
		$this->set('municipios', Hash::extract($municipios, "{n}.Municipio"));
		$this->set('_serialize', 'municipios');
		$this->render('/json/jsonmunicipio');
	}
	
	/*Las siguientes funciones permiten generar el reporte sobre
	 * municipios y departamentos donde se han desarrollado proyectos*
	 * */
	 function ubicacion_rep_proy_depmuni()
	 {
	 	$this->layout = 'cyanspark';
	 }
	 
	 function update_rep_proy_depmuni()
	 {
	 	$fechai= $this->request->data['Depmuni']['fechainicio'];
		$fechainicio=substr($fechai,6,4).'-'.substr($fechai,3,2).'-'.substr($fechai,0,2);
		$fechaf= $this->request->data['Depmuni']['fechafin'];
		$fechafin=substr($fechaf,6,4).'-'.substr($fechaf,3,2).'-'.substr($fechaf,0,2);

		switch (substr($fechai,3,2)) 
		{
			case '04': case '06': case '09': case '11':
				if(substr($fechai,0,2) <= 30)	$pasai=1;
				else 							$pasai=0;
				break;
			case '01': case '03': case '05': case '07': 
			case '08': case '10': case '12':
				if(substr($fechai,0,2) <= 31)	$pasai=1;
				else 							$pasai=0;
				break;
			case '02':
				if(substr($fechai,0,2) <= 29)	$pasai=1;
				else 							$pasai=0;
				break;
			default:	$pasai=0;		
				break;
		}
		
		switch (substr($fechaf,3,2)) 
		{
			case '04': case '06': case '09': case '11':
				if(substr($fechaf,0,2) <= 30)	$pasaf=1;
				else 							$pasaf=0;
				break;
			case '01': case '03': case '05': case '07': 
			case '08': case '10': case '12':
				if(substr($fechaf,0,2) <=31)	$pasaf=1;
				else 							$pasaf=0;
				break;
			case '02':
				if(substr($fechaf,0,2) <=29)	$pasaf=1;
				else 							$pasaf=0;
				break;
			default: 							$pasaf=0;
				break;
		}
		if ($pasai==1 && $pasaf==1)
		{
			$this->set('inicio',$this->request->data['Depmuni']['fechainicio']);
			$this->set('fin',$this->request->data['Depmuni']['fechafin']);
			$munis = $this->Depmuni->query(
				"SELECT DISTINCT municipio, COUNT(DISTINCT idproyecto) cantmuni
				FROM sicpro2012.vi_depmuni
				WHERE fechainiciocontrato >= '".$fechainicio."' AND fechafincontrato <= '".$fechafin."'
				GROUP BY municipio");
				$this->set('municipios', Hash::extract($munis, '{n}.0'));
			
			$deps = $this->Depmuni->query(
				"SELECT DISTINCT departamento, COUNT(DISTINCT idproyecto) cantidep
				FROM sicpro2012.vi_depmuni
				WHERE fechainiciocontrato >= '".$fechainicio."' AND fechafincontrato <= '".$fechafin."'
				GROUP BY departamento");
				$this->set('departamentos', Hash::extract($deps, '{n}.0'));
		}
		$this->render('/Elements/update_rep_proy_depmuni', 'ajax');
	 }

	function ubicacion_rep_proy_depmuni_pdf($inicio=null, $fin=null)
	{
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		$fechai = substr($inicio,4,4).'-'.substr($inicio,2,2).'-'.substr($inicio,0,2);
		$fechaf = substr($fin,4,4).'-'.substr($fin,2,2).'-'.substr($fin,0,2);
		
		$munis = $this->Depmuni->query(
				"SELECT DISTINCT municipio, COUNT(DISTINCT idproyecto) cantmuni
				FROM sicpro2012.vi_depmuni
				WHERE fechainiciocontrato >= '".$fechai."' AND fechafincontrato <= '".$fechaf."'
				GROUP BY municipio");
				$this->set('municipios', Hash::extract($munis, '{n}.0'));
			
		$deps = $this->Depmuni->query(
			"SELECT DISTINCT departamento, COUNT(DISTINCT idproyecto) cantidep
			FROM sicpro2012.vi_depmuni
			WHERE fechainiciocontrato >= '".$fechai."' AND fechafincontrato <= '".$fechaf."'
			GROUP BY departamento");
			$this->set('departamentos', Hash::extract($deps, '{n}.0'));
		
		$this->set('inicio',$fechai);
		$this->set('fin',$fechaf);
		$this->render();
	}

}