<?php

App::uses('AppController', 'Controller');

class PasswordController extends AppController {
    
    public function forgot_password(){
        $this->layout = '';
        $this->loadModel('Login');
    }
    
    public function forgotPassword(){
        $this->loadModel('Login');
        $result = $this->request->data;
        $error = $this->Login->validation($result);

        if ($error === '') {
            $username = trim($this->request->data['user_name']);
        
            if (!empty($result)) {

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
            $this->Session->setFlash($error);
            //$this->redirect('../Admin/creategroup');
            }
         }
    }
}
?>
