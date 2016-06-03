<?php
App::uses('AppModel', 'Model');

class Booking extends AppModel
{

	var $hasMany = array(						 
					'BookingTest'=> array(
						'className' => 'BookingTest',
						'foreignKey' => 'booking_id'
								)
				);
	
	/*public $hasAndBelongsToMany = array(
    'BookingTest' =>
        array(
            'className' => 'BookingTest',
            'joinTable' => 'booking_tests',
            'foreignKey' => 'booking_id',
            'associationForeignKey' => 'clinic_test_id',
            'unique' => true,
        )
		);*/
}
?>