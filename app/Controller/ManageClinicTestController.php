<?php
App::uses('AppController', 'Controller');

class ManageClinicTestController extends AppController
{
	/**
	 * Controller name :ManageClinicController
	 * Created By : Rithin Prabhakar for Capsten Technologies
	 * All rights reserved for Capsten Technologies	 
	 * Dated: 22- Nov-2014
	 * @var string
	 */
	public $name = 'ManageClinicTest';
	public $uses = array('Clinic','City','Area','ClinicTest','Test','TestCategory');
	
	/**
	   * This controller uses the following layout	
	 */
	var $layout = "admin-layout";		
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow('search_clinic_tests','list_clinic_test_element','perform_operation_test_home_collection','perform_operation_clinic_test_status','load_specific_test');
	}	
	
	function list_clinic_tests()
	{
		$this->search_clinic_tests();		
	}
	//search/list clinic_tests	
	function search_clinic_tests($limit=null, $jString=null)
	{
		$conditions = array();
		$selectedArea ='';
		$selectedClinic='';
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);		
			
			foreach($filter as $key => $filterValue)
			{
				if($key == 'clinic_id' && !empty($filterValue)){
					
					array_push($conditions, "ClinicTest.clinic_id = '$filterValue'");
					$selectedClinic= $filterValue;					
				}
				if($key == 'test_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Test.test_name LIKE '%$filterValue%'");
				}
				if($key == 'category_name' && !empty($filterValue)){
					array_push($conditions, "TestCategory.category_name = '$filterValue'");
									
				}
                                if($key == 'test_id' && !empty($filterValue)){
					
					array_push($conditions, "Test.id = '$filterValue'");
				}
                                if($key == 'category_id' && !empty($filterValue)){
					
					array_push($conditions, "TestCategory.id = '$filterValue'");
				}
                                if($key == 'home_collection' && !empty($filterValue)){
					if($filterValue==1){
                                            array_push($conditions, "ClinicTest.home_collection = '$filterValue'");
                                        }
				}
                                if($key == 'active_status_id' && !empty($filterValue)){
					
					array_push($conditions, "ClinicTest.status_id = '$filterValue'");
				}
                                if($key == 'test_type_id' && !empty($filterValue)){
					
					array_push($conditions, "TestCategory.type_id = '$filterValue'");
				}
			}			
		}
		
                //debug($conditions);
                
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}		
		
		$this->paginate = array(
			'fields' => array('Clinic.id','Clinic.clinic_name','Area.area_name','ClinicTest.id','ClinicTest.price_actual','ClinicTest.price_offer','ClinicTest.home_collection','Test.id','Test.test_name','ClinicTest.id','ClinicTest.price_actual','ClinicTest.price_offer','ClinicTest.status_id','TestCategory.category_name'),
			'conditions' => $conditions,
			'joins' => array(
                         array( 'table' => 'clinics',
                            'alias' => 'Clinic',
                            'conditions'=> array('ClinicTest.clinic_id = Clinic.id')
                        ), array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        ), array( 'table' => 'tests',
                            'alias' => 'Test',
                            'conditions'=> array('ClinicTest.test_id = Test.id')
                        ),
                            array( 'table' => 'test_categories',
                            'alias' => 'TestCategory',
                            'conditions'=> array('Test.category_id = TestCategory.id')
                        )
                        ),
			'recursive' => -1,
			'order' => array(),
			'limit' => $limit
		);
		
		$clinicTestList = $this->paginate('ClinicTest');		
		$area_options = $this->Area->find('list',array('fields'=>array('id','area_name')));
                
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
                
		
		//debug($clinicTestList);
                
                $category_options = $this->TestCategory->find('list',array('fields'=>array('id','category_name'),'conditions'=>array('TestCategory.status_id'=>1)));

                $this->set('category_options', $category_options);
                
                $test_options = $this->Test->find('list',array('fields'=>array('id','test_name'),'conditions'=>array('Test.status_id'=>1)));

                $this->set('test_options', $test_options);
                
                
                
                
                $this->set('area_options', $area_options);
		$this->set('clinic_options', $clinic_options);
		$this->set('selectedClinic', $selectedClinic);
		$this->set('selectedArea', $selectedArea);
		$this->set('clinicTestList', $clinicTestList);
		$this->set('limit', $limit);	
		$this->set('sysAdmSeldMenu', 'Manage Clinic Test');
	}
	// function is using for searching clinic_tests
	function list_clinic_test_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_clinic_tests($limit, $jString);
		$this->render('/Elements/ManageClinicTest/list_clinic_test_element');
	}	
	/**
	 * This method is used to add / edit Clinic
	 */ 
	function add_edit_clinic_test($clinic_test_id=0)
	{		
		$selectedTest = '';
                $selectedClinic='';
                $selectedTestCategory = '';
		if(!empty($this->data)){		
			
			//set the data to "Area" model
			$this->ClinicTest->set($this->request->data);			
			//validate the data
			if($this->ClinicTest->validates())
			{	
                $this->request->data['ClinicTest']['status_id'] =1;	
				//debug($this->request->data); die;					
				$this->ClinicTest->save($this->request->data);
				
				if($clinic_test_id>0){
					$this->Session->setFlash('Test has been updated successfully to the selected clinic.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Test has been added successfully to the selected clinic.', 'default', array('class'=>'success message'));
				}				
				$this->redirect(array('action' => 'list_clinic_tests'));
			}else{
				$errors = $this->Clinic->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
                        $result = $this->ClinicTest->query("SELECT ClinicTest.* FROM clinic_tests AS ClinicTest WHERE ClinicTest.id = $clinic_test_id");
			if(isset($result[0])){
				$this->request->data = $result[0];
				$selectedClinic = $result[0]['ClinicTest']['clinic_id'];
				$selectedTest = $result[0]['ClinicTest']['test_id'];
                                
                                $result1 = $this->Test->query("SELECT Test.* FROM tests AS Test WHERE Test.id = $selectedTest");
                                if(isset($result1[0])){
                                    $selectedTestCategory = $result1[0]['Test']['category_id'];
                                }
                                
			}
                       
		}
		
                //$selectedTestCategory = '';
                
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
                
                //debug($clinic_options);
                
                $test_category_options = $this->TestCategory->find('list',array('fields'=>array('id','category_name'),'conditions'=>array('TestCategory.status_id'=>1)));
                
                $test_options = $this->Test->find('list',array('fields'=>array('id','test_name'),'conditions'=>array('Test.status_id'=>1)));
		$this->set('clinic_options', $clinic_options);
                $this->set('test_category_options', $test_category_options);
		$this->set('test_options', $test_options);
		$this->set('selectedTest', $selectedTest);		
		$this->set('selectedClinic', $selectedClinic);
                $this->set('selectedTestCategory', $selectedTestCategory);
                
                //debug($selectedTestCategory);
                
		$this->set('clinic_test_id', $clinic_test_id);
		$this->set('sysAdmSeldMenu', 'Manage Clinic Tests');
	}
	
	
	function sanitizeStringForUrl($string){
		$string = strtolower($string);
		$string = html_entity_decode($string);
		$string = str_replace(array('ä','ü','ö','ß'),array('ae','ue','oe','ss'),$string);
		$string = preg_replace('#[^\w\säüöß]#',null,$string);
		$string = preg_replace('#[\s]{2,}#',' ',$string);
		$string = str_replace(array(' '),array('-'),$string);
		return $string;
	}
	
	function create_slug($string){
   		$string = preg_replace( '/[«»""!?,.!@£$%^&*{};:()]+/', '', $string );
   		$string = strtolower($string);
   		$slug=preg_replace('/[^A-Za-z0-9-]+/', '-', $string);
   		return $slug;
	}
	
        function perform_operation_test_home_collection(){
            
		$clinic_test_id = $_REQUEST['clinic_test_id'];
		$home_collection = $_REQUEST['home_collection'];
		
		if(Configure::read('Active_id')==$home_collection)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Test->query("UPDATE clinic_tests SET home_collection = $changeStatusTo WHERE id = $clinic_test_id");
		
		
		
		$this->Session->setFlash("The home collection status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
	function perform_operation_clinic_test_status(){
            
		$clinic_test_id = $_REQUEST['clinic_test_id'];
		$currentStatus = $_REQUEST['currentStatus'];		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Clinic->query("UPDATE clinic_tests SET status_id = $changeStatusTo WHERE id = $clinic_test_id");
		$this->Session->setFlash("The test status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
        function load_specific_test(){
                
                $this->autoRender = false;
            
		$category_id = $_REQUEST['category_id'];
		
                $test_options = $this->Test->find('all',array('fields'=>array('id','test_name'),'conditions'=>array('Test.status_id'=>1,'Test.category_id'=>$category_id)));
                
		return json_encode($test_options);
                exit;
		
	}
	
}

?>