<?php
App::uses('ConnectionManager', 'Model');
App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');
App::uses('CakeEmail', 'Network/Email');

class UserController extends AppController {
    /* display terms and condition page */

    public function displayGroupProfileToUser(){
        $this->layout = '';
                
        $group_id = trim($this->request->data['group_id']);
        $group_name = trim($this->request->data['group_name']);
        
        echo '<pre>';
        print_r($group_id);
        print_r($group_name);die();
        //session
        CakeSession::write('group_id', $group_id);
        CakeSession::write('group_name', $group_name);
        $this->redirect('../Pages/group_page');
    }
    public function termsandcondition() {
        
    }

    /* Display user registration page */

    public function user_registration() {
        $this->layout = '';
        $this->loadModel('User');
    }

    /* Display user profile page */

    public function user_profile() {
        $this->layout = '';
        $this->loadModel('User');

        //session
        $session_user_id = CakeSession::read('session_id');
        $sessionEmail = CakeSession::read('session_email');

        if (empty($session_user_id)) {
            $this->redirect('../login/home');
        }
        // display user profile
        $userInfo = $this->User->find('first', array(
            'conditions' => array('User.user_id' => $session_user_id)));
        $this->set('userInfo', $userInfo);

        //display join group request
        $this->loadModel('JoinGroup');

        $joinGroupRequest = $this->JoinGroup->find('all', array(
            'conditions' => array('user_id' => $session_user_id),
            'fields' => array('group_id','group_name', 'status')));
//        
//        $joinGroupRequest = $this->JoinGroup->find(array('fields' => array('JoinGroup.group_code'=> array(
//        'conditions' => array('user_id' => $session_user_id)))));

        
        $this->set('joinGroupRequest', $joinGroupRequest);

        //display dropdown list of groupname

        $this->loadModel('GetRegisteredGroupData');

        $findUserJoinedGroup = $this->JoinGroup->find('all', array('fields' => array('group_id'),
            'conditions' => array('user_id' => $session_user_id)));
        
        $inClausStr = '(';
        
        if ($findUserJoinedGroup) {
            foreach ($findUserJoinedGroup AS $val) {
               $inClausStr.="'" . trim($val['JoinGroup']['group_id']) . "',";
            }
        } else {
            $inClausStr.="''";
        }

        $inClausStr = trim($inClausStr, ",");
        $inClausStr.=')';
                
        $group_info = $this->GetRegisteredGroupData->query("select * from create_group where group_id NOT IN ".$inClausStr."");
        $this->set('groupInfo', $group_info);
    }

    /* post user registration */

    public function userRegistration() {
        $this->loadModel('User');
        $result = $this->request->data;
        $error = $this->User->validation($result);
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';
        if ($error === '') {
            $username = trim($this->request->data['user_name']);
            $useremail = trim($this->request->data['user_email']);
            $password = trim($this->request->data['password']);
            $cpassword = trim($this->request->data['c_password']);
            $usermobile = trim($this->request->data['user_mobile']);
            // Encrypt your text with my_key
            $encrypted_password = Security::cipher($password, $key);
            if (!empty($result)) {

                $flag = true;
                $this->loadModel('User');
                $userInfo = $this->User->find('all');

                $this->loadModel('CreateGroup');
                $groupInfo = $this->CreateGroup->find('all');

                foreach ($userInfo AS $value) {

                    $user_email = trim($value['User']['user_email']);

                    if ($user_email == $useremail) {
                        $flag = false;
                        break;
                    }
                }
                foreach ($groupInfo AS $value) {

                    $group_admin_email = trim($value['CreateGroup']['group_admin_email']);

                    if ($group_admin_email == $useremail) {
                        $flag = false;
                        break;
                    }
                }

                if ($flag == true) {
                    if ($this->User->save(array('user_name' => $username,
                                'user_email' => $useremail, 'user_mobile' => $usermobile,
                                'password' => $encrypted_password))) {
                        $this->Session->write('message', 'Registration successful');
                        //find user id from db
                        $result = $this->User->find('first', array(
                            'conditions' => array('User.user_email' => $useremail)));
                        //session
                        CakeSession::write('session_id', $result['User']['user_id']);
                        CakeSession::write('session_name', $username);
                        CakeSession::write('session_email', $useremail);

                        $this->redirect('../User/user_profile');
                    } else {
                        $this->Session->write('user_reg_message', 'Registration unsuccessful');
                        $this->redirect('../User/user_registration');
                    }
                } else {
                    $this->Session->write('user_reg_message', 'Already registered');
                    $this->redirect('../User/user_registration');
                }
            }
        } else {
            $this->Session->setFlash($error);
            //$this->redirect('../Admin/creategroup');
        }
    }

    /* Update profile */

    public function updateProfile() {
        $this->loadModel('User');
        $userId = trim($this->request->data['user_id']);
        //$imagePath = trim($this->request->data['profile_image']);
        $userName = trim($this->request->data['user_name']);
        $gender = trim($this->request->data['gender']);
        $userAddress = trim($this->request->data['user_address']);
        $country = trim($this->request->data['country']);
        $state = trim($this->request->data['state']);
        $city = trim($this->request->data['city']);
        $pincode = trim($this->request->data['pincode']);

        if ($this->User->updateAll(array('user_name' => "'$userName'", 'gender' => "'$gender'", 'user_address' => "'$userAddress'",
                    'country' => "'$country'", 'state' => "'$state'", 'city' => "'$city'", 'pincode' => "'$pincode'"), array('user_id' => $userId))) {
            $this->Session->write('message', 'Your profile updated successful');
            $this->redirect('../User/user_profile');
        } else {
            $this->Session->write('message', 'Your profile not updated');
            $this->redirect('../User/user_profile');
        }
    }

    /* Display change password page */

    public function change_password() {
        $this->layout = '';
        $this->loadModel('User');
        $sessionEmail = CakeSession::read('session_email');
        $userInfo = $this->User->find('first', array(
            'conditions' => array('User.user_email' => $sessionEmail)));
        $this->set('userInfo', $userInfo);
    }

    /* post change password */

    public function changePassword() {
        $this->loadModel('User');
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';
        $userId = trim($this->request->data['user_id']);
        $password = trim($this->request->data['password']);
        $cpassword = trim($this->request->data['c_password']);
        $encrypted_password = Security::cipher($password, $key);
            if ($password == $cpassword) {
                if ($this->User->updateAll(array('password' => "'$encrypted_password'"), array('user_id' => $userId))) {
                    $this->Session->write('pcmessage', 'password changed successfully');
                    $this->redirect('../User/change_password');
                } else {
                    $this->Session->write('pcmessage', 'Password not changed');
                    $this->redirect('../User/change_password');
                }
            } else {
                $this->Session->write('pcmessage', 'password and confirm pasword different');
                $this->redirect('../User/change_password');
            }
        }

    /* Join Group */

    public function joinGroup() {
        $this->loadModel('JoinGroup');
        $this->loadModel('CreateGroup');
        $result = $this->request->data;
        $error = $this->JoinGroup->validation($result);

        if ($error === '') {
            $session_userId = CakeSession::read('session_id');
            $session_userName = CakeSession::read('session_name');
            $sesion_userEmailId = CakeSession::read('session_email');
            $group_id = trim($this->request->data['group_id']);
            
            $groupInfo = $this->CreateGroup->find('first', array(
                'conditions' => array('CreateGroup.group_id' => $group_id)));
           
            $group_name = $groupInfo['CreateGroup']['group_name'];
            $group_code = $groupInfo['CreateGroup']['group_code'];
            $status = 'sent';

            if (!empty($result)) {


                if ($this->JoinGroup->save(array('user_id' => $session_userId,
                            'user_name' => $session_userName, 'user_email' => $sesion_userEmailId,
                            'group_id' => $group_id, 'group_name' => $group_name, 'group_code' => $group_code, 'status' => $status))) {
                    $this->Session->write('message', 'Request sent');
                    $this->redirect('../User/user_profile');
                } else {
                    $this->Session->write('message', 'Please send request');
                    $this->redirect('../User/user_profile');
                }
            }
        } else {
            $this->Session->setFlash($error);
            //$this->redirect('../Admin/creategroup');
        }
    }

    /* captcha */

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

}

?>