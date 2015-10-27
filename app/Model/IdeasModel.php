<?php
class IdeasModel extends AppModel
{
    
var $name='IdeasModel';
var $primaryKey = 'ideas_id'; 
var $foreignKey = 'group_id';
public $useDbConfig ='test';
var $useTable = 'ideas';


function validation($data) {
//    echo "<pre>"."hi";
//        print_r($data);
//        die();
        $errorString = '';
        if ($this->isEmpty(trim($data['ideas_title'])) == '') {
            $errorString.='<li>Invalid ideas title.</li>';
        }
        if ($this->isEmpty(trim($data['ideas_description'])) == '') {
            $errorString.='<li>Invalid ideas description.</li>';
        }
        if ($this->isEmpty(trim($data['ideas_category'])) == '') {
            $errorString.='<li>Invalid ideas category.</li>';
        }
        if ($this->isEmpty(trim($data['ideas_status'])) == '') {
            
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
