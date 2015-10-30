<?php
class IdeaModel extends AppModel
{
    
var $name='IdeaModel';
var $primaryKey = 'idea_id'; 
var $foreignKey = 'group_id';
public $useDbConfig ='test';
var $useTable = 'ideas';


function validation($data) {

        $errorString = '';
        if ($this->isEmpty(trim($data['idea_title'])) == '') {
            $errorString.='<li>Invalid idea title.</li>';
        }
        if ($this->isEmpty(trim($data['idea_description'])) == '') {
            $errorString.='<li>Invalid idea description.</li>';
        }
        if ($this->isEmpty(trim($data['idea_category'])) == '') {
            $errorString.='<li>Invalid idea category.</li>';
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
