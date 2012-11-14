<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {
	//...
	public $helpers = array('Ajax');
	public $uses = array('Notificacion');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'mains', 'action' => 'index'),
            'logoutRedirect' => array('controller' => 'mains', 'action' => 'index'),
            //'logoutRedirect' => array('controller' => 'pages', 'action' => 'display', 'home')
        )
    );

    /*
	  
	 public function beforeFilter() {
        $this->Auth->allow('index', 'view');
    }
	
	  */
    //...
	
	
	 public function beforeFilter() {
     
        $this->set('notificaciones',$this->Notificacion->find('all',array(
			'conditions' => array("Notificacion.creacion >= now() - interval '30 day'"),
			'order' => array('Notificacion.creacion DESC'))));
			
    }
}
