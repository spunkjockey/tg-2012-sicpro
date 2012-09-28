<?php
    class ContratoconstructorsController extends AppController {
	    public $helpers = array('Html', 'Form', 'Session','ajax');
	    public $components = array('Session');
		public $uses = array('Contratoconstructor','Contrato','Proyecto','Empresa','Persona');
		
		public function add()
		{
			$this->layout = 'cyanspark';
			$this->set('proys',$this->Proyecto->find('list', array(
												 'fields'=> array('Proyecto.idproyecto','Proyecto.nombreproyecto'),
												 'conditions'=>array( "OR" => array('Proyecto.estadoproyecto' => array('Licitacion','Adjudicacion'))))));
			
			$this->set('empresas',$this->Empresa->find('list',array(
												 'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa'))));
			
			
			$adm = $this->Persona->query("SELECT personas.idpersona, (nombrespersona||' '||apellidospersona) AS nomcompleto FROM sicpro2012.persona AS personas;");
			$this->set('administradores', Set::combine($adm, "{n}.0.idpersona","{n}.0.nomcompleto"));
			
			if($this->request->is('post'))
			{
				//Registro en contrato
				$this->Contrato->create();
				$this->Contrato->set('idproyecto', $this->request->data['Contratoconstructor']['proys']);
				$this->Contrato->set('idpersona', $this->request->data['Contratoconstructor']['administradores']);
				$this->Contrato->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
				$this->Contrato->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
				$this->Contrato->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
				$this->Contrato->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
				$this->Contrato->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
				$this->Contrato->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
				$this->Contrato->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
				$this->Contrato->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
				$this->Contrato->set('tipocontrato', 'Construcción de obras');
				$this->Contrato->set('userc', $this->Session->read('User.username'));
				//$montoori = (float)$monto*0.05;
				
				if ($this->Contrato->save()) 
				{
					//Registro en contrato constructor
					$this->Contratoconstructor->set('idcontrato',$this->Contrato->id);
					$this->Contratoconstructor->set('idproyecto',$this->request->data['Contratoconstructor']['proys']);
					$this->Contratoconstructor->set('idpersona', $this->request->data['Contratoconstructor']['administradores']);
					$this->Contratoconstructor->set('idempresa', $this->request->data['Contratoconstructor']['empresas']);
					$this->Contratoconstructor->set('codigocontrato', $this->request->data['Contratoconstructor']['codigocontrato']);
					$this->Contratoconstructor->set('nombrecontrato', $this->request->data['Contratoconstructor']['nombrecontrato']);
					$this->Contratoconstructor->set('montooriginal', $this->request->data['Contratoconstructor']['montocon']);
					$this->Contratoconstructor->set('plazoejecucion', $this->request->data['Contratoconstructor']['plazoejecucion']);
					$this->Contratoconstructor->set('fechainiciocontrato', $this->request->data['Contratoconstructor']['fechainicontrato']);
					$this->Contratoconstructor->set('fechafincontrato', $this->request->data['Contratoconstructor']['fechafincontrato']);
					$this->Contratoconstructor->set('detalleobras', $this->request->data['Contratoconstructor']['obras']);
					$this->Contratoconstructor->set('tipocontrato', 'Construcción de obras');
					$this->Contratoconstructor->set('retencion', $this->request->data['Contratoconstructor']['montocon']*0.05);
					$this->Contratoconstructor->set('anticipo', $this->request->data['Contratoconstructor']['anticipo']);
					$this->Contratoconstructor->set('userc', $this->Session->read('User.username'));
	                
					if($this->Contratoconstructor->save($this->Contrato->id))
					{
						$this->Session->setFlash('Contrato constructor ha sido registrado.','default',array('class'=>'success'));	
						$this->redirect(array('controller'=>'mains', 'action' => 'index'));
						
					}
					else 
					{
						$this->Session->setFlash('Ha ocurrido un error');
	                }
				}
				else 
				{
					$this->Session->setFlash('Ha ocurrido un error');
                }
				
			}
			
		}
	public function contrato_actualizarestado(){
		$this->layout = 'cyanspark';
		//Cargar el primero Combobox con los Proyectos
		$this->set('proyectos',$this->Proyecto->find('list', 
		array('fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
			  'order'=>'Proyecto.numeroproyecto ASC')));
			  
		$primer_proyecto = $this->Proyecto->find('first',
		array('fields'=>'Proyecto.idproyecto','order'=>'Proyecto.numeroproyecto ASC'));
		
		//Cargar el Segundo Combobox con los Contratos del primer proyecto
		$this->set('contratos', $this->Contrato->find('list',
		array('fields'=>array('Contrato.idcontrato','Contrato.codigocontrato'),'order'=>'Contrato.codigocontrato ASC',
		'conditions'=>'Contrato.idproyecto='.$primer_proyecto['Proyecto']['idproyecto'])
		));
		
		/*Debugger::dump($this->Contratoconstructor->find('all',
		array('fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato',
		'Contratoconstructor.nombrecontrato','Contratoconstructor.estadocontrato'),'order'=>'Contratoconstructor.codigocontrato ASC',
		'conditions'=>'Contratoconstructor.idproyecto='.$primer_proyecto['Proyecto']['idproyecto'])
		));*/
		
		
		$this->set('info',$this->Contratoconstructor->findByIdcontrato($primer_proyecto['Proyecto']['idproyecto']));
		
		if($this->request->is('post'))
			{
				$id = $this->request->data['Estado']['contratos']['idcontrato'];
				//Debugger::dump($this->Contratoconstructor->set('idproyecto', $this->request->data['Estado']['proyectos']));
				$this->Contratoconstructor->read(null, $id);
				$this->Contratoconstructor->set('estadocontrato', $this->request->data['Estado']['Estados']);	
				$this->Contratoconstructor->set('userm', $this->Session->read('User.username'));		
				$this->Contratoconstructor->set('modificacion', date('Y-m-d h:i:s'));
				if ($this->Contratoconstructor->save($id)) {
		            $this->Session->setFlash('El Estado del Contrato constructor ha sido actualizado.','default',array('class'=>'success'));
		            $this->redirect(array('action' => 'contrato_actualizarestado'));
			        } else {
		            	$this->Session->setFlash('Imposible actualizar el estado del contrato constructor');
	        	}
			}
		
	}

	function update_selectContrato()
        {
                if (!empty($this->data['Estado']['proyectos']))
                {
                        $proyecto_id = $this->data['Estado']['proyectos'];
                        $contratos= $this->Contrato->find('all', array(
	                        'fields'=>array('Contrato.idcontrato','Contrato.codigocontrato'),
	                        'order'=>'Contrato.codigocontrato ASC',
	                        'conditions'=>array('Contrato.idproyecto'=>$proyecto_id)));
                }
                $this->set('options', Set::combine($contratos, "{n}.Contrato.idcontrato","{n}.Contrato.codigocontrato"));
                $this->render('/elements/update_selectContrato', 'ajax');
        }
		
		
	function update_infocontrato(){
				 if (!empty($this->data['Estado']['contratos']))
		                {
		                        $contrato_id = $this->data['Estado']['contratos']['idcontrato'];
		                        $contrato= $this->Contratoconstructor->find('all', array(
			                        'fields'=>array(
			                        'Contratoconstructor.nombrecontrato','Contratoconstructor.estadocontrato'),
			                        'conditions'=>array('Contratoconstructor.idcontrato'=>$contrato_id)));
		                }
				$this->set('informacion',$contrato);
				/*$this->set('informacion', Set::combine($contrato,
				"{s}.Contratoconstructor.nombrecontrato",
				"{s}.Contratoconstructor.estadocontrato"
				));*/		
				$this->render('/elements/update_infocontrato', 'ajax');
	}	
	
}
