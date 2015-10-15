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
        $errorString = '';
        if ($this->isEmpty(trim($data['CreateGroup']['group_name'])) == '') {
            $errorString.='<li>Invalid Group Name.</li>';
        }
        if ($this->isEmpty(trim($data['CreateGroup']['group_code'])) == '') {
            $errorString.='<li>Invalid Group Code.</li>';
        }
        if ($this->isEmpty(trim($data['CreateGroup']['group_type'])) == '') {
            $errorString.='<li>Invalid Group Type.</li>';
        }
        if ($this->isEmpty(trim($data['CreateGroup']['group_admin_email'])) == '') {
            $errorString.='<li>Invalid Email.</li>';
        }
        if ($this->isEmpty(trim($data['CreateGroup']['password'])) == '') {
            $errorString.='<li>Invalid Password.</li>';
        }
        if ($this->isEmpty(trim($data['CreateGroup']['c_password'])) == '') {
            $errorString.='<li>Invalid Password.</li>';
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
