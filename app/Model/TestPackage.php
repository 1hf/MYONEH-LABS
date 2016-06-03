<?php
App::uses('AppModel', 'Model');

class TestPackage extends AppModel
{
		var $hasMany = array(						 
					'PackageTest' => array(
							'className' => 'PackageTest',
							'foreignKey' => 'test_package_id'		
						),
			);
	
}
?>