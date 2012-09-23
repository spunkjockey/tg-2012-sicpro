<?php
class ArchivosController extends AppController {
    public $helpers = array('Html', 'Form', 'Session','Ajax','AjaxMultiUpload.Upload');
    public $components = array('Session','AjaxMultiUpload.Upload');
	public $uses = array('Contratoconstructor','Proyecto','Avanceprogramado');


}