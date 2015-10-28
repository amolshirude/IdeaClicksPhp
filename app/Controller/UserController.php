<?php

App::uses('AppController', 'Controller');

class UserController extends AppController {
    /* display terms and condition page */

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
        $user_id = //get user id from session;
                $userInfo = $this->User->find('first', array(
            'conditions' => array('User.user_id' => 1)));
        $this->set('userInfo', $userInfo);

        $this->loadModel('GetRegisteredGroupData');
        $group_info = $this->GetRegisteredGroupData->find('all', array(
            'order' => array('GetRegisteredGroupData.group_name' => 'asc')));

        foreach ($group_info AS $arr => $value) {

            $groupid = trim($value['GetRegisteredGroupData']['group_id']);
            $groupname = trim($value['GetRegisteredGroupData']['group_name']);
            $groupcode = trim($value['GetRegisteredGroupData']['group_code']);
            $groupnamecode = $groupname . ' ( ' . $groupcode . ' )';
            $groupNameListWithGroupCode[$groupid] = $groupnamecode;
        }

        $this->set('groupNameListWithGroupCode', $groupNameListWithGroupCode);
    }

    /* post user registration */

    public function userRegistration() {
        $this->loadModel('User');
        $result = $this->request->data;
        $error = $this->User->validation($result);

        if ($error === '') {
            $username = trim($this->request->data['user_name']);
            $useremail = trim($this->request->data['user_email']);
            $password = trim($this->request->data['password']);
            $cpassword = trim($this->request->data['c_password']);
            $usermobile = trim($this->request->data['user_mobile']);

            if (!empty($result)) {

                $flag = true;
                $this->loadModel('User');
                $user_info = $this->User->find('all');

                foreach ($user_info AS $arr => $value) {

                    $user_email = trim($value['User']['user_email']);

                    if ($user_email == $useremail) {
                        $flag = false;
                        break;
                    }
                }
                if ($flag == true) {
                    if ($this->User->save(array('user_name' => $username,
                                'user_email' => $useremail, 'user_mobile' => $usermobile,
                                'password' => $password, 'c_password' => $cpassword))) {
                        $this->Session->write('message', 'Registration successful');
                        $this->redirect('../User/user_profile');
                    } else {
                        $this->Session->write('message', 'Registration unsuccessful');
                        $this->Session->delete($name);
                        $this->redirect('../User/user_registration');
                    }
                } else {
                    $this->Session->write('message', 'Already registered');
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
        $userName = trim($this->request->data['user_name']);
        $gender = trim($this->request->data['gender']);
        $userAddress = trim($this->request->data['user_address']);
        $country = trim($this->request->data['country']);
        $state = trim($this->request->data['state']);
        $city = trim($this->request->data['city']);
        $pincode = trim($this->request->data['pincode']);

        if ($this->User->updateAll(array('user_name' => "'$userName'", 'gender' => "'$gender'", 'user_address' => "'$userAddress'",
                    'country' => "'$country'", 'state' => "'$state'", 'city' => "'$city'", 'pincode' => "'$pincode'"), array('user_id' => $userId))) {
            $this->Session->write('message', 'updated successful');
            $this->redirect('../User/change_password');
        } else {
            $this->Session->write('message', 'Your Idea not updated');
            $this->redirect('../User/user_profile');
        }
    }

    /* Display change password page */

    public function change_password() {
        $this->layout = '';
        $this->loadModel('User');
        $user_id = //get user id from session;
                $userInfo = $this->User->find('first', array(
            'conditions' => array('User.user_id' => 1)));
        $this->set('userInfo', $userInfo);
    }

    /* post change password */

    public function changePassword() {
        $this->loadModel('User');
        $userId = trim($this->request->data['user_id']);
        $password = trim($this->request->data['password']);
        $cpassword = trim($this->request->data['c_password']);
        if ($password == $cpassword) {
            if ($this->User->updateAll(array('password' => "'$password'"), array('user_id' => $userId))) {
                $this->Session->write('message', 'password changed successfully');
                $this->redirect('../Ideas/submit_ideas');
            } else {
                $this->Session->write('message', 'Password not changed');
                $this->redirect('../User/change_password');
            }
        } else {
            $this->Session->write('message', 'password and confirm pasword different');
            $this->redirect('../User/change_password');
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