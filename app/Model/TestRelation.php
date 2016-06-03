<?php
App::uses('AppModel', 'Model');

class TestRelation extends AppModel
{
	var $belongsTo =array(		
			
			'Test' => array(
				'className' => 'Test',
				'foreignKey' => 'test_id'		
			),					
			
		);
	
}
?>