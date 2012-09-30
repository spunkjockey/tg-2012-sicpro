<?php
    class InformetecnicosController extends AppController{
	    public function informetecnico_registrar()
	    {
	    	$this->layout = 'cyanspark';
			$this->set('contratos',$this->Informetecnico->find('list',array(
										'fields'=>array())));	
	    }
	}
?>