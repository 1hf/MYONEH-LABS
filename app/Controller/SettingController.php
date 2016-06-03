<?php
App::uses('AppController', 'Controller');

class SettingController extends AppController
{
	var $layout = "innerpage-layout";	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestPackage','PackageTest');	
	public $name = 'Setting';
	public function beforeFilter()
	{
		parent::beforeFilter();		
		//$this->Auth->allow();
	//	$this->Session->delete('searchArr');
	}
	
	
	
}
?>