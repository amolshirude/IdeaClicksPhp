<?php
class User extends AppModel
{
    
var $name='User';
var $primaryKey = 'user_id'; 
public $useDbConfig ='test';
var $useTable = 'user';


function validation($data) {

        $errorString = '';
        if ($this->isEmpty(trim($data['user_name'])) == '') {
            $errorString.='<li>Invalid your name.</li>';
        }
        if ($this->isEmpty(trim($data['user_email'])) == '') {
            $errorString.='<li>Invalid your email.</li>';
        }
        if ($this->isEmpty(trim($data['password'])) == '') {
            $errorString.='<li>Invalid password.</li>';
        }
        if ($this->isEmpty(trim($data['c_password'])) == '') {
            $errorString.='<li>Invalid confirm password.</li>';
        }
       //echo "<pre>";print_r($errorString); die();
        return $errorString;
    }
function isEmpty($check) {
//        echo "check==".$check;exit();
        if ($check == '') {
            $result = 0;
        } else {
            $result = 1;
        }
        return $result;
    }
}
?>
