<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');
App::import('Vendor','nusoap');

class ApiController extends AppController
{	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestCategory');	
	public $name = 'Api';
	var $autoRender = false;
	
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow();
		$this->Session->delete('searchArr');
                
	}
	// join referrence qry
	//SELECT * FROM `test_categories` inner join tests on(test_categories.id = tests.category_id) inner join clinic_tests on(tests.id = clinic_tests.test_id) where tests.id=1
	public function loadTest(){
		$searchTerm=$this->request->query['testname'];
		$response = array();	
		echo "hai prabha";
		$result_arr=$this->TestCategory->query("SELECT DISTINCT test_name, TestCategory.id, 
				`TestCategory`.`category_name`, `Test`.`id`, `Test`.`category_id` FROM 
				`test_categories` AS `TestCategory` JOIN `tests` AS `Test` ON (`TestCategory`.`id` = `Test`.`category_id`) 
				WHERE (category_name like '%$searchTerm%' OR `Test`.`test_name` like '%$searchTerm%') 
				AND `Test`.`status_id`=1 AND `TestCategory`.`status_id`=1 
				GROUP BY `TestCategory`.`category_name` LIMIT 10");
		$i=0;
		//debug($result_arr);
		foreach($result_arr as $item){
			$rltd_test_string_arr=array();
			$response[$i]['value'] = $item['TestCategory']['id'];
			$response[$i]['label']=ucwords($item['TestCategory']['category_name']);
			unset($item['Test']['id']);
			unset($item['Test']['category_id']);
			unset($item['Test']['test_name']);
			//debug($item);
		
			$m=1;
			foreach($item['Test'] as $testDesc){
				if($m==4 || $m==8)	{
					$test_string=" </br>".ucwords(strtolower($testDesc['test_name']));
				}else{
					$test_string=" ".ucwords(strtolower($testDesc['test_name']));
				}
				$string_old=$test_string;
				array_push($rltd_test_string_arr,$test_string);
				$m++;
		
			}
			$response[$i]['desc']=implode(",",$rltd_test_string_arr);
			$i++;
		}
		//debug($response);
		return json_encode($response);
		exit;
	}
	public function loadLocation(){
		$searchTerm=$this->request->query['areaName'];
	//	$searchTerm='ind';
		$response = array();
		$result_arr=$this->Area->query("SELECT DISTINCT areas.area_name,areas.id FROM areas WHERE
			(area_name like '%$searchTerm%'	) LIMIT 5");
		
		
		$i=0;
		//debug($result_arr);
		foreach($result_arr as $item){
			$rltd_test_string_arr=array();
			$response[$i]['id'] = $item['areas']['id'];
			$response[$i]['value'] = $item['areas']['area_name'];
			//$response[$i]['label']=ucwords($item['TestCategory']['category_name']);
			unset($item['Test']['id']);
			//unset($item['Test']['category_id']);
			unset($item['Area']['area_name']);
			//debug($item);
			
		}
		//debug($result_arr);
		return json_encode($response);
		exit;
		
	}

	
	public function listDiagnostics(){
		
		$tests_array= array();
		$conditions = array();$stringTestCond='';	$stringAreaCond='';$orderbyString='';
		$selected_tests_arr=array();$additionalAreaFilterCondn='';$searchArr=array(); $areaID=array();	$homeColltnFilterCondn='';
		$additionalClinicFilterCondn='';
		//debug($_REQUEST);
		 $jsonString= str_replace("%22",'"',$_REQUEST['jString']);
		$postSearchResults= json_decode($jsonString,true);
			//debug($postSearchResults);
		foreach($postSearchResults['filterResults'] as $result){
			//debug($result);
			if(!empty($result['tests'])){
				$searchTestArr=$result['tests'];
			}
			if(!empty($result['AreaID'])){
				$searchAreaArr=json_decode($result['AreaID']);
				$areaString=implode(',',$searchAreaArr->AreaIDS);
				if($areaString!="")
					$additionalAreaFilterCondn=" AND clinics.area_id IN ( ".$areaString." )";
				else
					$additionalAreaFilterCondn='';
			}
			if(!empty($result['HomeCollection'])){
				$HomeCollection=json_decode($result['HomeCollection']);
				$HomeCollectionString=implode(',',$HomeCollection->HOmeCollection);
				if($HomeCollectionString!="" && $HomeCollectionString==1)
					if(!empty($searchTestArr->testSearch)){
					$homeColltnFilterCondn=" AND clinics.home_collection =1 and clinic_tests.home_collection=1 ";
				}else if(!empty($searchTestArr->packageSearch)){
					$homeColltnFilterCondn=" AND clinics.home_collection =1 and test_packages.home_collection=1 ";
				}
				else
					$homeColltnFilterCondn='';
			}
			if(!empty($result['ClinicID'])){
				$searchClinicArr=json_decode($result['ClinicID']);
				$clinicString=implode(',',$searchClinicArr->ClinicIDS);
				if($clinicString!="")
					$additionalClinicFilterCondn=" AND clinics.id IN ( ".$clinicString." )";
				else
					$additionalClinicFilterCondn='';
			}
		}
		
		if(!empty($searchTestArr['testsearch'])){			
			foreach($searchTestArr['testsearch'] as $item){
				
				$TestDetails = $this->Test->query("SELECT `Test`.`test_name`,`Test`.`id`,`Test`.`category_id`  FROM `tests` AS `Test`
					INNER JOIN `test_categories` AS `TestCategory` ON (`Test`.`category_id` = `TestCategory`.`id`) WHERE Test.status_id=1 AND `TestCategory`.`category_name` ='$item'");
				@$category_id=$TestDetails[0]['Test']['category_id'];
				if($category_id !=''){//finding related tests in the same category
					$ClinicTestArr = $this->Test->query("SELECT `Test`.`test_name`,`Test`.`id` FROM `tests` AS `Test` 
						INNER JOIN `test_categories` AS `TestCategory` ON (`Test`.`category_id` = `TestCategory`.`id`)
						WHERE Test.status_id=1 AND `Test`.`category_id` =$category_id");		
					//INNER JOIN `test_relations` AS `TestRelation` ON (`Test`.`id` = `TestRelation`.`test_id`)	
					if(!empty($ClinicTestArr)){
						foreach($ClinicTestArr as $rltdArr){
								array_push($tests_array,$rltdArr['Test']['id']);
						}
						$selected_tests_arr[$ClinicTestArr[0]['Test']['id']]=$ClinicTestArr[0]['Test']['test_name'];					
					}
				}
			 }
			 if(!empty($tests_array)){
			 	$stringTestCond = implode(',',$tests_array);
			 }else{
				$stringTestCond = '0'; 
			 }
		 }	
		 //here we are finding the area lattitude and longitude form the user searched area
		 if( $searchTestArr['areaSearch']){
		 	$areaDetails = $this->Area->find('first',array('fields'=>array('Area.id','Area.latitude','Area.longitude','Area.postcode'),'conditions'=>array('Area.area_name'=>$searchTestArr['areaSearch'])));
		 	$searchedAreaLatitude=$areaDetails['Area']['latitude'];
		 	$searchedAreaLongitude=$areaDetails['Area']['longitude'];
		 	$searchedAreaID=$areaDetails['Area']['id'];
		 	$stringAreaCond=", ( 3959 * acos( cos( radians($searchedAreaLatitude) ) * cos( radians(clinics.latitude ) ) * cos( radians(clinics.longitude ) - radians($searchedAreaLongitude) ) + sin( radians($searchedAreaLatitude) ) * sin( radians( clinics.latitude ) ) ) ) AS distance ";
		 	$orderbyString= " ,distance ASC";
		 }
	    if(!empty($searchTestArr['testsearch'])){// its only for tests
	  	
				$sql_find_test="SELECT count(clinic_tests.clinic_id) as countTest, clinics.*,areas.* $stringAreaCond 
				FROM clinics inner join areas on clinics.area_id=areas.id  inner join clinic_tests on clinic_tests.clinic_id= clinics.id 
				inner join tests on (clinic_tests.test_id = tests.id and clinic_tests.status_id=1)	WHERE clinic_tests.test_id IN ($stringTestCond)
				AND clinics.status_id=1 $homeColltnFilterCondn $additionalAreaFilterCondn $additionalClinicFilterCondn 
				GROUP BY clinic_tests.clinic_id HAVING count(clinic_tests.clinic_id)>=1 ORDER BY countTest DESC $orderbyString  ";
				//LIMIT $vpb_start,$vpb_total
				//echo $sql_find_test;
				$clinicLists = $this->Clinic->query($sql_find_test);
				
				$k=0; $seo_tags='';
				foreach($clinicLists as $clinicDetail){
					$clinic_id=$clinicDetail['clinics']['id'];	
					
					if(!empty($searchTestArr['testsearch'])){// its only for tests
					  $sql_test="SELECT * FROM `clinic_tests` inner join tests on (clinic_tests.test_id = tests.id)
						 where clinic_tests.test_id IN ($stringTestCond)and clinic_tests.clinic_id=$clinic_id";
						$clinicTestDetailsSub=$this->ClinicTest->query($sql_test);
					}	
					//debug($clinicTestDetailsSub);				
					$clinicLists[$k]['TestCount']=count($clinicTestDetailsSub);
					$clinicLists[$k]['TestResult']=$clinicTestDetailsSub;
					
					$k++;			
				}
							
			}
			//debug($clinicLists);
			return json_encode($clinicLists);
			exit;
				
	 }
	 //23-10-2015 // list Areas 
	 
	 public function listAreas(){
	 	$area_list=$this->Area->query("SELECT DISTINCT areas.area_name,areas.id FROM areas where status_id=1 ");
	 	return json_encode($area_list);
	 	exit;
	 	
	 }
	 public function listClinics(){
	 	$clinic_list=$this->Clinic->query("SELECT DISTINCT id,clinic_name FROM clinics WHERE status_id=1 ");
	 	return json_encode($clinic_list);
	 	exit;
	 	 
	 }
	
}

?>