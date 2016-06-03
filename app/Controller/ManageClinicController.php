<?php
App::uses('AppController', 'Controller');

class ManageClinicController extends AppController
{
	/**
	 * Controller name :ManageClinicController
	 * Created By : Rithin Prabhakar for Capsten Technologies
	 * All rights reserved for Capsten Technologies	 
	 * Dated: 22- Nov-2014
	 * @var string
	 */
	public $name = 'ManageClinic';
	public $uses = array('Clinic','City','Area');
	
	/**
	   * This controller uses the following layout	
	 */
	var $layout = "admin-layout";
		
	public function beforeFilter()
	{
		parent::beforeFilter();		
		$this->Auth->allow('search_clinics','list_clinic_element','perform_operation_clinic_status');
	}
	
	/**
	 * This method is used to display the list of event categories in the system.
	 */
	function list_clinics()
	{
		$this->search_clinics();		
	}
	//search/list clinics	
	function search_clinics($limit=null, $jString=null)
	{
		$conditions = array('');
		$selectedArea ='';
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);		
			foreach($filter as $key => $filterValue)
			{
				if($key == 'clinic_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Clinic.clinic_name LIKE '%$filterValue%'");
				}
				if($key == 'area_id' && !empty($filterValue)){
					array_push($conditions, "Clinic.area_id = '$filterValue'");
					$selectedArea =$filterValue;
				}				
			}			
		}
		
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
		//Paginate "EventCategory"
		$this->paginate = array(
			'fields' => array('Clinic.id','Clinic.clinic_name','Clinic.address_line1','Clinic.address_line2','Clinic.address_line3','Clinic.email','Clinic.tel_mobile','Clinic.status_id','City.city_name','Area.area_name'),
			'conditions' => $conditions,
			'joins' => array(
                         array( 'table' => 'cities',
                            'alias' => 'City',
                            'conditions'=> array('Clinic.city_id = City.id')
                        ), array( 'table' => 'areas',
                            'alias' => 'Area',
                            'conditions'=> array('Clinic.area_id = Area.id')
                        )
                        ),
			'recursive' => -1,
			'order' => array('Clinic.clinic_name'=>'ASC'),
			'limit' => $limit
		);
		
		$clinicList = $this->paginate('Clinic');
		$area_options = $this->Area->find('list',array('fields'=>array('id','area_name')));
		$this->set('area_options', $area_options);
		$this->set('clinicList', $clinicList);
		$this->set('limit', $limit);
		$this->set('selectedArea', $selectedArea);
		$this->set('sysAdmSeldMenu', 'Manage Speciality');
	}
	// function is using for searching clinics
	function list_clinic_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_clinics($limit, $jString);
		$this->render('/Elements/ManageClinic/list_clinic_element');
	}
	
	/**
	 * This method is used to add / edit Clinic
	 */ 

	function add_edit_clinic($clinic_id=0)
	{
		//print_r($this->data);
                //exit;
		$selectedCity = '';$selectedArea='';		
		if(!empty($this->data)){		
			
			//set the data to "Area" model
			$this->Clinic->set($this->request->data);			
			//validate the data
			if($this->Clinic->validates())
			{	
                $this->request->data['Clinic']['status_id'] =1;	
				//debug($this->request->data); die;					
                $this->request->data['Clinic']['email'] = $this->request->data['Clinic']['email_add'];
				$this->Clinic->save($this->request->data);
				if($this->request->data['Clinic']['id']>0){
					$last_insert_id=$this->request->data['Clinic']['id'];
				}else{
					$last_insert_id= $this->Clinic->getLastInsertID();
				}
				if($this->request->data['Clinic']['logo_file']['name'] ){				
				 $filename  = basename($this->request->data['Clinic']['logo_file']['name']);
                 $extension = pathinfo($filename, PATHINFO_EXTENSION);
                 $extension = strtolower($extension);
				 $file_name= $last_insert_id."_logo.".$extension; 
				 $filePath = Configure::read('webroot_path')."/upload/clinics/".$last_insert_id."/".$file_name; 
				 mkdir(Configure::read('webroot_path')."/upload/clinics/".$last_insert_id,0777,true); 
				 if(move_uploaded_file($this->request->data['Clinic']['logo_file']['tmp_name'], $filePath)){
						$this->Clinic->query("UPDATE clinics SET logo ='$file_name' WHERE id =$last_insert_id");
						//echo "File uploaded Successfully"; die;
					}
				 }	
				
				if($clinic_id>0){
					$this->Session->setFlash('Clinic has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Clinic has been added successfully.', 'default', array('class'=>'success message'));
				}				
				$this->redirect(array('action' => 'list_clinics'));
			}else{
				$errors = $this->Clinic->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
            $result = $this->Clinic->query("SELECT Clinic.* FROM clinics AS Clinic WHERE Clinic.id = $clinic_id");
			if(isset($result[0])){
				$this->request->data = $result[0];
                                $this->request->data['Clinic']['email_add'] = $this->request->data['Clinic']['email'];
				$selectedCity = $result[0]['Clinic']['city_id'];
				$selectedArea = $result[0]['Clinic']['area_id'];
			}
                       
		}
		
		 $city_options = $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.status_id'=>1)));
		$area_options = $this->Area->find('list',array('fields'=>array('id','area_name')));
		$this->set('city_options', $city_options);
		$this->set('area_options', $area_options);
		$this->set('selectedCity', $selectedCity);		
		$this->set('selectedArea', $selectedArea);
		$this->set('clinic_id', $clinic_id);
		$this->set('sysAdmSeldMenu', 'Manage Clinic');
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
	
	function perform_operation_clinic_status(){
            
		$clinic_id = $_REQUEST['clinicId'];
		$currentStatus = $_REQUEST['currentStatus'];		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Clinic->query("UPDATE clinics SET status_id = $changeStatusTo WHERE id = $clinic_id");
		$this->Session->setFlash("The clinic status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
	
}

?>