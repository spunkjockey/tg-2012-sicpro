<?php
class MainsController extends AppController {
    public $helpers = array('Html', 'Form', 'Session');
    public $components = array('Session','RequestHandler');
		
	public function index() {
		$this->layout = 'cyanspark';
		$this->set('title_for_layout', 'Index');
        //$this->set('posts', $this->Post->find('all'));
        //$this->set('posts', $this->paginate());
        //$this->set('_serialize', array('posts'));
		
	}
	
	
}