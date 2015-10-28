<?php

App::uses('AppController', 'Controller');

class loginController extends AppController {

    public function login() {
        $this->layout = '';
        $this->loadModel('Login');
    }

    public function postLogin() {
        $this->loadModel('Login');
        $email = trim($this->request->data['email']);
        $password = trim($this->request->data['password']);
        
        
        $this->redirect('../User/user_profile');
    }

}

?>
