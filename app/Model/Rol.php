<?php
class Rol extends AppModel {
public $name = 'Rol';
public $useTable= 'Rol';


 public $validate = array(
        'title' => array(
            'rule' => 'notEmpty'
        ),
        'body' => array(
            'rule' => 'notEmpty'
        )
    );
}


?>