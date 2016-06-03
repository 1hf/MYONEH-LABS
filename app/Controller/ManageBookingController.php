<?php
App::uses('AppController', 'Controller');

class ManageBookingController extends AppController
{
	/**
	 * Controller name :ManageClinicController
	 * Created By : Rithin Prabhakar for Capsten Technologies
	 * All rights reserved for Capsten Technologies	 
	 * Dated: 22- Nov-2014
	 * @var string
	 */
	public $name = 'ManageBooking';
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestPackage');
	
	/**
	   * This controller uses the following layout	
	 */
	var $layout = "admin-layout";		
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow('search_bookings','list_booking_element','download_pdf_file');
	}	
	// this method is for list all the bookings
	function list_bookings()
	{
		$this->search_bookings();                
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
                
                $area_options = $this->Area->find('list',array('fields'=>array('id','area_name')));
		
		$this->set('area_options', $area_options);
                
	}
	//search/list bookings	
	function search_bookings($limit=null, $jString=null)
	{
		$conditions = array();
		$selectedArea ='';
		$selectedClinic='';
                
                $booking_date_from = '';
                $booking_date_to = '';
                        
                        
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
			foreach($filter as $key => $filterValue)
			{
				//$booking_date_from ='';$booking_date_to ='';
				if($key == 'clinic_id' && !empty($filterValue)){
					array_push($conditions, "Clinic.id = '$filterValue'");
					$selectedClinic= $filterValue;					
				}				
				if($key == 'area_id' && !empty($filterValue)){
					array_push($conditions, "Clinic.area_id = '$filterValue'");
					$selectedArea =$filterValue;					
				}	
				if($key == 'patient_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.patient_name LIKE '%$filterValue%'");
				}
				if($key == 'patient_email' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.patient_email LIKE '%$filterValue%'");
				}
				if($key == 'patient_mobile' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.patient_mobile LIKE '%$filterValue%'");
				}
				if($key == 'contact_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.contact_name LIKE '%$filterValue%'");
				}
				if($key == 'contact_email' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.contact_email LIKE '%$filterValue%'");
				}
				if($key == 'contact_mobile' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.contact_mobile LIKE '%$filterValue%'");
				}
				if($key == 'voucher_unique_id' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Booking.voucher_unique_id LIKE '%$filterValue%'");
				}				
				if($key == 'booking_date_from' && !empty($filterValue)){
					$booking_date_from = date('Y-m-d', strtotime($filterValue));
					
					//array_push($conditions, "Booking.booking_date ='$filterValue'");
				}
				if($key == 'booking_date_to' && !empty($filterValue)){
					$booking_date_to = date('Y-m-d', strtotime($filterValue));
					
					//array_push($conditions, "Booking.booking_date = '$filterValue'");
				}
				
				if($key == 'test_package' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Test.test_name LIKE '%$filterValue%'");
				}			
						
			}	
			
                        
                        
			if($booking_date_from!='' && $booking_date_to !=''){
				array_push($conditions, "Booking.booking_date BETWEEN '$booking_date_from' AND '$booking_date_to' ");
			}elseif($booking_date_from!='' && $booking_date_to ==''){
				array_push($conditions, "Booking.booking_date>='$booking_date_from'");
			}elseif($booking_date_from ==''  && $booking_date_to !=''){
				array_push($conditions, "Booking.booking_date<='$booking_date_to'");
			}
		}
		//debug($conditions);
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}		
		//Paginate "EventCategory"
                
                //$this->Booking->unBindModel(array('hasMany' => array('BookingTest')));
                
		$this->paginate = array(
			'fields' => array('Booking.*','Clinic.id','Clinic.clinic_name','Clinic.address_line1','Clinic.address_line2','Clinic.address_line3','Area.area_name'),			
			'conditions' => $conditions,
			'joins' => array(
			  		
                         array( 'table' => 'clinics',
                            'alias' => 'Clinic',
                            'conditions'=> array('Booking.clinic_id = Clinic.id')
                        ),						
						 array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        ),
					
                        ),
			'recursive' => 2,
			//'group' => array('BookingTest.booking_id'),
			'order' => array('Booking.id'=>'DESC'),
			'limit' => $limit
		);
	
		$BookingList = $this->paginate('Booking');
                
		//debug($BookingList);
                
                foreach($BookingList as $key=>$bookingItem){
                    
                    $test_included = '';
                    
                    $booking_items = $bookingItem['BookingTest'];
                    
                    //debug($booking_items);
                    
                    if(count($booking_items)==1){
                        if(!empty($booking_items['0']['test_id'])){
                            
                            $test_included = $booking_items['0']['Test']['test_name'];
                        }
                        
                         if(!empty($booking_items['0']['clinic_package_id'])){
                            
                             $package_id = $booking_items['0']['clinic_package_id'];
                             
                            $package_data = $this->TestPackage->find('first',array('fields'=>array('id','package_name'),'conditions'=>array('TestPackage.id'=>$package_id)));
                             
                            $test_included = $package_data['TestPackage']['package_name'];
                            
                        }
                        
                    }
                    
                    $test_included_array = array();
                    
                    if(count($booking_items)>1){
                        foreach($booking_items as $ind_test){
                            
                            $test_included_array[] = $ind_test['Test']['test_name'];
                        }
                        
                        $test_included = implode(',',$test_included_array);
                    }
                    
                    
                    $BookingList[$key]['test_included'] = $test_included;
                }
                
                
		$this->set('BookingList', $BookingList);
		$this->set('limit', $limit);	
		$this->set('sysAdmSeldMenu', 'Manage Clinic Test');
	}
        
    function list_booking_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_bookings($limit, $jString);
		$this->render('/Elements/ManageBooking/list_booking_element');
	}
        
        function download_pdf_file($booking_id=null) {
            
                $this->pageTitle = 'Download';

              
            
                $booking_details = $this->Booking->find('first',array('fields'=>array('Booking.*'),
                            'conditions'=>array('Booking.id'=>$booking_id),
                            'joins' => array(
                         
                        )
                ));
                
                //debug($booking_details);
                
                $file_name = $booking_details['Booking']['voucher_attachment_name'];
            
                $voucher_upload_dir = Configure::read('webroot_path').'/voucher_uploads/'.$booking_id.'/';

		$file_path=$voucher_upload_dir.$file_name;

		$this->response->file($file_path);
                
                return $this->response;
	}
}
?>