<?php

App::uses('AppController', 'Controller');


class ManageTestPackageController extends AppController
{

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'ManageTestPackage';

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array('TestPackage','Clinic','PackageTest');
	
	/**
	 * This controller uses the following layout
	 *
	 * @var string
	 */
	var $layout = "admin-layout";
		
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('search_test_packages','list_test_package_element','perform_operation_package_status','perform_operation_test_home_collection','fetch_hospital_tests');
	}
	
	/**
	 * This method is used to display the list of event categories in the system.
	 */
	function list_test_packages()
	{
		$this->search_test_packages();
		
		$this->Clinic->unBindModel(array('hasMany' => array('ClinicTest')));
                
		$clinic_options_list = $this->Clinic->find('all',array('fields'=>array('Clinic.*,Area.*'),
                    'conditions'=>array('Clinic.status_id'=>1),
                    'joins' => array(
                         array( 'table' => 'cities',
                            'alias' => 'City',
                            'conditions'=> array('Clinic.city_id = City.id')
                        ), array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        )
                        ),
                    'order' => array('Clinic.clinic_name'=>'ASC'),
                ));
		
                $clinic_options = array();
                
                foreach($clinic_options_list as $clinic_list){
                    $clinic_options[$clinic_list['Clinic']['id']] = $clinic_list['Clinic']['clinic_name'].' - '.$clinic_list['Area']['area_name'];
                }
                
                $this->set('clinic_options', $clinic_options);
                
                $package_categories = array('men'=>'Men','Women'=>'Women','Child'=>'Child','Senior Citizen'=>'Senior Citizen');
                
                $this->set('package_categories', $package_categories);
	}
	
	/**
	 * This method is used to search eventcategories in the system*/
	
	function search_test_packages($limit=null, $jString=null)
	{
		$conditions = array('');
		
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
		
			foreach($filter as $key => $filterValue)
			{
				if($key == 'package_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "TestPackage.package_name LIKE '%$filterValue%'");
				}
				if($key == 'clinic_id' && !empty($filterValue)){
					array_push($conditions, "TestPackage.clinic_id = '$filterValue'");
				}
                                if($key == 'category_id' && !empty($filterValue)){
					array_push($conditions, "FIND_IN_SET('$filterValue',`package_category`)");
				}
			}
			
		}
		

		
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
		
		
		
		//Paginate "TestPackage"
		$this->paginate = array(
			'fields' => array('TestPackage.id','TestPackage.package_name','TestPackage.home_collection','TestPackage.status_id','Clinic.clinic_name','Area.area_name'),
			'conditions' => $conditions,
			'recursive' => -1,
			'order' => array(),
			'limit' => $limit,
                        'joins' => array(
                         array(
                            'table' => 'clinics',
                            'alias' => 'Clinic',
                            'conditions'=> array('Clinic.id = TestPackage.clinic_id')
                        ),
                            array(
                            'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        ),
                        ),
		);
		
		$packageList = $this->paginate('TestPackage');
		
		//debug($packageList);
		
		$this->set('packageList', $packageList);
		$this->set('limit', $limit);
		
		$this->set('sysAdmSeldMenu', 'Manage Test Packages');
	}
	
	/**
	 * This method is used to display the list of specialities in the system on click of search / pagination options.
	 */
	function list_test_package_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_test_packages($limit, $jString);
		$this->render('/Elements/ManageTestPackage/list_test_package_element');
	}
	
	/**
	 * This method is used to add / edit event category
	 */ 

	function add_edit_test_package($packageId=0)
	{
			
		//If the form is submitted	

		$selectedClinic = '';	
                
                $pkgCategoriesSelected=array();
                
		if(!empty($this->data))
		{
			
                        
                        $category_data = '';
                        if(!empty($this->data['category_ids'])){
                            $category_data = implode(',',$this->data['category_ids']);
                            
                        }
                       
                        
			$this->TestPackage->set($this->request->data);			
			//validate the data
			if($this->TestPackage->validates())
			{	
                                $this->request->data['TestPackage']['package_category'] = $category_data;
                                $this->request->data['TestPackage']['status_id'] =1;   
			  	if($this->TestPackage->save($this->request->data)){
					
				}
				
				//
				if($packageId>0){
					$this->Session->setFlash('Test Package has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Test Package has been added successfully.', 'default', array('class'=>'success message'));
				}
				
				$this->redirect(array('action' => 'list_test_packages'));
			}else{
				$errors = $this->TestPackage->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
			$this->TestPackage->recursive=2;
                        
			$this->TestPackage->unbindModel(array('belongsTo' => array('PackageTest')), true);
			$this->PackageTest->unbindModel(array('hasMany' => array('PackageTest')), true);	
			$data=$this->TestPackage->find('all',array(
					'fields'=>array('TestPackage.*','PackageTest.*'),
					'joins' => array(
							array( 'table' => 'package_tests',
									'alias' => 'PackageTest',
									'type' => 'LEFT OUTER',
									'conditions'=> array('PackageTest.test_package_id = TestPackage.id')
								),
						),
					'conditions'=>array('TestPackage.id'=>$packageId),
					'recursive' => 1,	
					'group' => array('TestPackage.id')
			));
                        
                        
			if(isset($data[0])){
					$this->request->data = $data[0];
					$selectedClinic = $data[0]['TestPackage']['clinic_id'];
					
					
                                        if(!empty($data[0]['TestPackage']['package_category'])){
                                            $pkgCategoriesSelected = explode(',',$data[0]['TestPackage']['package_category']);
                                        }
                                        
                                        
					$clinicTestLists = $this->Clinic->query("SELECT clinic_tests.*,tests.*  from clinic_tests inner join tests on (tests.id=clinic_tests.test_id) where clinic_tests.clinic_id=$selectedClinic");
					
					$this->set('clinicTestLists', $clinicTestLists);
			 }
              
                
                $this->Clinic->unBindModel(array('hasMany' => array('ClinicTest')));
                
		$clinic_options_list = $this->Clinic->find('all',array('fields'=>array('Clinic.*,Area.*'),
                    'conditions'=>array('Clinic.status_id'=>1),
                    'joins' => array(
                         array( 'table' => 'cities',
                            'alias' => 'City',
                            'conditions'=> array('Clinic.city_id = City.id')
                        ), array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        )
                        ),
                    'order' => array('Clinic.clinic_name'=>'ASC'),
                ));
		
                $clinic_options = array();
                
                foreach($clinic_options_list as $clinic_list){
                    $clinic_options[$clinic_list['Clinic']['id']] = $clinic_list['Clinic']['clinic_name'].' - '.$clinic_list['Area']['area_name'];
                }
			  
			  
		}
                
                $package_categories = array('men'=>'Men','Women'=>'Women','Child'=>'Child','Senior Citizen'=>'Senior Citizen');
                
                $this->set('package_categories', $package_categories);
                
                $this->set('pkgCategoriesSelected', $pkgCategoriesSelected);
                
		$this->set('clinic_options', $clinic_options);
		$this->set('selectedClinic', $selectedClinic);
		$this->set('packageId', $packageId);
		$this->set('sysAdmSeldMenu', 'Manage Area');
	}
	
	
	function perform_operation_package_status(){
            
		$packageId = $_REQUEST['packageId'];
		$currentStatus = $_REQUEST['currentStatus'];
		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->TestPackage->query("UPDATE test_packages SET status_id = $changeStatusTo WHERE id = $packageId");
		$this->Session->setFlash("The package status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
        function perform_operation_test_home_collection(){
            
		$packageId = $_REQUEST['packageId'];
		$home_collection = $_REQUEST['home_collection'];
		
		if(Configure::read('Active_id')==$home_collection)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->TestPackage->query("UPDATE test_packages SET home_collection = $changeStatusTo WHERE id = $packageId");
		
		
		
		$this->Session->setFlash("The home collection status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
	
	function fetch_hospital_tests($jstring=''){
		$conditions ="1=1";
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = false; //making this layout false for ajax to work.
		if($jString!='')
		{
			
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);			
			foreach($filter as $key => $filterValue)
			{
				if($key == 'clinic_id' && !empty($filterValue)){
					$conditions=" clinic_tests.clinic_id = '$filterValue'";
				}				
			}	
		}
		$clinicTestLists = $this->Clinic->query("SELECT clinic_tests.*,tests.*  from clinic_tests inner join tests on (tests.id=clinic_tests.test_id) where $conditions");
		$this->set('pkgTestIds', $pkgTestIds=array());
		$this->set('clinicTestLists', $clinicTestLists);
	}
	
}

?>