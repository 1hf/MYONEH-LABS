<?php
App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

//ini_set('memory_limit', '512M');
//ini_set('max_execution_time', '30000');

class BookingController extends AppController
{
	var $layout = "bookingpage-layout";	
	public $uses = array('Clinic','City','Area','ClinicTest','Test','Booking','BookingTest','TestPackage');	
	public $name = 'Booking';
        var $components = array('Pdf','Encryption');
        public $helpers = array('General');
        
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow();
	}
	
        public function unset_test_data(){
            $this->autoRender = false;
            $test_package_id = $_REQUEST['test_package_id'];
            $test_type = $_REQUEST['test_type'];
            
            if($test_package_id!="" && $test_type!=""){
                
                if($test_type=="test"){
                $session_test_ids = $this->Session->read('BookingTests');
                
                $clinic_test_ids = explode('_',$session_test_ids);
                
                if(($key = array_search($test_package_id, $clinic_test_ids)) !== false) {
                    unset($clinic_test_ids[$key]);
                }
                
                
                $updated_clinic_test_ids = implode('_',$clinic_test_ids);
                $this->Session->write('BookingTests',$updated_clinic_test_ids);
                }
            
                if($test_type=="package"){
                    $session_package_id = $this->Session->read('BookingPackage');
                
                    if($session_package_id==$test_package_id){
                        
                         $this->Session->write('BookingPackage','');
                    }
                   
                   
                    
                    
                }
                
                
                
            }
            
            echo '1';
            exit;
            
        }
        
	public function index()
	{
            
            $session_test_ids = $this->Session->read('BookingTests');
            $session_package_id = $this->Session->read('BookingPackage');
            
            
            
            if(!empty($_POST['clinic_test_id_vals']) || !empty($_POST['pacakge_id']) || !empty($session_test_ids) || !empty($session_package_id)){
		
            $clinic_test_id_vals = '';
                
            if(!empty($_POST['clinic_test_id_vals'])){
                $clinic_test_id_vals = $_POST['clinic_test_id_vals'];
                $this->Session->write('BookingTests',$clinic_test_id_vals);
            }
            
            if(empty($_POST['clinic_test_id_vals'])&& !empty($session_test_ids)){
                $clinic_test_id_vals = $session_test_ids;
            }
            
            
            
            $package_id = '';
            
            if(!empty($_POST['pacakge_id'])){
                $package_id = $_POST['pacakge_id'];
                $this->Session->write('BookingPackage',$package_id);
            }
            
            if(empty($_POST['pacakge_id'])&& !empty($session_package_id)){
                $package_id = $session_package_id;
            }
            
            $package_home_collection =0;
            
            $test_home_collection = 0;
            
            $clinic_home_collection = 0;
            
            if(!empty($clinic_test_id_vals)){
            
            $clinic_test_id = explode('_',$clinic_test_id_vals);
            
            
            
            $this->ClinicTest->unbindModel(array('belongsTo' => array('Clinic'),'hasMany'=>'BookingTest'), true);
            
            $clinic_test_details = $this->ClinicTest->find('first',array('fields'=>array('ClinicTest.*'),'conditions'=>array('ClinicTest.id'=>$clinic_test_id)));
            
            $clinic_id = $clinic_test_details['ClinicTest']['clinic_id'];
            
            $clinic_details = $this->Clinic->find('first',array('fields'=>array('Clinic.*'),'conditions'=>array('Clinic.id'=>$clinic_id)));
            
            $clinic_home_collection = $clinic_details['Clinic']['home_collection'];
            
            $clinic_test_array = $this->ClinicTest->find('all',array('fields'=>array('ClinicTest.*'),'conditions'=>array('ClinicTest.id'=>$clinic_test_id)));
            
            $clinic_details['TestDetails']= $clinic_test_array;
            
            
            $area_id = $clinic_details['Clinic']['area_id'];
                    
            $area_details = $this->Area->find('first',array('fields'=>array('Area.*'),'conditions'=>array('Area.id'=>$area_id)));
                    
            $clinic_details['Area'] =  $area_details['Area'];
            
            $city_id = $area_details['Area']['city_id'];
                    
            $city_details = $this->City->find('first',array('fields'=>array('City.*'),'conditions'=>array('City.id'=>$city_id)));
                    
            $clinic_details['City'] =  $city_details['City'];
            
            $total_amount_actual = 0;
                    
            $total_amount_offer = 0;
            
            $clinic_test_home_collection_flag = 1;
            
            foreach($clinic_details['TestDetails'] as $k=>$clinic_test_item){
                
                $test_id = $clinic_test_item['ClinicTest']['test_id'];
                $test_details = $this->Test->find('first',array('fields'=>array('Test.*'),'conditions'=>array('Test.id'=>$test_id)));
                $clinic_details['TestDetails'][$k]['Test'] =  $test_details['Test'];
                
                $total_amount_actual+=$clinic_test_item['ClinicTest']['price_actual'];
                       
                $total_amount_offer+= $clinic_test_item['ClinicTest']['price_offer'];  
                
                
                if($clinic_test_item['ClinicTest']['home_collection']==0){
                    $clinic_test_home_collection_flag = 0;
                }
                
            }
            
            if($clinic_test_home_collection_flag==1){
                $test_home_collection = 1;
            }
            
            //echo $test_home_collection;
            
            $clinic_details['total_amount_actual'] = round($total_amount_actual,2);
                
            $clinic_details['total_amount_offer'] = round($total_amount_offer,2);
                
            $total_discount_price = $total_amount_actual-$total_amount_offer;
            
            $clinic_details['total_discount_price'] = round($total_discount_price,2);
            
            $total_discount_percentage = ($total_discount_price/$total_amount_actual)*100;
            
            $clinic_details['total_discount_percentage'] = ceil($total_discount_percentage);
            
            //debug($clinic_details);
            
          
            $this->set('clinic_test_ids',$clinic_test_id);
            $this->set('clinic_details',$clinic_details);
            $test_type = 'clinic_test';
            
            
            }
            
            if(!empty($package_id)){
                
                    
                
                    $package_details=$this->TestPackage->find('first',array(			
				'fields' => array('TestPackage.*','Clinic.*','Area.*','City.*'),
				'conditions' => array('TestPackage.id'=>$package_id),
				'joins' => array(
								 array( 'table' => 'clinics',
										'alias' => 'Clinic',
										'conditions'=> array('Clinic.id = TestPackage.clinic_id')
								), array( 'table' => 'areas',
										'alias' => 'Area',
										'conditions'=> array('Clinic.area_id = Area.id')
								),
                                                                array( 'table' => 'cities',
										'alias' => 'City',
										'conditions'=> array('Area.city_id = City.id')
								)
							),
				'recursive' => 1			
				)
			);
                    
                 
                    
                    $total_discount_price = 0;
                    
                    $total_amount_actual = $package_details['TestPackage']['price_actual'];
                    
                    $total_discount_price = $package_details['TestPackage']['price_actual'] - $package_details['TestPackage']['price_offer'];
                    
                    $package_details['TestPackage']['total_discount_price'] = $total_discount_price;
                    
                    $total_discount_percentage = ($total_discount_price/$total_amount_actual)*100;
                    
                    $package_details['TestPackage']['total_discount_percentage'] = ceil($total_discount_percentage);
                    
                    
                    $clinic_id = $package_details['TestPackage']['clinic_id'];
            
                    $clinic_details = $this->Clinic->find('first',array('fields'=>array('Clinic.*'),'conditions'=>array('Clinic.id'=>$clinic_id)));
                
                    $clinic_home_collection = $clinic_details['Clinic']['home_collection'];
                    
                    $test_type = 'test_package';
                    
                    
                    $package_home_collection = $package_details['TestPackage']['home_collection'];
                    
                    $this->set('package_details',$package_details);
                    
                    $this->set('package_id',$package_id);
                
            }
            
            $this->set('test_type',$test_type);
           
            $this->set('package_home_collection',$package_home_collection);
            
            $this->set('test_home_collection',$test_home_collection);
            
            
            
            $this->set('clinic_home_collection',$clinic_home_collection);
            
            }else{
                $this->redirect(array('controller'=>'index','action'=>'index'));
            }
            
	}
        
        function confirmbooking(){
            
            $this->autoRender = false;
            
            //debug($this->request->data);
            //exit;
            
            if(!empty($this->request->data)){
                
                $contact_name = $this->request->data['contact_name'];
                $contact_email = $this->request->data['contact_email'];
                $contact_mobile = $this->request->data['contact_mobile'];
                
                $patient_name = $this->request->data['patient_name'];
                $gender = $this->request->data['gender'];
                $patient_email = $this->request->data['patient_email'];
                $patient_mobile = $this->request->data['patient_mobile'];
                
                $test_type = $this->request->data['test_type'];
                
                $home_collection_address = '';
                $home_collection_flag = $this->request->data['homecollection_checkbox'];
                if($home_collection_flag==1){
                    $home_collection_address = $this->request->data['home_collection_address'];
                }
                
                
                $total_amount_actual = 0;
                    
                $total_amount_offer = 0;
                
                $total_discount_price = 0;
                
                
                $test_details_data = ''; 
                
                $package_test_included = '';
                
                $test_list_array = array();
                
                // Save Test Details
                if($test_type=="clinic_test"){
                
                    $clinic_test_ids = $this->request->data['clinic_test_id'];
                
                    $test_id_list = array();
            
                    foreach($clinic_test_ids as $k=>$clinic_test_id){
                
                     
                        $clinic_test_details = $this->ClinicTest->find('first',array('fields'=>array('ClinicTest.*'),'conditions'=>array('ClinicTest.id'=>$clinic_test_id)));
                    
                        $test_id = $clinic_test_details['ClinicTest']['test_id'];
                    
                        $clinic_id = $clinic_test_details['ClinicTest']['clinic_id'];
                    
                        $test_details = $this->Test->find('first',array('fields'=>array('Test.*'),'conditions'=>array('Test.id'=>$test_id)));
                    
                        $clinic_details['TestDetails'][$k]['Test'] =  $test_details['Test'];
                
                        $total_amount_actual+=$clinic_test_details['ClinicTest']['price_actual'];
                       
                        $total_amount_offer+= $clinic_test_details['ClinicTest']['price_offer'];  
                
                        $test_id_list[$k]['test_id'] = $test_id;
                        $test_id_list[$k]['clinic_test_id'] = $clinic_test_id;
                        
                        $test_details_data .= $test_details['Test']['test_name'].'<br/><br/>';
                        
                        $test_list_array[] = $test_details['Test']['test_name'];
                
                    }
            
                $total_amount_actual = round($total_amount_actual,2);
                
                $total_amount_offer = round($total_amount_offer,2);
                
                $total_discount_price = $total_amount_actual-$total_amount_offer;
            
                $total_discount_price = round($total_discount_price,2);
                
                $no_of_test = count($clinic_test_ids);
              
              }
              
              
              if($test_type=="test_package"){
                    
                    
                    $package_id = $this->request->data['package_id'];
                
                    $package_details=$this->TestPackage->find('first',array(			
				'fields' => array('TestPackage.*','Clinic.*','Area.*','City.*'),
				'conditions' => array('TestPackage.id'=>$package_id),
				'joins' => array(
								 array( 'table' => 'clinics',
										'alias' => 'Clinic',
										'conditions'=> array('Clinic.id = TestPackage.clinic_id')
								), array( 'table' => 'areas',
										'alias' => 'Area',
										'conditions'=> array('Clinic.area_id = Area.id')
								),
                                                                array( 'table' => 'cities',
										'alias' => 'City',
										'conditions'=> array('Area.city_id = City.id')
								)
							),
				'recursive' => 1			
				)
			);
                    
                    $clinic_id = $package_details['TestPackage']['clinic_id'];
                    
                    $total_amount_actual = round($package_details['TestPackage']['price_actual'],2);
                    
                    $total_amount_offer = round($package_details['TestPackage']['price_offer'],2);
                    
                    $total_discount_price= $total_amount_actual-$total_amount_offer;
                    
                    $total_discount_price = round($total_discount_price,2);
                    
                    $no_of_test = 1;
                    
                    $test_list_array[] =  $package_details['TestPackage']['package_name'];
                    
                    $test_details_data = '<b>Package Name : '.$package_details['TestPackage']['package_name'].'</b>';
                    
                    $tests_included = $package_details['TestPackage']['tests_included'];
                    
                    $package_tests_data = '';
                    
                    $tests_inculed_arr =explode('###',$tests_included);
                    foreach($tests_inculed_arr as $itms){	
                        if($itms!=''){
                            $itmPcs =explode(':',$itms);	
                            if(count($itmPcs)>1){
                                $package_tests_data .="<strong>".$itmPcs[0].": </strong>".$itmPcs[1].'<br/>';
                            }else{
                                $package_tests_data .=$itms.'<br/>';
                            }
                        }
                    }
                    
                    $package_test_included = '<tr><td style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:12px;">';
                    $package_test_included.= $package_tests_data.'</td></tr>';
                    
                    
                    $mon_fri = $package_details['TestPackage']['mon_fri'];
                        
                    $saturday = $package_details['TestPackage']['saturday'];
                        
                    $sunday = $package_details['TestPackage']['holidays'];
                    
                    
                }    
            
                $booking_date = date("Y-m-d H:i:s");
            
                $booking_data = array();
                $booking_data['clinic_id'] = $clinic_id;
                
                $booking_data['booking_date'] = $booking_date;
                $booking_data['contact_name'] = $contact_name;
                $booking_data['contact_email'] = $contact_email;
                $booking_data['contact_mobile'] = $contact_mobile;
                $booking_data['patient_name'] = $patient_name;
                $booking_data['patient_gender'] = $gender;
                $booking_data['patient_email'] = $patient_email;
                $booking_data['patient_mobile'] = $patient_mobile;
                
                $booking_data['home_collection_flag'] = $home_collection_flag;
                $booking_data['home_collection_address'] = $home_collection_address;
                
                $booking_data['total_price_actual'] = $total_amount_actual;
                
                $booking_data['total_price_offer'] = $total_amount_offer;
                $booking_data['total_discount'] = $total_discount_price;
                $booking_data['test_type'] = $test_type;
                $booking_data['no_of_test'] = $no_of_test;
                $booking_data['status_id'] = 1;
                
                $total_offer_percentage = ceil(($total_discount_price/$total_amount_actual)*100);
                
                if($this->Booking->save($booking_data)){
                     $booking_id = $this->Booking->getLastInsertId();
                     $booking_test = array();
                     
                     
                     
                     if($test_type=="clinic_test"){
                     
                     foreach($test_id_list as $k=>$test_id_item){
                         $booking_test[$k]['booking_id'] = $booking_id;
                         $booking_test[$k]['clinic_test_id'] = $test_id_item['clinic_test_id']; 
                         $booking_test[$k]['test_id'] = $test_id_item['test_id']; 
                        
                         $clinic_test_id =$test_id_item['clinic_test_id'];
                         
                         $clinic_test_details = $this->ClinicTest->find('first',array('fields'=>array('ClinicTest.*'),'conditions'=>array('ClinicTest.id'=>$clinic_test_id)));
                         
                         $booking_test[$k]['price_actual'] = $clinic_test_details['ClinicTest']['price_actual'];
                         
                         $booking_test[$k]['price_offer'] = $clinic_test_details['ClinicTest']['price_offer'];
                         
                         $discount_price = $clinic_test_details['ClinicTest']['price_actual']-$clinic_test_details['ClinicTest']['price_offer'];
                         
                         $booking_test[$k]['price_discount'] = $discount_price;
                         
                     }
                     
                     
                     
                     }
                     if($test_type=="test_package"){
                         
                         $booking_test['booking_id'] = $booking_id;
                         $booking_test['clinic_package_id'] = $package_id; 
                         $booking_test['price_actual'] = $total_amount_actual;
                         $booking_test['price_offer'] = $total_amount_offer;
                         $booking_test['price_discount'] = $total_discount_price;        
                         
                         
                         
                     }
                     
                     if($this->BookingTest->saveAll($booking_test)){
                         // Create vouncher
                         
                        $myFile = Configure::read('medtest_root_path')."/app/webroot/templates/voucher.html";
                         
                        $file_funs = file($myFile);
                        
                        
                        
                        $printContent = '';
                        
                        $clinic_details = $this->Clinic->find('first',array('fields'=>array('Clinic.*','Area.*','City.*'),
                            'conditions'=>array('Clinic.id'=>$clinic_id),
                            'joins' => array(
                         array( 'table' => 'cities',
                            'alias' => 'City',
                            'conditions'=> array('Clinic.city_id = City.id')
                        ), array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        )
                        )
                        ));

                        $clinic_name = $clinic_details['Clinic']['clinic_name'];
                        
                        $clinic_area = $clinic_details['Area']['area_name'];
                        
                        $clinic_name_code = strtoupper(substr($clinic_name, 0, 3));
                        
                        $month_val = date("my");
                        
                        $mount_count = date("n");
                        
                        $year_count = date("Y");
                        
                        $booking_count = $this->Booking->find('count',array('conditions'=>array('YEAR(booking_date)'=>$year_count,'MONTH(booking_date)'=>$mount_count)));
                        
                        
                        
                        $monthly_booking_counter =  sprintf("%04s", $booking_count);
                        
                        
                        
                        $vouncher_code = $clinic_name_code.'-'.$month_val.$monthly_booking_counter;
                        
                        $clinic_address = '';
                        
                        $clinic_address = $clinic_details['Clinic']['address_line1'].' ,'.$clinic_details['Clinic']['address_line2'];
                        
                        if(!empty($clinic_details['Clinic']['address_line3'])){
                            $clinic_address .=' ,'.$clinic_details['Clinic']['address_line3'];
                        }
                        $clinic_address.= ' ,'.$clinic_details['Area']['area_name'].' ,<br/>'.$clinic_details['City']['city_name'].' - '.$clinic_details['Clinic']['postcode'];
                        
                        if($test_type=="clinic_test"){
                        
                            $mon_fri = $clinic_details['Clinic']['mon_fri'];
                        
                            $saturday = $clinic_details['Clinic']['saturday'];
                        
                            $sunday = $clinic_details['Clinic']['holidays'];
                        }
                        
                        if($home_collection_flag==1){
                            $payment_method_text = 'To be made to collection personnel';
                        }else{
                            $payment_method_text = 'At Center';
                        }
                        
                        $home_collection_address_text = '';
                        
                        $home_collection_address_modified= '';
                        
                        if($home_collection_flag==1){
                            
                            $home_collection_address_modified = str_replace("\n", ",", $home_collection_address);
                            
                            $home_collection_address_text = '<tr>
                                <td><table width="825" border="0" cellspacing="0" cellpadding="3" align="center">
                                    <tr>
                                      <td style="font-family:Arial, Helvetica, sans-serif; color:#1196ce; font-size:25px; text-decoration:underline;">Home Collection Details</td>
                                    </tr>
                                    <tr>
                                      <td height="5"></td>
                                    </tr>
                                    <tr>
                                        <td style="font-family:Arial, Helvetica, sans-serif; color:#000; font-size:14px;">'.$home_collection_address_modified.'</td>
                                    </tr>
                                    <tr>
                                      <td>&nbsp;</td>
                                    </tr>

                                  </table></td>
                              </tr>';
                    
                        }
                        
                        
                        
                        $header_bg_path = Configure::read('medtest_root_path')."app/webroot/img/header_bg.jpg";
                        
                        $header_bg ='<img width="900" height="260" src="'.$header_bg_path.'" />';
                        
                        $border_img_path = Configure::read('medtest_root_path')."app/webroot/img/border.jpg";
                        
                        $border_img ='<img width="898" height="21" src="'.$border_img_path.'" />';
                        
                        $logo_img_path = Configure::read('medtest_root_path')."app/webroot/img/voucher_logo.jpg";
                        
                        $logo_img ='<img width="142" height="58" src="'.$logo_img_path.'" />';
                        
                        $bullet_img_path = Configure::read('medtest_root_path')."app/webroot/img/bullet.jpg";
                        
                        $bullet_img ='<img width="13" height="12" src="'.$bullet_img_path.'" />';
                        
                        $date_of_booking = date("d/m/Y");
                        
                        $voucher_valitity_upto = date('d/m/Y', strtotime("+7 days"));
                        
                        $total_amount = number_format($total_amount_offer,2);
                        
			foreach ($file_funs as $file_num => $file_fun) {

                            //$file_fun = str_replace('$body$', 'body', $file_fun);
                            
                            $file_fun = str_replace('$header_bg$', $header_bg, $file_fun);
                            
                            $file_fun = str_replace('$border_img$', $border_img, $file_fun);
                            
                            $file_fun = str_replace('$logo_img$', $logo_img, $file_fun);
                            
                            $file_fun = str_replace('$bullet_img$', $bullet_img, $file_fun);

			    $file_fun = str_replace('$patient_name$', $patient_name, $file_fun);
                            
                            $file_fun = str_replace('$date_of_booking$', $date_of_booking, $file_fun);
                            
                            $file_fun = str_replace('$voucher_valitity_upto$', $voucher_valitity_upto, $file_fun);

                            $file_fun = str_replace('$customer_contact_no$', $patient_mobile, $file_fun);
                            
                            $file_fun = str_replace('$voucher_number$', $vouncher_code, $file_fun);
                            
                            $file_fun = str_replace('$clinic_name$', $clinic_name, $file_fun);
                            
                            $file_fun = str_replace('$clinic_address$', $clinic_address, $file_fun);
                            
                            $file_fun = str_replace('$package_test_included$', $package_test_included, $file_fun);
                            
                            $file_fun = str_replace('$test_details_data$', $test_details_data, $file_fun);
                            
                            $file_fun = str_replace('$sunday$', $sunday, $file_fun);
                            
                            $file_fun = str_replace('$mon_fri$', $mon_fri, $file_fun);
                            
                            $file_fun = str_replace('$saturday$', $saturday, $file_fun);
                            
                            $file_fun = str_replace('$payment_method_text$', $payment_method_text, $file_fun);
                            
                            $file_fun = str_replace('$home_collection_address_text$', $home_collection_address_text, $file_fun);
                            
                            
                            $file_fun = str_replace('$total_amount$', $total_amount, $file_fun);
                            
                            $printContent.= $file_fun;
                                        
                        }
                         
                        
                        
                        $voucher_upload_dir = Configure::read('webroot_path').'/voucher_uploads';
				
			if(!is_dir($voucher_upload_dir)){
                            mkdir($voucher_upload_dir,0777,true);
			}
			
                        $booking_dir = $voucher_upload_dir.'/'.$booking_id.'/';
				
			if(!is_dir($booking_dir)){
                            mkdir($booking_dir,0777,true);
			}
                        
                        
                        
                        $file_name=$vouncher_code;
                        
                        
                        
                        $print_html_file_name = $booking_dir.$vouncher_code.".html";
                        
                        
                        $print_file = fopen($print_html_file_name, 'w+') or die("can't open file");

			fwrite($print_file, $printContent);

			fclose($print_file);
                        
                       

			$this->Pdf->filename = $file_name; // Without .pdf

			// You can use download or browser here

			$this->Pdf->output = 'file';

			$path=$booking_dir;

			//debug($path);
                        //exit;

			$this->Pdf->init($path);

                        // Render the view with the file path in session

			Configure::write('pdf_html_link', $print_html_file_name);

			$this->Pdf->process(Router::url('/', true) . 'booking/download_pdf_view/'.$file_name.'/'.$booking_id);
                        
                        $pdf_full_path = $booking_dir.$vouncher_code.'.pdf';
                        
                        
                        $booking_data_update['id'] = $booking_id;
                        $booking_data_update['voucher_attachment_name'] = $vouncher_code.'.pdf';
                        $booking_data_update['voucher_unique_id'] = $vouncher_code;
                        
                        $this->Booking->save($booking_data_update);
                        
                        // Send Email to patient
                        
                        $email = new CakeEmail();
                        $email->sender(Configure::read('NO_REPLY_EMAIL'), Configure::read('NO_REPLY_EMAIL_NAME'));
                        
                        
                        $to_email = array($patient_email=>$patient_name);
			$email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
	
                        $email_subject = "Medical Investigation has been booked";
                        $email_content = '<b>Dear '.$patient_name.'</b>,<br/><br/>'.
                        '<b>Greetings from HealthX.in!<b><br/><br/>';
                        $email_content .='Please find attached the voucher for your investigations selected.<br/>';
                        if($home_collection_flag==1){
                                $email_content .='Please present the voucher to the home collection personnel.<br/><br/>';
                        }else{
                                $email_content .='Kindly carry a printed copy of this voucher and present it at the center selected.<br/><br/>';
                        }
                        $email_content .='Thank you<br/><br/>Team HealthX';
                        
                                
                                
                        if(file_exists($pdf_full_path))
                        $email->attachments($pdf_full_path); 
                        $email->template('patient_email');
                        $email->emailFormat('html');
                        $email->from($email_from);
                        $email->to($to_email);
                        $email->subject($email_subject);
                        $email->viewVars(array(
				'email_content'=>$email_content,
                        ));
                        $sent_status = $email->send();
                        
                        // Send Email to contact email
                        if($contact_email!=$patient_email){
                            
                            $to_email = array($contact_email=>$contact_name);
                            $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
	
                            $email_subject = "Medical Investigation has been booked";
                            $email_content = '<b>Dear '.$contact_name.'</b>,<br/><br/>'.
                            '<b>Greetings from HealthX.in!<b><br/><br/>';
                            $email_content .='Please find attached the voucher for your investigations selected.<br/>';
                            if($home_collection_flag==1){
                                $email_content .='Please present the voucher to the home collection personnel.<br/><br/>';
                            }else{
                                $email_content .='Kindly carry a printed copy of this voucher and present it at the center selected.<br/><br/>';
                            }
                            $email_content .='Thank you<br/><br/>Team HealthX';
                        
                            if(file_exists($pdf_full_path))
                            $email->attachments($pdf_full_path); 
                            $email->template('patient_email');
                            $email->emailFormat('html');
                            $email->from($email_from);
                            $email->to($to_email);
                            $email->subject($email_subject);
                            $email->viewVars(array(
				'email_content'=>$email_content,
                            ));
                            $sent_status = $email->send();
                            
                            
                            
                        }
                        
                        // Send Email to Clinic
                        
                        $clinic_name = $clinic_details['Clinic']['clinic_name'];
                        $clinic_email_item= $clinic_details['Clinic']['email'];
                        
                        if(!empty($clinic_email_item)){
                            
                            if(!empty($clinic_email_item)){
                                
                                $clinic_emails = explode(',',$clinic_email_item);
                                foreach($clinic_emails as $clinic_email){
                                    
                                    
                                    $to_email = array($clinic_email=>$clinic_name);
                                    
                                    $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
	
                                    $email_subject = "Medical Investigation has been booked";
                                    $email_content = '<b>Dear Sir/Madam</b>,<br/><br/>'.
                                    '<b>Please find attached attached voucher for '.$patient_name.'.</b>';
                                    
                                    if($home_collection_flag==1){
                                        $email_content .= '<br/><br/>Home Collection Address : '.$home_collection_address_modified;    
                                    }
                                    $email_content .= '<br/><br/><b>For any queries please call +91 95380 80180.</b>';
                                    $email_content .='<br/><br/><b>Thank you</b><br/><br/><b>Team HealthX</b>';
                                    
                                    if(file_exists($pdf_full_path))
                                    $email->attachments($pdf_full_path); 
                                    $email->template('general_email_template');
                                    $email->emailFormat('html');
                                    $email->from($email_from);
                                    $email->to($to_email);
                                    $email->subject($email_subject);
                                    $email->viewVars(array(
                                    'email_content'=>$email_content,
                                    ));
                                    $sent_status = $email->send();
                                    //debug($sent_status);
                                    debug($email_content);
                                    
                                    
                                }
                            }
                        }
                        
                        // Send Email to HealthX Admin
                        
                        $to_email = array(Configure::read('ADMIN_EMAIL')=>Configure::read('ADMIN_NAME'));
                        $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
	
                        $email_subject = "Medical Investigation has been booked";
                        $email_content = 'Dear <b>'.Configure::read('ADMIN_NAME').'</b>,<br/><br/>'.
                            'Please find attached a copy of the voucher for investigations booked.<br/><br/>';
                        $email_content .='Thank you<br/><br/>Team HealthX';
                        if(file_exists($pdf_full_path))
                        $email->attachments($pdf_full_path); 
                        $email->template('general_email_template');
                        $email->emailFormat('html');
                        $email->from($email_from);
                        $email->to($to_email);
                        $email->subject($email_subject);
                        $email->viewVars(array(
				'email_content'=>$email_content,
                            ));
                        $sent_status = $email->send();
                        // End Email
                        
                        
                        $test_list = '';
                        
                        
                        if(!empty($test_list_array)){
                            $test_list = implode(',',$test_list_array);
                        } 
                        
                        // Send Message to Patient
                        
                        if($patient_mobile!=""){
                        
                        //Your authentication key
                        $authKey = Configure::read('SMS_API_KEY');
                        
                        //Multiple mobiles numbers separated by comma
                        $mobileNumber = $patient_mobile;

                        //Sender ID,While using route4 sender id should be 6 characters long.
                        $senderId = Configure::read('SMS_API_SENDER_ID');

                        
                        $text_content = 'Dear '.$patient_name.',';
                        $text_content.= ' Your unique ID is : '.$vouncher_code.' for your - '.$test_list.' at '.$clinic_name.'-'.$clinic_area.'.';
                        $text_content.= ' Validity upto:'.$voucher_valitity_upto.'.';
                        $text_content.= ' Payment:'.$payment_method_text.'.';
                        $text_content.= ' Total Amount :'.$total_amount.' INR.'; 
                        if($home_collection_flag==1){
                            $text_content.= ' Total discount:  '.$total_offer_percentage.'% on tests ( collection charges as applicable).';
                        }else{
                            $text_content.= ' Total discount:  '.$total_offer_percentage.'% on tests.';
                        }
                        $text_content.= ' Quantity:'.$no_of_test.'.';  
                        $text_content.= ' Please call +91-9538080180 for any assistance. Team HealthX';
                        
                        
                        $message = $text_content;
                        
                        
                        //Prepare you post parameters
                        $postData = array(
                            'workingkey' => $authKey,
                            'to' => $mobileNumber,
                            'message' => $message,
                            'sender' => $senderId,
                            
                        );

                        //API URL
                        $url=Configure::read('SMS_API_URL');

                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));


                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                        //get response
                        $output = curl_exec($ch);
                        //print_r($output);
                        //Print error if any
                        if(curl_errno($ch))
                        {
                            echo 'error:' . curl_error($ch);
                        }

                        curl_close($ch);
                        
                        }
                        
                        
                        // Send Message to Contact Number if patient and contact are different
                        
                        
                        if($patient_mobile!=$contact_mobile){
                        
                        //Your authentication key
                        $authKey = Configure::read('SMS_API_KEY');
                        
                        //Multiple mobiles numbers separated by comma
                        $mobileNumber = $contact_mobile;

                        //Sender ID,While using route4 sender id should be 6 characters long.
                        $senderId = Configure::read('SMS_API_SENDER_ID');

                        
                        $text_content = 'Dear '.$contact_name.',';
                        $text_content.= ' Your unique ID is : '.$vouncher_code.' for your - '.$test_list.' at '.$clinic_name.'-'.$clinic_area.'.';
                        $text_content.= ' Validity upto:'.$voucher_valitity_upto.'.';
                        $text_content.= ' Payment:'.$payment_method_text.'.';
                        $text_content.= ' Total Amount :'.$total_amount.' INR.'; 
                        if($home_collection_flag==1){
                            $text_content.= ' Total discount:  '.$total_offer_percentage.'% on tests ( collection charges as applicable).';
                        }else{
                            $text_content.= ' Total discount:  '.$total_offer_percentage.'% on tests.';
                        }
                        $text_content.= ' Quantity:'.$no_of_test.'.';  
                        $text_content.= ' Please call +91-9538080180 for any assistance. Team HealthX';
                        
                        $message = $text_content;
                        
                        
                        //Prepare you post parameters
                        $postData = array(
                            'workingkey' => $authKey,
                            'to' => $mobileNumber,
                            'message' => $message,
                            'sender' => $senderId,
                            
                        );

                        //API URL
                        $url=Configure::read('SMS_API_URL');

                        // init the resource
                        $ch = curl_init();
                        curl_setopt_array($ch, array(
                            CURLOPT_URL => $url,
                            CURLOPT_RETURNTRANSFER => true,
                            CURLOPT_POST => true,
                            CURLOPT_POSTFIELDS => $postData
                            //,CURLOPT_FOLLOWLOCATION => true
                        ));


                        //Ignore SSL certificate verification
                        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
                        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


                        //get response
                        $output = curl_exec($ch);
                        
                        //debug($output);
                       
                        //Print error if any
                        if(curl_errno($ch))
                        {
                            echo 'error:' . curl_error($ch);
                        }

                        curl_close($ch);
                        
                        }
                       
                        //exit;
                        
                        $this->Session->write('BookingTests','');
                        $this->Session->write('BookingPackage','');
                        
                        $this->redirect(array('controller' => 'booking','action' => 'successbooking/'.$this->Encryption->enCrypt($booking_id)));
                       
                         
                         
                         
                     }
                    
                    
                    
                }
                
                
                
                
                
                
            }
        }
        
        function successbooking($booking_id=null){
            
                $booking_id = $this->Encryption->deCrypt($booking_id);
            
                $booking_details = $this->Booking->find('first',array('fields'=>array('Booking.*'),
                            'conditions'=>array('Booking.id'=>$booking_id),
                            'joins' => array(
                         
                        )
                ));
                
                $voucher_file = $booking_details['Booking']['voucher_attachment_name'];
                
                $voucher_upload_dir = Configure::read('webroot_path').'/voucher_uploads';
                
                $voucher_file_full_path = $voucher_upload_dir.'/'.$booking_id.'/'.$voucher_file;
                
                $this->set('voucher_file',$voucher_file_full_path);
                
                $this->set('booking_id',$booking_id);
                
        }
        
        function download_pdf_view($file_name = null,$booking_id=null) {

                $voucher_upload_dir = Configure::read('webroot_path').'/voucher_uploads/'.$booking_id.'/';

		$file_path=$voucher_upload_dir.$file_name.".html";

		$file_op = fopen($file_path, 'r');

		$content = fread($file_op, filesize($file_path));

		fclose($file_op);

		$this->set('content',$content);

		$this->layout = "ajax";

	}
        
        
        function download_pdf_file($booking_id=null) {
            
                $this->pageTitle = 'Download';

                $booking_id = $this->Encryption->deCrypt($booking_id);
            
                $booking_details = $this->Booking->find('first',array('fields'=>array('Booking.*'),
                            'conditions'=>array('Booking.id'=>$booking_id),
                            'joins' => array(
                         
                        )
                ));
                
                $file_name = $booking_details['Booking']['voucher_attachment_name'];
            
                $voucher_upload_dir = Configure::read('webroot_path').'/voucher_uploads/'.$booking_id.'/';

		$file_path=$voucher_upload_dir.$file_name;

		$this->response->file($file_path);
                
                return $this->response;
	}
	
}