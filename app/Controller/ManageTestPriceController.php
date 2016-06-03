<?php

App::uses('AppController', 'Controller');


class ManageTestPriceController extends AppController
{

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'ManageTestPrice';

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array('Clinic','City','Area','ClinicTest','Test','TestCategory');
	
	/**
	 * This controller uses the following layout
	 *
	 * @var string
	 */
	var $layout = "admin-layout";
		
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		//$this->Auth->allow('*');
	}
	
	
	function index()
	{
            
                if(empty($this->data)){
            
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
                
                }else{
                    
                    debug($this->request->data);
                    
                    $clinic_id = $this->request->data['ClinicTestPrice']['clinic_id']; 
                    
                    $type_id = $this->request->data['ClinicTestPrice']['type_id']; 
                    
                    $price_actual_update = $this->request->data['ClinicTestPrice']['price_actual_update'];
                    
                    $price_actual_update_type = $this->request->data['ClinicTestPrice']['price_actual_update_type'];
                    
                    $price_actual_percentage_val = $this->request->data['ClinicTestPrice']['price_actual_percentage_val'];
                    
                    $price_offer_update = $this->request->data['ClinicTestPrice']['price_offer_update'];
                    
                    $price_offer_update_type = $this->request->data['ClinicTestPrice']['price_offer_update_type'];
                    
                    $price_offer_percentage_val = $this->request->data['ClinicTestPrice']['price_offer_percentage_val'];
                    
                    $conditions = array();
                    
                    if(!empty($clinic_id)){
                        array_push($conditions, "ClinicTest.clinic_id = '$clinic_id'");
                    }
                    
                    if(!empty($type_id)){
                        array_push($conditions, "TestCategory.type_id = '$type_id'");
                    }
                    
                    $this->ClinicTest->unBindModel(array('belongsTo' => array('Clinic','Test')));
                    
                    $clinic_tests = $this->ClinicTest->find('all',array('fields'=>array('ClinicTest.*'),
                        'conditions'=>$conditions,
                        'joins' => array(
                            array( 'table' => 'tests',
                                'alias' => 'Test',
                                 'conditions'=> array('ClinicTest.test_id = Test.id')
                            ), array( 'table' => 'test_categories',
                                'alias' => 'TestCategory',
                                'conditions'=> array('Test.category_id = TestCategory.id')
                            )
                        ),
                        ));
                    
                    //debug($clinic_tests);
                    //exit;
                    
                    foreach($clinic_tests as $key=>$clinic_test){
                        
                        if(!empty($price_actual_update) && !empty($price_actual_update_type) && !empty($price_actual_percentage_val)){
                            $current_actual_price = $clinic_test['ClinicTest']['price_actual'];
                            
                            if($price_actual_percentage_val==1){
                                $update_actual_price = ($price_actual_update/100)*$current_actual_price;
                            }else{
                                $update_actual_price = $price_actual_update;
                            }
                            
                            if($price_actual_update_type==1){
                                $updated_actual_price = $current_actual_price+$update_actual_price;
                            }else{
                                $updated_actual_price = $current_actual_price-$update_actual_price;
                                
                            }        
                            
                            $clinic_tests[$key]['ClinicTest']['price_actual'] = $updated_actual_price;
                            
                        }
                        
                        if(!empty($price_offer_update) && !empty($price_offer_update_type) && !empty($price_offer_percentage_val)){
                            $current_offer_price = $clinic_test['ClinicTest']['price_offer'];
                            $current_actual_price = $clinic_test['ClinicTest']['price_actual'];
                            
                            if($price_offer_percentage_val==1){
                                $update_offer_price = ($price_offer_update/100)*$current_actual_price;
                            }else{
                                $update_offer_price = $price_offer_update;
                            }
                            
                            if($price_offer_update_type==1 && $price_offer_percentage_val==1){
                                $updated_offer_price = $current_actual_price-$update_offer_price;
                            }
                            else if($price_offer_update_type==1 && $price_offer_percentage_val==2){
                                $updated_offer_price = $current_actual_price-$update_offer_price;
                            }
                            else if($price_offer_update_type==2 && $price_offer_percentage_val==1){
                                $updated_offer_price = $current_offer_price+$update_offer_price;
                            }
                            else if($price_offer_update_type==2 && $price_offer_percentage_val==2){
                                $updated_offer_price = $current_offer_price-$update_offer_price;
                                
                            }        
                            
                            $clinic_tests[$key]['ClinicTest']['price_offer'] = $updated_offer_price;
                            
                        }
                        
                        
                    }
                    
                    $this->ClinicTest->saveAll($clinic_tests);
                    
                    $this->Session->setFlash('Test Prices has been updated successfully to the selected clinic.', 'default', array('class'=>'success message'));
                    
                    $this->redirect(array('action' => 'index'));
                    
                    //debug($clinic_tests);
                    
                    //echo 'here';
                    //exit;
                    
                    
                }
                
                
	}
	
	
	
}

?>