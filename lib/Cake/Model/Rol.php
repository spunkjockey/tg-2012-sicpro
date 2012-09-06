<?php
class Rol extends AppModel {
	public $name = 'Rol';

    public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
	public function isOwnedBy($rol, $user) {
    return $this->field('id', array('id' => $rol, 'user_id' => $user)) === $rol;
}
}