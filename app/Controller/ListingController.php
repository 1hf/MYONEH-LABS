<?php
App::uses('AppController', 'Controller');

class ListingController extends AppController
{
	var $layout = "innerpage-layout";	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestPackage','PackageTest');	
	public $name = 'Listing';
	public $helpers = array('General');
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow();
	}
	
	public function index(){
	$this->Session->write('BookingTests','');
        $this->Session->write('BookingPackage','');  
       
		if(empty($_REQUEST)){ 	
			$this->redirect(array('controller'=>'index','action'=>'index'));	
		}
		$flagTest=0;
		
		if(!empty($_REQUEST)){ 

	
	 $_SESSION['areaName'] = $_REQUEST['areaSearch'];
			$k=0;
		 if(!empty($_REQUEST['testSearch'])){
				$flagTest=1;
			 foreach($_REQUEST['testSearch'] as $item){
			  if($item==""){
					unset($_REQUEST['testSearch'][$k]);
				}else{
					$meta_title_arr[]=$item;
					
					$TestDetails = $this->Test->query("SELECT `Test`.`seo_tags`,`TestCategory`.`seo_tags`,`Test`.`id`,`Test`.`category_id`  FROM `tests` AS `Test`
					INNER JOIN `test_categories` AS `TestCategory` ON (`Test`.`category_id` = `TestCategory`.`id`) WHERE Test.status_id=1 AND `TestCategory`.`category_name` ='$item'");
					foreach($TestDetails as $dtls){
						if($dtls['Test']['seo_tags']!='' ) {
							$seo_tags_arr[]=$dtls['Test']['seo_tags']; }
							else { $seo_tags_arr[]=""; }
						if($dtls['TestCategory']['seo_tags']!='' && ($dtls['Test']['seo_tags'] != $dtls['TestCategory']['seo_tags'])) {
							 $seo_tags_arr[]=$dtls['TestCategory']['seo_tags']; }
							 else { $seo_tags_arr[]=""; }
						
					}
				}
					
				$k++;
			 }
			}else if(!empty($_REQUEST['packageSearch'])){ $this->Session->write('searchPackageValue',	$_REQUEST['packageSearch']);$this->Session->write('searchPackagesubCatValue',	$_REQUEST['package_subcat']);
				$flagTest=2;
				//print_r($_REQUEST);
				$meta_title_arr[]=$_REQUEST['packageSearch'];
				
			}
		}
			
		@$seo_tags=implode(",",$seo_tags_arr);	
		$this->set('seo_tags', $seo_tags);
		@$meta_title=implode(",",$meta_title_arr);
		$this->set('meta_title', $meta_title);
		$this->set('meta_title_arr', $meta_title_arr);
		
		$this->set('flagTest',$flagTest);	
	 	 $string=json_encode($_REQUEST);		
		$area_name='';		
		$this->set('jstring',$string);	
		$area_name=$_REQUEST['areaSearch'];
		$this->set('slctdArea',$area_name);
		$areaList = $this->Area->find('list',array('fields'=>array('Area.id','Area.area_name'),	'conditions'=> array('Area.status_id' => 1)));
//echo "<pre>"; print_r($areaList);	
		$this->set('areaList',$areaList);
		$clinicList = $this->Clinic->find('all',array(			
				'fields' => array('Clinic.id','Clinic.clinic_name','Area.area_name'),				
				'joins' => array( array( 'table' => 'areas',
										'alias' => 'Area',
										'conditions'=> array('Clinic.area_id = Area.id','Clinic.status_id' => 1)
								)
							),
				'recursive' => -1			
				)
			);
//echo '<pre>'; print_r($clinicList); exit;	
		$this->set('clinicList',$clinicList);
		
	}
	
	// this function is using for
	public function ajaxSearchFormatting(){ 
		$this->autoRender = false;		
		$srchItmsArr=array();
		parse_str($_REQUEST['jString'], $srchItmsArr);
		unset($srchItmsArr['"_method']); unset($srchItmsArr['_method']); 
//	print_r($srchItmsArr);
		if(!empty($srchItmsArr)){
			$k=0;
			if(!empty($srchItmsArr['testSearch'])){
				foreach($srchItmsArr['testSearch'] as $item){
					if($item==""){
						unset($srchItmsArr['testSearch'][$k]);
					}$k++;
				}
			}else if(!empty($srchItmsArr['packageSearch'])){
			}
		}
		
		if(empty($srchItmsArr['packageSearch']) && empty($srchItmsArr['testSearch'])){
			echo 'failed';	
		}else{
		$string=json_encode($srchItmsArr);
			echo $string;
		}
		//$this->set('jstringTestInside',$string);			
		//$area_name=$srchItmsArr['areaSearch'];
	//	$this->set('slctdArea',$area_name);
		
	}
	/* public function getlatlon($address){
	$address = str_replace(" ", "", $address);
	$url = "http://maps.google.com/maps/api/geocode/json?address=$address&region=India";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
	$response = curl_exec($ch);
	curl_close($ch);
	$response_a = json_decode($response);
	$lat2 = $response_a->results[0]->geometry->location->lat;
	$long2 = $response_a->results[0]->geometry->location->lng;
	return $address.",".$lat2.",".$long2;
} */
	public function listing($srchParms= null)
	{
		//debug($_POST);
        $this->Session->write('BookingTests','');
        $this->Session->write('BookingPackage','');            
		$this->layout = false; //making this layout false for ajax to work.
		$tests_array= array();$conditions = array();$stringTestCond='';	$stringAreaCond='';$orderbyString='';
		$selected_tests_arr=array();$additionalAreaFilterCondn='';$searchArr=array(); $areaID=array();	$homeColltnFilterCondn='';
		$additionalClinicFilterCondn='';
		$postSearchResults= json_decode($_POST['srchArrItms'],true);

		foreach($postSearchResults['filterResults'] as $result){
			if(!empty($result['tests'])){
				$searchTestArr=json_decode($result['tests']);
				$searchText = $searchTestArr->testSearch[0];
				$areaSearch = $searchTestArr->areaSearch;
				//debug($searchTestArr->areaSearch);
			}
		//$insert = "INSERT into searches values('',$searchText,$areaSearch,'','')";
			
			if(!empty($result['AreaID'])){
				$searchAreaArr=json_decode($result['AreaID']);					
				 $areaString=implode(',',$searchAreaArr->AreaIDS);
				 if($areaString!="")
				 	$additionalAreaFilterCondn=" AND clinics.area_id IN ( ".$areaString." )";
				 else
					$additionalAreaFilterCondn='';
			}

			
			if(!empty($result['HomeCollection'])){ 
			//debug($result['HomeCollection']);
				$HomeCollection=json_decode($result['HomeCollection']);
				$HomeCollectionString=implode(',',$HomeCollection->HOmeCollection);
				//echo "<script>alert('".$hcollectionnText."');</script>"; 
				if($HomeCollectionString!="" && $HomeCollectionString==1)
					if(!empty($searchTestArr->testSearch)){
				 		$homeColltnFilterCondn=" AND clinics.home_collection =1 and clinic_tests.home_collection=1 ";
					}else if(!empty($searchTestArr->packageSearch)){
						$homeColltnFilterCondn=" AND clinics.home_collection =1 and test_packages.home_collection=1 ";
					}
				 else
					 
					$homeColltnFilterCondn='';
					$hcollectionnText='';
					//unset($searchTestArr[2]);
					
			}
			if(!empty($searchTestArr->hcollection)){
			?>
				<script>
				document.getElementById('cbHomeCollection').checked='true';
				document.getElementById('homeCheckbox').style.display='none';
				</script>
			<?php
				$hcollectionnText = $searchTestArr->hcollection;
				if($hcollectionnText=='home'){
					$homeColltnFilterCondn=" AND clinics.home_collection =1 and clinic_tests.home_collection=1 ";
				}
				else{
					$homeColltnFilterCondn="";
				}
				
			}else{ 
			?>
			<script>
			document.getElementById('homeCheckbox').style.display='';
			</script>
			<?php
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
		
		//debug($searchTestArr);
		if(!empty($searchTestArr->testSearch)){ 
			foreach($searchTestArr->testSearch as $item){
				$TestDetails = $this->Test->query("SELECT `Test`.`test_name`,`Test`.`id`,`Test`.`category_id`  FROM `tests` AS `Test`
					INNER JOIN `test_categories` AS `TestCategory` ON (`Test`.`category_id` = `TestCategory`.`id`) WHERE Test.status_id=1 AND `TestCategory`.`category_name` ='$item'");
				@$category_id=$TestDetails[0]['Test']['category_id'];
				if($category_id !=''){//finding related tests in the same category
					$ClinicTestArr = $this->Test->query("SELECT `Test`.`test_name`,`Test`.`id` FROM `tests` AS `Test` 
						INNER JOIN `test_categories` AS `TestCategory` ON (`Test`.`category_id` = `TestCategory`.`id`)
						WHERE Test.status_id=1 AND `Test`.`category_id` =$category_id");

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
		 
		 if(!empty($searchTestArr->packageSearch)){ 
			 //debug($searchTestArr);
			$packageValue = $searchTestArr->packageSearch;
			$packageSubCatValue = $searchTestArr->package_subcat;
			
			
			//$this->Session->write('searchPackageValue',	$packageValue);		
			if($packageValue=='All'){
				$condtn_package=" 1=1 ";
			}else{
				$condtn_package=" FIND_IN_SET('$packageValue',`package_category`) "	;
			}
			//print $condtn_package;
			/* $packages=$this->TestPackage->find('list',array('fields'=>array('TestPackage.id'),'conditions'=>array($condtn_package,'package_subCategory'=>$packageSubCatValue,'status_id'=>1))); */
			$packages=$this->TestPackage->find('list',array('fields'=>array('TestPackage.id'),'conditions'=>array($condtn_package,'package_subCategory'=>$packageSubCatValue,'status_id'=>1)));
			//debug($packages);
			if(!empty($packages)){
				$stringPckgCond = implode(',',$packages);
				$stringPckgCond =" test_packages.`id` IN($stringPckgCond) AND ";
			}else{
				$stringPckgCond ="";
			}
		 }
		else {  }

		//here we are finding the area lattitude and longitude form the user searched area
		if( $searchTestArr->areaSearch!=''){

		$areaDetails = $this->Area->find('first',array('fields'=>array('Area.id','Area.latitude','Area.longitude','Area.postcode'),'conditions'=>array('Area.area_name'=>$searchTestArr->areaSearch)));

			if(count($areaDetails)>=1){
				if($areaDetails['Area']['latitude']!="") {
				$searchedAreaLatitude=$areaDetails['Area']['latitude'];
				$searchedAreaLongitude=$areaDetails['Area']['longitude'];
				//echo $searchedAreaLatitude."  ".$searchedAreaLongitude;
				} else { return false;}
			} else { 
			
				$address = str_replace(" ", "", $searchTestArr->areaSearch);
				//$url = "http://maps.google.com/maps/api/geocode/json?address=$address&region=India";
				$url = "http://maps.googleapis.com/maps/api/geocode/json?address=$address&region=India";
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
				curl_setopt($ch, CURLOPT_PROXYPORT, 3128);
				curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
				$response = curl_exec($ch);
				curl_close($ch);
				$response_a = json_decode($response);

if($response_a->results==null){
	exit;
}else{
	$lat2 = $response_a->results[0]->geometry->location->lat;
	$long2 = $response_a->results[0]->geometry->location->lng;
	//$userlatLon1 = explode(",", $userlatLon); 
	$searchedAreaLatitude = $lat2;
	$searchedAreaLongitude = $long2;
}

			}
			
			//$searchedAreaID=$areaDetails['Area']['id'];
			$stringAreaCond=", ( 3959 * acos( cos( radians($searchedAreaLatitude) ) * cos( radians(clinics.latitude ) ) * cos( radians(clinics.longitude ) - radians($searchedAreaLongitude) ) + sin( radians($searchedAreaLatitude) ) * sin( radians( clinics.latitude ) ) ) ) AS distance ";
			//$orderbyString= " ,distance ASC";
			$orderbyString= " ,distance ASC";
		}
else { 

}		
		//limit setting dynamically according to the ajax pageing		
	$vpb_start = isset($_POST['vpb_start']) && is_numeric($_POST['vpb_start']) ? strip_tags($_POST['vpb_start']) : 'vpb_is_finished';
$vpb_total =  isset($_POST['vpb_total']) && is_numeric($_POST['vpb_total']) ? strip_tags($_POST['vpb_total']) : 'vpb_is_finished';	
		if( $vpb_start == "vpb_is_finished" || $vpb_total == "vpb_is_finished" )
		{
			echo "vpb_is_finished";
		}else{	
			//here we are finding clinics which having the searched test(s) and nearing to the above area(latitude & longitude)
			if(!empty($searchTestArr->testSearch)){// its only for tests
			
		 	/* $sql_find_testaa="SELECT clinics.*,areas.* $stringAreaCond FROM clinics inner join areas on clinics.area_id=areas.id  
				WHERE clinics.id IN(SELECT clinic_id FROM `clinic_tests` 
				WHERE clinic_tests.status_id=1 AND test_id IN ($stringTestCond) GROUP BY clinic_id HAVING count(clinic_id)>=1 )
				 AND clinics.status_id=1  $homeColltnFilterCondn $additionalAreaFilterCondn $additionalClinicFilterCondn $orderbyString LIMIT $vpb_start,$vpb_total ";*/
				
				/* $sql_find_test="SELECT count(clinic_tests.clinic_id) as countTest, clinics.*,areas.* $stringAreaCond 
				FROM clinics inner join areas on clinics.area_id=areas.id  inner join clinic_tests on clinic_tests.clinic_id= clinics.id 
				inner join tests on (clinic_tests.test_id = tests.id and clinic_tests.status_id=1)	WHERE clinic_tests.test_id IN ($stringTestCond)
				AND clinics.status_id=1 $homeColltnFilterCondn $additionalAreaFilterCondn $additionalClinicFilterCondn 
				GROUP BY clinic_tests.clinic_id HAVING count(clinic_tests.clinic_id)>=1 ORDER BY countTest DESC $orderbyString LIMIT $vpb_start,$vpb_total ";
				*/
				$sql_find_test="SELECT count(clinic_tests.clinic_id) as countTest, clinics.*,areas.* $stringAreaCond 
				FROM clinics inner join areas on clinics.area_id=areas.id  inner join clinic_tests on clinic_tests.clinic_id= clinics.id 
				inner join tests on (clinic_tests.test_id = tests.id and clinic_tests.status_id=1)	WHERE clinic_tests.test_id IN ($stringTestCond)
				AND clinics.status_id=1 $homeColltnFilterCondn $additionalAreaFilterCondn $additionalClinicFilterCondn 
				GROUP BY clinic_tests.clinic_id HAVING count(clinic_tests.clinic_id)>=1 ORDER BY countTest DESC $orderbyString LIMIT $vpb_start,$vpb_total ";
				//echo $sql_find_test; exit;
				$clinicLists = $this->Clinic->query($sql_find_test);
				$k=0; $seo_tags='';
				foreach($clinicLists as $clinicDetail){
					$clinic_id=$clinicDetail['clinics']['id'];	
					
					if(!empty($searchTestArr->testSearch)){// its only for tests
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
			elseif(!empty($searchTestArr->packageSearch)){ // this condition is only for packages
				/*$clinicLists = $this->Clinic->query("SELECT clinics.*,areas.*,test_packages.* $stringAreaCond FROM 
				clinics inner join areas on (clinics.area_id=areas.id) inner join test_packages on (test_packages.clinic_id = clinics.id)
				  WHERE clinics.id IN(SELECT `clinic_id` FROM `test_packages` WHERE test_packages.`id` IN($stringPckgCond) GROUP BY clinic_id HAVING count(clinic_id)>=1) 
				  AND clinics.status_id=1 $homeColltnFilterCondn $additionalAreaFilterCondn  $orderbyString LIMIT $vpb_start,$vpb_total ");	*/
			  
				if($stringPckgCond!=""){
					$sql_package="SELECT ((LENGTH(package_category) - LENGTH(REPLACE(package_category, ',', '$packageValue')))+1) as countPackageCat, clinics.*,areas.*,test_packages.* $stringAreaCond FROM clinics inner join areas on (clinics.area_id=areas.id)
					 inner join test_packages on (test_packages.clinic_id = clinics.id)	 WHERE $stringPckgCond  
				   clinics.status_id=1 AND test_packages.status_id=1 $homeColltnFilterCondn $additionalAreaFilterCondn $additionalClinicFilterCondn ORDER BY distance ASC, test_packages.price_offer ASC LIMIT $vpb_start,$vpb_total ";
				  // echo $sql_package;
			 $clinicLists = $this->Clinic->query($sql_package);				
			//echo "<pre>";print_r($clinicLists);
				} else{
					echo "vpb_is_finished";
				}
			
			}
		}
		//debug($clinicLists);
		if(empty($clinicLists)){
				echo "vpb_is_finished";
		}
	
		$this->set('selected_tests_arr', $selected_tests_arr);
		$this->set('clinicTestList', $clinicLists);
		
	}
	
}