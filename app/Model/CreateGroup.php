<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CreateGroup extends AppModel
{
    
var $name='CreateGroup';
var $primaryKey='group_id'; 
public $useDbConfig ='test';
var $useTable = 'create_group';


function validation($data) {
//    echo "<pre>"."hi";
//        print_r($data);
//        die();
        $errorString = '';
        if ($this->isEmpty(trim($data['group_name'])) == '') {
            $errorString.='<li>Invalid Group Name.</li>';
        }
        if ($this->isEmpty(trim($data['group_code'])) == '') {
            $errorString.='<li>Invalid Group Code.</li>';
        }
        if ($this->isEmpty(trim($data['group_type'])) == '') {
            $errorString.='<li>Invalid Group Type.</li>';
        }
        if ($this->isEmpty(trim($data['group_admin_email'])) == '') {
            $errorString.='<li>Invalid Email.</li>';
        }
        if ($this->isEmpty(trim($data['password'])) == '') {
            $errorString.='<li>Invalid Password.</li>';
        }
        if ($this->isEmpty(trim($data['c_password'])) == '') {
            $errorString.='<li>Invalid Password.</li>';
        }
//        echo "<pre>";print_r($errorString); die();
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
