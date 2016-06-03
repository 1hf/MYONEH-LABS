<?php
App::uses('AppModel', 'Model');

class BookingTest extends AppModel
{
	var $belongsTo =array(		
			/*'Booking' => array(
				'className' => 'Booking',
				'foreignKey' => 'booking_id'		
			),	*/		
			'ClinicTest' => array(
				'className' => 'ClinicTest',
				'foreignKey' => 'clinic_test_id'		
			),
			'Test' => array(
				'className' => 'Test',
				'foreignKey' => 'test_id'		
			),
		);
	
}
?>