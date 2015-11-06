<?php

class CommentModel extends AppModel
{    
    var $name='CommentModel';
    var $primaryKey = 'comment_id'; 
    public $useDbConfig ='test';
    var $useTable = 'comments';
}
?>
