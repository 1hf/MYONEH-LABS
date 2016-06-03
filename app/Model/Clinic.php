<?php
App::uses('AppModel', 'Model');

class Clinic extends AppModel
{
	public $actsAs = array('Containable');
		var $hasMany = array(						 
					'ClinicTest'=> array(
						'className' => 'ClinicTest',
						'foreignKey' => 'clinic_id'
								)
				);
}
?>