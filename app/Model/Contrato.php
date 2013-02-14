<?php
    class Contrato extends AppModel {
        public $name = 'Contrato';
		public $useTable = 'contrato';
		public $primaryKey = 'idcontrato';
		
		public $belongsTo = array(
			'Persona'=> array(
				'className'    => 'Persona',
				'foreignKey'   => 'idpersona'
				),
			'Proyecto' => array(
				'className'    => 'Proyecto',
				'foreignKey'   => 'idproyecto'
				),
			'Realproyecto' => array(
				'className'    => 'Realproyecto',
				'foreignKey'   => 'idproyecto'
				),
			'Empresa' => array(
				'className'    => 'Empresa',
				'foreignKey'   => 'idempresa'
				)
			);
		
		public $validate = array(

			'ordeninicio' => array(
		        'rule'       => array('date', 'dmy'),
		        'message'    => 'Ingrese el formato de la manera siguiente DD/MM/AAAA.',
		        'allowEmpty' => true,
				'required'=>false),
					
			'codigocontrato' => array(
				'isUnique' => array(
		        	'rule'    => 'isUnique',
		        	'message' => 'Este código de contrato ya existe'
					)),
			
			'fechafincontrato' => array(
	        	'formatofecha'=>array(
					'rule'       => array('date', 'dmy'),
			        'message'    => 'Ingrese fecha fin con el siguiente formato DD/MM/AAAA.',
			        'allowEmpty' => true,
					'required'=>false
					)
				),
				'montooriginal' => array(
					'montocorrecto' => array(
		            	'rule'    => array('montocorrecto'),
		            	'message' => 'El monto del contrato supera el monto del proyecto'
		        	)
				),
	        	'fechainiciocontrato' => array(
					'visitamenorigual'=>array(
						'rule'=>array('iniciomenor'),
	            		'message' => 'La fecha de inicio de contrato debe ser menor a la fecha de fin del contrato'),
					'formatofecha'=>array(
						'rule'       => array('date', 'dmy'),
				        'message'    => 'Ingrese fecha de inicio con el siguiente formato DD/MM/AAAA.',
				        'allowEmpty' => true,
						'required'=>false
						)
				),
				'con_idcontrato' => array(
					'isUnique' => array(
			        	'rule'    => 'isUnique',
			            'allowEmpty' => false,
		            	'message' => 'El contrato seleccionado ya ha sido asignado'
		        		)
				),
		 
			);
			
		public function iniciomenor($check) 
		{
			
			return date_create_from_format('d/m/Y', $this->data['Contrato']['fechainiciocontrato']) < date_create_from_format('d/m/Y', $this->data['Contrato']['fechafincontrato']);
    	
		}
				
		public function montocorrecto($check) {
			//Debugger::dump($this->data);
			$mproyecto = $this->Realproyecto->find('first',array(
				'fields' => array('Realproyecto.montoreal'),
				'conditions' => array('Realproyecto.idproyecto' => $this->data['Contrato']['idproyecto']),
				'recursive' => 0
			));
	
			$mcontrato = $this->query("SELECT 
										  proyecto.idproyecto, 
										  SUM(contrato.montooriginal) + SUM(contrato.variacion) totalmonto
										FROM 
										  sicpro2012.proyecto, 
										  sicpro2012.contrato
										WHERE 
										  proyecto.idproyecto = contrato.idproyecto AND
										  contrato.codigocontrato NOT IN ('". $this->data['Contrato']['codigocontrato'] ."') AND
										  proyecto.idproyecto = ". $this->data['Contrato']['idproyecto'] ."
										GROUP BY
										 proyecto.idproyecto;");
			
			  
	
			  //Debugger::dump($this->data);
			  //Debugger::dump($mproyecto['Realproyecto']['montoreal']);
			  //Debugger::dump(Hash::get($mcontrato,'0.0.totalmonto'));
			  $montodisponible = (float) $mproyecto['Realproyecto']['montoreal'] - (float) Hash::get($mcontrato,'0.0.totalmonto');
			  //Debugger::dump($check['montooriginal']); 
			  //Debugger::dump(round($montodisponible,2));
			  //Debugger::dump($check['montooriginal'] <= (float) round($montodisponible,2));
	          return (float) $check['montooriginal'] <= (float) round($montodisponible,2);
	        //return false;
	
	    }
		
		
		public function beforeSave($options = array()) {
		    if (!empty($this->data['Contrato']['fechainiciocontrato']) && !empty($this->data['Contrato']['fechafincontrato'])) {
		        $this->data['Contrato']['fechainiciocontrato'] = $this->dateFormatBeforeSave($this->data['Contrato']['fechainiciocontrato']);
		        $this->data['Contrato']['fechafincontrato'] = $this->dateFormatBeforeSave($this->data['Contrato']['fechafincontrato']);
	   
			}
			if(!empty($this->data['Contrato']['ordeninicio'] )){
				$this->data['Contrato']['ordeninicio'] = $this->dateFormatBeforeSave($this->data['Contrato']['ordeninicio']);
			}
			//Debugger::dump($this->data);
		    return true;
		}
		
		
		public function dateFormatBeforeSave($dateString) {
		    
    		list($d, $m, $y) = explode('/', $dateString);
    		$mk=mktime(0, 0, 0, $m, $d, $y);
    		return strftime('%Y-%m-%d',$mk);
		}
		
	};