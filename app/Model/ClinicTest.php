<?php
App::uses('AppModel', 'Model');

class ClinicTest extends AppModel
{
	var $belongsTo =array(		
			'Clinic' => array(
				'className' => 'Clinic',
				'foreignKey' => 'clinic_id'		
			),	
			'Test' => array(
				'className' => 'Test',
				'foreignKey' => 'test_id'		
			),					
			
		);
	var $hasMany = array(						 
					'BookingTest'=> array(
						'className' => 'BookingTest',
						'foreignKey' => 'clinic_test_id'
								)
				);
}
?>