<?php
App::uses('AppModel', 'Model');

class Test extends AppModel
{
	var $belongsTo =array(		
				
			'TestCategory' => array(
				'className' => 'TestCategory',
				'foreignKey' => 'category_id'		
			),					
			
		);
	var $hasMany = array(						 
						'BookingTest'=> array(
							'className' => 'BookingTest',
							'foreignKey' => 'test_id'
								),
						'ClinicTest'=> array(
							'className' => 'ClinicTest',
							'foreignKey' => 'test_id'
								),
								
						'TestRelation'=> array(
							'className' => 'TestRelation',
							'foreignKey' => 'test_id'
								)
				);
	
}
?>