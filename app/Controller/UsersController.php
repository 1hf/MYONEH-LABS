<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {
	
	public $helpers = array('Html', 'Form');

	public $components = array('Encryption');
	
	var $name='Users';
	
	public $uses = array('User');
	
	public function beforeFilter() {
		parent::beforeFilter();
		//$this->Auth->allow('register','socialConnect','userHomePage', 'login','checkuserid','forgot_password','reset_password','admin');
		$this->Auth->allow();
		
	}
	
		
	public function register() {
	        if ($this->request->is('post')) {
	            $this->request->data['User']['group_id'] = Configure::read('UserGroup_Id');
	           	
	            //$old_date = strtotime($this->request->data['User']['birthday']);
	            //$new_date = date('Y-m-d', $old_date);
	            //$this->request->data['User']['birthday'] = $new_date;
	            $this->request->data['User']['email_id'] = $this->request->data['User']['username'];
	            $this->request->data['User']['full_name'] = $this->request->data['User']['screen_name'];
	            //pr($this->request->data);exit;
	            $this->User->create();
	            if ($this->User->save($this->request->data)) {
                        
                        $user_id = $this->User->getInsertID();
                        
                        $user_contact_list = $this->UserContact->find('all',
				array('conditions'=>array('contact_email' => $this->request->data['User']['email_id']),
					 
						)
		
                        );
                        
                        foreach($user_contact_list as $contact_list){
                            $user_contact['id'] = $contact_list['UserContact']['id'];
                            $user_contact['contact_name'] = $contact_list['UserContact']['contact_name'];
                            $user_contact['eventnize_id'] = $user_id;
                            $status = $this->UserContact->save($user_contact);
                        }
                        $this->Auth->login();
	            	$this->redirect(array('controller' => 'userhome','action' => 'index'));
			
	            } else {
	                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
	                $this->redirect(array('controller' => 'pages','action' => 'home'));
	            }
	        }
	}
	    
	public function checkuserid() {
		$this->layout = "ajax";
		$userid = $this->request->data['User']['username'];
		$data = $this->User->find('all',array('conditions' => array('email_id'=> ''.$userid.'' )));
		if(empty($data)){
			echo "success";
			exit;
		}else{
			echo "unsuccess";
			exit;
		}
	}
	
	

	public function forgot_password() {
		
		$this->layout="forgot_password";
		if (!empty($this->request->data)) {
			$getUserDet= $this->User->query("SELECT * from users where username='".$this->request->data['ForgotPassword']['username']."'");
			if(!empty($getUserDet)){
				$userId=$getUserDet[0]['users']['id'];
				$userfullName=$getUserDet[0]['users']['full_name'];
				$userName=$getUserDet[0]['users']['username'];
								
				$this->User->id = $userId;				
				$this->User->read();
				$EncUserId = rand(100,999).base64_encode($userId);
			
			
				$Email = new CakeEmail();
				$Email->template('reset-password');
				$Email->emailFormat('html');
				$Email->from(array('admin@eventnize.com' => 'Eventnize Admin'));
				$Email->to(''.$userName.'');
				$Email->subject('Reset Password');

				//$content="Hi ".$userfullName.",<br/><br/>     Please click the following link to reset your password.<br/><br/>".Configure::read('eventnize_root_path')."users/reset_password/".$EncUserId."<br/><br/>Regards,<br/>Eventnize Team";
				//echo $content;
				$Email->viewVars(array(	'userfullName'=>$userfullName,
										'userName'=>$userName,
										'EncUserId'=>$EncUserId));

				$Email->send();

				$this->redirect(array('controller'=>'users', 'action'=>'forgot_password_sent'));
			}
			else{ 
				
				$this->Session->setFlash('Invalid username.', 'default', array('class'=>'alert alert-error'));
				
			}
		}
		
			
	}
	
	function forgot_password_sent()
	{
		$this->layout="forgot_password";
	}


	function reset_password($EncUserId=0)
	{
		$this->layout="forgot_password";

		if (!empty($this->request->data)) 
		{
			//for decrypt the id
			$unsecure = substr($this->request->data['ResetPassword']['id'],3);
			$DecUserId = base64_decode($unsecure);
			$this->User->id = $DecUserId;
			$this->User->read();
			$this->User->set('password',$this->request->data['ResetPassword']['new_password']);
			if($this->User->save()){
				$this->redirect(array('controller'=>'users', 'action'=>'reset_password_success'));
			}
			else
			{
				$this->Session->setFlash(__('Error while saving your password.'));
				$this->redirect('/');
			}
		}
		$this->set('EncUserId', $EncUserId);

	}


	function profile($encrypted_user_id=0)
	{
		
		$this->layout="profile_layout";
		
		$login_user = 0;
		
		$logged_user_id = $this->Session->read("Auth.User.id");
		if(!empty($logged_user_id))
			$login_user = 1;
		
		$this->set('login_user',$login_user);
		
		$upcmg_events=array();
		$recent_events=array();
		$current_employer=array();
		$decrypted_user_id=$this->Encryption->deCrypt($encrypted_user_id);
		//pr($decrypted_user_id);exit;

		$result=$this->User->query("SELECT User.* from users as User where User.id = $decrypted_user_id ");
		$events=$this->UserEvent->query("SELECT User_Event.* from user_events as User_Event where User_Event.user_id = $decrypted_user_id");
		
		/*Current Employer details.. */
		$employer_details=$this->User->query("SELECT UserCompany.* from user_companies as UserCompany where UserCompany.user_id = $decrypted_user_id ");
		$max = 0;
          foreach ($employer_details as $key =>$val) {
              $max =max($max, $val['UserCompany']['year']); 
          }//echo $max;
        $user_company=$this->User->query("SELECT UserCompany.* from user_companies as UserCompany where UserCompany.year = $max");
        if(isset($user_company[0])){
        $current_employer=$user_company[0]['UserCompany']['company_name'];
		}
		else{
		 $current_employer='';	
		}
		
		
		$upcoming_events = $this->UserEvent->find('all',array('conditions'=>array('UserEvent.user_id'=>$decrypted_user_id,'UserEvent.end_date>now()')));
		
		$recent_events = $this->UserEvent->find('all',array('conditions'=>array('UserEvent.user_id'=>$decrypted_user_id,'UserEvent.end_date<now()')));
		
		$ad_list = array();
		$event_photo='';
		$ad_list=$this->Ad->selectedBanner('profile_page');
		$this->set('ad_list',$ad_list);

		$event_photo = $this->UserImage->query("SELECT UserImage.*,UserProfileImage.* FROM user_images as UserImage, user_public_images as UserProfileImage  where UserImage.id=UserProfileImage.image_id and UserImage.user_id=$decrypted_user_id");	
		//pr($event_photo);exit;

		$this->set('event_photo',$event_photo);
		$this->set('events', $events);
		$this->set('current_employer', $current_employer);
		$this->set('recent_events', $recent_events);
		$this->set('upcmg_events', $upcoming_events);
		$this->set('encrypted_user_id', $encrypted_user_id);
		$this->set('result', $result);
	}


	function reset_password_success()
	{
		$this->layout="forgot_password";
	}

        public function login() {
    	$this->layout = "login-layout";
		if ($this->request->is('post')) { 
	    	if ($this->Auth->login()) {
	    		/*if($this->request->data['User']['rememberme'] == '1'){
	    			$this->Cookie->write('username',$this->request->data['User']['username']);
	    			
	    		}*/
	    		$redir = $this->Session->read('redir');
	    		//print_r($redir);exit;
	    		//$this->redirect(array('action' => 'loginRedirect'));
	    		
	    		if (!empty($redir)) {
	    			$this->redirect ($redir);
	    			//$this->redirect ($this->webroot."".$redir['controller']."\".$redir['action']."\".$redir[0]);
	    		} else {
	    			$this->redirect(array('action' => 'loginRedirect'));
	    		}
	           	
	        } else {
	            $this->Session->setFlash('Your attempt to login got failed because of invalid username or password.');
	         	if(isset($this->request->data['User']['admin']) && $this->request->data['User']['admin']=='yes'){
	            	$this->redirect(array('controller' => 'users', 'action' => 'admin'));
	            }else{
	            	$this->redirect(array('controller' => 'users', 'action' => 'login'));
	            }
	            
	            
	        }
	    }
	}

	
	public function logout() {
		$group_id = $this->Session->read('Auth.User.group_id');
		$this->Session->destroy();
		$this->Cookie->delete('username');
		$this->Session->delete('User');
		$this->Auth->logout();
		if($group_id == Configure::read('AdminGroup_Id')){
			$this->redirect(array('controller' => 'users', 'action' => 'admin'));
		}else if($group_id == Configure::read('UserGroup_Id')){
			$this->redirect('/');
		}else{
			$this->redirect('/');
		}
	}
	
	public function loginRedirect(){
		$group_id = $this->Session->read('Auth.User.group_id');
		if($group_id == Configure::read('AdminGroup_Id')){
			$this->redirect(array('controller' => 'manage_area', 'action' => 'list_areas'));
		}else if($group_id == Configure::read('UserGroup_Id')){
			$this->redirect(array('controller' => 'userhome', 'action' => 'index'));
		}
	}
	
	
	
	/* ------------------------------- admin area starts --------------------------- */
	
	public function admin(){
		$this->layout = "admin-login";
	}
	
	public function adminDashboard(){
		$this->layout = "admin-layout";
		$this->redirect(array('controller' => 'manage_areas', 'action' => 'list_areas'));
	}
	
	
	public function viewusers()
	{
		$this->layout = "admin-layout";
		$this->search_users();
	}
	
	
	function search_users($limit=null, $jString=null)
	{
		$conditions = array();
		array_push($conditions, "User.group_id NOT LIKE '1'");
		if($jString!='')
		{
			$jString = stripslashes($_REQUEST['jString']);
			$filter = json_decode($jString);
			foreach($filter as $key => $filterValue)
			{
				if($key == 'email_id' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					array_push($conditions, "User.email_id LIKE '%$filterValue%'");
				}
	
			}
		}
	
			
	
		if( empty($limit) ){
			$limit = Configure::read('PaginationLimit');
		}
	
		//Paginate "Users"
		$this->paginate = array(
				'fields' => array('User.id','User.full_name','User.email_id','User.gender','User.city','User.created'),
				'conditions' => $conditions,
				'recursive' => -1,
				'order' => array(),
				'limit' => $limit
		);
	
		$eventUsersList = $this->paginate('User');
		$this->set('usersList', $eventUsersList);
		$this->set('limit', $limit);
	
		$this->set('sysAdmSeldMenu', 'Manage Speciality');
	}
	
	function list_users($limit=null, $jString=null)
	{
		if(!empty($_REQUEST['jString'])){
			$jString = $_REQUEST['jString'];
		}
		$this->layout = "ajax";
		$this->search_users($limit, $jString);
		$this->render('/Elements/users/list_users');
	}
	
	public function detail($id=null){
		if($id){
			$this->layout = false;
			$this->request->data = $this->User->read(null,$id);
		}
	}
	
	/* ------------------------------- admin area ends --------------------------- */
	
}
