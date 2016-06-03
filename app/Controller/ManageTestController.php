<?php

App::uses('AppController', 'Controller');


class ManageTestController extends AppController
{

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'ManageTest';

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array('Test','TestCategory','TestRelation');
	
	/**
	 * This controller uses the following layout
	 *
	 * @var string
	 */
	var $layout = "admin-layout";
		
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('search_test_category','list_test_category_element','perform_operation_test_category_status','perform_operation_test_home_collection','search_tests','list_test_element','perform_operation_test_status');
	}
	
        function list_test_category()
	{
		$this->search_test_category();
		
		
	}
        
        function search_test_category($limit=null, $jString=null)
	{
		$conditions = array('');
		
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
		
			foreach($filter as $key => $filterValue)
			{
				if($key == 'category_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "TestCategory.category_name LIKE '%$filterValue%'");
				}
				
				
			}
			
		}
		
               
		
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
		
		
		
		//Paginate "EventCategory"
		$this->paginate = array(
			'fields' => array('TestCategory.*'),
			'conditions' => $conditions,
			//'recursive' => -1,
			'recursive' => 0,
			'order' => array(),
			'limit' => $limit,
                       
		);
		
		$testCategoryList = $this->paginate('TestCategory');
		
		
		
		$this->set('testCategoryList', $testCategoryList);
		$this->set('limit', $limit);
		
		$this->set('sysAdmSeldMenu', 'Manage Areas');
	}
	
	function list_test_category_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_test_category($limit, $jString);
		$this->render('/Elements/ManageTest/list_test_category_element');
	}
        
	
	
	
        
        function add_edit_test_category($testCategoryId=0)
	{
			
		//If the form is submitted
		

		
		
		if(!empty($this->data))
		{
			
			
			//set the data to "Area" model
			$this->TestCategory->set($this->request->data);
			
			//validate the data
			if($this->TestCategory->validates())
			{	
                                $this->request->data['TestCategory']['status_id'] =1;
                              
                                //$test_category_name = ucwords(strtolower($this->request->data['TestCategory']['category_name']));
                                
                                //$this->request->data['TestCategory']['category_name']= $test_category_name;
                                
				pr($this->request->data['TestCategory']);
                                
                               
				$this->TestCategory->save($this->request->data);
				if($testCategoryId>0){
					$this->Session->setFlash('Generic Test has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Generic Test has been added successfully.', 'default', array('class'=>'success message'));
				}
				
				$this->redirect(array('action' => 'list_test_category'));
			}else{
				$errors = $this->TestCategory->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
                        $result = $this->TestCategory->query("SELECT TestCategory.* FROM test_categories AS TestCategory WHERE TestCategory.id = $testCategoryId");
			if(isset($result[0])){
				$this->request->data = $result[0];
				
			}
                        
		}
		
		
		
		$this->set('testCategoryId', $testCategoryId);
		$this->set('sysAdmSeldMenu', 'Manage Test Category');
	}
	
	
	function perform_operation_test_category_status(){
            
		$testCategoryId = $_REQUEST['testCategoryId'];
		$currentStatus = $_REQUEST['currentStatus'];
		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Test->query("UPDATE test_categories SET status_id = $changeStatusTo WHERE id = $testCategoryId");
		
		
		
		$this->Session->setFlash("The test category status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
        function perform_operation_test_home_collection(){
            
		$testCategoryId = $_REQUEST['testCategoryId'];
		$home_collection = $_REQUEST['home_collection'];
		
		if(Configure::read('Active_id')==$home_collection)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Test->query("UPDATE test_categories SET home_collection = $changeStatusTo WHERE id = $testCategoryId");
		
		
		
		$this->Session->setFlash("The home collection status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
        
        
        
        function list_tests()
	{
		$this->search_tests();
		
		$category_options = $this->TestCategory->find('list',array('fields'=>array('id','category_name'),'conditions'=>array('TestCategory.status_id'=>1)));

                $this->set('category_options', $category_options);
	}
        
        
	
	function search_tests($limit=null, $jString=null)
	{
		$conditions = array('');
		
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
		
			foreach($filter as $key => $filterValue)
			{
				if($key == 'test_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Test.test_name LIKE '%$filterValue%'");
				}
				if($key == 'category_id' && !empty($filterValue)){
					array_push($conditions, "Test.category_id = '$filterValue'");
				}
				
			}
			
		}
		

		
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
		
		
		
		//Paginate "EventCategory"
		$this->paginate = array(
			'fields' => array('Test.*','TestCategory.category_name'),
			'conditions' => $conditions,
			'recursive' => -1,
			'order' => array(),
			'limit' => $limit,
                        'joins' => array(
                         array(
                            'table' => 'test_categories',
                            'alias' => 'TestCategory',
                            'conditions'=> array('Test.category_id = TestCategory.id')
                        )
                        ),
                       
		);
		
		$testList = $this->paginate('Test');
		
		
		
		$this->set('testList', $testList);
		$this->set('limit', $limit);
		
		$this->set('sysAdmSeldMenu', 'Manage Areas');
	}
	
	
	function list_test_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_tests($limit, $jString);
		$this->render('/Elements/ManageTest/list_test_element');
	}
	
	

	function add_edit_test($testId=0)
	{
			
		//If the form is submitted
		
                $selectedCategory = '';
		
		
		if(!empty($this->data))
		{
			
			
			//set the data to "Area" model
			$this->Test->set($this->request->data);
			
			//validate the data
			if($this->Test->validates())
			{	
                                $this->request->data['Test']['status_id'] =1;
                              
                                //$test_name = ucwords(strtolower($this->request->data['Test']['test_name']));
                                
                                //$this->request->data['Test']['test_name']= $test_name;
                                
				pr($this->request->data['Test']);
				$this->Test->save($this->request->data);
				if($testId>0){
					$this->Session->setFlash('Test has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Test has been added successfully.', 'default', array('class'=>'success message'));
				}
				
				$this->redirect(array('action' => 'list_tests'));
			}else{
				$errors = $this->Test->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
                        $result = $this->Test->query("SELECT Test.* FROM tests AS Test WHERE Test.id = $testId");
			if(isset($result[0])){
				$this->request->data = $result[0];
				$selectedCategory = $result[0]['Test']['category_id'];
			}
                        
		}
                
                $category_options = $this->TestCategory->find('list',array('fields'=>array('id','category_name'),'conditions'=>array('TestCategory.status_id'=>1)));

                $this->set('category_options', $category_options);
		
                $this->set('selectedCategory', $selectedCategory);
                
		
		
		$this->set('testId', $testId);
		$this->set('sysAdmSeldMenu', 'Manage Test');
	}
	
	
	function perform_operation_test_status(){
            
		$testId = $_REQUEST['testId'];
		$currentStatus = $_REQUEST['currentStatus'];
		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Test->query("UPDATE tests SET status_id = $changeStatusTo WHERE id = $testId");
		
		
		
		$this->Session->setFlash("The test status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
        
        function related_tests($testId=0){
           
            
            if(!empty($this->data))
		{
			
                
                        debug($this->request->data);
                        
			
			//set the data to "TestRelation" model
			$this->TestRelation->set($this->request->data);
			
                        
                        $test_relation = array();
                        
			//validate the data
			if($this->TestRelation->validates())
			{	
                               
                              
                                
				pr($this->request->data['TestRelation']);
                                
                                //debug($this->request->data['TestRelation']);
                                //exit;
                                
                                foreach($this->request->data['TestRelation']['related_test_id'] as $k=>$related_test_id){
                                    $test_relation['TestRelation'][$k]['test_id'] = $this->request->data['TestRelation']['test_id'];
                                    $test_relation['TestRelation'][$k]['related_test_id'] = $related_test_id;
                                }
                                
                                debug($test_relation['TestRelation']);
                                
                                $relation_count = count($test_relation['TestRelation']);
                                
                                debug($relation_count);
                                
                                
                                
                                foreach($this->request->data['TestRelation']['related_test_id'] as $k=>$related_test_id){
                                    $test_relation['TestRelation'][$relation_count+$k+1]['test_id'] = $related_test_id;
                                    $test_relation['TestRelation'][$relation_count+$k+1]['related_test_id'] = $this->request->data['TestRelation']['test_id'];
                                }
                                
                                
                                
                                debug($test_relation);
                                exit;
                                
				$this->TestRelation->saveAll($test_relation['TestRelation']);
				if($testId>0){
					$this->Session->setFlash('Test Relations has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Test Relations has been added successfully.', 'default', array('class'=>'success message'));
				}
				
				$this->redirect(array('action' => 'list_tests'));
			}else{
				$errors = $this->TestRelation->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
                        $result = $this->Test->query("SELECT Test.* FROM tests AS Test WHERE Test.id = $testId");
			if(isset($result[0])){
				$this->request->data = $result[0];
				
			}
                        
		}
            
                $test_options = $this->Test->find('list',array('fields'=>array('id','test_name'),'conditions'=>array('Test.status_id'=>1)));

                $this->set('test_options', $test_options);
            
                $seletedTest = '';
            
                $this->set('selectedTest', $seletedTest);
            
                $related_test_options = $this->Test->find('list',array('fields'=>array('id','test_name'),'conditions'=>array('Test.status_id'=>1)));

                $this->set('related_test_options', $related_test_options);
            
                $relatedSeletedTest ='';
            
                $this->set('relatedSelectedTest', $relatedSeletedTest);
            
                $this->set('testId', $testId);
        }
	
}

?>