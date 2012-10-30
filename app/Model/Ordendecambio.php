<?php
class Ordendecambio extends AppModel {
public $useTable = 'ordendecambio';
public $primaryKey = 'idordencambio';

		public $validate=array(
			'fecharegistroorden'=>array(
				'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
				)
			)
		);

		public function beforeSave($options = array()) {
			if(!empty($this->data['Ordendecambio']['fecharegistroorden'] )){
				$this->data['Ordendecambio']['fecharegistroorden'] = $this->dateFormatBeforeSave($this->data['Ordendecambio']['fecharegistroorden']);
			}

			//Debugger::dump($this->data);
		    return true;
		}
		
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
}
?>
