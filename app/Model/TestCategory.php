<?php
App::uses('AppModel', 'Model');

class TestCategory extends AppModel
{

	var $hasMany = array(
						'Test'=> array(
							'className' => 'Test',
							'foreignKey' => 'category_id'
								),
						
				);
}
?>