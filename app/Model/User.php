<?php
// app/Model/User.php
class User extends AppModel {
    public $name = 'User';
    //public $cacheQueries = true;
	public $belongsTo = array(
			'Rol' => array(
				'className'    => 'Rol',
				'foreignKey'   => 'idrol'
				) 
			);
			
    public $validate = array(
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'El Nombre de Usuario es obligatorio'
            ),
            'unique' => array(
		        'rule' => 'isUnique',
		        'required' => 'create',
		        'message' => 'El nombre de usuario ya existe'
		    )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'La Contraseña es obligatoria'
            ),
			'matchPass' => array(
                'rule' => array('matchPass'),
                'message' => 'La contraseña es invalida',
                'on' => 'update'
            )
        ),
        'nombrespersona'=>array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Ingrese nombre del usuario'
            ),
            'soloLetras' => array(
				'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
	        	'message' => 'Solo Letras'
	        )
		),
		'apellidospersona'=>array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Ingrese apellido del usuario'
            ),
            'soloLetras' => array(
				'rule'    => '/^[a-zA-ZáéíóúAÉÍÓÚÑñ\s]{2,}$/i',
	        	'message' => 'Solo Letras'
	        )
		),
		'roles'=>array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Seleccione'
            )
		),
		'estado'=>array(
			'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Seleccione'
            )
		)
        
		
    );
	
	public $virtualFields = array(
		'nombrecomun' => "initcap(split_part(nombre, ' ', 1) || ' ' || split_part(apellidos, ' ', 1))"
		
	);
	
	
	public function beforeSave($options = array()) {
	    if (isset($this->data[$this->alias]['password'])) {
	        $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
	    }
	    return true;
	}

	public function matchPass($check) {
		//Debugger::dump($this->data);
		if(isset($this->data['User']['oldpass'])) {
			$resultado = $this->find('count',array('conditions' => array(
				'User.id' => $this->data['User']['id'],
				'User.password' => AuthComponent::password($this->data['User']['oldpass']))));
			//Debugger::dump($resultado);
			return $resultado;
		} else {
			return true;
		}
	}

}