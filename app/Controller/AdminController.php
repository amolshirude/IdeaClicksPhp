<?php

App::uses('AppController', 'Controller');

class AdminController extends AppController {

    public $uses = array();
    
    public function termsandcondition() {
        
    }

    public function get_captcha() {
        $this->autoRender = false;
        App::import('Component', 'Captcha');

        //generate random charcters for captcha
        $random = mt_rand(100, 99999);

        //save characters in session
        $this->Session->write('captcha_code', $random);

        $settings = array(
            'characters' => $random,
            'winHeight' => 50, // captcha image height 
            'winWidth' => 220, // captcha image width
            'fontSize' => 25, // captcha image characters fontsize 
            'fontPath' => WWW_ROOT . 'tahomabd.ttf', // captcha image font
            'noiseColor' => '#ccc',
            'bgColor' => '#fff',
            'noiseLevel' => '100',
            'textColor' => '#000'
        );
        $img = $this->Captcha->ShowImage($settings);
        echo $img;
    }
    public function group_profile(){
         $this->layout = '';
       
        $this->loadModel('SelectGroupType');
        $group_type = $this->SelectGroupType->find('all');

        $groupTypeList = array();
        foreach ($group_type AS $arr => $value) {
//           print_r($value);
            $groupid = trim($value['SelectGroupType']['id']);
            $grouptype = trim($value['SelectGroupType']['type']);
            $groupTypeList[$groupid] = $grouptype;
        }
//        echo "<pre>";
//        print_r($groupLsitWithCode);
//        die();
        $this->set('groupListWithCode', $groupTypeList);
    }
    public function creategroup() {
        $this->layout = '';
       
        $this->loadModel('SelectGroupType');
        $group_type = $this->SelectGroupType->find('all');

        $groupTypeList = array();
        foreach ($group_type AS $arr => $value) {
//           print_r($value);
            $groupid = trim($value['SelectGroupType']['id']);
            $grouptype = trim($value['SelectGroupType']['type']);
            $groupTypeList[$groupid] = $grouptype;
        }
//        echo "<pre>";
//        print_r($groupLsitWithCode);
//        die();
        $this->set('groupListWithCode', $groupTypeList);

        $this->loadModel('GetRegisteredGroupData');
        $group_info = $this->GetRegisteredGroupData->find('all', array(
            'order' => array('GetRegisteredGroupData.group_name' => 'asc')));
        $count = 0;
        foreach ($group_info AS $arr => $value) {
            $count++;
            $groupid = trim($value['GetRegisteredGroupData']['group_id']);
            $groupname = trim($value['GetRegisteredGroupData']['group_name']);
            $groupcode = trim($value['GetRegisteredGroupData']['group_code']);
            $groupnamecode = $groupname .' ( '. $groupcode.' )';
            $groupNameListWithGroupCode[$groupid] = $groupnamecode;
        }
        $this->set('noofgroups', $count);
        $this->set('groupNameListWithGroupCode', $groupNameListWithGroupCode);
    }

    function register() {

        $this->loadModel('CreateGroup');
        $result = $this->request->data;
        $error = $this->CreateGroup->validation($result);
//        echo "<pre>";
//                print_r($error);die();
        if ($error === '') {
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

                    if ($group_admin_email == $groupadminemail) {
                        $flag = false;
                        break;
                    }
                }
                if ($flag == true) {
                    if ($this->CreateGroup->save(array('group_name' => $groupname, 'group_code' => $groupcode,
                                'group_type' => $grouptype, 'group_admin_email' => $groupadminemail,
                                'password' => $password, 'c_password' => $cpassword))) {
                        $this->Session->write('message', 'Registration successful');
                        $this->redirect('../Demos/creategroup');
                    } else {
                        $this->Session->write('message', 'Registration unsuccessful');
                        $this->Session->delete($name);
                        $this->redirect('../Demos/creategroup');
                    }
                } else {
                    $this->Session->write('message', 'Already registered');
                    $this->redirect('../Demos/creategroup');
                }
            }
        }
        else{
            $this->Session->setFlash($error); 
            //$this->redirect('../Demos/creategroup');
        }
    }

}
