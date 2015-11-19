<?php
class JoinGroup extends AppModel
{
    
var $name='JoinGroup';
var $primaryKey = 'request_id';
var $foreignKey = 'user_id';
public $useDbConfig ='test';
var $useTable = 'join_group';


function validation($data) {
        $errorString = '';
        if ($this->isEmpty(trim($data['group_id'])) == '') {
            $errorString.='<li>Invalid group name.</li>';
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