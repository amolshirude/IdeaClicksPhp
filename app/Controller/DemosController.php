<?php

App::uses('AppController', 'Controller');

class DemosController extends AppController {

    public $uses = array();

    public function creategroup() {
        $this->loadModel('SelectGroupType');
        $group_type = $this->SelectGroupType->find('all');
        
        $groupListWithCode = array();
        foreach ($group_type AS $arr => $value) {
//           print_r($value);
            $groupid = trim($value['SelectGroupType']['id']);
            $grouptype = trim($value['SelectGroupType']['type']);
            $groupListWithCode[$groupid] = $grouptype;
        }
//        echo "<pre>";
//        print_r($groupLsitWithCode);
//        die();
        $this->set('groupListWithCode', $groupListWithCode);

    }
    
    

    function register() {
               
        $this->loadModel('CreateGroup');
        $result = $this->request->data;
        $groupname = trim($this->request->data['group_name']);
        $groupcode = trim($this->request->data['group_code']);
        $grouptype = trim($this->request->data['group_type']);
        $groupadminemail = trim($this->request->data['group_admin_email']);
        $password = trim($this->request->data['password']);
        $cpassword = trim($this->request->data['c_password']);

        if (!empty($result)) {
           
            $flag = true;
            $this->loadModel('GetRegisteredGroupData');
            $group_info = $this->GetRegisteredGroupData->find('all');
            
            foreach ($group_info AS $arr => $value) {
            
               $group_admin_email = trim($value['GetRegisteredGroupData']['group_admin_email']);
           
               if($group_admin_email == $groupadminemail){
                  $flag = false; 
                  break;
               }
                
            }
           if($flag == true){
            if ($this->CreateGroup->save(array('group_name' => $groupname, 'group_code' => $groupcode,
                        'group_type' => $grouptype, 'group_admin_email' => $groupadminemail,
                        'password' => $password, 'c_password' => $cpassword))) {
                $this->flash('Registration Successful', '../Demos/creategroup');
            } else {
                $this->flash('Not succeeded', '../Demos/creategroup');
            }
            }
            else {
                $this->flash('Already Registered', '../Demos/creategroup');    
            }
        }
        
    }

}
