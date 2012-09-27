<?php
class MainsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
		
	public function index() {
		//$this->layout = 'cyanspark';
		$this->set('title_for_layout', 'Index');
        switch ($this->Session->read('User.idrol')) {
			case 9:
		        $this->render('/mains/master', 'cyanspark');
		        break;
		    case 8:
		        $this->render('/mains/observer', 'cyanspark');
		        break;
		    case 7:
		        $this->render('/mains/jefeplan', 'cyanspark');
		        break;
			case 6:
		        $this->render('/mains/tecproy', 'cyanspark');
		        break;
		    case 5:
		        $this->render('/mains/tecplan', 'cyanspark');
		        break;
		    case 4:
		        $this->render('/mains/adminsys', 'cyanspark');
		        break;
			case 3:
		        $this->render('/mains/admincon', 'cyanspark');
		        break;
		    case 2:
		        $this->render('/mains/adminproy', 'cyanspark');
		        break;
		    case 1:
		        $this->render('/mains/director', 'cyanspark');
		        break;			
		}
		
	}
	
	
}