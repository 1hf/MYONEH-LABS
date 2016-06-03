<?php
App::uses('AppController', 'Controller');

class DetailController extends AppController
{
	var $layout = "innerpage-layout";	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestPackage','PackageTest');	
	public $name = 'Detail';
	var $components = array('Encryption');
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow();
	//	$this->Session->delete('searchArr');
	}
	public function maptest(){
		//  $this->layout = "ajax";
		// $this->autoRender = false;
	}
	public function index($package_id){
		$package_id=$this->Encryption->deCrypt($package_id);
	 	if($package_id!=''){			
			$package_details=$this->TestPackage->find('all',array(			
				'fields' => array('TestPackage.*','Clinic.*','Area.*'),
				'conditions' => array('TestPackage.id'=>$package_id),
				'joins' => array(
								 array( 'table' => 'clinics',
										'alias' => 'Clinic',
										'conditions'=> array('Clinic.id = TestPackage.clinic_id')
								), array( 'table' => 'areas',
										'alias' => 'Area',
										'conditions'=> array('Clinic.area_id = Area.id')
								)
							),
				'recursive' => 1			
				)
			);
			$searchPackageValue=$this->Session->read('searchPackageValue');
			$condtn_package=""; $addfield=" ";
			if($searchPackageValue=="All"){
				$orderString=" RAND()";	
				$condtn_package=" 1=1 ";		
			}else{
				$addfield=" ((LENGTH(package_category) - LENGTH(REPLACE(package_category, ',', '$searchPackageValue')))+1) as countPackageCat, ";
				$orderString=" RAND(), countPackageCat DESC ";	
				$condtn_package=" FIND_IN_SET('$searchPackageValue',`package_category`) "	;
				
			}
			//debug($package_details);
			$this->set('selected_package_name', $package_details[0]['TestPackage']['package_name']);
			$this->set('packageDetails', $package_details[0]);
			//finding 2 related packages for related packages display.
			$rltd_package_details=$this->TestPackage->find('all',array(			
				'fields' => array("$addfield TestPackage.*",'Clinic.*','Area.*'),
				'conditions' => array("TestPackage.id!=".$package_details[0]['TestPackage']['id'],'Clinic.status_id=1',$condtn_package),
				'joins' => array(
								 array( 'table' => 'clinics',
										'alias' => 'Clinic',
										'conditions'=> array('Clinic.id = TestPackage.clinic_id')
								), array( 'table' => 'areas',
										'alias' => 'Area',
										'conditions'=> array('Clinic.area_id = Area.id')
								)
							),
				'recursive' => 1,
				'order' => array("$orderString"),
				'limit'=>2
				)
			);
			
			//debug($rltd_package_details);
			$this->set('rltd_package_details', $rltd_package_details);
		}	// end of packege check IF condition	
	
		$this->set('seo_tags', $package_details[0]['TestPackage']['seo_tags']);		
		$this->set('meta_title', $package_details[0]['TestPackage']['seo_tags']);
	}// end of index action
	
	
	
}?>