<?php
class Rol extends AppModel {
public $name = 'Rol';
public $useTable= 'rol';
public $primaryKey = 'idrol';


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