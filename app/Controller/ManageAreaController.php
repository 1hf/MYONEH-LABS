<?php

App::uses('AppController', 'Controller');


class ManageAreaController extends AppController
{

	/**
	 * Controller name
	 *
	 * @var string
	 */
	public $name = 'ManageArea';

	/**
	 * This controller does not use a model
	 *
	 * @var array
	 */
	public $uses = array('Area','City');
	
	/**
	 * This controller uses the following layout
	 *
	 * @var string
	 */
	var $layout = "admin-layout";
		
	public function beforeFilter()
	{
		parent::beforeFilter();
		
		$this->Auth->allow('search_areas','list_area_element','perform_operation_area_status');
	}
	
	/**
	 * This method is used to display the list of event categories in the system.
	 */
	function list_areas()
	{
		$this->search_areas();
		
		$city_options = $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.status_id'=>1)));

                $this->set('city_options', $city_options);
	}
	
	/**
	 * This method is used to search eventcategories in the system*/
	
	function search_areas($limit=null, $jString=null)
	{
		$conditions = array('');
		
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
		
			foreach($filter as $key => $filterValue)
			{
				if($key == 'area_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "Area.area_name LIKE '%$filterValue%'");
				}
				if($key == 'city_id' && !empty($filterValue)){
					array_push($conditions, "Area.city_id = '$filterValue'");
				}
				
			}
			
		}
		

		
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
		
		
		
		//Paginate "EventCategory"
		$this->paginate = array(
			'fields' => array('Area.id','Area.area_name','Area.city_id','Area.status_id','City.city_name'),
			'conditions' => $conditions,
			'recursive' => -1,
			'order' => array('Area.area_name'=>'ASC'),
			'limit' => $limit,
                        'joins' => array(
                         array(
                            'table' => 'cities',
                            'alias' => 'City',
                            'conditions'=> array('Area.city_id = City.id')
                        )
                        ),
		);
		
		$areaList = $this->paginate('Area');
		
		
		
		$this->set('areaList', $areaList);
		$this->set('limit', $limit);
		
		$this->set('sysAdmSeldMenu', 'Manage Speciality');
	}
	
	/**
	 * This method is used to display the list of specialities in the system on click of search / pagination options.
	 */
	function list_area_element($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_areas($limit, $jString);
		$this->render('/Elements/ManageArea/list_area_element');
	}
	
	/**
	 * This method is used to add / edit event category
	 */ 

	function add_edit_area($areaId=0)
	{
			
		//If the form is submitted
		

		$selectedCity = '';
		
		if(!empty($this->data))
		{
			
			
			//set the data to "Area" model
			$this->Area->set($this->request->data);
			
			//validate the data
			if($this->Area->validates())
			{	
                                $this->request->data['Area']['status_id'] =1;
                              
                                
				pr($this->request->data['Area']);
				$this->Area->save($this->request->data);
				if($areaId>0){
					$this->Session->setFlash('Area has been updated successfully.', 'default', array('class'=>'success message'));
				}else{
					$this->Session->setFlash('Area has been added successfully.', 'default', array('class'=>'success message'));
				}
				
				$this->redirect(array('action' => 'list_areas'));
			}else{
				$errors = $this->Area->validationErrors;
				debug($errors);
			}
		}
		//else, display the form with pri filled Specialitiy details, ready for view / edit
		else{
                        $result = $this->Area->query("SELECT Area.* FROM areas AS Area WHERE Area.id = $areaId");
			if(isset($result[0])){
				$this->request->data = $result[0];
				$selectedCity = $result[0]['Area']['city_id'];
			}
                        $city_options = $this->City->find('list',array('fields'=>array('id','city_name'),'conditions'=>array('City.status_id'=>1)));
		}
		
		
		
		$this->set('city_options', $city_options);
		$this->set('selectedCity', $selectedCity);
		
		
		$this->set('areaId', $areaId);
		$this->set('sysAdmSeldMenu', 'Manage Area');
	}
	
	
	function perform_operation_area_status(){
            
		$areaId = $_REQUEST['areaId'];
		$currentStatus = $_REQUEST['currentStatus'];
		
		if(Configure::read('Active_id')==$currentStatus)
			$changeStatusTo = Configure::read('Inactive_id');
		else
			$changeStatusTo = Configure::read('Active_id');
		
		$this->Area->query("UPDATE areas SET status_id = $changeStatusTo WHERE id = $areaId");
		$this->Session->setFlash("The area status has been changed successfully.",'default', array('class' => 'message success'));
		echo '1';
		exit;
		
	}
	
}

?>