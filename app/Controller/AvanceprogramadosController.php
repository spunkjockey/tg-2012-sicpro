<?php
class AvanceprogramadosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax');
    public $components = array('Session');
	public $uses = array('Contratoconstructor','Proyecto','Avanceprogramado');
	
	public function index() {
	    $this->layout = 'cyanspark';
		
		//Recuperar el numero de proyecto
		$lProyectos = $this->Proyecto->find('all', array(
			'fields'=>array('Proyecto.idproyecto','Proyecto.numeroproyecto'),
			'order'=>'Proyecto.numeroproyecto ASC'//,
			//'conditions'=>'Fuentefinanciamiento.idfuentefinanciamiento NOT IN (SELECT ff.idfuentefinanciamiento FROM financia AS ff WHERE ff.idproyecto='.$id['Proyecto']['idproyecto'].') 
				//AND Fuentefinanciamiento.montodisponible <> 0'
		));
    	$this->set('Proyectos', Set::combine($lProyectos, "{n}.Proyecto.idproyecto","{n}.Proyecto.numeroproyecto"));
		
		//Primer Id
		$id = $this->Proyecto->find("first",array(
			'fields' => array('Proyecto.idproyecto', 'Proyecto.numeroproyecto'),
			'order' => array('Proyecto.numeroproyecto')
		));
		
		//Recuperar los contratos asociados a dicho proyecto
		$lContratos = $this->Contratoconstructor->find('all', array(
			'fields'=>array('Contratoconstructor.idcontrato','Contratoconstructor.codigocontrato'),
			'order'=>'Contratoconstructor.codigocontrato ASC',
			'conditions'=>array('Contratoconstructor.idproyecto'=>$id['Proyecto']['idproyecto'])
		));
		
		
        
    }
	
}