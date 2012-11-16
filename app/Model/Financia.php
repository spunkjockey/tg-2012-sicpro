<?php
class Financia extends AppModel {
	public $name = 'Financia';
	public $useTable = 'financia';
	public $primaryKey = 'fuente_proyecto';
	public $belongsTo = array(
        'Proyecto' => array(
            'className'    => 'Proyecto',
            'foreignKey'   => 'idproyecto'
        ),
        'Fuentefinanciamiento' => array(
            'className'    => 'Fuentefinanciamiento',
            'foreignKey'   => 'idfuentefinanciamiento'
        )
    );
	public $validate = array(
		'montoparcial' => array(
			'mayorquepermitido' => array(
            	'rule'    => array('limitarMonto'),
            	'allowEmpty' => true,
            	'message' => 'El valor sobrepasa el monto disponible'
        	),
			'actualizas' => array(
            	'rule'    => array('limitarMontoActual'),
            	'allowEmpty' => true,
            	'on' => 'update',
            	'message' => 'El valor es menor al monto asignado a los contratos'
        	) 
			 /*,
			'mayorqueproyecto' => array(
            	'rule'    => array('limitarMontoProyecto'),
            	'allowEmpty' => true,
            	'message' => 'El valor sobrepasa el monto del proyecto'
        	)*/
		)
		
	);
	
	public function limitarMonto($check) {
        $monto_disponible = $this->Fuentefinanciamiento->find('first', array(
            'fields' => 'Fuentefinanciamiento.montodisponible',
            'conditions' => array('Fuentefinanciamiento.idfuentefinanciamiento ' => $this->data['Financia']['idfuentefinanciamiento'])   
			
        ));
		
		$monto_fuente = $this->find('first', array(
            'fields' => 'Financia.montoparcial',
            'conditions' => array('Financia.idproyecto ' => $this->data['Financia']['idproyecto'],
				'Financia.idfuentefinanciamiento ' => $this->data['Financia']['idfuentefinanciamiento'])
        ));
		//Debugger::dump($this->data);
		
		//Debugger::dump($check['montoparcial']);
        return round(($monto_disponible['Fuentefinanciamiento']['montodisponible'] + $monto_fuente['Financia']['montoparcial']),2) >= $check['montoparcial'];
    }
	
	
	public function limitarMontoActual($check) {
        $monto_actual = $this->find('first', array(
            'fields' => 'Financia.montoparcial',
            'conditions' => array('Financia.fuente_proyecto ' => $this->data['Financia']['fuente_proyecto'])
        ));
		//Debugger::dump($monto_actual);
		//Debugger::dump($check);
		if($monto_actual['Financia']['montoparcial'] <= $check['montoparcial']) {
			return true;
		} else {
			
			
			$monto =  $this->query('SELECT 
				  montofinancias,parcial,montocontratos,montofinancias - parcial - CASE WHEN montocontratos IS NOT NULL THEN montocontratos ELSE 0 END + '.$this->data['Financia']['montoparcial'].' AS monto 
				FROM
					(SELECT 
					  financia.idproyecto,
				          (SELECT montoparcial FROM sicpro2012.financia fin WHERE fin.fuente_proyecto = '.$this->data['Financia']['fuente_proyecto'].' ) parcial,
					  (SELECT SUM(montooriginal) + SUM(variacion) FROM sicpro2012.contrato WHERE contrato.idproyecto = financia.idproyecto) montocontratos,
					  SUM(montoparcial) montofinancias
					FROM 
					  sicpro2012.financia
					GROUP BY
					  financia.idproyecto
					  ) resum
					WHERE idproyecto = (SELECT idproyecto FROM sicpro2012.financia WHERE financia.fuente_proyecto = '.$this->data['Financia']['fuente_proyecto'].');');
	
	//Debugger::dump($monto['0']['0']['monto']);
			if($monto['0']['0']['monto']>=0)
				return true;
			else
				return false;
		}
		
		//Debugger::dump($this->data['Financia']['idfuentefinanciamiento']);
		//Debugger::dump($monto_disponible);
		//Debugger::dump($check['montoparcial']);
        
    }
	
	
	public function limitarMontoProyecto($check) {
        $monto_disponible = $this->Proyecto->find('first', array(
            'fields' => 'Proyecto.montoplaneado',
            'conditions' => array('Proyecto.idproyecto ' => $this->data['Financia']['idproyecto'])   
			
        ));
		
		$monto_utilizado = $this->query('SELECT 
				   idproyecto, SUM(montoparcial) as totalmonto 
				FROM 
				  sicpro2012.financia
				WHERE 
				  idproyecto = ' . $this->data['Financia']['idproyecto'] .'
				GROUP BY
				  idproyecto;');
		
		
		//Debugger::dump($monto_disponible['Proyecto']['montoplaneado']);
		//Debugger::dump(Hash::get($monto_utilizado, '0.0.totalmonto'));
		
		$montototal = $monto_disponible['Proyecto']['montoplaneado'] - Hash::get($monto_utilizado, '0.0.totalmonto');
		
		//Debugger::dump(round($montototal,2) . ' >= ' .$check['montoparcial']);
		
		
        return (float) round($montototal,2) >= (float) $check['montoparcial'];
    }
	
	public function beforeValidate($options = array()) {
		parent::beforeValidate(); 
	    if (!empty($this->data['Financia']['montoparcial'])) {
	        $this->data['Financia']['montoparcial'] = number_format($this->data['Financia']['montoparcial'], 2, '.', '');
	    }
		
	    return true;
	}
	
	public function beforeDelete($cascade = false) {
	    $count = $this->query('SELECT 
			  financia.fuente_proyecto, 
			  financia.idfuentefinanciamiento, 
			  financia.idproyecto, 
			  financia.montoparcial, 
			  (SELECT SUM(montoparcial) FROM sicpro2012.financia fin WHERE fin.idproyecto = financia.idproyecto AND fin.idfuentefinanciamiento != financia.idfuentefinanciamiento) montofuentes,
			  SUM(contrato.montooriginal) + SUM(contrato.variacion) montocontratos
			FROM 
			  sicpro2012.financia, 
			  sicpro2012.contrato
			WHERE 
			  financia.idproyecto = contrato.idproyecto AND 
			  financia.fuente_proyecto = '. $this->id .'
			GROUP BY 
			  financia.fuente_proyecto, 
			  financia.idfuentefinanciamiento, 
			  financia.idproyecto, 
			  financia.montoparcial;');
	    
		//Debugger::dump($count);
		//return false;
	    if ( round(Hash::get($count, '0.0.montofuentes'),2) >= round(Hash::get($count, '0.0.montocontratos'),2) ) {
	        return true;
	    } else {
	        return false;
	    }
	    
	}
	
}