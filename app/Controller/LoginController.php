<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class loginController extends AppController {

    public function home() {
        $this->layout = 'Home_layout';
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';

        CakeSession::delete('session_id');
        CakeSession::delete('session_name');
        CakeSession::delete('session_email');
        CakeSession::delete('session_code');
    }

    public function postLogin() {
        $this->loadModel('User');

        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';

        $email = trim($this->request->data['email']);
        $password = trim($this->request->data['password']);
        $encrypted_password = Security::cipher($password, $key);

        $opts = array(
            'conditions' => array(
                'and' => array(
                    'User.user_email' => $email,
                    'User.password' => $encrypted_password)));
        $userInfo = $this->User->find('first', $opts);
        if ($userInfo) {
            //session
            CakeSession::write('session_id', $userInfo['User']['user_id']);
            CakeSession::write('session_name', $userInfo['User']['user_name']);
            CakeSession::write('session_email', $userInfo['User']['user_email']);
            $this->redirect('../User/user_profile');
        } else {
            $this->loadModel('CreateGroup');
            $opts = array(
                'conditions' => array(
                    'and' => array(
                        'CreateGroup.group_admin_email' => $email,
                        'CreateGroup.password' => $encrypted_password)));
            $groupInfo = $this->CreateGroup->find('first', $opts);
            if ($groupInfo) {
                //session
                CakeSession::write('session_id', $groupInfo['CreateGroup']['group_id']);
                CakeSession::write('session_name', $groupInfo['CreateGroup']['group_name']);
                CakeSession::write('session_code', $groupInfo['CreateGroup']['group_code']);
                CakeSession::write('session_email', $groupInfo['CreateGroup']['group_admin_email']);
                $this->redirect('../Admin/group_profile');
            } else {
                $this->Session->write('login_message', 'Invalid username or password');
                $this->redirect('../login/home');
            }
        }
    }
}
?>