
<?php
class RolsController extends AppController {
    public $helpers = array('Html', 'Form');
	public $name = 'Rols';
    public $components = array('Session');

	
	public function index() {
        $this->set('rols', $this->Rol->find('all'));
	}
	 public function view($id = null) {
        $this->Rol->id = $id;
        $this->set('rol', $this->Rol->read());
    }
	
	public function add() {
    if ($this->request->is('rol')) {
        $this->request->data['rol']['user_id'] = $this->Auth->user('id'); //Added this line
        if ($this->rol->save($this->request->data)) {
            $this->Session->setFlash('Your rol has been saved.');
            $this->redirect(array('action' => 'index'));
        }
    }
}
	
	function edit($id = null) {
    $this->Rol->id = $id;
    if ($this->request->is('get')) {
        $this->request->data = $this->Rol->read();
    } else {
        if ($this->Rol->save($this->request->data)) {
            $this->Session->setFlash('Your rol has been updated.');
            $this->redirect(array('action' => 'index'));
        }
    }
}

function delete($id) {
    if (!$this->request->is('rol')) {
        throw new MethodNotAllowedException();
    }
    if ($this->Rol->delete($id)) {
        $this->Session->setFlash('The rol with id: ' . $id . ' has been deleted.');
        $this->redirect(array('action' => 'index'));
    }
}
public function isAuthorized($user) {
    // All registered users can add posts
    if ($this->action === 'add') {
        return true;
    }

    // The owner of a post can edit and delete it
    if (in_array($this->action, array('edit', 'delete'))) {
        $postId = $this->request->params['pass'][0];
        if ($this->Rol->isOwnedBy($rolId, $user['id'])) {
            return true;
        }
    }

    return parent::isAuthorized($user);
}
}