<?php
App::uses('AppModel', 'Model');

class Search extends AppModel
{
		var $hasMany = array(						 
					'SearchTest'=> array(
						'className' => 'SearchTest',
						'foreignKey' => ''
								)
				);
}
?>