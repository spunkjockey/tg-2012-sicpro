<?php
class EmpresasController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','Javascript','Js');
    public $components = array('Session','RequestHandler');
	public $uses = array('Empresa','Empresaconsuper');

    public function index() {
    	$this->layout = 'cyanspark';
        $this->set('empresas', $this->Empresa->find('all'));
    }
	
	public function view($id = null) {
		$this->layout = 'cyanspark';
        $this->Empresa->id = $id;
		if (!$this->Empresa->read()) {
        	throw new NotFoundException('No se puede encontrar la Empresa', 404);
    	} else {
        	$this->set('empresas', $this->Empresa->read());
		}
    }
	
	public function view_w($id = null) {
		//$this->layout = 'cyanspark';
        $this->Empresa->id = $id;
		if (!$this->Empresa->read()) {
        	throw new NotFoundException('No se puede encontrar la Empresa', 404);
    	} else {
        	$this->set('empresas', $this->Empresa->read());
		}
		$this->render('view_w','ajax');
    }

	
	public function empresa_registrar() {
		$this->layout = 'cyanspark';
        if ($this->request->is('post')) {
				    if ($this->Empresa->save($this->request->data, array('validate' => true, 'callbacks' => true))) {


		            	$this->Session->setFlash('La Empresa '. $this->request->data['Empresa']['nombreempresa'] .' ha sido registrada.','default',array('class' => 'success'));

		            	$this->redirect(array('action' => 'index'));
		        	} else {
		            	$this->Session->setFlash('No se pudo realizar el registro' );
		        	}			
		}
    }

	function empresa_modificar($id = null) {
		$this->layout = 'cyanspark';
	    $this->Empresa->id = $id;
		if (!$this->Empresa->read()) {
        	throw new NotFoundException('Imposible editar la Empresa', 404);
    	} else {
		    if ($this->request->is('get')) {
		        $this->request->data = $this->Empresa->read();
		    } else {
		        if ($this->Empresa->save($this->request->data)) {
		            $this->Session->setFlash('La Empresa '. $this->request->data['Empresa']['nombreempresa'] .' ha sido modificada.','default',array('class' => 'success'));
		            $this->redirect(array('action' => 'index'));
		        } else {
	            	$this->Session->setFlash('Imposible editar Empresa');
	        	}
		    }
		}
	}
	
	function delete($id) {
		$empresa = $this->Empresa->findByIdempresa($id);
		if (!$this->request->is('post')) {
	        throw new MethodNotAllowedException();
	    }
	    if ($this->Empresa->delete($id)) {
	        $this->Session->setFlash('La Empresa '. $empresa['Empresa']['nombreempresa'] .' ha sido eliminada.','default',array('class' => 'success'));
	        $this->redirect(array('action' => 'index'));
	    } else {
			$this->Session->setFlash('La Empresa '. $empresa['Empresa']['nombreempresa'] .' no se puede eliminar, mientras se encuentra asignada a un contrato.');
			$this->redirect(array('action' => 'index'));
		}
	}
	
	function empresa_rephistorial()
	{
		$this->layout = 'cyanspark';
		if($this->request->is('post')) 
		{
			$this->redirect(array('action' => 'empresa_rephistorial_result',$this->request->data['Empresa']['empresas']));
		}
	}
	
	function empresa_rephistorial_result($idempresa = null)
	{
		$this->layout = 'cyanspark';
		$this->set('datos',$this->Empresaconsuper->find('all',array(
			'fields'=>array('Empresaconsuper.codigosuper','Empresaconsuper.montooriginal','Empresaconsuper.plazoejecucion',
							'Empresaconsuper.ordeninicio','Empresaconsuper.nomcompleto','Empresaconsuper.constructora',
							'Empresaconsuper.empresasup'),
			'conditions'=>array('Empresaconsuper.empresasup'=>$idempresa)
			)));
		$this->set('nombre',$this->Empresa->field('nombreempresa',array('idempresa'=>$idempresa)));
		if($this->request->is('post')) 
		{
			$this->redirect(array('action' => 'empresa_rephistorial_result_pdf',
								$this->request->data['Empresa']['empresasup']));
		}
	}
	
	function empresa_rephistorial_result_pdf($idempresa = null)
	{
		Configure::write('debug',0);
		$this->layout = 'pdf'; //esto utilizara el layout 'pdf.ctp'
		
		$this->set('datos',$this->Empresaconsuper->find('all',array(
			'fields'=>array('Empresaconsuper.codigosuper','Empresaconsuper.montooriginal','Empresaconsuper.plazoejecucion',
							'Empresaconsuper.ordeninicio','Empresaconsuper.nomcompleto','Empresaconsuper.constructora',
							'Empresaconsuper.empresasup'),
			'conditions'=>array('Empresaconsuper.empresasup'=>$idempresa)
			)));
		$this->set('nombre',$this->Empresa->field('nombreempresa',array('idempresa'=>$idempresa)));
		
		$this->render();
	}

	function empresarepjson()
	{
		$empresas = $this->Empresa->find('all',array(
							'fields' => array('Empresa.idempresa', 'Empresa.nombreempresa'),
							'conditions'=>array('Empresa.idempresa IN (SELECT idempresa FROM sicpro2012.contratosupervisor)')));
		$this->set('empresas', Hash::extract($empresas, "{n}.Empresa"));
		$this->set('_serialize', 'empresas');
		$this->render('/json/jsonempresa');	
	}
}