<?php
App::uses('AppController', 'Controller');

ini_set('memory_limit', '512M');
ini_set('max_execution_time', '30000');

class UploadTestController extends AppController
{
        public $name = 'UploadTest';
        
        public $uses = array('Area','City','TestCategory','Test','Clinic','ClinicTest');
        
        var $components = array('ExcelImport');
        
        var $layout = "admin-layout";
        
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow('validate_data','ajax_check_duplicate_test','ajax_create_test','load_array','ajax_unset_test');
	}
	
	public function index(){
            
            $displayTestArray = array();
	    $this->Session->write('TestArray',$displayTestArray);
            
           
            if(isset($this->data) && count($this->data)>0)
		{
                    
                
			if(!empty($this->data['x']) && !empty($this->data['y'])){
				
				
				
				$upload_file_name = $this->data['UploadTest']['file_upload']['name'];
				
				$upload_file_tmp = $this->data['UploadTest']['file_upload']['tmp_name'];
                                
                                $test_upload_dir = Configure::read('webroot_path').'/test_uploads';
				
				if(!is_dir($test_upload_dir)){
					mkdir($test_upload_dir,0777,true);
				}
				
				$current_date_dir = $test_upload_dir.'/'.date('Y-m-d');
				
				if(!is_dir($current_date_dir)){
					mkdir($current_date_dir,0777,true);
				}
				
				$ext = pathinfo($upload_file_name, PATHINFO_EXTENSION);
				
				$new_file_name = time().'.'.$ext;
				
				$new_upload_location = $current_date_dir.'/'.$new_file_name;
                                
				if(move_uploaded_file($upload_file_tmp,$new_upload_location)){
					
                     $data_array  = $this->ExcelImport->excel_to_array($new_upload_location);
                                        
					if(!empty($data_array) && count($data_array)>0){
						
						$validated_data_array = $this->validate_data($data_array);
						
						$displayTestArray = $validated_data_array;
                                                
						
						
					}
					
				}else{
					echo "There was some error while uploading";
					
				}
				
				
				
				
			}
			
		}
		
               
                
		$this->Session->write('TestArray',$displayTestArray);
		$this->set('displayTestArray',$displayTestArray);
            
		
	}
        
        function validate_data($data_array){
            
            if(!empty($data_array)){
                $i=0;
		foreach($data_array as $k=>$data){
                    
                    
                    $test_category = $data['TestCategory'];
                    
                    if($test_category==""){
                                    //$data_array[$k]['Errors'][] = 'Test Generic Name is null.';
                    }else{
                    
                        $test_category_det = $this->TestCategory->find('first',array(
						'conditions'=>array('TestCategory.category_name="'.$test_category.'"',
						  ))
						);
                        if(!empty($test_category_det)){
                            $data_array[$k]['TestCategoryId'] = $test_category_det['TestCategory']['id'];
                        }else{
                            
                            $test_category_data['category_name'] = $test_category;
                            $test_category_data['type_id'] = $data['TestType'];
                            $test_category_data['status_id'] = 1;
                            if($this->TestCategory->saveAll($test_category_data)){
                                $data_array[$k]['TestCategoryId'] = $this->TestCategory->getLastInsertId();
                                
                            }else{
                                $data_array[$k]['Errors'][] = 'Test Generic Name is not existing.';
                            }
                        }
                    
                    }
                    
                    
                    $test_name = $data['TestName'];
                    
                    if($test_name==""){
                        $data_array[$k]['Errors'][] = 'Test Name is null.';
                    }else{
                    
                        if(!empty($data_array[$k]['TestCategoryId'] )){
                        
                            $test_name_det = $this->Test->find('first',array(
						'conditions'=>array('Test.test_name="'.$test_name.'"',
                                                    'Test.category_id'=>$data_array[$k]['TestCategoryId'],
						  ))
						);
                            
                            if(!empty($test_name_det)){
                                $data_array[$k]['TestId'] = $test_name_det['Test']['id'];
                               
                            }else{
                            
                            
                            
                            $test_data['test_name'] = $test_name;
                            $test_data['category_id'] = $data_array[$k]['TestCategoryId'];
                            $test_data['status_id'] = 1;
                            
                            if($this->Test->saveAll($test_data)){
                                $data_array[$k]['TestId'] = $this->Test->getLastInsertId();
                            }else{
                                $data_array[$k]['Errors'][] = 'Test Name is not existing.';
                            }
                            
                             
                            }
                        }
                        
                        
                        if(empty($data_array[$k]['TestCategoryId'] )){
                        
                        $test_name_det = $this->Test->find('first',array(
						'conditions'=>array('Test.test_name="'.$test_name.'"'
						  ))
						);
                        if(!empty($test_name_det)){
                            $data_array[$k]['TestId'] = $test_name_det['Test']['id'];
                            $data_array[$k]['TestCategoryId'] = $test_name_det['Test']['category_id'];
                        }else{
                            
                            
                            
                            $test_data['test_name'] = $test_name;
                            $test_data['category_id'] = $data_array[$k]['TestCategoryId'];
                            $test_data['status_id'] = 1;
                            
                            if($this->Test->saveAll($test_data)){
                                $data_array[$k]['TestId'] = $this->Test->getLastInsertId();
                            }else{
                                $data_array[$k]['Errors'][] = 'Test Name is not existing.';
                            }
                            
                             
                            }
                        }
                    
                    }
                    
                    $clinic_area_name = $data['ClinicArea'];
                    
                    if($clinic_area_name==""){
                        $data_array[$k]['Errors'][] = 'Center Location is null.';
                    }else{
                    
                        
                        
                        $area_det = $this->Area->find('first',array(
						'conditions'=>array('Area.area_name LIKE "%'.$clinic_area_name.'%"',
                                                   
						  ))
						);
                        if(!empty($area_det)){
                            $data_array[$k]['AreaId'] = $area_det['Area']['id'];
                        }else{
			    $data_array[$k]['Errors'][] = 'Clinic Location is not existing.';
                        }
                    
                    }
                      
                    $clinic_name = $data['ClinicName'];
                    
                    if($clinic_name==""){
                        $data_array[$k]['Errors'][] = 'Clinic Name is null.';
                    }else{
                        
                        if(!empty($data_array[$k]['AreaId'] )){
                        
                        $clinic_det = $this->Clinic->find('first',array(
						'conditions'=>array('Clinic.clinic_name LIKE "%'.$clinic_name.'%"',
                                                    'Clinic.area_id'=>$data_array[$k]['AreaId'],
						  ))
						);
                        if(!empty($clinic_det)){
                            $data_array[$k]['ClinicId'] = $clinic_det['Clinic']['id'];
                        }else{
			    $data_array[$k]['Errors'][] = 'Clinic Name is not existing.';
                        }
                        }
                    
                    }
                    
                    $actual_price = $data['ActualPrice'];
                    if($actual_price==""){
                        $data_array[$k]['Errors'][] = 'Actual Price is null.';
                    }
                    
                    $offer_price = $data['OfferPrice'];
                    if($offer_price==""){
                        $data_array[$k]['Errors'][] = 'Offer Price is null.';
                    }
                    
                    //debug($data_array);
                    
                    if(empty($data_array[$k]['Errors'])){
                        
                        $clinic_id = $data_array[$k]['ClinicId'];
                        $test_id = $data_array[$k]['TestId'];
                    
                        $clinic_test_det = $this->ClinicTest->find('first',array(
						'conditions'=>array('ClinicTest.clinic_id'=>$clinic_id,
                                                    'ClinicTest.test_id'=>$test_id,
						  ))
						);
                        
                        //debug($clinic_test_det);
                        
                        //Save Clinic Test
                        if(count($clinic_test_det)==0){
                            
                            $clinic_test_details= array();
                            
                            $clinic_test_details['test_id'] = $data_array[$k]['TestId'];
                            $clinic_test_details['clinic_id'] = $data_array[$k]['ClinicId'];
                            $clinic_test_details['price_actual'] = $actual_price;
                            $clinic_test_details['price_offer'] = $offer_price;
                            $clinic_test_details['home_collection']= $data_array[$k]['HomeCollection'];
                            $clinic_test_details['status_id'] = 1;
                
                            //debug($clinic_test_details);
                            
                            if($this->ClinicTest->saveAll($clinic_test_details)){
                                $data_array[$k]['CreatedStatus'] = 'True';
                            }
                            
                            
                            
                        }
                    }
                    
                    
                            
                }
                
                $i++;
                        
            }            
            return $data_array;
        }
        
        function ajax_check_duplicate_test(){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $test_array_index = $_POST['test_array_index'];
		
            $upload_test_array = $this->Session->read('TestArray');
	    $test_array = $upload_test_array[$test_array_index];
            
            if(!empty($test_array)){
                
                   
                    
                    $clinic_id = $test_array['ClinicId'];
                    $test_id = $test_array['TestId'];
                    
                    $clinic_test_det = $this->ClinicTest->find('first',array(
						'conditions'=>array('ClinicTest.clinic_id'=>$clinic_id,
                                                    'ClinicTest.test_id'=>$test_id,
						  ))
						);
                    
                   
                    
                    if(count($clinic_test_det)>0){
                        $result = array('response'=>'duplicate');
                        
                    }else{
                        $result = array('response'=>'success');
                        
                    }
                    
                    return json_encode($result);
                    
                }
                exit;
            
            
        }
        
        function ajax_create_test(){
            $this->layout = 'ajax';
            $this->autoRender = false;
            
            $test_array_index = $_POST['test_array_index'];
		
            $upload_test_array = $this->Session->read('TestArray');
	    $test_array = $upload_test_array[$test_array_index];
            
            if(!empty($test_array)){
                $clinic_test_details = array();
                
                $clinic_test_details['test_id'] = $test_array['TestId'];
                $clinic_test_details['clinic_id'] = $test_array['ClinicId'];
                $clinic_test_details['price_actual'] = $test_array['ActualPrice'];
                $clinic_test_details['price_offer'] = $test_array['OfferPrice'];
                $clinic_test_details['status_id'] = 1;
                
                $this->ClinicTest->save($clinic_test_details);
                
                unset($upload_test_array[$test_array_index]);
		$this->Session->write('TestArray',$upload_test_array);
		$result = array('response'=>'success');
		return json_encode($result);
		exit;
                
            }else{
                $result = array('response'=>'failure');
		return json_encode($result);
		exit;
            }
            
            
        }
        
        function load_array(){
		$this->layout = 'ajax';
		$displayTestArray = $this->Session->read('TestArray');
		$this->set('displayTestArray',$displayTestArray);
	}
        
        function ajax_unset_test(){
            $this->layout = 'ajax';
            $this->autoRender = false;
            $test_array_index = $_POST['test_array_index'];
            $upload_test_array = $this->Session->read('TestArray');
            
            //debug($upload_test_array);
            unset($upload_test_array[$test_array_index]);
            $this->Session->write('TestArray',$upload_test_array);
	   
            $result = array('response'=>'success');
	    return json_encode($result);
	    exit;
                
        }
        
}

