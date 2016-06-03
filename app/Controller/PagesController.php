<?php
/**
 * Static content controller.
 *
 * This file will render views from views/pages/
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('AppController', 'Controller');

App::uses('CakeEmail', 'Network/Email');

/**
 * Static content controller
 *
 * Override this controller by placing a copy in controllers directory of an application
 *
 * @package       app.Controller
 * @link http://book.cakephp.org/2.0/en/controllers/pages-controller.html
 */
class PagesController extends AppController {

	public $uses = array('Clinic');
    var $layout = "home-layout";
		
    public function beforeFilter() {
   		parent::beforeFilter();
   		$this->Auth->allow();
     }	   
	
	public function display() {
		$path = func_get_args();
		$count = count($path);
		if (!$count) {
			return $this->redirect('/');
		}
		$page = $subpage = $title_for_layout = null;

		if (!empty($path[0])) {
			$page = $path[0];
		}
		if (!empty($path[1])) {
			$subpage = $path[1];
		}
		if (!empty($path[$count - 1])) {
			$title_for_layout = Inflector::humanize($path[$count - 1]);
		}
		$this->set(compact('page', 'subpage', 'title_for_layout'));

		try {
			$this->render(implode('/', $path));
		} catch (MissingViewException $e) {
			if (Configure::read('debug')) {
				throw $e;
			}
			throw new NotFoundException();
		}
	}
        
        public function aboutus(){
		
	}
	public function contactus(){
		
	}
	public function partner_with_us(){
            
        }    
	
        public function save_partner_with_us(){
		//debug($_POST);	
		$this->autoRender=false;
		$jString = stripslashes($_REQUEST['jString']);
		$filter = json_decode($jString);
		if($jString!='')
		{
			foreach($filter as $key => $filterValue)
			{
				if($key == 'parnter_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_name = $filterValue;
				}
				if($key == 'parnter_email' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_email = $filterValue;
				}
				if($key == 'parnter_mobile' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_mobile = $filterValue;
				}
                                if($key == 'parnter_organaization' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$parnter_organaization = $filterValue;
				}
                                if($key == 'parnter_address' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$parnter_address = $filterValue;
				}
				if($key == 'parnter_proposition' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$parnter_proposition = $filterValue;
				}					
			}			
		}
                
        // Send Email to contact email
        if(!empty($contactus_email)){
                            
            $email = new CakeEmail();    
                            
            $to_email = array(Configure::read('ADMIN_EMAIL')=>Configure::read('ADMIN_NAME'));
            $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
	    
            $email_subject =   ucfirst($contactus_name).' submitted partner with us form in  healthX website.';
            $email_content = 'Dear <b>HealthX</b>,<br/><br/>'.
                            ucfirst($contactus_name).' submitted partner with us form in  healthX website.<br/>'.
							'<br> Name:'.ucfirst($contactus_name).
							'<br> Email:'.$contactus_email.
							'<br> Mobile:'.$contactus_mobile;
                        if(!empty($parnter_organaization)){
                            $email_content .='<br> Organization:'.$parnter_organization;
                        }
                        if(!empty($parnter_address)){
                            $email_content .='<br> Message:'.$parnter_address;
                        }
                        if(!empty($contactus_message)){
                            $email_content .='<br> Proposition:'.$parnter_proposition;
                        }
			$email_content .='<br/><br/>Thank you<br/><br/>Team HealthX';
                        
          
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
    
        public function our_partners(){
            
            $clinic_details = $this->Clinic->find('all',array('fields'=>array('Clinic.*','Area.*','City.*'),
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
            
            $this->set('clinic_details',$clinic_details);
            
        }
        
	public function request_contactus(){
		//debug($_POST);	
		$this->autoRender=false;
		$jString = stripslashes($_REQUEST['jString']);
		$filter = json_decode($jString);
		if($jString!='')
		{
			foreach($filter as $key => $filterValue)
			{
				if($key == 'contactus_name' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_name = $filterValue;
				}
				if($key == 'contactus_email' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_email = $filterValue;
				}
				if($key == 'contactus_mobile' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_mobile = $filterValue;
				}	
				if($key == 'contactus_message' && !empty($filterValue)){
					$filterValue = str_replace("_RemSp_"," ",$filterValue);
					$contactus_message = $filterValue;
				}					
			}			
		}
                
                // Send Email to contact email
                if(!empty($contactus_email)){
                            
                $email = new CakeEmail();    
                            
                $to_email = array(Configure::read('ADMIN_EMAIL')=>Configure::read('ADMIN_NAME'));
                $email_from = array(Configure::read('NO_REPLY_EMAIL')=>Configure::read('NO_REPLY_EMAIL_NAME'));
		$email_subject =  ucfirst($contactus_name).' tried to contact us through healthX website.';
                $email_content = 'Dear <b>HealthX</b>,<br/><br/>'.
                            ucfirst($contactus_name).' tried to contact us through healthX website.<br/>'.
							'<br> Name:'.ucfirst($contactus_name).
							'<br> Email:'.$contactus_email.
							'<br> Mobile:'.$contactus_mobile.'<br> Message:'.$contactus_message;
			$email_content .='<br/><br/>Thank you<br/><br/>Team HealthX';
          
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
