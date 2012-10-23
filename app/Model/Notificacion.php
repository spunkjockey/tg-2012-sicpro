<?php
class Notificacion extends AppModel {
	public $name = 'Notificacion';
	public $useTable = 'vi_notificaciones';
    public $primaryKey = 'idnot';
	
	public $virtualFields = array(
		'fechacreacion' => "to_char(creacion, 'DD/MM/YYYY')",
		'horacreacion' => "to_char(creacion, 'HH24:MI:SS')"
	);
	
}