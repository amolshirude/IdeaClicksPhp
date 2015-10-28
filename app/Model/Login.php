<?php
class Login extends AppModel
{
    
var $name='Login';
var $primaryKey = 'id'; 
public $useDbConfig ='test';
var $useTable = 'login';


function validation($data) {
        $errorString = '';
        if ($this->isEmpty(trim($data['email'])) == '') {
            $errorString.='<li>Invalid email.</li>';
        }
        if ($this->isEmpty(trim($data['password'])) == '') {
            $errorString.='<li>Invalid password.</li>';
        }
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