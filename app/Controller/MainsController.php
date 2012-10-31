<?php
class MainsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
	public $uses = array('Proyecto');
		
	public function index() {
		//$this->layout = 'cyanspark';
		$this->set('title_for_layout', 'Index');
		$proyectos = $this->Proyecto->query('SELECT 
				  proyecto.numeroproyecto, 
				  proyecto.nombreproyecto, 
				  proyecto.montoplaneado, 
				  proyecto.estadoproyecto, 
				  SUM(financia.montoparcial) montoreal, 
				  COUNT(contrato.idcontrato) numcontratos, 
				  SUM(contrato.montooriginal) + SUM(contrato.variacion) AS montocontratos
				FROM 
				  sicpro2012.proyecto, 
				  sicpro2012.financia, 
				  sicpro2012.contrato
				WHERE 
				  proyecto.idproyecto = financia.idproyecto AND
				  proyecto.idproyecto = contrato.idproyecto
				GROUP BY
				  proyecto.numeroproyecto, 
				  proyecto.nombreproyecto, 
				  proyecto.montoplaneado, 
				  proyecto.estadoproyecto
				ORDER BY
				  proyecto.numeroproyecto DESC
				LIMIT 10;');
		$this->set('proyectos',$proyectos);

		//Debugger::dump($proyectos);
        switch ($this->Session->read('User.idrol')) {
			case 9:
		        $this->render('/Mains/master', 'cyanspark');
		        break;
		    case 8:
		        $this->render('/Mains/observer', 'cyanspark');
		        break;
		    case 7:
		        $this->render('/Mains/jefeplan', 'cyanspark');
		        break;
			case 6:
		        $this->render('/Mains/tecproy', 'cyanspark');
		        break;
		    case 5:
		        $this->render('/Mains/tecplan', 'cyanspark');
		        break;
		    case 4:
		        $this->render('/Mains/adminsys', 'cyanspark');
		        break;
			case 3:
		        $this->render('/Mains/admincon', 'cyanspark');
		        break;
		    case 2:
		        $this->render('/Mains/adminproy', 'cyanspark');
		        break;
		    case 1:
		        $this->render('/Mains/director', 'cyanspark');
		        break;			
		}
		
	}


	
	
}