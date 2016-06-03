<?php
App::uses('AppModel', 'Model');

class PackageTest extends AppModel
{
	var $belongsTo =array(	
					'TestPackage' => array(
						'className' => 'TestPackage',
						'foreignKey' => 'test_package_id'		
						),					
				
			);
	
}
?>