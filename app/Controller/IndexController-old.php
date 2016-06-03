<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

class IndexController extends AppController
{
	var $layout = "home-layout";	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestCategory');	
	public $name = 'Index';
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow();
		$this->Session->delete('searchArr');
                
	}
	
	public function index(){
		
		$area_options = $this->Area->find('list',array('fields'=>array('id','area_name'),'conditions'=>array('Area.status_id'=>1)));
		$this->set('area_options', $area_options);
	}
	
    public function ajaxFetchTests(){ 
		$this->autoRender = false;
                $this->layout = "ajax";
                $this->request->onlyAllow('ajax');
                
                $searchTerm = $this->request->query['term'];
                //alert($searchTerm);
                $limit =10;
		if ($searchTerm=="") {
			$searchTerm="%";
		} else {
			$searchTerm = "%" . $searchTerm . "%";
		}	
		
	 	$response = array();  
	//	$SQL = "SELECT test_categories.id,test_categories.category_name,tests.id,tests.category_id,tests.test_name FROM test_categories inner join tests on test_categories.id = tests.category_id WHERE category_name like '$searchTerm'  ORDER BY category_name limit 10";	
			
		//$result_arr=$this->Test->query($SQL);
		$result_arr=$this->TestCategory->find('all',array(			
			'fields' => array('DISTINCT Test.test_name','TestCategory.id','TestCategory.category_name','Test.id','Test.category_id'),
			'conditions' => array("(category_name like '$searchTerm' OR Test.test_name like '$searchTerm') ",'Test.status_id=1','TestCategory.status_id=1'),
			'joins' => array(
								  array( 'table' => 'tests',
										'alias' => 'Test',
										'conditions'=> array('TestCategory.id = Test.category_id')
								)
							),
				'recursive' => 1,
				'group'=>array('TestCategory.category_name'),
				'limit' =>10			
				)
			);
		
		$i=0; $acount = count($result_arr); if($acount>0) { 
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
		} } else { $response=""; }
		if($response=="") { $response = "No Data Available"; } 
echo json_encode($response);
		exit;
	}
        
       public function ajaxFetchPackages(){
		$this->autoRender = false;
                $this->layout = "ajax";
                $this->request->onlyAllow('ajax');
                
                $searchTerm = $this->request->query['term'];
                
                $limit =10;
		if ($searchTerm=="") {
			$searchTerm="%";
		} else {
			$searchTerm = "%" . $searchTerm . "%";
		}	
		$SQL = "SELECT count(*) count FROM test_packages WHERE package_name like '$searchTerm' AND status_id=1 ORDER BY package_name ";		
		$result_arr=$this->Test->query($SQL);
		//debug($result_arr);
		$count = $result_arr[0][0]['count'];

		
                $response = array();
                
                
		$SQL = "SELECT * FROM test_packages WHERE package_name like '$searchTerm' AND status_id=1 ORDER BY package_name ";		
		$result_arr=$this->Test->query($SQL);
		
		$i=0;
		foreach($result_arr as $item){			
			
                        $response[$i]['value'] = $item['test_packages']['id'];
			$response[$i]['label']=$item['test_packages']['package_name'];
                        //$response[$i]['desc']='H1B1';        
                        
			$i++;
		}
		
		if($response=="") { echo "No Data Available"; } else { echo json_encode($response); }

		
	}
        
        
        public function ajaxFetchArea(){ 
		$this->autoRender = false;
                $this->layout = "ajax";
                $this->request->onlyAllow('ajax');
                
                $searchTerm = $this->request->query['term'];
                
                $limit =10;
		if ($searchTerm=="") {
			$searchTerm="%";
		} else {
			$searchTerm = "%" . $searchTerm . "%";
		}	
		$SQL = "SELECT count(*) count FROM areas WHERE area_name like '$searchTerm' AND status_id=1 ORDER BY area_name ";		
		$result_arr=$this->Test->query($SQL);
		//debug($result_arr);
		$count = $result_arr[0][0]['count'];

                $SQL = "SELECT * FROM areas WHERE area_name like '$searchTerm'  AND status_id=1 ORDER BY area_name ";		
		$result_arr=$this->Test->query($SQL);
		
                $response = array();
                
		$i=0;
		foreach($result_arr as $item){			
			$response[$i]['value'] = $item['areas']['id'];
			$response[$i]['label']=$item['areas']['area_name'];
                        $i++;
		}
		
		echo json_encode($response);
	}
        
	function request_call_back(){ echo "<script>alert("+$_REQUEST['jString']+"]');</script>";
			
		$this->autoRender=false;
		$jString = stripslashes($_REQUEST['jString']);
		$filter = json_decode($jString);
		if($jString!='')
		{
			foreach($filter as $key => $filterValue)
			{
				if($key == 'contact_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contact_name = $filterValue;
				}
				if($key == 'contact_email' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contact_email = $filterValue;
				}
				if($key == 'contact_mobile' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contact_mobile = $filterValue;
				}					
			}			
		}		
        
            // Send Email to contact email
            if(!empty($contact_mobile)){
                
            $email = new CakeEmail();    
                            
            $to_email = array(Configure::read('ADMIN_EMAIL')=>Configure::read('ADMIN_NAME'));
            $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
            $email_subject = "Call back requested by ".ucfirst($contact_name);
            $email_content = 'Dear <b>One Health</b>,<br/><br/>'.
                            'A Call back requested has been intiated from One Health website.<br/>'.
							'<br> Name:'.ucfirst($contact_name).
							'<br> Email:'.$contact_email.
							'<br> mobile:'.$contact_mobile;
            $email_content .='<br/><br/>Thank you<br/><br/>Team One Health';
          
            $email->template('general_email_template');
            $email->emailFormat('html');
            $email->from($email_from);
            $email->to($to_email);
            $email->subject($email_subject);
            $email->viewVars(array(				
                                'email_content'=>$email_content,
             ));
            $sent_status = $email->send();                           
             
                            
            }		
            echo "Success"; 
            exit;
		
	}
}

