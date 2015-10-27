<?php

class Category extends AppModel
{
    
var $name='Category';
var $primaryKey = 'category_id'; 
var $foreignKey = 'group_id';
public $useDbConfig ='test';
var $useTable = 'category';


function validation($data) {
//    echo "<pre>"."hi";
//        print_r($data);
//        die();
        $errorString = '';
        if ($this->isEmpty(trim($data['category_name'])) == '') {
            $errorString.='<li>Invalid Category.</li>';
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
