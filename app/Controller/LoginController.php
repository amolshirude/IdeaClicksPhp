<?php

App::uses('AppController', 'Controller');
App::uses('Security', 'Utility');

class loginController extends AppController {

    public function home() {
        $this->layout = '';
        $key = 'iznWsaal5lKhOKu4f7f0YagKW81ClEBXqVuTjrFovrXXtOggrqHdDJqkGXsQpHf';
        CakeSession::delete('email');
        // Encrypt your text with my_key
        $secret = Security::cipher('Amol@123', $key);

        // Later decrypt your text
        $nosecret = Security::cipher($secret, $key);

//        echo"<pre>";
//        print_r($secret."  ");
//        print_r($nosecret);
//        die();
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
            CakeSession::write('user_id', $userInfo['User']['user_id']);
            CakeSession::write('user_name', $userInfo['User']['user_name']);
            CakeSession::write('email', $userInfo['User']['user_email']);
            $this->redirect('../User/user_profile');
        } else {
            $this->redirect('../login/home');
        }
    }

}

?>
