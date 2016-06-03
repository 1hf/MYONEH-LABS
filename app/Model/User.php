<?php 
App::uses('AuthComponent', 'Controller/Component');
class User extends AppModel {
	
	 public $name = 'User';
	 
	 	 
	 public $hasMany = array(
	 		
	 );
	 
	 public $validate = array(
    	
        'username' => array(
            'notEmpty'=>array(
                'rule' => 'notEmpty',
                'message' => 'A email is required'
            ),
        	'email_idRule-1' => array(
        		'rule' => 'Email',
        		'message' => "Please enter valid email address.",
        		'last' => true
        	),
        ),
        'password' => array(
            'notEmpty'=>array(
                'rule' => 'notEmpty',
                'message' => 'A password is required'
            )
        )
        
    );
    
    public function beforeSave($options = array()) {
    	if (isset($this->data[$this->alias]['password'])) { 
    		$this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
    	}
    	return true;
    }
}
?>